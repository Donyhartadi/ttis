<div class="container mx-auto px-1 max-w-3xl mt-3">

  <!-- Judul -->
  <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-snug mb-2">
    <?= $berita->judul ?>
  </h1>

  <!-- Meta -->
  <div class="text-sm text-gray-500 mb-4">
    [BERITA] · <?= date('d M Y', strtotime($berita->tanggal)) ?> · <?= $berita->kategori ?>
  </div>
  <hr class="mb-6">

  <!-- Gambar -->
  <?php if (!empty($berita->gambar)) : ?>
    <div class="mb-6 rounded-lg overflow-hidden">
      <img 
        src="<?= base_url('assets/uploads/berita/' . $berita->gambar) ?>" 
        alt="<?= $berita->judul ?>" 
        class="w-full max-w-full h-auto rounded-lg object-cover mx-auto"
        style="max-height: 480px;"
      />
    </div>
  <?php endif; ?><hr>

  <!-- Penulis -->
  <div class="text-sm text-gray-700 font-medium mb-4">
    Tim Persandian dan Kemanan Informasi 
  </div>

  <!-- Isi Berita -->
  <div class="text-gray-800 text-base md:text-lg leading-relaxed" style="text-align: justify;">
  <?= nl2br($berita->isi) ?>
</div>

</div>
