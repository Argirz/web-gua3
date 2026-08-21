import './bootstrap';
import Velocity from 'velocity-animate';

document.documentElement.classList.add('has-js');



// =====================
// Velocity scroll — parallax berbasis kecepatan scroll
// Elemen [data-velocity] bergerak pada kecepatan berbeda (depth layer)
// Elemen [data-velocity-fade] memudar saat halaman di-scroll ke bawah
// =====================
const velocityEls = document.querySelectorAll('[data-velocity]');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (velocityEls.length && !reduceMotion) {
    let ticking = false;

    function updateVelocity() {
        const sy = window.scrollY;
        const vh = window.innerHeight;

        velocityEls.forEach((el) => {
            const speed = parseFloat(el.dataset.velocity || '0.5');
            const rect = el.getBoundingClientRect();
            const distance = rect.top + rect.height / 2 - vh / 2;

            let y = distance * (1 - speed);
            y = Math.max(-140, Math.min(140, y));

            let opacity = null;
            if (el.hasAttribute('data-velocity-fade')) {
                const fadeAt = parseFloat(el.dataset.velocityFade || '0.6');
                opacity = Math.max(0, Math.min(1, 1 - sy / (vh * fadeAt)));
            }

            const prevY = parseFloat(el.dataset.py ?? 'NaN');
            const prevO = el.dataset.po ? parseFloat(el.dataset.po) : null;
            const moved = Number.isNaN(prevY) || Math.abs(y - prevY) > 0.5;
            const faded = opacity === null || prevO === null || Math.abs(opacity - prevO) > 0.01;

            if (moved || faded) {
                el.dataset.py = y;
                if (opacity !== null) el.dataset.po = opacity;
                Velocity(
                    el,
                    opacity !== null ? { translateY: y, opacity } : { translateY: y },
                    { duration: 100, easing: 'easeOutQuad', queue: false, mobileHA: true }
                );
            }
        });

        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(updateVelocity);
        }
    }, { passive: true });
    window.addEventListener('resize', updateVelocity);
    updateVelocity();
}

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
// Brosur Slideshow (Peek Carousel)
(function() {
    const slideshow = document.getElementById('brosur-slideshow');
    if (!slideshow) return;
    const slides = Array.from(slideshow.querySelectorAll('.brosur-slide'));
    const lightbox = document.getElementById('brosur-lightbox');
    const lbImg = document.getElementById('brosur-lb-img');
    const lbClose = document.getElementById('brosur-lb-close');
    
    let current = 0;
    let autoTimer = null;
    const total = slides.length;

    function updateVisuals() {
        slides.forEach((s, idx) => {
            if (idx === current) {
                s.classList.replace('opacity-50', 'opacity-100');
                s.classList.replace('scale-95', 'scale-100');
            } else {
                s.classList.replace('opacity-100', 'opacity-50');
                s.classList.replace('scale-100', 'scale-95');
            }
        });
    }

    let isScrolling;
    slideshow.addEventListener('scroll', () => {
        // Find slide closest to the center
        const viewCenter = slideshow.scrollLeft + (slideshow.clientWidth / 2);
        let closestIdx = 0;
        let minDistance = Infinity;
        
        slides.forEach((s, idx) => {
            const sCenter = s.offsetLeft - slideshow.offsetLeft + (s.clientWidth / 2);
            const dist = Math.abs(sCenter - viewCenter);
            if (dist < minDistance) {
                minDistance = dist;
                closestIdx = idx;
            }
        });

        if (current !== closestIdx) {
            current = closestIdx;
            updateVisuals();
        }
    }, { passive: true });

    function goTo(index, isWrap = false) {
        if (!slides[index]) return;
        const targetLeft = slides[index].offsetLeft - slideshow.offsetLeft - (slideshow.clientWidth / 2) + (slides[index].clientWidth / 2);
        slideshow.scrollTo({ left: targetLeft, behavior: isWrap ? 'instant' : 'smooth' });
    }

    function next() {
        const nextIdx = (current + 1) % total;
        goTo(nextIdx, nextIdx === 0 && current === total - 1);
    }

    function startAuto() { stopAuto(); autoTimer = setInterval(next, 2500); }
    function stopAuto() { if (autoTimer) clearInterval(autoTimer); }

    slideshow.addEventListener('mouseenter', stopAuto);
    slideshow.addEventListener('mouseleave', startAuto);
    slideshow.addEventListener('touchstart', stopAuto, {passive: true});
    slideshow.addEventListener('touchend', startAuto, {passive: true});
    
    // Initial setup
    goTo(0);
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
