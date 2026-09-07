import './bootstrap';
import Velocity from 'velocity-animate';

document.documentElement.classList.add('has-js');

// Velocity scroll parallax
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
                Velocity(el, opacity !== null ? { translateY: y, opacity } : { translateY: y }, { duration: 100, easing: 'easeOutQuad', queue: false, mobileHA: true });
            }
        });
        ticking = false;
    }
    window.addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(updateVelocity); } }, { passive: true });
    window.addEventListener('resize', updateVelocity);
    updateVelocity();
}

// Scroll reveal
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => { if (entry.isIntersecting) { entry.target.classList.add('is-visible'); revealObserver.unobserve(entry.target); } });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.anim-hidden, .anim-slide-left, .anim-slide-right, .anim-scale, .stagger > *').forEach((el) => revealObserver.observe(el));

// Navbar: glassmorphism + menghilang perlahan saat scroll ke bawah,
// muncul lagi saat scroll ke atas
const navbar = document.getElementById('navbar');
let lastScrollY = window.scrollY || 0;
let navTicking = false;
function updateNavbar() {
    if (!navbar) return;
    const y = window.scrollY || 0;
    const scrolled = y > 28;
    navbar.classList.toggle('nav-scrolled', scrolled);

    const menuEl = document.getElementById('mobile-menu');
    const menuOpen = menuEl && !menuEl.classList.contains('hidden');

    // Jangan sembunyikan saat menu mobile terbuka atau masih di atas
    if (menuOpen || y <= 140) {
        navbar.classList.remove('nav-hidden');
    } else {
        const goingDown = y > lastScrollY + 4;
        const goingUp = y < lastScrollY - 4;
        if (goingDown) navbar.classList.add('nav-hidden');
        else if (goingUp) navbar.classList.remove('nav-hidden');
    }
    lastScrollY = y;
    navTicking = false;
}
window.addEventListener('scroll', () => {
    if (!navTicking) { navTicking = true; requestAnimationFrame(updateNavbar); }
}, { passive: true });
window.addEventListener('resize', updateNavbar);
updateNavbar();

// Mobile menu
const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('mobile-menu');
const openIcon = document.getElementById('menu-open');
const closeIcon = document.getElementById('menu-close');
if (toggle && menu) {
    toggle.addEventListener('click', () => {
        const hidden = menu.classList.toggle('hidden');
        openIcon?.classList.toggle('hidden', !hidden);
        closeIcon?.classList.toggle('hidden', hidden);
        toggle.setAttribute('aria-expanded', String(!hidden));
        // Saat menu dibuka, pastikan navbar selalu terlihat
        if (!hidden) navbar?.classList.remove('nav-hidden');
    });
    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        menu.classList.add('hidden');
        openIcon?.classList.remove('hidden');
        closeIcon?.classList.add('hidden');
        toggle.setAttribute('aria-expanded','false');
    }));
    document.addEventListener('keydown', (e)=> { if(e.key==='Escape' && !menu.classList.contains('hidden')) { menu.classList.add('hidden'); openIcon?.classList.remove('hidden'); closeIcon?.classList.add('hidden'); } });
}

// Counter animation hardware accelerated via rAF
function animateCounter(el, target, suffix = '', duration = 1400) {
    let start = 0;
    const step = (ts) => {
        if (!start) start = ts;
        const progress = Math.min((ts - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString('id-ID') + suffix;
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target.toLocaleString('id-ID') + suffix;
    };
    requestAnimationFrame(step);
}
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const raw = el.dataset.count || '0';
            const target = parseInt(String(raw).replace(/\./g,''),10) || 0;
            const suffix = el.dataset.suffix || '';
            animateCounter(el, target, suffix);
            counterObserver.unobserve(el);
        }
    });
}, { threshold: 0.5 });
document.querySelectorAll('[data-count]').forEach((el) => counterObserver.observe(el));

// Lightbox generic
document.querySelectorAll('[data-lightbox]').forEach((el) => {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        if (el.classList.contains('brosur-zoom-trigger')) return;
        openLightbox(el.dataset.title || '', e.currentTarget.getAttribute('href'));
    });
});
function openLightbox(title, src) {
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 z-[100] bg-brand-950/90 backdrop-blur-sm flex items-center justify-center p-4 cursor-zoom-out opacity-0 transition-opacity duration-300';
    overlay.innerHTML = `
        <button class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white text-xl transition" aria-label="Tutup">&times;</button>
        <figure class="max-w-4xl w-full scale-95 transition-transform duration-300">
            <img src="${src}" alt="${title}" class="w-full max-h-[82vh] object-contain rounded-2xl shadow-2xl bg-white" />
            <figcaption class="text-center text-white mt-4 text-sm font-medium">${title}</figcaption>
        </figure>`;
    const close = () => {
        overlay.classList.remove('opacity-100');
        overlay.querySelector('figure')?.classList.remove('scale-100');
        setTimeout(() => overlay.remove(), 280);
        document.body.style.overflow = '';
    };
    overlay.querySelector('button').addEventListener('click', close);
    overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
    const escHandler = (e) => { if (e.key === 'Escape') { close(); document.removeEventListener('keydown', escHandler); } };
    document.addEventListener('keydown', escHandler);
    document.body.style.overflow = 'hidden';
    document.body.appendChild(overlay);
    requestAnimationFrame(() => { overlay.classList.add('opacity-100'); overlay.querySelector('figure')?.classList.add('scale-100'); });
}

// Smooth scroll with offset
document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener('click', (e) => {
        const id = a.getAttribute('href');
        if (!id || id === '#') return;
        const target = document.querySelector(id);
        if (target) {
            e.preventDefault();
            const navH = navbar?.offsetHeight || 72;
            const top = target.getBoundingClientRect().top + window.scrollY - navH - 12;
            window.scrollTo({ top, behavior: 'smooth' });
        }
    });
});

// Brosur Slideshow modern peek carousel (unified)
(function() {
    const slideshow = document.getElementById('brosur-slideshow');
    if (!slideshow) return;
    if (slideshow.dataset.initialized) return;
    slideshow.dataset.initialized = '1';
    const slides = Array.from(slideshow.querySelectorAll('.brosur-slide'));
    const lightbox = document.getElementById('brosur-lightbox');
    const lbImg = document.getElementById('brosur-lb-img');
    const lbClose = document.getElementById('brosur-lb-close');
    const prev = document.getElementById('brosur-prev');
    const nextBtn = document.getElementById('brosur-next');
    if (!slides.length) return;
    let current = 0;
    let autoTimer = null;
    const total = slides.length;
    function updateVisuals() {
        slides.forEach((s, idx) => {
            if (idx === current) { s.classList.remove('opacity-60','scale-[0.96]'); s.classList.add('opacity-100','scale-100'); }
            else { s.classList.add('opacity-60','scale-[0.96]'); s.classList.remove('opacity-100','scale-100'); }
        });
    }
    slideshow.addEventListener('scroll', () => {
        const viewCenter = slideshow.scrollLeft + (slideshow.clientWidth / 2);
        let closest = 0; let min = Infinity;
        slides.forEach((s, idx) => {
            const c = s.offsetLeft - slideshow.offsetLeft + (s.clientWidth / 2);
            const d = Math.abs(c - viewCenter);
            if (d < min) { min = d; closest = idx; }
        });
        if (current !== closest) { current = closest; updateVisuals(); }
    }, { passive: true });
    function goTo(index, instant=false) {
        if (!slides[index]) return;
        current = index;
        const targetLeft = slides[index].offsetLeft - slideshow.offsetLeft - (slideshow.clientWidth / 2) + (slides[index].clientWidth / 2);
        slideshow.scrollTo({ left: targetLeft, behavior: instant ? 'instant' : 'smooth' });
        updateVisuals();
    }
    function next(){ goTo((current+1)%total); }
    function prevGo(){ goTo((current-1+total)%total); }
    function startAuto(){ stopAuto(); autoTimer = setInterval(next, 3200); }
    function stopAuto(){ if(autoTimer) clearInterval(autoTimer); }
    slideshow.addEventListener('mouseenter', stopAuto);
    slideshow.addEventListener('mouseleave', startAuto);
    slideshow.addEventListener('touchstart', stopAuto, {passive:true});
    slideshow.addEventListener('touchend', startAuto, {passive:true});
    if(prev) prev.addEventListener('click', ()=>{ stopAuto(); prevGo(); startAuto(); });
    if(nextBtn) nextBtn.addEventListener('click', ()=>{ stopAuto(); next(); startAuto(); });
    goTo(0, true);
    startAuto();
    document.querySelectorAll('.brosur-zoom-trigger').forEach((img) => {
        img.addEventListener('click', (e) => {
            e.preventDefault(); e.stopPropagation();
            if (lbImg) lbImg.src = img.src;
            if (lightbox) { lightbox.classList.remove('hidden'); requestAnimationFrame(()=> lightbox.classList.add('opacity-100')); document.body.style.overflow='hidden'; }
        });
    });
    function closeLb(){ if(!lightbox) return; lightbox.classList.remove('opacity-100'); setTimeout(()=>{ lightbox.classList.add('hidden'); document.body.style.overflow=''; }, 280); }
    if (lbClose) lbClose.addEventListener('click', closeLb);
    if (lightbox) lightbox.addEventListener('click', (e)=>{ if(e.target===lightbox) closeLb(); });
    document.addEventListener('keydown', (e)=>{ if(e.key==='Escape' && lightbox && !lightbox.classList.contains('hidden')) closeLb(); });
})();

// Active nav highlight via IntersectionObserver
(function(){
    const ids = ['beranda','availability','spek','legalitas','kontak'];
    const navLinks = document.querySelectorAll('.nav-link');
    if(!navLinks.length) return;
    const obs = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                const id = entry.target.id;
                navLinks.forEach(a=> a.classList.toggle('active', a.getAttribute('href')==='#'+id));
            }
        });
    }, { rootMargin: '-45% 0px -45% 0px', threshold: 0 });
    ids.forEach(id=>{ const el = document.getElementById(id); if(el) obs.observe(el); });
})();
