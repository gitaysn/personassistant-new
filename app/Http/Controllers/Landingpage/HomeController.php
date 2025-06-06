<?php

namespace App\Http\Controllers\Landingpage;

use App\Models\Pakaian;
use App\Models\Kriteria;
use App\Models\QuizHistory;
use App\Models\SubKriteria;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\DataAlternatif;
use App\Models\PenilaianPakaian;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $subKriteria = SubKriteria::with('kriteria')->get()->groupBy(function ($item) {
            return $item->kriteria->nama_kriteria;
        });

        $pakaians = Pakaian::with('subKriterias')->get();

        return view('landingpage.master', [
            'subKriteria' => $subKriteria,
            'pakaians' => $pakaians
        ]);
    }
    public function prosesRekomendasi(Request $request)
    {
        // Input validation and processing
        $userInput = $this->processUserInput($request->input('sub_kriteria', []));

        if (empty($userInput)) {
            return $this->returnNoResults('Silakan pilih minimal satu kriteria.');
        }

        // \Log::debug('User Input:', $userInput);

        // Get selected subcriteria data
        $selectedSubkriteria = SubKriteria::whereIn('id', collect($userInput)->flatten())
            ->get()
            ->keyBy('id');

        // Extract criteria inputs
        $criteriaInputs = $this->extractCriteriaInputs($userInput, $selectedSubkriteria);

        // Apply strict filtering
        $filteredClothing = $this->applyStrictFiltering($criteriaInputs);

        if ($filteredClothing->isEmpty()) {
            return $this->returnNoResults('Tidak ada pakaian yang sesuai dengan kriteria yang Anda pilih.');
        }

        // Calculate recommendations using weighted scoring
        $recommendations = $this->calculateRecommendations($filteredClothing, $userInput);

        return view('landingpage.hasil', compact('recommendations'));
    }

    /**
     * Process and validate user input
     */
    private function processUserInput(array $userInput): array
    {
        $processedInput = [];

        foreach ($userInput as $kriteria_id => $subkriteria) {
            $subkriteriaArray = (array) $subkriteria;

            // Remove empty values and validate
            $cleanedSubkriteria = array_filter($subkriteriaArray, function($value) {
                return !empty($value) && is_numeric($value);
            });

            if (!empty($cleanedSubkriteria)) {
                $processedInput[$kriteria_id] = array_map('intval', $cleanedSubkriteria);
            }
        }

        return $processedInput;
    }

    /**
     * Extract and organize criteria inputs
     */
    private function extractCriteriaInputs(array $userInput, $selectedSubkriteria): array
    {
        $inputs = [
            'warna' => $userInput[1] ?? [],           // Criteria 1: Color
            'harga' => $userInput[2] ?? [],           // Criteria 2: Price
            'jenis_pakaian' => $userInput[3] ?? [],   // Criteria 3: Clothing Type
            'jenis_acara' => $userInput[4] ?? [],     // Criteria 4: Event Type
            'lokasi' => $userInput[5] ?? []           // Criteria 5: Location
        ];

        // Calculate price range if price criteria is selected
        if (!empty($inputs['harga'])) {
            $hargaRanges = $selectedSubkriteria->only($inputs['harga']);
            $inputs['harga_min'] = $hargaRanges->min('min_value');
            $inputs['harga_max'] = $hargaRanges->max('max_value');
        }

        // \Log::debug("Extracted Criteria Inputs:", $inputs);

        return $inputs;
    }

    /**
     * Apply strict filtering based on mandatory criteria
     */
    private function applyStrictFiltering(array $criteriaInputs)
    {
        $query = Pakaian::with(['penilaian.subkriteria.kriteria']);

        // Mandatory filter: Clothing Type (highest weight criteria)
        if (!empty($criteriaInputs['jenis_pakaian'])) {
            // \Log::debug('Applying clothing type filter:', $criteriaInputs['jenis_pakaian']);

            $query->whereHas('penilaian.subkriteria', function ($q) use ($criteriaInputs) {
                $q->where('kriteria_id', 3)
                ->whereIn('id', $criteriaInputs['jenis_pakaian']);
            });
        }

        // Mandatory filter: Price Range (if specified)
        if (isset($criteriaInputs['harga_min']) && isset($criteriaInputs['harga_max'])) {
            // \Log::debug("Applying price filter: {$criteriaInputs['harga_min']} - {$criteriaInputs['harga_max']}");

            $query->whereHas('penilaian.subkriteria', function ($q) use ($criteriaInputs) {
                $q->where('kriteria_id', 2)
                ->where('min_value', '<=', $criteriaInputs['harga_max'])
                ->where('max_value', '>=', $criteriaInputs['harga_min']);
            });
        }

        $filteredClothing = $query->get();

        // Validate filtering results
        $this->validateFilterResults($filteredClothing, $criteriaInputs);

        // \Log::debug('Filtered clothing count: ' . $filteredClothing->count());

        return $filteredClothing;
    }

    /**
     * Validate that filtering worked correctly
     */
    private function validateFilterResults($clothing, array $criteriaInputs): void
    {
        if (!empty($criteriaInputs['jenis_pakaian'])) {
            foreach ($clothing as $item) {
                $clothingTypeAssessment = $item->penilaian
                    ->where('subkriteria.kriteria_id', 3)
                    ->first();

                if (!$clothingTypeAssessment ||
                    !in_array($clothingTypeAssessment->sub_kriteria_id, $criteriaInputs['jenis_pakaian'])) {
                    // \Log::error("❌ Filter validation failed for clothing: {$item->nama}");
                }
            }
        }
    }

    /**
     * Calculate recommendations using SAW method
     */
    private function calculateRecommendations($clothing, array $userInput): \Illuminate\Support\Collection
    {
        // Get criteria with weights
        $criteria = Kriteria::with('subkriteria')
            ->whereIn('id', [1, 2, 3, 4, 5])
            ->orderByDesc('bobot') // Order by weight (highest first)
            ->get();

        // Build decision matrix
        $decisionMatrix = $this->buildDecisionMatrix($clothing, $criteria, $userInput);

        // Calculate min/max values for normalization
        $normalizationValues = $this->calculateNormalizationValues($decisionMatrix, $criteria);

        // Calculate preference scores
        $results = $this->calculatePreferenceScores(
            $clothing,
            $decisionMatrix,
            $criteria,
            $normalizationValues,
            $userInput
        );

        // Sort by score (descending)
        $recommendations = collect($results)
            ->sortByDesc('score')
            ->values();

        $this->logFinalRecommendations($recommendations);

        return $recommendations;
    }

    /**
     * Build decision matrix for each clothing item
     */
    private function buildDecisionMatrix($clothing, $criteria, array $userInput): array
    {
        $matrix = [];

        foreach ($clothing as $item) {
            $matrix[$item->id] = [];

            foreach ($criteria as $criterion) {
                $userSubIds = $userInput[$criterion->id] ?? [];

                if (empty($userSubIds)) {
                    continue; // Skip criteria not selected by user
                }

                // Get matching assessments for this criterion
                $matchingAssessments = $item->penilaian->filter(function ($assessment) use ($userSubIds) {
                    return in_array($assessment->sub_kriteria_id, $userSubIds);
                });

                if ($matchingAssessments->isNotEmpty()) {
                    // Use average if multiple matches, first match for clothing type
                    $value = ($criterion->id == 3)
                        ? $matchingAssessments->first()->nilai
                        : $matchingAssessments->avg('nilai');

                    $matrix[$item->id][$criterion->id] = $value;

                    // \Log::debug("Item {$item->id} - Criterion {$criterion->id}: {$value}");
                }
            }
        }

        return $matrix;
    }

    /**
     * Calculate min/max values for normalization
     */
    private function calculateNormalizationValues(array $decisionMatrix, $criteria): array
    {
        $values = ['max' => [], 'min' => []];

        foreach ($criteria as $criterion) {
            $criterionValues = collect($decisionMatrix)
                ->pluck($criterion->id)
                ->filter(function($value) {
                    return $value !== null && $value > 0;
                });

            if ($criterionValues->isNotEmpty()) {
                $values['max'][$criterion->id] = $criterionValues->max();
                $values['min'][$criterion->id] = $criterionValues->min();
            } else {
                // Fallback values
                $values['max'][$criterion->id] = 1;
                $values['min'][$criterion->id] = 1;
            }

            // \Log::debug("Criterion {$criterion->id} normalization - Max: {$values['max'][$criterion->id]}, Min: {$values['min'][$criterion->id]}");
        }

        return $values;
    }

    /**
     * Calculate final preference scores using SAW method
     */
    private function calculatePreferenceScores($clothing, array $decisionMatrix, $criteria, array $normValues, array $userInput): array
    {
        $results = [];

        foreach ($clothing as $item) {
            $preferenceScore = 0;
            $totalWeight = 0;

            foreach ($criteria as $criterion) {
                $userSubIds = $userInput[$criterion->id] ?? [];

                if (empty($userSubIds) || !isset($decisionMatrix[$item->id][$criterion->id])) {
                    continue;
                }

                $value = $decisionMatrix[$item->id][$criterion->id];

                if ($value <= 0) continue;

                // Normalize value based on criterion type
                $normalizedValue = $this->normalizeValue(
                    $value,
                    $normValues['max'][$criterion->id],
                    $normValues['min'][$criterion->id],
                    $criterion->jenis
                );

                // Calculate weighted contribution
                $weight = $criterion->bobot;
                $contribution = $normalizedValue * $weight;
                $preferenceScore += $contribution;
                $totalWeight += $weight;

                // \Log::debug("Item {$item->id} - Criterion {$criterion->id}: Value={$value}, Normalized={$normalizedValue}, Weight={$weight}, Contribution={$contribution}");
            }

            $clothingType = $item->penilaian
                ->firstWhere('subkriteria.kriteria_id', 3)
                ?->subkriteria->nama ?? 'Lainnya';

            $results[] = [
                'pakaian' => $item,
                'score' => round($preferenceScore, 4),
                'jenis_pakaian' => $clothingType,
                'total_weight' => $totalWeight
            ];

            // \Log::debug("📊 Final Score - Item {$item->id} ({$item->nama}): {$preferenceScore}");
        }

        return $results;
    }

    /**
     * Normalize value based on criterion type (BENEFIT/COST)
     */
    private function normalizeValue(float $value, float $max, float $min, string $type): float
    {
        if ($type === 'COST') {
            return $value > 0 ? $min / $value : 0;
        } else {
            return $max > 0 ? $value / $max : 0;
        }
    }

    /**
     * Log final recommendations
     */
    private function logFinalRecommendations($recommendations): void
    {
        // \Log::debug('🏆 FINAL RECOMMENDATIONS:');

        foreach ($recommendations as $index => $item) {
            $rank = $index + 1;
            // \Log::debug("{$rank}. {$item['pakaian']->nama} - Score: {$item['score']} - Type: {$item['jenis_pakaian']}");
        }
    }

    /**
     * Return view with no results message
     */
    private function returnNoResults(string $message)
    {
        return view('landingpage.hasil', [
            'recommendations' => collect([]),
            'message' => $message
        ]);
    }

}
