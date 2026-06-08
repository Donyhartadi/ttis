<main class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
      <div style="font-family:var(--font-mono);color:var(--cyber-cyan);font-size:0.75rem;letter-spacing:2px;">// MANAJEMEN KONTEN</div>
      <h2 class="mb-0" style="font-family:var(--font-display);color:var(--cyber-text);">Manajemen Berita</h2>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <form method="get" action="<?= site_url('berita') ?>" class="d-flex gap-2">
        <input type="text" name="q" class="cyber-input" placeholder="Cari judul atau kategori..."
               value="<?= htmlspecialchars($q ?? '') ?>" style="min-width:220px;">
        <button class="btn btn-cyber px-3" type="submit"><i class="bi bi-search"></i></button>
        <?php if (!empty($q)): ?>
          <a href="<?= site_url('berita') ?>" class="btn btn-cyber px-3" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);" title="Reset"><i class="bi bi-x-lg"></i></a>
        <?php endif; ?>
      </form>
      <a href="<?= site_url('berita/tambah') ?>" class="btn btn-cyber">
        <i class="bi bi-plus-lg me-1"></i>Tambah Berita
      </a>
    </div>
  </div>

  <?php if (!empty($q)): ?>
    <div style="margin-bottom:1.25rem;font-family:var(--font-mono);font-size:0.8rem;color:var(--cyber-text-dim);">
      <i class="bi bi-funnel me-1" style="color:var(--cyber-cyan);"></i>
      Hasil pencarian: <strong style="color:var(--cyber-cyan);">"<?= htmlspecialchars($q) ?>"</strong>
      — <?= count($berita) ?> berita ditemukan
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <?php foreach ($berita as $b): ?>
      <div class="col-md-6 col-lg-4 scroll-reveal">
        <div class="cyber-card cyber-card-shine h-100" style="display:flex;flex-direction:column;">

          <!-- Gambar dengan overflow:hidden untuk hover zoom -->
          <?php if ($b->gambar): ?>
            <div style="height:180px;overflow:hidden;position:relative;flex-shrink:0;border-radius:2px 2px 0 0;">
              <img src="<?= base_url('assets/uploads/berita/' . $b->gambar) ?>"
                   alt="<?= htmlspecialchars($b->judul) ?>"
                   style="width:100%;height:100%;object-fit:cover;filter:brightness(0.8) saturate(0.9);">
              <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,var(--cyber-card) 100%);pointer-events:none;"></div>
              <!-- Status badge on image -->
              <?php
                $status = $b->status ?? 'publish';
                $statusColor = ($status === 'draft') ? 'var(--cyber-amber)' : 'var(--cyber-green)';
                $statusLabel = ($status === 'draft') ? 'DRAFT' : 'PUBLISH';
              ?>
              <span style="position:absolute;top:0.6rem;left:0.6rem;background:rgba(0,0,0,0.75);border:1px solid <?= $statusColor ?>;color:<?= $statusColor ?>;font-family:var(--font-mono);font-size:0.6rem;padding:2px 8px;letter-spacing:1px;">
                <?= $statusLabel ?>
              </span>
            </div>
          <?php else: ?>
            <div style="height:100px;background:rgba(0,212,255,0.03);border-bottom:1px solid var(--cyber-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;">
              <i class="bi bi-image" style="font-size:2rem;color:var(--cyber-text-dim);"></i>
              <?php
                $status = $b->status ?? 'publish';
                $statusColor = ($status === 'draft') ? 'var(--cyber-amber)' : 'var(--cyber-green)';
                $statusLabel = ($status === 'draft') ? 'DRAFT' : 'PUBLISH';
              ?>
              <span style="position:absolute;top:0.6rem;left:0.6rem;background:rgba(0,0,0,0.75);border:1px solid <?= $statusColor ?>;color:<?= $statusColor ?>;font-family:var(--font-mono);font-size:0.6rem;padding:2px 8px;letter-spacing:1px;">
                <?= $statusLabel ?>
              </span>
            </div>
          <?php endif; ?>

          <div style="padding:1rem;flex:1;display:flex;flex-direction:column;">
            <div class="mb-2 d-flex align-items-center gap-2">
              <span style="background:rgba(0,212,255,0.1);border:1px solid var(--cyber-border);color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.65rem;padding:2px 8px;letter-spacing:1px;text-transform:uppercase;">
                <?= htmlspecialchars($b->kategori) ?>
              </span>
              <span style="color:var(--cyber-text-dim);font-size:0.78rem;font-family:var(--font-mono);">
                <?= date('d M Y', strtotime($b->tanggal)) ?>
              </span>
            </div>
            <h6 style="color:var(--cyber-text);font-weight:600;margin-bottom:0.5rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
              <?= htmlspecialchars($b->judul) ?>
            </h6>
            <p style="color:var(--cyber-text-dim);font-size:0.83rem;line-height:1.5;flex:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
              <?= htmlspecialchars(word_limiter($b->ringkasan ?: strip_tags($b->isi), 18)) ?>
            </p>
            <div class="d-flex gap-2 mt-3">
              <a href="<?= site_url('berita/edit/' . $b->id) ?>" class="btn btn-cyber btn-sm flex-fill"
                 style="background:rgba(255,176,32,0.08);border-color:var(--cyber-amber);color:var(--cyber-amber);">
                <i class="bi bi-pencil me-1"></i>Edit
              </a>
              <a href="<?= site_url('berita/hapus/' . $b->id) ?>" class="btn btn-cyber btn-sm flex-fill"
                 style="background:rgba(255,59,92,.08);border-color:var(--cyber-red);color:var(--cyber-red);"
                 data-confirm="Hapus berita &quot;<?= htmlspecialchars(addslashes($b->judul)) ?>&quot;? Tindakan ini tidak dapat dibatalkan."
                 data-confirm-title="HAPUS BERITA">
                <i class="bi bi-trash me-1"></i>Hapus
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (empty($berita)): ?>
      <div class="col-12">
        <div class="cyber-card text-center py-5">
          <i class="bi bi-newspaper" style="font-size:3rem;color:var(--cyber-text-dim);"></i>
          <?php if (!empty($q)): ?>
            <p class="mt-3" style="color:var(--cyber-text-dim);">Tidak ada berita yang cocok dengan pencarian <strong>"<?= htmlspecialchars($q) ?>"</strong>.</p>
            <a href="<?= site_url('berita') ?>" class="btn btn-cyber btn-sm mt-2">Tampilkan Semua</a>
          <?php else: ?>
            <p class="mt-3" style="color:var(--cyber-text-dim);">Belum ada berita. Klik Tambah Berita untuk memulai.</p>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>
