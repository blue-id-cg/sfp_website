// Préchargeur
const splash = document.getElementById('splash');
if (splash) {
    const splashPct = document.getElementById('splashPct');
    let splashProgress = 0;
    let splashDone = false;

    const formatPct = (value) => `${String(Math.floor(value)).padStart(2, '0')} %`;

    const tickSplashProgress = () => {
        if (splashDone) return;
        splashProgress = Math.min(splashProgress + Math.random() * 8 + 3, 90);
        if (splashPct) splashPct.textContent = formatPct(splashProgress);
        if (splashProgress < 90) setTimeout(tickSplashProgress, 150);
    };
    tickSplashProgress();

    window.addEventListener('load', () => {
        splashDone = true;
        splashProgress = 100;
        if (splashPct) splashPct.textContent = formatPct(100);
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

// Machine à écrire (texte d'accroche du hero)
const typewriterEl = document.getElementById('heroTypewriter');
if (typewriterEl) {
    const phrases = JSON.parse(typewriterEl.dataset.typewriter || '[]');

    if (phrases.length && !reducedMotion) {
        let phraseIndex = 0;
        let charIndex = 0;
        let deleting = false;

        const tick = () => {
            const current = phrases[phraseIndex];

            if (!deleting) {
                charIndex++;
                typewriterEl.textContent = current.slice(0, charIndex);
                if (charIndex === current.length) {
                    deleting = true;
                    setTimeout(tick, 1900);
                    return;
                }
            } else {
                charIndex--;
                typewriterEl.textContent = current.slice(0, charIndex);
                if (charIndex === 0) {
                    deleting = false;
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                }
            }

            setTimeout(tick, deleting ? 35 : 55);
        };

        tick();
    } else if (phrases.length) {
        typewriterEl.textContent = phrases[0];
    }
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

// Galerie « carotte de forage » : défilement horizontal à la souris + carrousel automatique
document.querySelectorAll('[data-core-strip]').forEach((strip) => {
    let isDragging = false;
    let startX = 0;
    let startScroll = 0;
    let autoPaused = false;

    const pauseAuto = () => {
        autoPaused = true;
    };
    const resumeAutoSoon = () => {
        setTimeout(() => {
            autoPaused = false;
        }, 1800);
    };

    strip.addEventListener('mousedown', (event) => {
        isDragging = true;
        startX = event.pageX;
        startScroll = strip.scrollLeft;
        pauseAuto();
    });
    window.addEventListener('mouseup', () => {
        isDragging = false;
        resumeAutoSoon();
    });
    window.addEventListener('mousemove', (event) => {
        if (!isDragging) return;
        event.preventDefault();
        strip.scrollLeft = startScroll - (event.pageX - startX);
    });

    strip.addEventListener('mouseenter', pauseAuto);
    strip.addEventListener('mouseleave', resumeAutoSoon);
    strip.addEventListener('touchstart', pauseAuto, { passive: true });
    strip.addEventListener('touchend', resumeAutoSoon, { passive: true });

    // Diapositive « active » = celle la plus proche du centre du carrousel
    const samples = Array.from(strip.querySelectorAll('.core-sample'));
    let activeTicking = false;

    const highlightActive = () => {
        const stripRect = strip.getBoundingClientRect();
        const center = stripRect.left + stripRect.width / 2;
        let best = null;
        let bestDist = Infinity;
        samples.forEach((sample) => {
            const rect = sample.getBoundingClientRect();
            const dist = Math.abs(rect.left + rect.width / 2 - center);
            if (dist < bestDist) {
                bestDist = dist;
                best = sample;
            }
        });
        samples.forEach((sample) => sample.classList.toggle('is-active', sample === best));
    };

    strip.addEventListener('scroll', () => {
        if (activeTicking) return;
        activeTicking = true;
        requestAnimationFrame(() => {
            highlightActive();
            activeTicking = false;
        });
    }, { passive: true });
    window.addEventListener('resize', highlightActive);
    highlightActive();

    if (reducedMotion) return;

    setInterval(() => {
        if (autoPaused) return;

        const first = strip.querySelector('.core-sample');
        const gap = parseFloat(getComputedStyle(strip).gap) || 16;
        const step = (first?.offsetWidth ?? 300) + gap;
        const atEnd = strip.scrollLeft + strip.clientWidth >= strip.scrollWidth - 4;

        strip.scrollTo({ left: atEnd ? 0 : strip.scrollLeft + step, behavior: 'smooth' });
    }, 3600);
});

// Animations au scroll (apparition à l'entrée, disparition à la sortie)
const revealTargets = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .stagger');
if ('IntersectionObserver' in window && revealTargets.length && !reducedMotion) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                entry.target.classList.toggle('is-in', entry.isIntersecting);
            });
        },
        { threshold: 0.15 }
    );
    revealTargets.forEach((target) => observer.observe(target));
} else {
    revealTargets.forEach((target) => target.classList.add('is-in'));
}

// Jauge de profondeur (toutes les pages) : reformule la progression de scroll en mètres forés
const siteFooter = document.querySelector('.footer');
const depthGauge = document.getElementById('depthGauge');
const depthFill = document.getElementById('depthFill');
const depthBit = document.getElementById('depthBit');
const depthValueEl = document.getElementById('depthValue');

if (depthGauge && depthFill && depthBit && depthValueEl) {
    const onDepthScroll = () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const progress = scrollable > 0 ? Math.min(Math.max(window.scrollY / scrollable, 0), 1) : 0;
        const nearFooter = siteFooter ? siteFooter.getBoundingClientRect().top < window.innerHeight : false;

        depthGauge.classList.toggle('show', window.scrollY > 200 && !nearFooter);
        depthFill.style.height = `${progress * 100}%`;
        depthBit.style.top = `${progress * 100}%`;
        depthValueEl.textContent = `${Math.round(progress * 3000).toLocaleString('fr-FR')} m`;
    };

    document.addEventListener('scroll', onDepthScroll, { passive: true });
    onDepthScroll();
}

// Zone de dépôt de fichier (CV du formulaire de candidature)
document.querySelectorAll('[data-file-input]').forEach((input) => {
    const drop = input.closest('.field')?.querySelector('[data-file-drop]');
    const nameEl = drop?.querySelector('[data-file-name]');
    if (!drop || !nameEl) return;

    input.addEventListener('change', () => {
        if (input.files?.[0]) nameEl.textContent = input.files[0].name;
    });

    ['dragover', 'dragleave', 'drop'].forEach((eventName) => {
        drop.addEventListener(eventName, (event) => {
            event.preventDefault();
            drop.classList.toggle('drag', eventName === 'dragover');
        });
    });

    drop.addEventListener('drop', (event) => {
        if (event.dataTransfer?.files?.[0]) {
            input.files = event.dataTransfer.files;
            nameEl.textContent = event.dataTransfer.files[0].name;
        }
    });
});

// Lightbox (galerie & équipements)
const lightbox = document.getElementById('lightbox');
const lbImage = document.getElementById('lbImage');
const lbCap = document.getElementById('lbCap');
const lbCount = document.getElementById('lbCount');
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
        if (lbCount) lbCount.textContent = `${currentIndex + 1} / ${lightboxTriggers.length}`;
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

// Bandeau de consentement cookies
const cookieBanner = document.getElementById('cookieBanner');
if (cookieBanner) {
    const COOKIE_CONSENT_KEY = 'sfp_cookie_consent';

    if (!window.localStorage.getItem(COOKIE_CONSENT_KEY)) {
        setTimeout(() => cookieBanner.classList.add('show'), 800);
    }

    cookieBanner.querySelector('[data-cookie-accept]')?.addEventListener('click', () => {
        window.localStorage.setItem(COOKIE_CONSENT_KEY, 'accepted');
        cookieBanner.classList.remove('show');
    });
}

// Nos métiers · Coupe de puits interactive : cliquer/survoler une phase
// fait descendre le trépan jusqu'à la station correspondante.
document.querySelectorAll('.wellbore').forEach((wellbore) => {
    const rows = Array.from(wellbore.querySelectorAll('.phase-row'));
    const readout = wellbore.querySelector('[data-wb-readout]');

    const activate = (row) => {
        const phase = row.dataset.phase;
        if (wellbore.dataset.active === phase) return;
        wellbore.dataset.active = phase;
        rows.forEach((r) => r.setAttribute('aria-current', String(r === row)));
        if (readout) {
            readout.textContent = row.querySelector('.phase-row-title')?.textContent ?? readout.textContent;
        }
    };

    rows.forEach((row) => {
        row.addEventListener('click', () => activate(row));
        row.addEventListener('mouseenter', () => activate(row));
        row.addEventListener('focus', () => activate(row));
    });
});

// « L'histoire qui s'écrit » : révélation mot à mot au scroll (préserve les <strong>)
const writeBlocks = document.querySelectorAll('[data-write]');
if (writeBlocks.length && !reducedMotion && 'IntersectionObserver' in window) {
    const wrapWords = (node, state) => {
        Array.from(node.childNodes).forEach((child) => {
            if (child.nodeType === Node.TEXT_NODE) {
                const parts = child.textContent.split(/(\s+)/);
                const frag = document.createDocumentFragment();
                parts.forEach((part) => {
                    if (part.trim() === '') {
                        frag.appendChild(document.createTextNode(part));
                    } else {
                        const span = document.createElement('span');
                        span.className = 'w';
                        span.style.setProperty('--wi', state.i++);
                        span.textContent = part;
                        frag.appendChild(span);
                    }
                });
                node.replaceChild(frag, child);
            } else if (child.nodeType === Node.ELEMENT_NODE) {
                wrapWords(child, state);
            }
        });
    };

    const writeObserver = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-writing');
                    obs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.2 }
    );

    writeBlocks.forEach((block) => {
        const state = { i: 0 };
        wrapWords(block, state);
        const target = block.lastElementChild ?? block;
        const caret = document.createElement('span');
        caret.className = 'write-caret';
        caret.setAttribute('aria-hidden', 'true');
        caret.style.setProperty('--wi', state.i);
        target.appendChild(caret);
        writeObserver.observe(block);
    });
}
