<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Dokumen Download</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('kontak/admin_setting') ?>">Kontak</a></li>
                        <li class="breadcrumb-item active">Dokumen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Dokumen</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpload">
                                    <i class="fas fa-upload"></i> Upload Dokumen
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(empty($dokumen)): ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Belum ada dokumen yang diupload.
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">No</th>
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th>Ukuran</th>
                                                <th>Download</th>
                                                <th>Tanggal</th>
                                                <th style="width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($dokumen as $index => $doc): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <i class="fas fa-file-pdf text-danger"></i>
                                                    <?= htmlspecialchars($doc->judul) ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($doc->deskripsi) {
                                                        $desc = htmlspecialchars($doc->deskripsi);
                                                        echo strlen($desc) > 50 ? substr($desc, 0, 50) . '...' : $desc;
                                                    } else {
                                                        echo '<span class="text-muted">-</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if($doc->ukuran_file): ?>
                                                        <?= number_format($doc->ukuran_file / 1024, 2) ?> MB
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info"><?= $doc->jumlah_download ?>x</span>
                                                </td>
                                                <td><?= date('d/m/Y', strtotime($doc->tanggal_upload)) ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?= base_url('kontak/download/' . $doc->id) ?>" 
                                                           class="btn btn-success px-3 py-2" target="_blank"
                                                           title="Download">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                        <a href="<?= base_url('kontak/admin_dokumen_delete/' . $doc->id) ?>" 
                                                           class="btn btn-danger px-3 py-2"
                                                           onclick="return confirm('Yakin ingin menghapus dokumen ini?')"
                                                           title="Hapus">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informasi</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Dokumen</strong> yang diupload akan ditampilkan di halaman kontak publik.</p>
                            <p>Pengunjung bisa mendownload dokumen tersebut.</p>
                            
                            <hr>
                            
                            <h6><i class="fas fa-info-circle"></i> Ketentuan Upload:</h6>
                            <ul class="small">
                                <li>Format: PDF</li>
                                <li>Maksimal ukuran: 10 MB</li>
                                <li>Judul harus diisi</li>
                                <li>Deskripsi optional</li>
                            </ul>
                            
                            <hr>
                            
                            <h6><i class="fas fa-lightbulb"></i> Contoh Dokumen:</h6>
                            <ul class="small">
                                <li>Panduan Pelaporan</li>
                                <li>SOP Penanganan Insiden</li>
                                <li>Form Pelaporan</li>
                                <li>Dokumen Kebijakan</li>
                            </ul>
                            
                            <hr>
                            
                            <a href="<?= base_url('kontak/admin_setting') ?>" class="btn btn-primary btn-block">
                                <i class="fas fa-arrow-left"></i> Kembali ke Pengaturan
                            </a>
                            <a href="<?= base_url('kontak') ?>" class="btn btn-info btn-block" target="_blank">
                                <i class="fas fa-eye"></i> Lihat Halaman Publik
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="modalUpload" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= form_open_multipart('kontak/admin_dokumen_upload') ?>
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Upload Dokumen Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Dokumen <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="judul" required 
                           placeholder="Contoh: Panduan Pelaporan Insiden Siber">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3"
                              placeholder="Deskripsi singkat tentang dokumen ini (opsional)"></textarea>
                </div>
                <div class="form-group">
                    <label>File PDF <span class="text-danger">*</span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_pdf" name="file_pdf" 
                               accept=".pdf" required>
                        <label class="custom-file-label" for="file_pdf">Pilih file...</label>
                    </div>
                    <small class="text-muted">Maksimal ukuran: 10 MB, Format: PDF</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-upload"></i> Upload
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
// Update label file input saat file dipilih
document.getElementById('file_pdf').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var label = e.target.nextElementSibling;
    label.textContent = fileName;
});
</script>
