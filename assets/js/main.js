/**
 * Origen8.8 — Interacciones de la landing page.
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

    // ─── Videos: reproducir/pausar según visibilidad ───
    const visibilityVideos = document.querySelectorAll('video[data-autoplay], video[data-stop-when-hidden]');
    if ('IntersectionObserver' in window && visibilityVideos.length) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                const video = entry.target;
                if (entry.isIntersecting && video.hasAttribute('data-autoplay')) {
                    video.play().catch(function () {});
                } else if (!entry.isIntersecting) {
                    video.pause();
                    try {
                        video.currentTime = 0;
                    } catch (error) {}
                }
            });
        }, { threshold: 0.3 });

        visibilityVideos.forEach(function (video) {
            observer.observe(video);
        });
    }

    // ─── Click manual: habilitar sonido y reanudar ───
    document.querySelectorAll('video[data-click-to-play]').forEach(function (video) {
        video.addEventListener('click', function () {
            if (video.hasAttribute('data-unmute-on-click')) {
                video.muted = false;
                video.volume = 1;
            }

            if (video.paused || video.ended) {
                video.play().catch(function () {});
            }
        });
    });

    // ─── Sonido por gesto del usuario sin interferir controles nativos ───
    document.querySelectorAll('video[data-unmute-on-interaction]').forEach(function (video) {
        video.addEventListener('pointerdown', function () {
            video.muted = false;
            video.volume = 1;
        });
    });

    // ─── Videos exclusivos: solo uno reproduciéndose a la vez ───
    document.querySelectorAll('video[data-exclusive-video]').forEach(function (video) {
        video.addEventListener('play', function () {
            document.querySelectorAll('video[data-exclusive-video]').forEach(function (other) {
                if (other !== video) {
                    other.pause();
                }
            });

            if (video.hasAttribute('data-unmute-on-play')) {
                video.muted = false;
                video.volume = 1;
            }
        });
    });

    // ─── Lightbox para fotos del local e indumentaria ───
    const lightboxImages = document.querySelectorAll('.section-local img, .section-indumentaria .indumentaria-fotos img');
    if (lightboxImages.length) {
        const lightbox = document.createElement('div');
        const dialog = document.createElement('div');
        const image = document.createElement('img');
        const close = document.createElement('button');

        lightbox.className = 'image-lightbox';
        lightbox.hidden = true;
        lightbox.setAttribute('role', 'dialog');
        lightbox.setAttribute('aria-modal', 'true');
        lightbox.setAttribute('aria-label', 'Imagen ampliada');

        dialog.className = 'image-lightbox__dialog';
        image.className = 'image-lightbox__image';
        close.className = 'image-lightbox__close';
        close.type = 'button';
        close.setAttribute('aria-label', 'Cerrar imagen ampliada');
        close.textContent = '×';

        dialog.append(image, close);
        lightbox.appendChild(dialog);
        document.body.appendChild(lightbox);

        function closeLightbox() {
            lightbox.hidden = true;
            document.body.classList.remove('lightbox-open');
            image.removeAttribute('src');
            image.removeAttribute('alt');
        }

        function openLightbox(source) {
            image.src = source.currentSrc || source.src;
            image.alt = source.alt || 'Imagen ampliada';
            lightbox.hidden = false;
            document.body.classList.add('lightbox-open');
            close.focus({ preventScroll: true });
        }

        lightboxImages.forEach(function (photo) {
            photo.classList.add('js-lightbox-image');
            photo.addEventListener('click', function () {
                openLightbox(photo);
            });
        });

        close.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function (event) {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        window.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !lightbox.hidden) {
                closeLightbox();
            }
        });
    }

    // ─── Buscador del catálogo de productos ───
    const catalogSearch = document.querySelector('[data-catalog-search]');
    if (catalogSearch) {
        const clearSearch = document.querySelector('[data-catalog-search-clear]');
        const searchStatus = document.querySelector('[data-catalog-search-status]');
        const items = Array.from(document.querySelectorAll('[data-catalog-search-item]'));
        const videos = Array.from(document.querySelectorAll('.catalog-video-card'));
        const subsections = Array.from(document.querySelectorAll('.catalog-subsection'));
        const sections = Array.from(document.querySelectorAll('.catalog-section'));

        function normalizeSearchText(value) {
            return String(value || '')
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .trim();
        }

        function updateCatalogSearch() {
            const query = normalizeSearchText(catalogSearch.value);
            let visibleCount = 0;

            items.forEach(function (item) {
                const text = normalizeSearchText(item.dataset.searchText || item.textContent);
                const isVisible = query === '' || text.indexOf(query) !== -1;
                item.hidden = !isVisible;
                if (isVisible) visibleCount += 1;
            });

            videos.forEach(function (video) {
                video.hidden = query !== '';
            });

            subsections.forEach(function (subsection) {
                const visibleItems = subsection.querySelectorAll('[data-catalog-search-item]:not([hidden])');
                subsection.hidden = query !== '' && visibleItems.length === 0;
            });

            sections.forEach(function (section) {
                const visibleSubsections = section.querySelectorAll('.catalog-subsection:not([hidden])');
                section.hidden = query !== '' && visibleSubsections.length === 0;
            });

            if (clearSearch) {
                clearSearch.hidden = query === '';
            }

            if (searchStatus) {
                searchStatus.textContent = query === ''
                    ? ''
                    : visibleCount === 1
                        ? 'Encontramos 1 producto.'
                        : 'Encontramos ' + visibleCount + ' productos.';
            }

            document.querySelectorAll('.catalog-grid').forEach(function (track) {
                track.scrollLeft = 0;
            });
            window.dispatchEvent(new Event('resize'));
        }

        catalogSearch.addEventListener('input', updateCatalogSearch);

        if (clearSearch) {
            clearSearch.addEventListener('click', function () {
                catalogSearch.value = '';
                updateCatalogSearch();
                catalogSearch.focus();
            });
        }
    }

    const categoryMenus = document.querySelectorAll('.catalog-category-menu');
    if (categoryMenus.length) {
        categoryMenus.forEach(function (menu) {
            menu.querySelectorAll('.catalog-category-menu__panel a').forEach(function (link) {
                link.addEventListener('click', function () {
                    menu.open = false;
                });
            });
        });

        document.addEventListener('click', function (event) {
            categoryMenus.forEach(function (menu) {
                if (menu.open && !menu.contains(event.target)) {
                    menu.open = false;
                }
            });
        });

        window.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') return;
            categoryMenus.forEach(function (menu) {
                menu.open = false;
            });
        });
    }

    // ─── Controles desktop para carriles horizontales de productos ───
    document.querySelectorAll('[data-catalog-rail]').forEach(function (rail) {
        const track = rail.querySelector('.catalog-grid');
        const previous = rail.querySelector('[data-catalog-scroll="prev"]');
        const next = rail.querySelector('[data-catalog-scroll="next"]');
        if (!track || !previous || !next) return;

        function canScroll() {
            return track.scrollWidth > track.clientWidth + 2;
        }

        function updateButtons() {
            if (!canScroll()) {
                previous.hidden = true;
                next.hidden = true;
                return;
            }

            previous.hidden = track.scrollLeft <= 2;
            next.hidden = track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
        }

        function scrollProducts(direction) {
            const firstCard = track.querySelector('.catalog-video-card, .catalog-card, .catalog-placeholder');
            const step = firstCard ? firstCard.getBoundingClientRect().width + 18 : track.clientWidth * 0.85;
            track.scrollBy({ left: direction * step, behavior: 'smooth' });
        }

        previous.addEventListener('click', function () {
            scrollProducts(-1);
        });

        next.addEventListener('click', function () {
            scrollProducts(1);
        });

        track.addEventListener('scroll', updateButtons, { passive: true });
        window.addEventListener('resize', updateButtons);
        window.setTimeout(updateButtons, 0);
    });
})();
