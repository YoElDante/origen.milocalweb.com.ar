/**
 * Origen 8.8 — Interacciones de la landing page.
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

    // ─── Autoplay de videos al entrar en pantalla ───
    const autoplayVideos = document.querySelectorAll('video[data-autoplay]');
    if ('IntersectionObserver' in window && autoplayVideos.length) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                const video = entry.target;
                if (entry.isIntersecting) {
                    video.play().catch(function () {});
                } else {
                    video.pause();
                }
            });
        }, { threshold: 0.3 });

        autoplayVideos.forEach(function (video) {
            observer.observe(video);
        });
    }
})();
