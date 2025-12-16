// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Dash - Front page interactive functionality.
 *
 * @module     theme_dash/frontpage
 * @copyright  2024 Dash Authority
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery'], function($) {

    /**
     * Initialize FAQ accordion functionality.
     */
    const initFaqAccordion = function() {
        $(document).on('click', '.dash-faq-question', function() {
            const $question = $(this);
            const $answer = $question.next('.dash-faq-answer');
            const isExpanded = $question.attr('aria-expanded') === 'true';

            // Toggle current item
            $question.attr('aria-expanded', !isExpanded);
            $answer.toggleClass('show');

            // Optionally close other items (accordion behavior)
            // Uncomment the following to enable single-open accordion
            /*
            const $parent = $question.closest('.dash-faq-item');
            $parent.siblings('.dash-faq-item').find('.dash-faq-question').attr('aria-expanded', 'false');
            $parent.siblings('.dash-faq-item').find('.dash-faq-answer').removeClass('show');
            */
        });
    };

    /**
     * Initialize back to top button functionality.
     */
    const initBackToTop = function() {
        const $button = $('.dash-back-to-top');

        if (!$button.length) {
            return;
        }

        // Show/hide button based on scroll position
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $button.addClass('visible');
            } else {
                $button.removeClass('visible');
            }
        });

        // Scroll to top on click
        $button.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });
    };

    /**
     * Initialize smooth scrolling for anchor links.
     */
    const initSmoothScroll = function() {
        $(document).on('click', 'a[href^="#"]:not([href="#"])', function(e) {
            const target = $(this.hash);

            if (target.length) {
                e.preventDefault();

                $('html, body').animate({
                    scrollTop: target.offset().top - 80 // Account for fixed header
                }, 500);

                // Update URL hash without jumping
                if (history.pushState) {
                    history.pushState(null, null, this.hash);
                }
            }
        });
    };

    /**
     * Initialize counter animation for stats section.
     */
    const initCounterAnimation = function() {
        const $counters = $('.dash-stat-number[data-count]');

        if (!$counters.length) {
            return;
        }

        const animateCounter = function($counter) {
            const target = parseInt($counter.data('count'), 10);
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;

            const updateCounter = function() {
                current += step;
                if (current >= target) {
                    $counter.text(target.toLocaleString());
                } else {
                    $counter.text(Math.floor(current).toLocaleString());
                    requestAnimationFrame(updateCounter);
                }
            };

            updateCounter();
        };

        // Use Intersection Observer to trigger animation when visible
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter($(entry.target));
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            $counters.each(function() {
                observer.observe(this);
            });
        } else {
            // Fallback for older browsers
            $counters.each(function() {
                animateCounter($(this));
            });
        }
    };

    /**
     * Initialize lazy loading for images.
     */
    const initLazyLoading = function() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');

            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px'
            });

            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        } else {
            // Fallback: load all images immediately
            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(function(img) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
        }
    };

    /**
     * Initialize testimonials carousel (if present).
     */
    const initTestimonialsCarousel = function() {
        const $carousel = $('.dash-testimonials-carousel');

        if (!$carousel.length) {
            return;
        }

        const $items = $carousel.find('.dash-testimonial-card');
        const itemCount = $items.length;
        let currentIndex = 0;
        let autoplayInterval;

        const showItem = function(index) {
            $items.removeClass('active');
            $items.eq(index).addClass('active');

            // Update indicators
            $carousel.find('.carousel-indicator').removeClass('active');
            $carousel.find('.carousel-indicator').eq(index).addClass('active');
        };

        const nextItem = function() {
            currentIndex = (currentIndex + 1) % itemCount;
            showItem(currentIndex);
        };

        const prevItem = function() {
            currentIndex = (currentIndex - 1 + itemCount) % itemCount;
            showItem(currentIndex);
        };

        const startAutoplay = function() {
            autoplayInterval = setInterval(nextItem, 5000);
        };

        const stopAutoplay = function() {
            clearInterval(autoplayInterval);
        };

        // Navigation buttons
        $carousel.find('.carousel-next').on('click', function() {
            nextItem();
            stopAutoplay();
            startAutoplay();
        });

        $carousel.find('.carousel-prev').on('click', function() {
            prevItem();
            stopAutoplay();
            startAutoplay();
        });

        // Indicator clicks
        $carousel.find('.carousel-indicator').on('click', function() {
            currentIndex = $(this).index();
            showItem(currentIndex);
            stopAutoplay();
            startAutoplay();
        });

        // Pause on hover
        $carousel.on('mouseenter', stopAutoplay);
        $carousel.on('mouseleave', startAutoplay);

        // Start autoplay
        showItem(0);
        startAutoplay();
    };

    /**
     * Initialize scroll reveal animations.
     */
    const initScrollReveal = function() {
        const $elements = $('[data-reveal]');

        if (!$elements.length || !('IntersectionObserver' in window)) {
            return;
        }

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const $el = $(entry.target);
                    const delay = $el.data('reveal-delay') || 0;

                    setTimeout(function() {
                        $el.addClass('revealed');
                    }, delay);

                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        $elements.each(function() {
            observer.observe(this);
        });
    };

    /**
     * Initialize all front page functionality.
     */
    const init = function() {
        $(document).ready(function() {
            initFaqAccordion();
            initBackToTop();
            initSmoothScroll();
            initCounterAnimation();
            initLazyLoading();
            initTestimonialsCarousel();
            initScrollReveal();
        });
    };

    return {
        init: init
    };
});

