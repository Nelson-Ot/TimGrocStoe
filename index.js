document.addEventListener('DOMContentLoaded', function() {

    // Initialize Swiper.js
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        effect: 'slide', // or 'fade' depending on preference
    });

    // Toast auto-hide
    const toast = document.querySelector('.toaster');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.style.display = 'none', 300);
        }, 5000);
    }

    // Close button for toast
    const closeToast = document.querySelector('.toast-close');
    if (closeToast) {
        closeToast.addEventListener('click', function() {
            toast.style.opacity = '0';
            setTimeout(() => toast.style.display = 'none', 300);
        });
    }
});
