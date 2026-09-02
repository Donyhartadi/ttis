<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan Kontak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengaturan Kontak</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Kontak</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditKontak">
                                    <i class="fas fa-edit"></i> Edit Data
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Email</h6>
                                    <p class="lead"><?= !empty($kontak->email) ? htmlspecialchars($kontak->email) : '<span class="text-muted">-</span>' ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Jam Operasional</h6>
                                    <p class="lead"><?= !empty($kontak->jam_operasional) ? nl2br(htmlspecialchars($kontak->jam_operasional)) : '<span class="text-muted">-</span>' ?></p>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6 class="text-muted">Alamat Kantor</h6>
                            <p><?= !empty($kontak->alamat) ? nl2br(htmlspecialchars($kontak->alamat)) : '<span class="text-muted">-</span>' ?></p>
                            
                            <hr>
                            
                            <h6 class="text-muted">Koordinat Lokasi (Latitude / Longitude)</h6>
                            <p>
                                <strong>Latitude:</strong> <?= !empty($kontak->latitude) ? htmlspecialchars($kontak->latitude) : '<span class="text-muted">-</span>' ?><br>
                                <strong>Longitude:</strong> <?= !empty($kontak->longitude) ? htmlspecialchars($kontak->longitude) : '<span class="text-muted">-</span>' ?>
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <a href="<?= base_url('kontak') ?>" class="btn btn-info px-4" target="_blank">
                                <i class="fas fa-eye"></i> Lihat Halaman Publik
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Menu Kontak</h3>
                        </div>
                        <div class="card-body">
                            <a href="<?= base_url('kontak/admin_operator') ?>" class="btn btn-success btn-block mb-2">
                                <i class="fab fa-whatsapp"></i> Kelola Operator
                            </a>
                            <a href="<?= base_url('kontak/admin_dokumen') ?>" class="btn btn-warning btn-block mb-2">
                                <i class="fas fa-file-pdf"></i> Kelola Dokumen
                            </a>
                            <a href="<?= base_url('kontak/admin_publickey') ?>" class="btn btn-secondary btn-block">
                                <i class="fas fa-key"></i> Kelola Public Key
                            </a>
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Bantuan</h3>
                        </div>
                        <div class="card-body">
                            <h6><i class="fas fa-info-circle"></i> Cara mendapatkan Koordinat:</h6>
                            <ol class="small">
                                <li>Buka Google Maps</li>
                                <li>Cari lokasi kantor Anda</li>
                                <li>Klik kanan pada lokasi</li>
                                <li>Klik koordinat yang muncul</li>
                                <li>Copy dan paste ke form</li>
                            </ol>
                            
                            <p class="small text-muted mt-2">
                                <i class="fas fa-map-marked-alt"></i> Peta menggunakan OpenStreetMap (gratis, tidak perlu API key)
                            </p>
                        </div>
                    </div>

                    <?php if(!empty($kontak->latitude) && !empty($kontak->longitude)): ?>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Preview Peta</h3>
                        </div>
                        <div class="card-body p-0">
                            <div id="map" style="height: 300px;"></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Edit Kontak -->
<div class="modal fade" id="modalEditKontak" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= form_open('kontak/admin_update') ?>
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Informasi Kontak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?= isset($kontak->email) ? $kontak->email : '' ?>" 
                           placeholder="contoh@email.com">
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat Kantor</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                              placeholder="Alamat lengkap kantor"><?= isset($kontak->alamat) ? $kontak->alamat : '' ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="jam_operasional">Jam Operasional</label>
                    <textarea class="form-control" id="jam_operasional" name="jam_operasional" rows="3" 
                              placeholder="Contoh: Senin - Jumat: 08.00 - 16.00"><?= isset($kontak->jam_operasional) ? $kontak->jam_operasional : '' ?></textarea>
                </div>
                
                <hr>
                <h6><i class="fas fa-map"></i> Koordinat Peta Lokasi</h6>
                <div class="alert alert-info small">
                    <strong>OpenStreetMap (100% Gratis!)</strong><br>
                    Tidak perlu API Key. Dapatkan koordinat dari Google Maps.
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" 
                                   value="<?= isset($kontak->latitude) ? $kontak->latitude : '' ?>" 
                                   placeholder="-6.2088">
                            <small class="text-muted">Contoh: -6.2088</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" 
                                   value="<?= isset($kontak->longitude) ? $kontak->longitude : '' ?>" 
                                   placeholder="106.8456">
                            <small class="text-muted">Contoh: 106.8456</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<?php if(!empty($kontak->latitude) && !empty($kontak->longitude)): ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var mapEl = document.getElementById('map');
    if (mapEl) {
        var map = L.map('map').setView([<?= $kontak->latitude ?>, <?= $kontak->longitude ?>], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);
        
        L.marker([<?= $kontak->latitude ?>, <?= $kontak->longitude ?>])
            .addTo(map)
            .bindPopup('<strong>Lokasi Kantor</strong>')
            .openPopup();
    }
});
</script>
<?php endif; ?>
