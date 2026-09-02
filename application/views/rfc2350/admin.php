<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola RFC 2350</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">RFC 2350</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Upload Form -->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-upload"></i> Upload Dokumen Baru</h3>
                        </div>
                        
                        <?= form_open_multipart('rfc2350/admin_upload') ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="judul">Judul Dokumen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul" name="judul" 
                                       value="RFC 2350 — MuaraEnimKab-CSIRT" required>
                                <small class="text-muted">Contoh: RFC 2350 — MuaraEnimKab-CSIRT</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="versi">Versi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="versi" name="versi" 
                                       placeholder="1.0" required>
                                <small class="text-muted">Contoh: 1.0, 1.1, 2.0</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="tanggal_publikasi">Tanggal Publikasi <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                                          placeholder="Deskripsi singkat tentang dokumen ini">Deskripsi Tim Tanggap Insiden Siber Kabupaten Muara Enim</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="file_pdf">File PDF <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_pdf" name="file_pdf" 
                                           accept=".pdf" required>
                                    <label class="custom-file-label" for="file_pdf">Pilih file PDF...</label>
                                </div>
                                <small class="text-muted">Max. 20 MB, Format: PDF</small>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-upload"></i> Upload Dokumen
                            </button>
                        </div>
                        <?= form_close() ?>
                    </div>

                    <!-- Info Box -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi</h3>
                        </div>
                        <div class="card-body">
                            <ul class="small mb-0">
                                <li>Dokumen yang baru diupload akan otomatis menjadi <strong>aktif</strong></li>
                                <li>Dokumen lama akan menjadi <strong>arsip</strong></li>
                                <li>Hanya ada 1 dokumen aktif pada satu waktu</li>
                                <li>Dokumen aktif akan ditampilkan di halaman publik</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Preview -->
                    <?php if($rfc_aktif): ?>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-eye"></i> Lihat Halaman Publik</h3>
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('rfc2350') ?>" class="btn btn-success btn-block" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Buka Halaman RFC 2350
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Daftar Dokumen -->
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list"></i> Daftar Dokumen RFC 2350</h3>
                        </div>
                        <div class="card-body">
                            <?php if(empty($rfc_list)): ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Belum ada dokumen RFC 2350 yang diupload.
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Status</th>
                                                <th>Judul</th>
                                                <th>Versi</th>
                                                <th>Tanggal Publikasi</th>
                                                <th>Upload</th>
                                                <th>Ukuran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($rfc_list as $rfc): ?>
                                            <tr class="<?= $rfc->status == 'aktif' ? 'table-success' : '' ?>">
                                                <td>
                                                    <?php if($rfc->status == 'aktif'): ?>
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check-circle"></i> Aktif
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-archive"></i> Arsip
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <strong><?= htmlspecialchars($rfc->judul) ?></strong>
                                                    <?php if($rfc->deskripsi): ?>
                                                    <br><small class="text-muted"><?= htmlspecialchars($rfc->deskripsi) ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($rfc->versi) ?></td>
                                                <td><?= date('d M Y', strtotime($rfc->tanggal_publikasi)) ?></td>
                                                <td><small><?= date('d/m/Y H:i', strtotime($rfc->tanggal_upload)) ?></small></td>
                                                <td><?= number_format($rfc->ukuran_file / 1024, 2) ?> MB</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('assets/files/rfc2350/' . $rfc->nama_file) ?>" 
                                                           class="btn btn-info" target="_blank" title="Lihat PDF">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="<?= base_url('assets/files/rfc2350/' . $rfc->nama_file) ?>" 
                                                           class="btn btn-success" download title="Download">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <?php if($rfc->status != 'aktif'): ?>
                                                        <a href="<?= base_url('rfc2350/admin_set_aktif/' . $rfc->id) ?>" 
                                                           class="btn btn-warning" 
                                                           onclick="return confirm('Aktifkan dokumen ini?')"
                                                           title="Aktifkan">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        <?php endif; ?>
                                                        <a href="<?= base_url('rfc2350/admin_delete/' . $rfc->id) ?>" 
                                                           class="btn btn-danger" 
                                                           onclick="return confirm('Yakin ingin menghapus dokumen ini?')"
                                                           title="Hapus">
                                                            <i class="fas fa-trash"></i>
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
            </div>
        </div>
    </section>
</div>

<script>
// Update custom file input label
$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);
});
</script>
