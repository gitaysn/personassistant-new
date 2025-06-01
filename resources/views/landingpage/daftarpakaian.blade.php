@php use Illuminate\Support\Str; @endphp

<section class="py-3 bg-white" id="daftarpakaian">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 mb-3">
        <h2 class="fw-bold">Daftar Pakaian</h2>
        <p class="text-muted">
          Temukan beragam busana seperti dress, blouse, cardigan, celana, dan rok. Dirancang dengan berbagai model dan warna, cocok untuk gaya kasual hingga acara khusus.
        </p>
      </div>
    </div>

    @php
      $kategoriList = ['Dress', 'Blouse', 'Cardigan', 'Rok', 'Celana'];
    @endphp

    {{-- Tombol filter --}}
    <div class="d-flex justify-content-center mb-4 flex-wrap gap-2">
      <button class="btn btn-outline-primary btn-sm filter-btn active" data-kategori="all">Semua</button>
      @foreach ($kategoriList as $kategori)
        <button class="btn btn-outline-secondary btn-sm filter-btn" data-kategori="{{ strtolower($kategori) }}">{{ $kategori }}</button>
      @endforeach
    </div>

    {{-- Daftar pakaian --}}
    <div class="row g-2" id="pakaian-list">
      @foreach ($pakaians as $pakaian)
        @php
          $kategoriSub = $pakaian->subKriterias->firstWhere('kriteria_id', 3);
          $kategori = $kategoriSub ? Str::lower($kategoriSub->nama_sub) : null;
        @endphp
        @if ($kategori)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 pakaian-item kategori-{{ $kategori }}">
          <div class="card h-100 border-0 shadow-sm"
            data-nama="{{ $pakaian->nama_pakaian }}"
            data-img="{{ $pakaian->img ? asset($pakaian->img) : '' }}"
            data-harga="Rp{{ number_format($pakaian->harga, 0, ',', '.') }}"
            data-deskripsi="{{ $pakaian->deskripsi }}"
            onclick="showDetailModal(this)">

          @if ($pakaian->img && file_exists(public_path($pakaian->img)))
            <img src="{{ asset($pakaian->img) }}" class="card-img-top" alt="{{ $pakaian->nama_pakaian }}" style="height: 150px; object-fit: cover;">
          @else
            <div class="bg-light d-flex align-items-center justify-content-center" style="height:150px;">
              <span class="text-muted small">Gambar tidak tersedia</span>
            </div>
          @endif

          <div class="card-body p-2">
            <p class="card-title mb-1 fw-semibold small" style="font-size: 0.85rem;">
              {{ Str::limit($pakaian->nama_pakaian, 35) }}
            </p>
            <p class="fw-bold text-danger mb-0" style="font-size: 0.9rem;">
              Rp{{ number_format($pakaian->harga, 0, ',', '.') }}
            </p>
            @if ($pakaian->deskripsi)
              <p class="text-muted mb-0" style="font-size: 0.75rem;">
                {{ Str::limit($pakaian->deskripsi, 50) }}
              </p>
            @endif
          </div>
        </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
</section>

{{-- Modal Detail --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="detailModalLabel">Detail Pakaian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-5">
            <img id="modal-img" src="" class="img-fluid rounded shadow" alt="Gambar Pakaian">
          </div>
          <div class="col-md-7">
            <h5 id="modal-nama" class="fw-semibold mb-2"></h5>
            <p id="modal-harga" class="text-danger fw-bold fs-5 mb-2"></p>
            <p id="modal-deskripsi" class="text-muted"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script filter kategori --}}
<script>
  document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', () => {
      const kategori = button.getAttribute('data-kategori');
      document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      document.querySelectorAll('.pakaian-item').forEach(item => item.style.display = 'none');
      if (kategori === 'all') {
        document.querySelectorAll('.pakaian-item').forEach(item => item.style.display = 'block');
      } else {
        document.querySelectorAll(`.kategori-${kategori}`).forEach(item => item.style.display = 'block');
      }
    });
  });

  function showDetailModal(card) {
    const nama = card.getAttribute('data-nama');
    const img = card.getAttribute('data-img');
    const harga = card.getAttribute('data-harga');
    const deskripsi = card.getAttribute('data-deskripsi') || 'Tidak ada deskripsi.';

    document.getElementById('modal-nama').textContent = nama;
    document.getElementById('modal-img').src = img || '';
    document.getElementById('modal-harga').textContent = harga;
    document.getElementById('modal-deskripsi').textContent = deskripsi;

    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
  }
</script>
