<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Operator WhatsApp</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('kontak/admin_setting') ?>">Kontak</a></li>
                        <li class="breadcrumb-item active">Operator</li>
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
                            <h3 class="card-title">Daftar Operator</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                    <i class="fas fa-plus"></i> Tambah Operator
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(empty($operators)): ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Belum ada operator yang ditambahkan.
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>No WhatsApp</th>
                                                <th>Urutan</th>
                                                <th style="width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($operators as $index => $op): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($op->nama) ?></td>
                                                <td><?= htmlspecialchars($op->jabatan) ?></td>
                                                <td>
                                                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $op->no_whatsapp) ?>" 
                                                       target="_blank" class="text-success">
                                                        <i class="fab fa-whatsapp"></i> <?= htmlspecialchars($op->no_whatsapp) ?>
                                                    </a>
                                                </td>
                                                <td><?= $op->urutan ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-info px-3 py-2" 
                                                                data-bs-toggle="modal" data-bs-target="#modalEdit<?= $op->id ?>">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <a href="<?= base_url('kontak/admin_operator_delete/' . $op->id) ?>" 
                                                           class="btn btn-danger px-3 py-2"
                                                           onclick="return confirm('Yakin ingin menghapus operator ini?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEdit<?= $op->id ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <?= form_open('kontak/admin_operator_edit/' . $op->id) ?>
                                                        <div class="modal-header bg-info">
                                                            <h5 class="modal-title">Edit Operator</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="nama" 
                                                                       value="<?= htmlspecialchars($op->nama) ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jabatan</label>
                                                                <input type="text" class="form-control" name="jabatan" 
                                                                       value="<?= htmlspecialchars($op->jabatan) ?>" 
                                                                       placeholder="Contoh: Staff IT">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nomor WhatsApp <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="no_whatsapp" 
                                                                       value="<?= htmlspecialchars($op->no_whatsapp) ?>" required
                                                                       placeholder="Contoh: 628123456789">
                                                                <small class="text-muted">Format: 628xxx (gunakan 62 untuk Indonesia)</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Urutan Tampil</label>
                                                                <input type="number" class="form-control" name="urutan" 
                                                                       value="<?= $op->urutan ?>" min="0">
                                                                <small class="text-muted">Urutan tampil di halaman publik (dari terkecil)</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-info">
                                                                <i class="fas fa-save"></i> Simpan
                                                            </button>
                                                        </div>
                                                        <?= form_close() ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Informasi</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Kontak operator</strong> akan ditampilkan di halaman publik dengan tombol WhatsApp.</p>
                            <p>Pengunjung bisa langsung chat dengan operator dengan sekali klik.</p>
                            
                            <hr>
                            
                            <h6><i class="fas fa-info-circle"></i> Format Nomor WhatsApp:</h6>
                            <ul class="small">
                                <li><strong>Benar:</strong> 628123456789</li>
                                <li><strong>Benar:</strong> 62-812-3456-789</li>
                                <li><strong>Salah:</strong> 08123456789 (harus gunakan 62)</li>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open('kontak/admin_operator_add') ?>
            <div class="modal-header bg-success">
                <h5 class="modal-title">Tambah Operator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" required 
                           placeholder="Nama operator">
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" 
                           placeholder="Contoh: Staff IT, Helpdesk">
                </div>
                <div class="form-group">
                    <label>Nomor WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_whatsapp" required
                           placeholder="Contoh: 628123456789">
                    <small class="text-muted">Format: 628xxx (gunakan 62 untuk Indonesia)</small>
                </div>
                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" class="form-control" name="urutan" value="0" min="0">
                    <small class="text-muted">Urutan tampil di halaman publik (dari terkecil)</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
