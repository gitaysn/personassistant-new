<section class="py-5" id="pilihpakaian">
    <div class="container my-5">
        <form method="POST" action="{{ route('proses.rekomendasi') }}">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Pilih Pakaian Anda</h5>
                        <p class="text-muted">Untuk mendapatkan rekomendasi pakaian yang sesuai dengan preferensi Anda.</p>
                    </div>

                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5 bg-light">

                            <!-- Progress Bar -->
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 20%;" id="progressBar"></div>
                            </div>

                            @php
                                $steps = [
                                    'Jenis Pakaian' => $subKriteria['Jenis Pakaian'] ?? [],
                                    'Harga' => $subKriteria['Harga'] ?? [],
                                    'Jenis Acara' => $subKriteria['Jenis Acara'] ?? [],
                                    'Warna Pakaian' => $subKriteria['Warna Pakaian'] ?? [],
                                    'Lokasi Acara' => $subKriteria['Lokasi Acara'] ?? [],
                                ];

                                $multiAnswerKriteria = ['Jenis Acara', 'Warna Pakaian', 'Lokasi Acara'];
                                $stepIndex = 1;
                            @endphp

                            @foreach ($steps as $label => $subs)
                                <div class="step {{ $stepIndex === 1 ? 'active' : '' }}" id="step-{{ $stepIndex }}">
                                    <h5 class="fw-bold mb-3">Pilih {{ strtolower($label) }}:</h5>

                                    @foreach ($subs as $sub)
                                        <div class="form-check mb-2">
                                            @php
                                                $isMultiple = in_array($label, $multiAnswerKriteria);
                                                $inputType = $isMultiple ? 'checkbox' : 'radio';
                                                $nameAttr = $isMultiple ? "sub_kriteria[{$sub->kriteria_id}][]" : "sub_kriteria[{$sub->kriteria_id}]";
                                            @endphp
                                            <input class="form-check-input" type="{{ $inputType }}" id="sub_{{ $sub->id }}"
                                                name="{{ $nameAttr }}" value="{{ $sub->id }}">
                                            <label class="form-check-label" for="sub_{{ $sub->id }}">
                                                {{ $sub->nama_sub }}
                                            </label>
                                        </div>
                                    @endforeach

                                    <div class="mt-4">
                                        @if ($stepIndex > 1)
                                            <button type="button" class="btn btn-secondary me-2" onclick="prevStep()">Kembali</button>
                                        @endif
                                        @if ($stepIndex < count($steps))
                                            <button type="button" class="btn btn-primary" onclick="nextStep()">Selanjutnya</button>
                                        @else
                                            <button type="submit" class="btn btn-success">Lihat Rekomendasi</button>
                                        @endif
                                    </div>
                                </div>
                                @php $stepIndex++; @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Script Multi-Step -->
    <script>
        let currentStep = 1;
        const totalSteps = {{ count($steps) }};

        function showStep(step) {
            for (let i = 1; i <= totalSteps; i++) {
                document.getElementById(`step-${i}`).classList.remove('active');
            }
            document.getElementById(`step-${step}`).classList.add('active');
            updateProgressBar(step);
        }

        function nextStep() {
            const currentInputs = document.querySelectorAll(`#step-${currentStep} input`);
            const isAnswered = Array.from(currentInputs).some(input => input.checked);

            if (!isAnswered) {
                alert("Silakan pilih minimal satu opsi terlebih dahulu.");
                return;
            }

            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function updateProgressBar(step) {
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = (step / totalSteps) * 100 + '%';
        }

        showStep(currentStep);
    </script>
</section>
