document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.testimonials-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 30,
        loop: true,
        centeredSlides: false,
        navigation: {
            nextEl: '.testimonials-button-next',
            prevEl: '.testimonials-button-prev',
        }
    });
});