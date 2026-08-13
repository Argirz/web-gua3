import './bootstrap';

document.documentElement.classList.add('has-js');

// =====================
// Scroll reveal
// =====================
const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
);

document.querySelectorAll('.anim-hidden, .anim-slide-left, .anim-slide-right, .anim-scale, .stagger > *').forEach((el) => {
    revealObserver.observe(el);
});

// =====================
// Navbar scroll state
// =====================
const navbar = document.getElementById('navbar');

function updateNavbar() {
    if (!navbar) return;
    navbar.classList.toggle('nav-scrolled', window.scrollY > 40);
}

window.addEventListener('scroll', updateNavbar, { passive: true });
updateNavbar();

// =====================
// Mobile menu toggle
// =====================
const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('mobile-menu');
const openIcon = document.getElementById('menu-open');
const closeIcon = document.getElementById('menu-close');

if (toggle && menu) {
    toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        openIcon?.classList.toggle('hidden');
        closeIcon?.classList.toggle('hidden');
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menu.classList.add('hidden');
            openIcon?.classList.remove('hidden');
            closeIcon?.classList.add('hidden');
        });
    });
}

// =====================
// Counter animation (stat numbers)
// =====================
function animateCounter(el, target, duration = 1500) {
    let start = 0;
    const step = (timestamp) => {
        if (!start) start = timestamp;
        const progress = Math.min((timestamp - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
        el.textContent = Math.floor(eased * target);
        if (progress < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
}

const counterObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.count || '0', 10);
                animateCounter(el, target);
                counterObserver.unobserve(el);
            }
        });
    },
    { threshold: 0.5 }
);

document.querySelectorAll('[data-count]').forEach((el) => counterObserver.observe(el));

// =====================
// Simple lightbox
// =====================
document.querySelectorAll('[data-lightbox]').forEach((el) => {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        openLightbox(el.dataset.title || '', e.currentTarget.getAttribute('href'));
    });
});

function openLightbox(title, src) {
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 z-[100] bg-brand-950/90 backdrop-blur-sm flex items-center justify-center p-4 cursor-zoom-out opacity-0 transition-opacity duration-300';
    overlay.innerHTML = `
        <button class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white text-xl transition" aria-label="Tutup">&times;</button>
        <figure class="max-w-4xl w-full scale-95 transition-transform duration-300">
            <img src="${src}" alt="${title}" class="w-full max-h-[80vh] object-contain rounded-2xl" />
            <figcaption class="text-center text-white mt-4 text-sm font-medium">${title}</figcaption>
        </figure>`;
    const close = () => {
        overlay.classList.remove('opacity-100');
        overlay.querySelector('figure')?.classList.remove('scale-100');
        setTimeout(() => overlay.remove(), 300);
    };
    overlay.querySelector('button').addEventListener('click', close);
    overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
    document.addEventListener('keydown', function handler(e) {
        if (e.key === 'Escape') { close(); document.removeEventListener('keydown', handler); }
    });
    document.body.appendChild(overlay);
    requestAnimationFrame(() => {
        overlay.classList.add('opacity-100');
        overlay.querySelector('figure')?.classList.add('scale-100');
    });
}

// =====================
// Smooth scroll offset for navbar
// =====================
document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener('click', (e) => {
        const id = a.getAttribute('href');
        if (id === '#') return;
        const target = document.querySelector(id);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// =====================
// Brosur Slideshow
// =====================
(function() {
    const slides = document.querySelectorAll('#brosur-slideshow .brosur-slide');
    const dots = document.querySelectorAll('.brosur-dot');
    const prevBtn = document.getElementById('brosur-prev');
    const nextBtn = document.getElementById('brosur-next');
    const caption = document.getElementById('brosur-caption');
    const desc = document.getElementById('brosur-desc');
    const lightbox = document.getElementById('brosur-lightbox');
    const lbImg = document.getElementById('brosur-lb-img');
    const lbClose = document.getElementById('brosur-lb-close');

    if (!slides.length) return;

    let current = 0;
    let autoTimer = null;
    const total = slides.length;

    function goTo(index) {
        slides.forEach((s) => { s.classList.replace('opacity-100', 'opacity-0'); s.classList.add('pointer-events-none'); });
        dots.forEach((d) => { d.classList.replace('bg-gold-400', 'bg-white/40'); d.classList.remove('w-8'); });

        current = index;
        slides[current].classList.replace('opacity-0', 'opacity-100');
        slides[current].classList.remove('pointer-events-none');
        dots[current].classList.replace('bg-white/40', 'bg-gold-400');
        dots[current].classList.add('w-8');

        if (caption) caption.textContent = slides[current].querySelector('img')?.dataset.title || '';
        if (desc) desc.textContent = slides[current].querySelector('img')?.dataset.desc || '';
    }

    function next() { goTo((current + 1) % total); }
    function prev() { goTo((current - 1 + total) % total); }

    function startAuto() { stopAuto(); autoTimer = setInterval(next, 4000); }
    function stopAuto() { if (autoTimer) clearInterval(autoTimer); }

    if (prevBtn) prevBtn.addEventListener('click', () => { prev(); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { next(); startAuto(); });
    dots.forEach((d) => d.addEventListener('click', () => { goTo(parseInt(d.dataset.index)); startAuto(); }));

    const slideshow = document.getElementById('brosur-slideshow');
    if (slideshow) {
        slideshow.addEventListener('mouseenter', stopAuto);
        slideshow.addEventListener('mouseleave', startAuto);
    }
    startAuto();

    // Lightbox zoom
    document.querySelectorAll('.brosur-zoom-trigger').forEach((img) => {
        img.addEventListener('click', () => {
            if (lbImg) lbImg.src = img.src;
            if (lightbox) {
                lightbox.classList.remove('hidden');
                requestAnimationFrame(() => lightbox.classList.add('opacity-100'));
                document.body.style.overflow = 'hidden';
            }
        });
    });

    function closeLb() {
        if (!lightbox) return;
        lightbox.classList.remove('opacity-100');
        setTimeout(() => { lightbox.classList.add('hidden'); document.body.style.overflow = ''; }, 300);
    }

    if (lbClose) lbClose.addEventListener('click', closeLb);
    if (lightbox) lightbox.addEventListener('click', (e) => { if (e.target === lightbox) closeLb(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) closeLb(); });
})();
