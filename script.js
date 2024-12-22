var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    loop: true,
    spaceBetween: 0, // Show 2 slides at once// Optional: Space between slides in pixels
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }, // Optional: Allows for continuous loop mode
    breakpoints: {
        480: {  // When window width is >= 640px
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {  // When window width is >= 768px
          slidesPerView: 2,
          spaceBetween: 0,
        },
        1024: {  // When window width is >= 1024px
          slidesPerView: 4,
          spaceBetween: 0,
        },
        320: {  // When window width is >= 1024px
            slidesPerView: 2,
            spaceBetween: 40,
          },
      },
    });

    var swiper1 = new Swiper(".mySwiper2", {
        slidesPerView: 1,
        spaceBetween: 100,
        navigation: {
          nextEl: ".swiper-button-next2",
          prevEl: ".swiper-button-prev2",
        },
        loop: true,
      });

      function toggleForms() {
        document.getElementById('login-form').classList.toggle('hidden');
        document.getElementById('register-form').classList.toggle('hidden');
    }
    