/**
 * HeroMarket Theme JS
 */

document.addEventListener('DOMContentLoaded', function () {

    // Mobile nav toggle
    var toggle = document.querySelector('.nav-toggle');
    var nav = document.querySelector('.main-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('active');
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !expanded);
        });
    }

    // Hero Slider
    var heroEl = document.querySelector('.heroSwiper');
    if (heroEl) {
        new Swiper('.heroSwiper', {
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            effect: 'fade',
            fadeEffect: { crossFade: true }
        });
    }

    // Promotion tab filter
    var tabButtons = document.querySelectorAll('.tab-nav button');
    var promoCards = document.querySelectorAll('#promoGrid .promo-card');

    tabButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabButtons.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var filter = btn.getAttribute('data-filter');

            promoCards.forEach(function (card) {
                if (filter === 'all') {
                    card.style.display = '';
                } else {
                    var cats = card.getAttribute('data-category') || '';
                    card.style.display = cats.indexOf(filter) !== -1 ? '' : 'none';
                }
            });
        });
    });

    // Store region filter
    var storeButtons = document.querySelectorAll('.store-tabs button');
    var storeCards = document.querySelectorAll('#storeGrid .store-card');

    storeButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            storeButtons.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var region = btn.getAttribute('data-region');

            storeCards.forEach(function (card) {
                if (region === 'all') {
                    card.style.display = '';
                } else {
                    var regions = card.getAttribute('data-region') || '';
                    card.style.display = regions.indexOf(region) !== -1 ? '' : 'none';
                }
            });
        });
    });
});
