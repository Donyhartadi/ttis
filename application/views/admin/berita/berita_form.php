<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="w-full max-w-5xl mx-auto mt-12 px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-xl rounded-xl px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">
      <?= isset($berita) ? 'Edit' : 'Tambah' ?> Berita
    </h1>

    <?= form_open_multipart() ?>
    
      <!-- Judul -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
        <input type="text" name="judul" value="<?= isset($berita) ? $berita->judul : '' ?>" 
          class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
          placeholder="Masukkan judul berita" required>
      </div>

      <!-- Kategori -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
        <input type="text" name="kategori" value="<?= isset($berita) ? $berita->kategori : '' ?>" 
          class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
          placeholder="Misal: Keamanan Siber" required>
      </div>

      <!-- Isi -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
        <textarea name="isi" rows="8" 
          class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Tulis isi lengkap berita di sini..."><?= isset($berita) ? $berita->isi : '' ?></textarea>
      </div>

      <!-- Gambar -->
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar (opsional)</label>
        <input type="file" name="gambar" 
          class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700">

        <?php if (!empty($berita->gambar)): ?>
          <div class="mt-3">
            <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
            <img src="<?= base_url('assets/uploads/berita/' . $berita->gambar) ?>" alt="Gambar Berita" class="w-64 rounded shadow">
          </div>
        <?php endif; ?>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex items-center mt-8">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition">
          Simpan
        </button>
        <a href="<?= site_url('berita') ?>" class="ml-4 text-gray-600 hover:underline">Batal / Kembali</a>
      </div>

    <?= form_close() ?>
  </div>
</div>
