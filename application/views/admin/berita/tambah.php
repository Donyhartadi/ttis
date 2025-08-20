<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-3xl mx-auto mt-10 px-4">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Berita</h2>

  <?php if (isset($error)) : ?>
    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-4"><?= $error ?></div>
  <?php endif; ?>

  <form action="<?= site_url('admin/berita/simpan') ?>" method="post" enctype="multipart/form-data" class="space-y-5 bg-white p-6 rounded-lg shadow-md">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
      <input type="text" name="judul" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:outline-none" required>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
      <input type="text" name="kategori" class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
      <textarea name="isi" rows="6" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
      <input type="file" name="gambar" class="w-full text-sm text-gray-700">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 shadow text-sm">Simpan</button>
    <a href="<?= site_url('admin/berita') ?>" class="t_
