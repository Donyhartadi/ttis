<?php if($this->session->flashdata('success')): ?>
<script>document.addEventListener('DOMContentLoaded',()=>{
  const t=document.createElement('div');
  t.style.cssText='position:fixed;top:1.2rem;right:1.2rem;z-index:9999;background:rgba(0,255,136,0.1);border:1px solid rgba(0,255,136,0.4);color:#00ff88;padding:.75rem 1.5rem;border-radius:4px;font-family:monospace;font-size:.85rem;display:flex;align-items:center;gap:.5rem;';
  t.innerHTML='<i class="bi bi-check-circle-fill"></i><?= addslashes($this->session->flashdata('success')) ?>';
  document.body.appendChild(t);setTimeout(()=>t.remove(),4000);
});</script>
<?php endif; ?>

<main class="container-fluid px-4 py-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:0.75rem;">// MANAJEMEN INSIDEN</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:0;">Daftar Laporan</h4>
    </div>
    <a href="<?= site_url('laporan/cetak') ?>" class="btn btn-cyber btn-sm" style="border-color:var(--cyber-amber);color:var(--cyber-amber);">
      <i class="bi bi-printer me-1"></i>Cetak Laporan
    </a>
  </div>

  <!-- Search & Filter -->
  <form method="get" class="mb-4">
    <div class="row g-2">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="input-group">
          <span class="input-group-text"
                style="background:rgba(0,212,255,0.05);border:1px solid var(--cyber-border);border-right:none;color:var(--cyber-cyan);">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" name="q" class="form-control cyber-input" style="border-left:none;"
                 placeholder="Cari judul, pelapor, kode resi..."
                 value="<?= htmlspecialchars($q ?? '') ?>">
          <button type="submit" class="btn btn-cyber px-4">Cari</button>
          <?php if (!empty($q)): ?>
            <a href="<?= site_url('laporan') ?>" class="btn btn-cyber" style="border-color:rgba(255,59,92,0.5);color:var(--cyber-red);" title="Hapus filter">
              <i class="bi bi-x-lg"></i>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </form>

  <!-- Cyber Table Card -->
  <div class="cyber-card p-0 overflow-hidden mb-4">
    <div class="table-responsive">
      <table class="table cyber-table mb-0" style="min-width:720px;">
        <thead>
          <tr>
            <th style="width:38px;text-align:center;">#</th>
            <th style="min-width:200px;">Laporan</th>
            <th style="min-width:150px;">Pelapor</th>
            <th style="min-width:220px;">Deskripsi</th>
            <th style="width:110px;">Status</th>
            <th style="width:95px;">Waktu</th>
            <th style="width:120px;text-align:right;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($laporan)): ?>
            <tr>
              <td colspan="7" class="text-center py-5">
                <div style="font-size:2.5rem;color:var(--cyber-text-dim);margin-bottom:.75rem;"><i class="bi bi-inbox"></i></div>
                <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.85rem;margin:0;">
                  <?= !empty($q) ? 'Tidak ada laporan yang cocok dengan pencarian.' : 'Belum ada laporan masuk.' ?>
                </p>
              </td>
            </tr>
          <?php else: ?>
            <?php $no = ((int)$this->input->get('start') ?: 0) + 1; foreach ($laporan as $row):
              $no_hp_raw = preg_replace('/[^0-9]/', '', $row->no_hp ?? '');
              $wa = (strpos($no_hp_raw, '0') === 0) ? '62' . substr($no_hp_raw, 1) : $no_hp_raw;
              $status = strtolower($row->status ?? 'menunggu');
              $sc = $status === 'selesai' ? 'badge-cyber-green' : ($status === 'diproses' ? 'badge-cyber-cyan' : 'badge-cyber-amber');
              $link = !empty($row->link) ? (preg_match('#^https?://#', $row->link) ? $row->link : 'https://' . $row->link) : null;
            ?>
            <tr style="transition:background .15s;">
              <!-- No -->
              <td class="text-center">
                <span style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-text-dim);"><?= $no++ ?></span>
              </td>
              <!-- Laporan -->
              <td>
                <div style="font-weight:600;color:var(--cyber-text);font-size:0.88rem;line-height:1.3;">
                  <?= htmlspecialchars($row->judul_laporan) ?>
                </div>
                <div style="font-family:var(--font-mono);font-size:0.68rem;color:var(--cyber-cyan);margin-top:3px;">
                  <i class="bi bi-tag me-1" style="opacity:.6;"></i><?= htmlspecialchars($row->kode_resi) ?>
                </div>
              </td>
              <!-- Pelapor -->
              <td>
                <div style="color:var(--cyber-text);font-size:0.88rem;"><?= htmlspecialchars($row->nama_pelapor) ?></div>
                <div style="font-family:var(--font-mono);font-size:0.68rem;color:var(--cyber-text-dim);margin-top:2px;">
                  <i class="bi bi-telephone me-1"></i><?= htmlspecialchars($row->no_hp ?? '-') ?>
                </div>
              </td>
              <!-- Deskripsi -->
              <td>
                <div style="font-size:0.83rem;color:var(--cyber-text-dim);line-height:1.4;
                            display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
                            overflow:hidden;max-width:220px;"
                     title="<?= htmlspecialchars($row->deskripsi) ?>">
                  <?= htmlspecialchars($row->deskripsi) ?>
                </div>
              </td>
              <!-- Status -->
              <td><span class="badge <?= $sc ?>"><?= htmlspecialchars($row->status ?? 'Menunggu') ?></span></td>
              <!-- Waktu -->
              <td>
                <div style="font-family:var(--font-mono);font-size:0.72rem;color:var(--cyber-text-dim);line-height:1.5;">
                  <?= $row->waktu_laporan ? date('d M Y', strtotime($row->waktu_laporan)) : '-' ?>
                  <br><span style="color:var(--cyber-cyan);"><?= $row->waktu_laporan ? date('H:i', strtotime($row->waktu_laporan)) : '' ?></span>
                </div>
              </td>
              <!-- Aksi -->
              <td class="text-end">
                <div class="d-flex gap-1 justify-content-end">
                  <a href="https://wa.me/<?= $wa ?>" target="_blank" rel="noopener noreferrer"
                     class="btn btn-cyber btn-sm px-2" style="border-color:rgba(0,255,136,0.5);color:var(--cyber-green);"
                     title="WhatsApp Pelapor"><i class="bi bi-whatsapp"></i></a>
                  <?php if (!empty($row->eviden)): ?>
                  <a href="<?= base_url('eviden/view/' . $row->eviden) ?>" target="_blank"
                     class="btn btn-cyber btn-sm px-2" title="Lihat Eviden"><i class="bi bi-paperclip"></i></a>
                  <?php endif; ?>
                  <button class="btn btn-cyber btn-sm px-2"
                          data-bs-toggle="modal" data-bs-target="#detailModal<?= $row->id_laporan ?>"
                          title="Detail Laporan" style="border-color:rgba(0,212,255,0.4);color:var(--cyber-cyan);">
                    <i class="bi bi-eye"></i>
                  </button>
                  <button class="btn btn-cyber btn-sm px-2"
                          data-bs-toggle="modal" data-bs-target="#statusModal<?= $row->id_laporan ?>"
                          title="Update Status" style="border-color:rgba(255,59,92,0.5);color:var(--cyber-red);">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center"><?= $pagination ?></div>

</main>

<!-- ===== MODALS ===== -->
<?php if (!empty($laporan)):
  $no2 = ((int)$this->input->get('start') ?: 0) + 1;
  foreach ($laporan as $row):
    $no_hp_raw = preg_replace('/[^0-9]/', '', $row->no_hp ?? '');
    $wa = (strpos($no_hp_raw, '0') === 0) ? '62' . substr($no_hp_raw, 1) : $no_hp_raw;
    $status = strtolower($row->status ?? 'menunggu');
    $sc = $status === 'selesai' ? 'badge-cyber-green' : ($status === 'diproses' ? 'badge-cyber-cyan' : 'badge-cyber-amber');
    $link = !empty($row->link) ? (preg_match('#^https?://#', $row->link) ? $row->link : 'https://' . $row->link) : null;
?>

<!-- Detail Modal #<?= $row->id_laporan ?> -->
<div class="modal fade" id="detailModal<?= $row->id_laporan ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content cyber-modal">

      <div class="modal-header cyber-modal-header">
        <h5 class="modal-title" style="font-family:var(--font-display);font-size:0.9rem;">
          <i class="bi bi-file-earmark-text me-2" style="color:var(--cyber-cyan);"></i>
          <?= htmlspecialchars($row->judul_laporan) ?>
        </h5>
        <button type="button" class="btn-close btn-close-cyber" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body cyber-modal-body">
        <!-- Meta strip -->
        <div class="d-flex flex-wrap gap-2 mb-4">
          <div class="px-3 py-2" style="background:rgba(0,212,255,0.06);border:1px solid var(--cyber-border);border-radius:4px;flex:1;min-width:120px;">
            <div style="font-family:var(--font-mono);font-size:0.62rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:3px;">KODE RESI</div>
            <div style="font-family:var(--font-mono);font-size:0.88rem;color:var(--cyber-cyan);font-weight:700;"><?= htmlspecialchars($row->kode_resi) ?></div>
          </div>
          <div class="px-3 py-2" style="background:rgba(0,212,255,0.04);border:1px solid var(--cyber-border);border-radius:4px;flex:1;min-width:100px;">
            <div style="font-family:var(--font-mono);font-size:0.62rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:3px;">STATUS</div>
            <span class="badge <?= $sc ?>"><?= htmlspecialchars($row->status ?? 'Menunggu') ?></span>
          </div>
          <div class="px-3 py-2" style="background:rgba(0,212,255,0.04);border:1px solid var(--cyber-border);border-radius:4px;flex:1;min-width:130px;">
            <div style="font-family:var(--font-mono);font-size:0.62rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:3px;">WAKTU LAPORAN</div>
            <div style="font-family:var(--font-mono);font-size:0.82rem;color:var(--cyber-text);">
              <?= $row->waktu_laporan ? date('d M Y, H:i', strtotime($row->waktu_laporan)) : '-' ?>
            </div>
          </div>
        </div>

        <!-- Pelapor -->
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="cyber-label">Nama Pelapor</label>
            <div class="cyber-input" style="padding:.5rem .75rem;pointer-events:none;font-size:0.9rem;">
              <?= htmlspecialchars($row->nama_pelapor) ?>
            </div>
          </div>
          <div class="col-md-6">
            <label class="cyber-label">Nomor HP</label>
            <div class="cyber-input" style="padding:.5rem .75rem;pointer-events:none;font-size:0.9rem;font-family:var(--font-mono);">
              <?= htmlspecialchars($row->no_hp ?? '-') ?>
            </div>
          </div>
        </div>

        <!-- Link -->
        <?php if ($link): ?>
        <div class="mb-3">
          <label class="cyber-label">Link Terkait</label>
          <a href="<?= htmlspecialchars($link) ?>" target="_blank" rel="noopener noreferrer"
             class="d-block cyber-input" style="padding:.5rem .75rem;font-size:0.85rem;color:var(--cyber-cyan);text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
            <i class="bi bi-globe me-1"></i><?= htmlspecialchars($row->link) ?>
          </a>
        </div>
        <?php endif; ?>

        <!-- Deskripsi -->
        <div>
          <label class="cyber-label">Deskripsi Insiden</label>
          <div style="background:rgba(0,0,0,0.3);border:1px solid var(--cyber-border);border-radius:4px;
                      padding:.75rem 1rem;font-size:0.9rem;line-height:1.7;color:var(--cyber-text);
                      white-space:pre-wrap;max-height:220px;overflow-y:auto;">
            <?= htmlspecialchars($row->deskripsi) ?>
          </div>
        </div>
      </div>

      <div class="modal-footer cyber-modal-footer gap-2">
        <?php if (!empty($row->eviden)): ?>
        <a href="<?= base_url('eviden/view/' . $row->eviden) ?>" target="_blank"
           class="btn btn-cyber btn-sm me-auto"><i class="bi bi-paperclip me-1"></i>Lihat Eviden</a>
        <?php endif; ?>
        <a href="https://wa.me/<?= $wa ?>" target="_blank" rel="noopener noreferrer"
           class="btn btn-cyber btn-sm" style="border-color:rgba(0,255,136,0.5);color:var(--cyber-green);">
          <i class="bi bi-whatsapp me-1"></i>WA Pelapor
        </a>
        <button type="button" class="btn btn-cyber btn-sm"
                data-bs-toggle="modal" data-bs-target="#statusModal<?= $row->id_laporan ?>"
                onclick="bootstrap.Modal.getInstance(document.getElementById('detailModal<?= $row->id_laporan ?>')).hide()">
          <i class="bi bi-pencil-square me-1"></i>Update Status
        </button>
        <button type="button" class="btn btn-cyber btn-sm" style="border-color:rgba(255,59,92,0.4);color:var(--cyber-red);"
                data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Status Modal #<?= $row->id_laporan ?> -->
<div class="modal fade" id="statusModal<?= $row->id_laporan ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cyber-modal">
      <form method="post" action="<?= base_url('laporan/update_status_lanjutan/' . $row->id_laporan) ?>">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
        <div class="modal-header cyber-modal-header">
          <h5 class="modal-title" style="font-size:0.9rem;">
            <i class="bi bi-pencil-square me-2" style="color:var(--cyber-cyan);"></i>Update Status Laporan
          </h5>
          <button type="button" class="btn-close btn-close-cyber" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body cyber-modal-body">
          <div class="mb-3 p-3" style="background:rgba(0,212,255,0.04);border:1px solid var(--cyber-border);border-radius:4px;">
            <div style="font-size:0.78rem;color:var(--cyber-text-dim);font-family:var(--font-mono);margin-bottom:4px;"><?= htmlspecialchars($row->kode_resi) ?></div>
            <div style="font-size:0.9rem;color:var(--cyber-text);"><?= htmlspecialchars($row->judul_laporan) ?></div>
          </div>
          <label class="cyber-label">Status Penanganan</label>
          <select name="status" class="form-select cyber-input" required>
            <option value="">-- Pilih Status --</option>
            <option value="Menunggu" <?= ($row->status ?? '') == 'Menunggu' ? 'selected' : '' ?>>⏳ Menunggu</option>
            <option value="Diproses" <?= ($row->status ?? '') == 'Diproses' ? 'selected' : '' ?>>⚙️ Diproses</option>
            <option value="Selesai"  <?= ($row->status ?? '') == 'Selesai'  ? 'selected' : '' ?>>✅ Selesai</option>
          </select>
        </div>
        <div class="modal-footer cyber-modal-footer">
          <button type="button" class="btn btn-cyber btn-sm" style="border-color:rgba(255,59,92,0.4);color:var(--cyber-red);" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-cyber btn-sm"><i class="bi bi-check2 me-1"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; endif; ?>

