<!-- Container -->
<div class="max-w-6xl mx-auto mt-10 px-4">

  <!-- Notifikasi Sukses -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="mb-6 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-700 shadow-sm">
      <?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?>

  <!-- Grid Berita -->
  <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    <?php foreach ($berita as $b): ?>
      <article class="flex flex-col overflow-hidden rounded-lg bg-white shadow-md transition hover:shadow-lg">
        
        <!-- Gambar -->
        <?php if ($b->gambar): ?>
          <img src="<?= base_url('assets/uploads/berita/' . $b->gambar) ?>" 
               alt="<?= $b->judul ?>" 
               class="h-48 w-full object-cover">
        <?php else: ?>
          <div class="flex h-48 w-full items-center justify-center bg-gray-200 text-sm text-gray-500">
            Tidak ada gambar
          </div>
        <?php endif; ?>
        
        <!-- Konten -->
        <div class="flex flex-1 flex-col justify-between p-4">
          <div>
            <h2 class="mb-1 line-clamp-2 text-lg font-semibold text-gray-900"><?= $b->judul ?></h2>
            <p class="mb-2 text-sm text-gray-500">
              <?= date('d M Y', strtotime($b->tanggal)) ?> | <?= $b->kategori ?>
            </p>
            <p class="mb-3 line-clamp-3 text-sm text-gray-700">
              <?= word_limiter($b->ringkasan ?: $b->isi, 20) ?>
            </p>
          </div>

          <!-- Link -->
          <div class="mt-auto">
            <a href="<?= site_url('welcome/detail/' . $b->slug) ?>" 
               class="text-sm font-medium text-blue-600 hover:underline">
              Baca selengkapnya →
            </a>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>
