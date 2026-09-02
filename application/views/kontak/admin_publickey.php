<div class="content-wrapper" style="background:var(--cyber-bg1);min-height:calc(100vh - 3.5rem);">
    <section class="content-header" style="padding:1.5rem 1rem;border-bottom:1px solid var(--cyber-border);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 style="color:var(--cyber-primary);font-family:var(--font-mono);margin:0;">
                        <i class="fas fa-key"></i> Kelola PGP Public Key
                    </h3>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpload">
                        <i class="fas fa-upload"></i> Upload Public Key
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="content" style="padding:1.5rem 1rem;">
        <div class="container-fluid">
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Tabel Public Keys -->
            <div class="card">
                <div class="card-header" style="background:var(--cyber-bg2);border-bottom:1px solid var(--cyber-border);">
                    <h5 style="color:var(--cyber-text);font-family:var(--font-mono);margin:0;">
                        <i class="fas fa-list"></i> Daftar PGP Public Key
                    </h5>
                </div>
                <div class="card-body" style="background:var(--cyber-bg2);">
                    <?php if(empty($publickeys)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Belum ada public key yang diupload.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover" style="color:var(--cyber-text);">
                                <thead style="background:var(--cyber-bg3);border-bottom:2px solid var(--cyber-border);">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Judul</th>
                                        <th width="30%">Deskripsi</th>
                                        <th width="15%">File</th>
                                        <th width="10%">Ukuran</th>
                                        <th width="10%">Download</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($publickeys as $index => $pk): ?>
                                    <tr style="border-bottom:1px solid var(--cyber-border);">
                                        <td><?= $index + 1 ?></td>
                                        <td><strong><?= htmlspecialchars($pk->judul) ?></strong></td>
                                        <td><small><?= $pk->deskripsi ? htmlspecialchars($pk->deskripsi) : '-' ?></small></td>
                                        <td>
                                            <small class="font-monospace text-muted"><?= $pk->nama_file ?></small>
                                        </td>
                                        <td><?= number_format($pk->ukuran_file) ?> KB</td>
                                        <td>
                                            <span class="badge bg-info"><?= $pk->jumlah_download ?></span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('assets/uploads/kontak/publickey/' . $pk->nama_file) ?>" 
                                                   target="_blank" class="btn btn-info px-3 py-2" title="Lihat">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <a href="<?= base_url('kontak/admin_publickey_delete/' . $pk->id) ?>" 
                                                   class="btn btn-danger px-3 py-2" title="Hapus"
                                                   onclick="return confirm('Hapus public key ini?')">
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
    </section>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="modalUpload" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open_multipart('kontak/admin_publickey_upload') ?>
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Upload PGP Public Key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info small">
                    <i class="fas fa-info-circle"></i> Upload file PGP public key untuk komunikasi terenkripsi.
                    Format: .asc, .gpg, .txt, .key, .pgp (Max: 1 MB)
                </div>
                
                <div class="form-group mb-3">
                    <label>Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="judul" required 
                           placeholder="Contoh: PGP Public Key TTIS">
                </div>
                
                <div class="form-group mb-3">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="2" 
                              placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>
                
                <div class="form-group mb-3">
                    <label>File Public Key <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="file_publickey" required
                           accept=".asc,.gpg,.txt,.key,.pgp">
                    <small class="text-muted">Format: .asc, .gpg, .txt, .key, .pgp (Max: 1 MB)</small>
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

