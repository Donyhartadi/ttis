<!-- Tambahkan style Tailwind jika belum -->


<div class="max-w-6xl mx-auto mt-10 px-">

  <?php if ($this->session->flashdata('success')): ?>
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
      <?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?>

  <div class="grid md:grid-cols-1 lg:grid-cols-4 gap-6">
    <?php foreach ($berita as $b): ?>
      <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all overflow-hidden flex flex-col">
        <?php if ($b->gambar): ?>
          <img src="<?= base_url('assets/uploads/berita/' . $b->gambar) ?>" class="w-full h-48 object-cover" alt="<?= $b->judul ?>">

        <?php else: ?>
          <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">Tidak ada gambar</div>
        <?php endif; ?>
        
        <div class="p-4 flex-1 flex flex-col justify-between">
          <div>
            <h2 class="text-lg font-semibold mb-1 text-gray-900 line-clamp-2"><?= $b->judul ?></h2>
            <p class="text-sm text-gray-500 mb-2"><?= date('d M Y', strtotime($b->tanggal)) ?> | <?= $b->kategori ?></p>
            <p class="text-gray-700 mb-3 text-sm line-clamp-3"><?= word_limiter($b->ringkasan ?: $b->isi, 20) ?></p>
          </div>

          <div class="flex justify-between items-center mt-auto">
            <a href="<?= site_url('welcome/detail/' . $b->slug) ?>" class="text-blue-600 hover:underline text-sm">Baca selengkapnya →</a>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div>
