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

// Scrollspy (page d'accueil)
const spy = document.getElementById('spy');
const spySections = spy
    ? Array.from(spy.querySelectorAll('a[data-spy]'))
          .map((link) => ({ link, section: document.getElementById(link.dataset.spy) }))
          .filter((entry) => entry.section)
    : [];

if (spy && spySections.length) {
    const onScrollSpy = () => {
        spy.classList.toggle('show', window.scrollY > 200);

        const current = spySections.reduce((active, entry) => {
            const rect = entry.section.getBoundingClientRect();
            return rect.top <= window.innerHeight * 0.4 ? entry : active;
        }, spySections[0]);

        spySections.forEach((entry) => entry.link.classList.toggle('active', entry === current));
    };
    document.addEventListener('scroll', onScrollSpy, { passive: true });
    onScrollSpy();
}

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
