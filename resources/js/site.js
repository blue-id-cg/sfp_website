// Préchargeur
const splash = document.getElementById('splash');
if (splash) {
    window.addEventListener('load', () => {
        setTimeout(() => splash.classList.add('done'), 300);
    });
}

// Barre de navigation : fond au scroll
const nav = document.getElementById('nav');
const onScroll = () => {
    if (!nav) return;
    nav.classList.toggle('scrolled', window.scrollY > 40);
};
document.addEventListener('scroll', onScroll, { passive: true });
onScroll();

// Parallaxe (bannière hero & page-head)
const parallaxEls = Array.from(document.querySelectorAll('[data-parallax]'));
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (parallaxEls.length && !reducedMotion) {
    let ticking = false;

    const applyParallax = () => {
        parallaxEls.forEach((el) => {
            const speed = parseFloat(el.dataset.parallax) || 0.15;
            const rect = (el.parentElement ?? el).getBoundingClientRect();
            el.style.transform = `translate3d(0, ${rect.top * speed}px, 0)`;
        });
        ticking = false;
    };

    const onParallaxScroll = () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(applyParallax);
    };

    applyParallax();
    window.addEventListener('scroll', onParallaxScroll, { passive: true });
    window.addEventListener('resize', applyParallax);
}

// Curseur « trépan » (identité transverse, site public uniquement)
if (nav && window.matchMedia('(hover: hover) and (pointer: fine)').matches && !reducedMotion) {
    document.body.classList.add('custom-cursor');

    const cursorDot = document.createElement('div');
    cursorDot.className = 'cursor-dot';
    const cursorRing = document.createElement('div');
    cursorRing.className = 'cursor-ring';
    document.body.append(cursorDot, cursorRing);

    let mouseX = 0;
    let mouseY = 0;
    let ringX = 0;
    let ringY = 0;

    const positionCursor = (el, x, y) => {
        el.style.transform = `translate(${x}px, ${y}px) translate(-50%, -50%)`;
    };

    document.addEventListener('mousemove', (event) => {
        mouseX = event.clientX;
        mouseY = event.clientY;
        document.body.classList.add('custom-cursor-active');
        positionCursor(cursorDot, mouseX, mouseY);
    });

    document.addEventListener('mouseleave', () => document.body.classList.remove('custom-cursor-active'));

    const followRing = () => {
        ringX += (mouseX - ringX) * 0.18;
        ringY += (mouseY - ringY) * 0.18;
        positionCursor(cursorRing, ringX, ringY);
        requestAnimationFrame(followRing);
    };
    followRing();

    document.querySelectorAll('a, button, [role="button"], input, textarea, select').forEach((el) => {
        el.addEventListener('mouseenter', () => cursorRing.classList.add('hover'));
        el.addEventListener('mouseleave', () => cursorRing.classList.remove('hover'));
    });
}

// Menu mobile
const burger = document.getElementById('burger');
const mobileMenu = document.getElementById('mobileMenu');
const mmClose = document.getElementById('mmClose');

const openMobileMenu = () => {
    mobileMenu?.classList.add('open');
    mobileMenu?.setAttribute('aria-hidden', 'false');
    burger?.setAttribute('aria-expanded', 'true');
};
const closeMobileMenu = () => {
    mobileMenu?.classList.remove('open');
    mobileMenu?.setAttribute('aria-hidden', 'true');
    burger?.setAttribute('aria-expanded', 'false');
};

burger?.addEventListener('click', openMobileMenu);
mmClose?.addEventListener('click', closeMobileMenu);
mobileMenu?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMobileMenu));

// Retour en haut
const toTop = document.getElementById('toTop');
const onScrollTop = () => toTop?.classList.toggle('show', window.scrollY > 600);
document.addEventListener('scroll', onScrollTop, { passive: true });
onScrollTop();
toTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// Jauge de profondeur (page d'accueil) : reformule le scroll en mètres forés
const siteFooter = document.querySelector('.footer');
const depthGauge = document.getElementById('depthGauge');
const depthFill = document.getElementById('depthFill');
const depthBit = document.getElementById('depthBit');
const depthValueEl = document.getElementById('depthValue');
const depthLabelEl = document.getElementById('depthLabel');

const DEPTH_SECTIONS = [
    { id: 'accueil', label: 'Surface', depth: 0 },
    { id: 'entreprise', label: 'Entreprise', depth: 380 },
    { id: 'metiers', label: 'Métiers', depth: 860 },
    { id: 'innovation', label: 'Innovation', depth: 1340 },
    { id: 'hse', label: 'HSE', depth: 1820 },
    { id: 'equipements', label: 'Équipements', depth: 2260 },
    { id: 'galerie', label: 'Galerie', depth: 2620 },
    { id: 'realisations', label: 'Réalisations', depth: 2940 },
    { id: 'contact', label: 'Contact', depth: 3200 },
];

const depthSections = DEPTH_SECTIONS.map((entry) => ({ ...entry, el: document.getElementById(entry.id) })).filter(
    (entry) => entry.el
);

if (depthGauge && depthFill && depthBit && depthValueEl && depthLabelEl && depthSections.length) {
    const maxDepth = depthSections[depthSections.length - 1].depth;

    const onDepthScroll = () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const progress = scrollable > 0 ? Math.min(Math.max(window.scrollY / scrollable, 0), 1) : 0;
        const nearFooter = siteFooter ? siteFooter.getBoundingClientRect().top < window.innerHeight : false;

        depthGauge.classList.toggle('show', window.scrollY > 200 && !nearFooter);
        depthFill.style.height = `${progress * 100}%`;
        depthBit.style.top = `${progress * 100}%`;

        const current = depthSections.reduce((active, entry) => {
            const rect = entry.el.getBoundingClientRect();
            return rect.top <= window.innerHeight * 0.4 ? entry : active;
        }, depthSections[0]);

        depthValueEl.textContent = `${Math.round(progress * maxDepth).toLocaleString('fr-FR')} m`;
        depthLabelEl.textContent = current.label;
    };

    document.addEventListener('scroll', onDepthScroll, { passive: true });
    onDepthScroll();
}

// Galerie « carotte de forage » : défilement horizontal à la souris
document.querySelectorAll('[data-core-strip]').forEach((strip) => {
    let isDragging = false;
    let startX = 0;
    let startScroll = 0;

    strip.addEventListener('mousedown', (event) => {
        isDragging = true;
        startX = event.pageX;
        startScroll = strip.scrollLeft;
    });
    window.addEventListener('mouseup', () => {
        isDragging = false;
    });
    window.addEventListener('mousemove', (event) => {
        if (!isDragging) return;
        event.preventDefault();
        strip.scrollLeft = startScroll - (event.pageX - startX);
    });
});

// Animations au scroll
const revealTargets = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .stagger');
if ('IntersectionObserver' in window && revealTargets.length) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 }
    );
    revealTargets.forEach((target) => observer.observe(target));
} else {
    revealTargets.forEach((target) => target.classList.add('is-in'));
}

// Lightbox (galerie & équipements)
const lightbox = document.getElementById('lightbox');
const lbImage = document.getElementById('lbImage');
const lbCap = document.getElementById('lbCap');
const lightboxTriggers = Array.from(document.querySelectorAll('[data-lightbox]'));

if (lightbox && lbImage && lightboxTriggers.length) {
    let currentIndex = 0;

    const sourceFor = (el) =>
        el.dataset.full || el.querySelector('img')?.currentSrc || el.querySelector('img')?.src || '';
    const captionFor = (el) => el.querySelector('figcaption')?.textContent?.trim() ?? el.querySelector('img')?.alt ?? '';

    const openLightboxAt = (index) => {
        currentIndex = (index + lightboxTriggers.length) % lightboxTriggers.length;
        const el = lightboxTriggers[currentIndex];
        lbImage.src = sourceFor(el);
        lbImage.alt = captionFor(el);
        if (lbCap) lbCap.textContent = captionFor(el);
        lightbox.classList.add('open');
    };

    lightboxTriggers.forEach((el, index) => {
        el.addEventListener('click', () => openLightboxAt(index));
    });

    document.querySelector('[data-lb-close]')?.addEventListener('click', () => lightbox.classList.remove('open'));
    document.querySelector('[data-lb-prev]')?.addEventListener('click', () => openLightboxAt(currentIndex - 1));
    document.querySelector('[data-lb-next]')?.addEventListener('click', () => openLightboxAt(currentIndex + 1));
    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) lightbox.classList.remove('open');
    });
    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('open')) return;
        if (event.key === 'Escape') lightbox.classList.remove('open');
        if (event.key === 'ArrowLeft') openLightboxAt(currentIndex - 1);
        if (event.key === 'ArrowRight') openLightboxAt(currentIndex + 1);
    });
}

// Compteurs animés (bandeau hero / chiffres clés)
const counters = document.querySelectorAll('[data-count]');
if ('IntersectionObserver' in window && counters.length) {
    const animateCount = (el) => {
        const target = Number(el.dataset.count);
        const suffix = el.dataset.suffix ?? '';
        const literal = el.dataset.literal;
        if (literal) {
            el.textContent = literal;
            return;
        }
        const duration = 1400;
        const start = performance.now();
        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            el.textContent = Math.round(progress * target) + suffix;
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    };

    const counterObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCount(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );
    counters.forEach((counter) => counterObserver.observe(counter));
}
