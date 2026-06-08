/*!
 * TTIS React App — v2.0
 * Tim Tanggap Insiden Siber Kab. Muara Enim
 * React components via CDN globals (no build tools required)
 */
;(function (R, RD) {
  'use strict';
  if (!R || !RD) { console.warn('TTIS: React not found'); return; }

  const {
    createElement: h, Fragment,
    useState, useEffect, useRef, useCallback
  } = R;
  const { createRoot } = RD;

  /* ================================================================
     PAGE PROGRESS BAR
     ================================================================ */
  const progressBar = (() => {
    let el = null, t = null, pct = 0;

    function mount() {
      if (el) return;
      el = document.createElement('div');
      el.id = 'ttis-progress';
      el.style.cssText = [
        'position:fixed', 'top:0', 'left:0', 'height:3px',
        'width:0%', 'z-index:99999', 'pointer-events:none',
        'background:linear-gradient(90deg,#00d4ff 0%,#00ff88 60%,#a855f7 100%)',
        'box-shadow:0 0 12px rgba(0,212,255,.7)',
        'transition:width .25s ease,opacity .3s ease',
        'opacity:0'
      ].join(';');
      document.body.prepend(el);
    }

    function start() {
      mount();
      pct = 5;
      el.style.opacity = '1';
      el.style.width = pct + '%';
      clearInterval(t);
      t = setInterval(() => {
        pct = Math.min(pct + (Math.random() * 10 + 2), 88);
        el.style.width = pct + '%';
      }, 200);
    }

    function done() {
      clearInterval(t);
      if (!el) return;
      el.style.width = '100%';
      setTimeout(() => {
        el.style.opacity = '0';
        setTimeout(() => { if (el) el.style.width = '0%'; }, 300);
      }, 220);
    }

    return { start, done };
  })();

  /* ================================================================
     TOAST NOTIFICATION SYSTEM
     ================================================================ */
  let _setToasts = null;

  const TOAST_CFG = {
    success: { color: '#00ff88', bg: 'rgba(0,255,136,.1)',  bd: 'rgba(0,255,136,.4)',  icon: 'bi-check-circle-fill' },
    error:   { color: '#ff3b5c', bg: 'rgba(255,59,92,.1)',  bd: 'rgba(255,59,92,.4)',  icon: 'bi-x-octagon-fill'    },
    warning: { color: '#ffb020', bg: 'rgba(255,176,32,.1)', bd: 'rgba(255,176,32,.4)', icon: 'bi-exclamation-triangle-fill' },
    info:    { color: '#00d4ff', bg: 'rgba(0,212,255,.1)',  bd: 'rgba(0,212,255,.4)',  icon: 'bi-info-circle-fill'  }
  };

  function ToastItem({ id, msg, type, onRemove }) {
    const [visible, setVisible] = useState(false);
    const s = TOAST_CFG[type] || TOAST_CFG.info;

    useEffect(() => {
      requestAnimationFrame(() => setVisible(true));
    }, []);

    return h('div', {
      style: {
        background: s.bg,
        border: `1px solid ${s.bd}`,
        borderLeft: `3px solid ${s.color}`,
        color: s.color,
        padding: '.7rem 1rem',
        borderRadius: '4px',
        marginBottom: '.5rem',
        display: 'flex',
        alignItems: 'center',
        gap: '.75rem',
        fontFamily: "'Share Tech Mono',monospace",
        fontSize: '.82rem',
        boxShadow: '0 6px 24px rgba(0,0,0,.5)',
        backdropFilter: 'blur(12px)',
        pointerEvents: 'auto',
        maxWidth: '380px',
        transform: visible ? 'translateX(0)' : 'translateX(120%)',
        opacity: visible ? 1 : 0,
        transition: 'transform .35s cubic-bezier(.22,1,.36,1), opacity .35s ease',
        cursor: 'default'
      }
    },
      h('i', { className: `bi ${s.icon}`, style: { flexShrink: 0, fontSize: '.95rem' } }),
      h('span', { style: { flex: 1, lineHeight: '1.45', wordBreak: 'break-word' } }, msg),
      h('button', {
        onClick: () => onRemove(id),
        style: {
          background: 'none', border: 'none', color: 'inherit',
          cursor: 'pointer', opacity: .55, padding: '0 .15rem',
          fontSize: '1.1rem', lineHeight: '1', flexShrink: 0,
          transition: 'opacity .2s'
        },
        onMouseEnter: e => { e.currentTarget.style.opacity = '1'; },
        onMouseLeave: e => { e.currentTarget.style.opacity = '.55'; }
      }, '×')
    );
  }

  function ToastContainer() {
    const [toasts, setToasts] = useState([]);
    _setToasts = setToasts;

    const remove = useCallback(id => {
      setToasts(p => p.filter(t => t.id !== id));
    }, []);

    return h(Fragment, null,
      toasts.map(t => h(ToastItem, { key: t.id, ...t, onRemove: remove }))
    );
  }

  function toast(msg, type = 'info', ms = 4500) {
    if (!_setToasts) return;
    const id = Date.now() + Math.random();
    _setToasts(p => [...p, { id, msg, type }]);
    setTimeout(() => _setToasts(p => p.filter(t => t.id !== id)), ms);
  }

  /* ================================================================
     ANIMATED COUNTER
     ================================================================ */
  function AnimatedCounter({ target = 0, duration = 1800, prefix = '', suffix = '', color }) {
    const [val, setVal] = useState(0);
    const ran = useRef(false);
    const rootRef = useRef(null);

    useEffect(() => {
      if (ran.current) return;
      if (target === 0) { setVal(0); return; }

      const obs = new IntersectionObserver(entries => {
        if (!entries[0].isIntersecting) return;
        obs.disconnect();
        if (ran.current) return;
        ran.current = true;

        const start = performance.now();
        function step(now) {
          const p = Math.min((now - start) / duration, 1);
          const ease = 1 - Math.pow(1 - p, 3); // ease-out cubic
          setVal(Math.round(target * ease));
          if (p < 1) requestAnimationFrame(step);
          else setVal(target);
        }
        requestAnimationFrame(step);
      }, { threshold: 0.25 });

      const anchor = rootRef.current?.closest('.stat-card') || rootRef.current;
      if (anchor) obs.observe(anchor);
      return () => obs.disconnect();
    }, [target, duration]);

    return h('span', { ref: rootRef, style: color ? { color } : undefined },
      prefix, val.toLocaleString('id-ID'), suffix
    );
  }

  /* ================================================================
     SYSTEM CLOCK
     ================================================================ */
  function SystemClock() {
    const [time, setTime] = useState(new Date());

    useEffect(() => {
      const t = setInterval(() => setTime(new Date()), 1000);
      return () => clearInterval(t);
    }, []);

    const pad = n => String(n).padStart(2, '0');
    const hh = pad(time.getHours());
    const mm = pad(time.getMinutes());
    const ss = pad(time.getSeconds());

    return h('span', {
      style: {
        fontFamily: "'Share Tech Mono',monospace",
        fontSize: '.78rem',
        color: 'var(--cyber-cyan)',
        letterSpacing: '2px'
      }
    },
      h('i', { className: 'bi bi-clock', style: { marginRight: '.4rem', opacity: .7 } }),
      `${hh}:${mm}:`,
      h('span', { style: { color: 'var(--cyber-green)' } }, ss)
    );
  }

  /* ================================================================
     LIVE SEARCH (client-side table filter)
     ================================================================ */
  function LiveSearch({ tableId, cols, placeholder }) {
    const [q, setQ] = useState('');
    const inputRef = useRef(null);

    useEffect(() => {
      const tbl = document.getElementById(tableId);
      if (!tbl) return;
      const rows = Array.from(tbl.querySelectorAll('tbody tr'));
      const lq = q.toLowerCase().trim();

      rows.forEach(row => {
        // Skip the "no data" row (single merged cell)
        if (row.cells.length <= 1) { row.style.display = ''; return; }
        if (!lq) { row.style.display = ''; return; }

        const idxs = (cols && cols.length) ? cols : [...Array(row.cells.length).keys()];
        const hit = idxs.some(i => row.cells[i] && row.cells[i].textContent.toLowerCase().includes(lq));
        row.style.display = hit ? '' : 'none';
      });
    }, [q, tableId, cols]);

    const clear = () => { setQ(''); if (inputRef.current) inputRef.current.focus(); };

    return h('div', {
      style: { display: 'flex', alignItems: 'stretch', flex: '1 1 auto', maxWidth: '460px' }
    },
      h('div', {
        style: {
          display: 'flex', alignItems: 'center',
          background: 'rgba(0,212,255,.05)',
          border: '1px solid var(--cyber-border)',
          borderRight: 'none',
          padding: '0 .85rem',
          color: 'var(--cyber-cyan)',
          borderRadius: '2px 0 0 2px'
        }
      }, h('i', { className: 'bi bi-funnel-fill', style: { fontSize: '.85rem' } })),

      h('input', {
        ref: inputRef,
        type: 'text',
        className: 'form-control cyber-input',
        style: { borderLeft: 'none', borderRight: q ? 'none' : undefined, borderRadius: q ? '0' : '0 2px 2px 0' },
        placeholder: placeholder || 'Filter cepat di halaman ini...',
        value: q,
        onChange: e => setQ(e.target.value)
      }),

      q && h('button', {
        className: 'btn btn-cyber',
        style: {
          borderLeft: 'none', borderRadius: '0 2px 2px 0',
          borderColor: 'rgba(255,59,92,.5)', color: 'var(--cyber-red)',
          padding: '0 .75rem', fontSize: '.85rem'
        },
        onClick: clear,
        title: 'Hapus filter'
      }, h('i', { className: 'bi bi-x-lg' }))
    );
  }

  /* ================================================================
     STATUS FILTER TABS
     ================================================================ */
  function StatusTabs({ tableId, colIndex = 4 }) {
    const [active, setActive] = useState('all');

    const tabs = [
      { k: 'all',      label: 'Semua',    color: '#5a7a8a',  activeColor: '#c8d8e8' },
      { k: 'Menunggu', label: 'Menunggu', color: '#ffb020',  activeColor: '#ffb020' },
      { k: 'Diproses', label: 'Diproses', color: '#00d4ff',  activeColor: '#00d4ff' },
      { k: 'Selesai',  label: 'Selesai',  color: '#00ff88',  activeColor: '#00ff88' }
    ];

    function applyFilter(key) {
      setActive(key);
      const tbl = document.getElementById(tableId);
      if (!tbl) return;
      Array.from(tbl.querySelectorAll('tbody tr')).forEach(row => {
        if (row.cells.length <= 1) return;
        if (key === 'all') { row.style.display = ''; return; }
        const cell = row.cells[colIndex];
        const match = cell && cell.textContent.trim().includes(key);
        row.style.display = match ? '' : 'none';
      });
    }

    return h('div', { style: { display: 'flex', gap: '.4rem', flexWrap: 'wrap' } },
      tabs.map(t => {
        const isActive = active === t.k;
        return h('button', {
          key: t.k,
          onClick: () => applyFilter(t.k),
          style: {
            padding: '.3rem .9rem',
            border: `1px solid ${isActive ? t.activeColor : 'var(--cyber-border)'}`,
            background: isActive ? `rgba(${t.k === 'all' ? '200,216,232' : t.k === 'Menunggu' ? '255,176,32' : t.k === 'Diproses' ? '0,212,255' : '0,255,136'},.08)` : 'transparent',
            color: isActive ? t.activeColor : 'var(--cyber-text-dim)',
            borderRadius: '2px',
            cursor: 'pointer',
            fontFamily: "'Rajdhani',sans-serif",
            fontWeight: 600,
            fontSize: '.78rem',
            letterSpacing: '1.5px',
            textTransform: 'uppercase',
            transition: 'all .2s ease',
            whiteSpace: 'nowrap'
          }
        }, t.label);
      })
    );
  }

  /* ================================================================
     KEGIATAN STATUS TABS (open/closed filter)
     ================================================================ */
  function KegiatanTabs({ tableId }) {
    const [active, setActive] = useState('all');

    const tabs = [
      { k: 'all',    label: 'Semua',   color: '#c8d8e8' },
      { k: 'open',   label: 'Terbuka', color: '#00ff88' },
      { k: 'closed', label: 'Ditutup', color: '#ff3b5c' }
    ];

    function applyFilter(key) {
      setActive(key);
      const tbl = document.getElementById(tableId);
      if (!tbl) return;
      Array.from(tbl.querySelectorAll('tbody tr')).forEach(row => {
        if (row.cells.length <= 1) { row.style.display = ''; return; }
        if (key === 'all') { row.style.display = ''; return; }
        const cell = row.cells[3]; // status cell
        if (!cell) return;
        const txt = cell.textContent.toLowerCase();
        const show = key === 'open' ? txt.includes('terbuka') || txt.includes('open') : txt.includes('ditutup') || txt.includes('closed');
        row.style.display = show ? '' : 'none';
      });
    }

    return h('div', { style: { display: 'flex', gap: '.4rem', flexWrap: 'wrap' } },
      tabs.map(t => {
        const isActive = active === t.k;
        return h('button', {
          key: t.k,
          onClick: () => applyFilter(t.k),
          style: {
            padding: '.3rem .9rem',
            border: `1px solid ${isActive ? t.color : 'var(--cyber-border)'}`,
            background: isActive ? `rgba(${t.k === 'open' ? '0,255,136' : t.k === 'closed' ? '255,59,92' : '200,216,232'},.08)` : 'transparent',
            color: isActive ? t.color : 'var(--cyber-text-dim)',
            borderRadius: '2px',
            cursor: 'pointer',
            fontFamily: "'Rajdhani',sans-serif",
            fontWeight: 600,
            fontSize: '.78rem',
            letterSpacing: '1.5px',
            textTransform: 'uppercase',
            transition: 'all .2s ease'
          }
        }, t.label);
      })
    );
  }

  /* ================================================================
     CONFIRM DIALOG (replaces browser confirm())
     ================================================================ */
  function ConfirmDialog({ title, message, onConfirm, onCancel, confirmText = 'Ya, Lanjutkan', danger = false }) {
    const [visible, setVisible] = useState(false);
    useEffect(() => { requestAnimationFrame(() => setVisible(true)); }, []);

    const overlayStyle = {
      position: 'fixed', inset: 0, background: 'rgba(0,5,12,.85)',
      display: 'flex', alignItems: 'center', justifyContent: 'center',
      zIndex: 99999, backdropFilter: 'blur(4px)',
      opacity: visible ? 1 : 0, transition: 'opacity .25s ease'
    };

    const boxStyle = {
      background: 'var(--cyber-card2)',
      border: `1px solid ${danger ? 'rgba(255,59,92,.4)' : 'var(--cyber-border)'}`,
      borderTop: `2px solid ${danger ? 'var(--cyber-red)' : 'var(--cyber-cyan)'}`,
      borderRadius: '4px',
      padding: '1.75rem',
      maxWidth: '400px',
      width: '90%',
      boxShadow: '0 20px 60px rgba(0,0,0,.7)',
      transform: visible ? 'scale(1)' : 'scale(.9)',
      transition: 'transform .25s cubic-bezier(.22,1,.36,1)'
    };

    return h('div', { style: overlayStyle, onClick: onCancel },
      h('div', { style: boxStyle, onClick: e => e.stopPropagation() },
        h('div', { style: { marginBottom: '1.25rem' } },
          h('div', {
            style: {
              fontFamily: "'Orbitron',monospace",
              fontSize: '.85rem',
              color: danger ? 'var(--cyber-red)' : 'var(--cyber-cyan)',
              letterSpacing: '2px',
              marginBottom: '.5rem'
            }
          }, title),
          h('p', { style: { color: 'var(--cyber-text)', fontSize: '.92rem', margin: 0, lineHeight: 1.6 } }, message)
        ),
        h('div', { style: { display: 'flex', gap: '.75rem', justifyContent: 'flex-end' } },
          h('button', {
            className: 'btn btn-cyber btn-sm',
            style: { borderColor: 'rgba(255,59,92,.4)', color: 'var(--cyber-red)' },
            onClick: onCancel
          }, 'Batal'),
          h('button', {
            className: `btn btn-cyber btn-sm${danger ? ' btn-cyber-red' : ''}`,
            onClick: onConfirm
          }, confirmText)
        )
      )
    );
  }

  let _confirmRoot = null;
  let _confirmEl = null;

  function showConfirm(options) {
    return new Promise(resolve => {
      if (!_confirmEl) {
        _confirmEl = document.createElement('div');
        document.body.appendChild(_confirmEl);
        _confirmRoot = createRoot(_confirmEl);
      }

      function cleanup(result) {
        _confirmRoot.render(null);
        resolve(result);
      }

      _confirmRoot.render(h(ConfirmDialog, {
        ...options,
        onConfirm: () => cleanup(true),
        onCancel: () => cleanup(false)
      }));
    });
  }

  /* ================================================================
     SCROLL REVEAL
     ================================================================ */
  function initScrollReveal() {
    const io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -32px 0px' });

    document.querySelectorAll('.scroll-reveal').forEach(el => io.observe(el));
  }

  /* ================================================================
     BACK TO TOP BUTTON
     ================================================================ */
  function initBackToTop() {
    const btn = document.createElement('button');
    btn.id = 'back-to-top';
    btn.title = 'Kembali ke atas';
    btn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    document.body.appendChild(btn);

    window.addEventListener('scroll', () => {
      btn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });

    btn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ================================================================
     PAGE LINK INTERCEPTION (progress bar)
     ================================================================ */
  function initPageLinks() {
    document.addEventListener('click', e => {
      const a = e.target.closest('a[href]');
      if (!a) return;
      const href = a.getAttribute('href') || '';
      if (
        !href ||
        href.startsWith('#') ||
        href.startsWith('javascript') ||
        href.startsWith('mailto') ||
        href.startsWith('tel') ||
        a.getAttribute('target') === '_blank' ||
        a.getAttribute('data-bs-toggle') ||
        a.getAttribute('data-bs-dismiss')
      ) return;
      progressBar.start();
    });
  }

  /* ================================================================
     FORM SUBMIT LOADING STATE
     ================================================================ */
  function initFormLoaders() {
    document.querySelectorAll('[data-loading-form]').forEach(form => {
      form.addEventListener('submit', () => {
        const btn = form.querySelector('[type="submit"]');
        if (!btn) return;
        btn.disabled = true;
        const orig = btn.innerHTML;
        btn.dataset.origText = orig;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>' +
          (form.dataset.loadingText || 'Memproses...');
        progressBar.start();
        // Safety: re-enable after 15s if no redirect
        setTimeout(() => {
          btn.disabled = false;
          btn.innerHTML = orig;
        }, 15000);
      });
    });
  }

  /* ================================================================
     DELETE CONFIRM ENHANCEMENT
     ================================================================ */
  function initDeleteConfirm() {
    document.querySelectorAll('[data-confirm]').forEach(el => {
      el.addEventListener('click', async e => {
        e.preventDefault();
        const msg = el.dataset.confirm || 'Yakin ingin menghapus data ini?';
        const title = el.dataset.confirmTitle || 'KONFIRMASI HAPUS';
        const ok = await showConfirm({ title, message: msg, confirmText: 'Ya, Hapus', danger: true });
        if (ok) {
          const href = el.getAttribute('href');
          if (href) window.location.href = href;
          const form = el.closest('form');
          if (form) form.submit();
        }
      });
    });
  }

  /* ================================================================
     FLASH MESSAGE → TOAST
     ================================================================ */
  function initFlashToast() {
    const el = document.getElementById('__ttis_flash__');
    if (!el) return;
    const { msg, type } = el.dataset;
    if (msg) setTimeout(() => toast(msg, type || 'success'), 700);
  }

  /* ================================================================
     MAIN INIT
     ================================================================ */
  document.addEventListener('DOMContentLoaded', () => {
    // Toast mount
    const wrap = document.createElement('div');
    wrap.style.cssText = 'position:fixed;top:1rem;right:1rem;z-index:99990;display:flex;flex-direction:column;align-items:flex-end;pointer-events:none;';
    document.body.appendChild(wrap);
    createRoot(wrap).render(h(ToastContainer));

    // Animated counters
    document.querySelectorAll('[data-counter]').forEach(el => {
      createRoot(el).render(h(AnimatedCounter, {
        target: +(el.dataset.target) || 0,
        duration: +(el.dataset.duration) || 1800,
        prefix: el.dataset.prefix || '',
        suffix: el.dataset.suffix || '',
        color: el.dataset.color || undefined
      }));
    });

    // System clock
    document.querySelectorAll('[data-clock]').forEach(el => {
      createRoot(el).render(h(SystemClock));
    });

    // Live search
    document.querySelectorAll('[data-live-search]').forEach(el => {
      const cols = (el.dataset.cols || '').split(',').filter(Boolean).map(Number);
      createRoot(el).render(h(LiveSearch, {
        tableId: el.dataset.table || '',
        cols: cols.length ? cols : undefined,
        placeholder: el.dataset.placeholder || undefined
      }));
    });

    // Status tabs
    document.querySelectorAll('[data-status-tabs]').forEach(el => {
      createRoot(el).render(h(StatusTabs, {
        tableId: el.dataset.table || '',
        colIndex: +(el.dataset.col) || 4
      }));
    });

    // Kegiatan tabs
    document.querySelectorAll('[data-kegiatan-tabs]').forEach(el => {
      createRoot(el).render(h(KegiatanTabs, {
        tableId: el.dataset.table || ''
      }));
    });

    // Page links + progress
    progressBar.done();
    initPageLinks();

    // Back to top
    initBackToTop();

    // Scroll reveal
    initScrollReveal();

    // Form loaders
    initFormLoaders();

    // Delete confirm
    initDeleteConfirm();

    // Flash toast
    initFlashToast();
  });

  /* Public API */
  window.TTIS = { toast, progressBar, showConfirm };

})(window.React, window.ReactDOM);
