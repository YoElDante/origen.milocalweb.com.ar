/**
 * Origen Run & Bike — Interacciones de la landing page.
 * Vanilla JS. Sin frameworks.
 */

(function () {
    'use strict';

    // ─── Navbar scroll + mobile toggle ───
    const header = document.querySelector('.site-header');
    const toggle = document.querySelector('.navbar-toggle');
    const menu   = document.querySelector('.navbar-menu');

    function updateHeader() {
        if (!header) return;
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            const isOpen = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(isOpen));
        });

        // Cerrar menú al hacer click en un link
        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    window.addEventListener('scroll', updateHeader, { passive: true });
    updateHeader();

    // ─── Smooth scroll para anchors ───
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const headerHeight = header ? header.offsetHeight : 0;
                const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // ─── Back to top ───
    const backToTop = document.querySelector('.back-to-top');

    function updateBackToTop() {
        if (!backToTop) return;
        if (window.scrollY > 400) {
            backToTop.classList.add('is-visible');
        } else {
            backToTop.classList.remove('is-visible');
        }
    }

    if (backToTop) {
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    window.addEventListener('scroll', updateBackToTop, { passive: true });
    updateBackToTop();

    // ─── Reels play/pause ───
    document.querySelectorAll('.reel-card').forEach(function (card) {
        const video = card.querySelector('video');
        const playBtn = card.querySelector('.reel-play');

        if (!video || !playBtn) return;

        playBtn.addEventListener('click', function () {
            if (video.paused) {
                // Pausar otros videos
                document.querySelectorAll('.reel-card video').forEach(function (v) {
                    if (v !== video) {
                        v.pause();
                        const btn = v.closest('.reel-card')?.querySelector('.reel-play');
                        if (btn) btn.style.opacity = '1';
                    }
                });
                video.play();
                playBtn.style.opacity = '0';
            } else {
                video.pause();
                playBtn.style.opacity = '1';
            }
        });

        video.addEventListener('pause', function () {
            playBtn.style.opacity = '1';
        });

        video.addEventListener('play', function () {
            playBtn.style.opacity = '0';
        });

        video.addEventListener('ended', function () {
            playBtn.style.opacity = '1';
        });
    });
})();
