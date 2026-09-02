<!-- === KONTAK PAGE - CYBER THEME === -->
<div class="cyber-grid-bg" style="min-height: 100vh; padding: 3rem 0;">
    <div class="container" style="max-width:1200px;">
        
        <!-- Breadcrumb -->
        <nav style="margin-bottom:2rem;">
            <small style="font-family:var(--font-mono);color:var(--cyber-text-dim);font-size:0.75rem;letter-spacing:1px;">
                <a href="<?= base_url() ?>" style="color:var(--cyber-cyan);text-decoration:none;">Beranda</a>
                <span style="margin:0 .5rem;opacity:.4;">/</span>
                <span style="color:var(--cyber-text);">Kontak</span>
            </small>
        </nav>

        <!-- PGP Public Keys -->
        <?php if(!empty($publickeys)): ?>
        <style>
            @keyframes glow-pulse {
                0%, 100% { 
                    box-shadow: 0 0 15px rgba(168,85,247,0.4), 0 0 30px rgba(168,85,247,0.2), inset 0 0 15px rgba(168,85,247,0.1);
                    border-color: rgba(168,85,247,0.6);
                }
                50% { 
                    box-shadow: 0 0 25px rgba(168,85,247,0.6), 0 0 50px rgba(168,85,247,0.4), inset 0 0 20px rgba(168,85,247,0.15);
                    border-color: rgba(168,85,247,0.9);
                }
            }
            .pgp-glow-card {
                animation: glow-pulse 2s ease-in-out infinite;
            }
        </style>
        <div class="mb-5">
            <div style="margin-bottom:1.5rem;text-align:center;">
                <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-purple);letter-spacing:2px;margin-bottom:0.5rem;">
                    <i class="bi bi-circle-fill me-2" style="font-size:0.4rem;"></i>KEAMANAN KOMUNIKASI
                </div>
                <h2 style="font-family:var(--font-display);color:var(--cyber-text);font-size:1.8rem;margin:0;">
                    <span style="color:var(--cyber-purple);">PGP</span> Public Key
                </h2>
            </div>
            
            <div class="cyber-card pgp-glow-card" style="background:linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.05));border:2px solid rgba(168,85,247,0.6);border-radius:8px;padding:2rem;position:relative;max-width:800px;margin:0 auto;">
                <!-- Badge Indicator -->
                <div style="position:absolute;top:-10px;right:25px;background:linear-gradient(135deg,var(--cyber-purple),#a855f7);color:white;padding:0.35rem 0.75rem;border-radius:20px;font-size:0.7rem;font-family:var(--font-mono);font-weight:600;letter-spacing:1px;box-shadow:0 4px 10px rgba(168,85,247,0.4);">
                    <i class="bi bi-shield-lock-fill"></i> SECURE
                </div>

                <div class="text-center">
                    <?php foreach($publickeys as $pk): ?>
                    <a href="<?= base_url('kontak/download_publickey/' . $pk->id) ?>" 
                       class="btn d-inline-block mb-2" 
                       style="background:linear-gradient(135deg,var(--cyber-purple),#a855f7);color:white;border:none;border-radius:8px;padding:0.85rem 2rem;font-family:var(--font-mono);font-weight:600;font-size:0.95rem;text-decoration:none;transition:all 0.3s ease;box-shadow:0 4px 15px rgba(168,85,247,0.3);"
                       onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 25px rgba(168,85,247,0.5)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(168,85,247,0.3)'">
                        <i class="bi bi-download me-2"></i><?= htmlspecialchars($pk->judul) ?>
                    </a>
                    <?php endforeach; ?>
                    <div style="margin-top:1rem;color:var(--cyber-text-dim);font-size:0.85rem;font-family:var(--font-mono);">
                        <i class="bi bi-shield-check"></i> Komunikasi terenkripsi end-to-end
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Info Kontak & Maps -->
        <div class="mb-5">
            <div style="margin-bottom:2rem;">
                <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:0.5rem;">
                    <i class="bi bi-circle-fill me-2" style="font-size:0.4rem;"></i>INFORMASI KONTAK
                </div>
            </div>

            <div class="row g-4">
                <!-- Info Cards (Kiri) -->
                <div class="col-lg-5">
                    <!-- Email -->
                    <div class="cyber-card mb-3" style="background:var(--cyber-card);border:1px solid rgba(0,212,255,0.3);border-radius:8px;padding:1.5rem;">
                        <div class="d-flex align-items-center">
                            <div style="width:50px;height:50px;background:rgba(0,212,255,0.1);border:1px solid var(--cyber-cyan);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:1rem;flex-shrink:0;">
                                <i class="bi bi-envelope-at" style="color:var(--cyber-cyan);font-size:1.5rem;"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--cyber-cyan);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem;">
                                    Email
                                </div>
                                <div style="color:var(--cyber-text);font-size:0.95rem;word-break:break-all;">
                                    <?= !empty($kontak->email) ? $kontak->email : '<span style="color:var(--cyber-text-dim);">Belum diatur</span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="cyber-card mb-3" style="background:var(--cyber-card);border:1px solid rgba(0,255,136,0.3);border-radius:8px;padding:1.5rem;">
                        <div class="d-flex align-items-start">
                            <div style="width:50px;height:50px;background:rgba(0,255,136,0.1);border:1px solid var(--cyber-green);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:1rem;flex-shrink:0;">
                                <i class="bi bi-geo-alt" style="color:var(--cyber-green);font-size:1.5rem;"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--cyber-green);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem;">
                                    Alamat
                                </div>
                                <div style="color:var(--cyber-text);font-size:0.95rem;line-height:1.6;">
                                    <?= !empty($kontak->alamat) ? nl2br($kontak->alamat) : '<span style="color:var(--cyber-text-dim);">Belum diatur</span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="cyber-card" style="background:var(--cyber-card);border:1px solid rgba(255,176,32,0.3);border-radius:8px;padding:1.5rem;">
                        <div class="d-flex align-items-start">
                            <div style="width:50px;height:50px;background:rgba(255,176,32,0.1);border:1px solid var(--cyber-amber);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:1rem;flex-shrink:0;">
                                <i class="bi bi-clock-history" style="color:var(--cyber-amber);font-size:1.5rem;"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--cyber-amber);text-transform:uppercase;letter-spacing:1px;margin-bottom:0.25rem;">
                                    Jam Operasional
                                </div>
                                <div style="color:var(--cyber-text);font-size:0.95rem;line-height:1.6;">
                                    <?= !empty($kontak->jam_operasional) ? nl2br($kontak->jam_operasional) : '<span style="color:var(--cyber-text-dim);">Belum diatur</span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Maps (Kanan) -->
                <div class="col-lg-7">
                    <?php if(!empty($kontak->latitude) && !empty($kontak->longitude)): ?>
                    <div class="cyber-card h-100" style="background:var(--cyber-card);border:1px solid var(--cyber-border);border-radius:8px;overflow:hidden;min-height:400px;">
                        <div id="map" style="height:100%;width:100%;min-height:400px;"></div>
                    </div>
                    <?php else: ?>
                    <div class="cyber-card h-100 d-flex align-items-center justify-content-center" style="background:var(--cyber-card);border:1px solid var(--cyber-border);border-radius:8px;min-height:400px;">
                        <div style="text-align:center;padding:2rem;">
                            <i class="bi bi-geo-alt-fill" style="font-size:4rem;color:var(--cyber-text-dim);margin-bottom:1rem;"></i>
                            <p style="color:var(--cyber-text-dim);margin:0;">Lokasi peta belum diatur oleh admin.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Kontak Operator WhatsApp -->
        <?php if(!empty($operators)): ?>
        <div class="mb-5">
            <div style="margin-bottom:2rem;">
                <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-green);letter-spacing:2px;margin-bottom:0.5rem;">
                    <i class="bi bi-circle-fill me-2" style="font-size:0.4rem;"></i>KONTAK OPERATOR
                </div>
                <h2 style="font-family:var(--font-display);color:var(--cyber-text);font-size:1.8rem;margin:0;">
                    Hubungi Kami Via <span style="color:#25D366;">WhatsApp</span>
                </h2>
            </div>
            
            <div class="row g-3">
                <?php foreach($operators as $op): ?>
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $op->no_whatsapp) ?>" 
                       target="_blank" 
                       class="d-block text-decoration-none h-100" 
                       style="background:var(--cyber-card);border:1px solid rgba(37,211,102,0.3);border-radius:8px;padding:1.5rem;transition:all 0.3s ease;"
                       onmouseover="this.style.background='rgba(37,211,102,0.1)';this.style.borderColor='#25D366';this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 20px rgba(37,211,102,0.3)'"
                       onmouseout="this.style.background='var(--cyber-card)';this.style.borderColor='rgba(37,211,102,0.3)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
                        <div class="d-flex align-items-start">
                            <div style="width:50px;height:50px;background:rgba(37,211,102,0.1);border:1px solid #25D366;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-right:1rem;">
                                <i class="bi bi-whatsapp" style="color:#25D366;font-size:1.5rem;"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="color:var(--cyber-text);font-weight:600;font-size:1.05rem;margin-bottom:0.25rem;">
                                    <?= htmlspecialchars($op->nama) ?>
                                </div>
                                <?php if($op->jabatan): ?>
                                <div style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.85rem;margin-bottom:0.5rem;">
                                    <?= htmlspecialchars($op->jabatan) ?>
                                </div>
                                <?php endif; ?>
                                <div style="color:#25D366;font-family:var(--font-mono);font-size:0.9rem;">
                                    <i class="bi bi-telephone"></i> <?= $op->no_whatsapp ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Dokumen & Panduan -->
        <div class="mb-5">
            <div style="margin-bottom:2rem;">
                <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-amber);letter-spacing:2px;margin-bottom:0.5rem;">
                    <i class="bi bi-circle-fill me-2" style="font-size:0.4rem;"></i>DOKUMENTASI
                </div>
                <h2 style="font-family:var(--font-display);color:var(--cyber-text);font-size:1.8rem;margin:0;">
                    Dokumen & <span style="color:var(--cyber-amber);">Panduan</span>
                </h2>
            </div>
            
            <div class="cyber-card" style="background:var(--cyber-card);border:1px solid rgba(255,176,32,0.3);border-radius:8px;padding:2rem;">
                <?php if(empty($dokumen)): ?>
                    <div style="text-align:center;padding:2rem;">
                        <i class="bi bi-folder2-open" style="font-size:3rem;color:var(--cyber-text-dim);margin-bottom:1rem;"></i>
                        <p style="color:var(--cyber-text-dim);margin:0;">Belum ada dokumen yang tersedia.</p>
                    </div>
                <?php else: ?>
                    <div class="row g-3">
                        <?php foreach($dokumen as $doc): ?>
                        <div class="col-md-6 col-lg-4">
                            <a href="<?= base_url('kontak/download/' . $doc->id) ?>" 
                               class="d-block text-decoration-none h-100" 
                               style="background:rgba(255,176,32,0.05);border:1px solid rgba(255,176,32,0.3);border-radius:8px;padding:1.25rem;transition:all 0.3s ease;"
                               onmouseover="this.style.background='rgba(255,176,32,0.15)';this.style.borderColor='var(--cyber-amber)';this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 20px rgba(255,176,32,0.2)'"
                               onmouseout="this.style.background='rgba(255,176,32,0.05)';this.style.borderColor='rgba(255,176,32,0.3)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
                                <div class="d-flex align-items-start mb-3">
                                    <div style="width:50px;height:50px;background:rgba(255,176,32,0.1);border:1px solid var(--cyber-amber);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-right:1rem;">
                                        <i class="bi bi-file-earmark-pdf" style="color:var(--cyber-amber);font-size:1.5rem;"></i>
                                    </div>
                                    <div style="flex:1;">
                                        <h6 style="color:var(--cyber-amber);margin-bottom:0.5rem;font-weight:600;font-size:1rem;">
                                            <?= htmlspecialchars($doc->judul) ?>
                                        </h6>
                                    </div>
                                </div>
                                <?php if($doc->deskripsi): ?>
                                <p style="color:var(--cyber-text-dim);margin-bottom:0.75rem;font-size:0.85rem;line-height:1.5;">
                                    <?= htmlspecialchars($doc->deskripsi) ?>
                                </p>
                                <?php endif; ?>
                                <div style="font-size:0.75rem;color:var(--cyber-text-dim);font-family:var(--font-mono);">
                                    <span><i class="bi bi-download"></i> <?= $doc->jumlah_download ?></span>
                                    <?php if($doc->ukuran_file): ?>
                                    <span class="ms-2"><i class="bi bi-hdd"></i> <?= number_format($doc->ukuran_file / 1024, 2) ?> MB</span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<!-- Leaflet CSS & JS (OpenStreetMap - 100% Free!) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- OpenStreetMap Script -->
<?php if(!empty($kontak->latitude) && !empty($kontak->longitude)): ?>
<style>
    /* Custom Leaflet Dark Theme */
    .leaflet-tile-pane {
        filter: brightness(0.8) contrast(1.1) saturate(0.9);
    }
    .leaflet-popup-content-wrapper {
        background: linear-gradient(135deg, rgba(0,212,255,0.95), rgba(0,255,136,0.95));
        color: #000;
        font-family: var(--font-body);
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0,212,255,0.4);
    }
    .leaflet-popup-tip {
        background: rgba(0,212,255,0.95);
    }
    .leaflet-popup-content {
        margin: 15px;
        font-size: 14px;
        line-height: 1.5;
    }
    .leaflet-popup-content strong {
        display: block;
        margin-bottom: 5px;
        font-size: 15px;
    }
    .leaflet-control-attribution {
        background: rgba(13, 31, 45, 0.8) !important;
        color: var(--cyber-text-dim) !important;
        font-size: 10px !important;
        border-radius: 4px;
    }
    .leaflet-control-attribution a {
        color: var(--cyber-cyan) !important;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var mapEl = document.getElementById('map');
    if (mapEl) {
        // Initialize map
        var map = L.map('map').setView([<?= $kontak->latitude ?>, <?= $kontak->longitude ?>], 15);
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);
        
        // Custom cyan marker icon
        var customIcon = L.divIcon({
            className: 'custom-marker',
            html: '<div style="background:var(--cyber-cyan);width:20px;height:20px;border-radius:50%;border:3px solid white;box-shadow:0 0 15px rgba(0,212,255,0.8);"></div>',
            iconSize: [26, 26],
            iconAnchor: [13, 13]
        });
        
        // Add marker
        var marker = L.marker([<?= $kontak->latitude ?>, <?= $kontak->longitude ?>], {
            icon: customIcon
        }).addTo(map);
        
        // Add popup
        var popupContent = '<strong>Diskominfo Statistik dan Persandian</strong><br><?= !empty($kontak->alamat) ? str_replace(["\r\n", "\n", "\r"], '<br>', addslashes($kontak->alamat)) : 'Kabupaten Muara Enim' ?>';
        marker.bindPopup(popupContent).openPopup();
    }
});
</script>
<?php endif; ?>
