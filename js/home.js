var swiper = new Swiper(".swiper-container", {
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  loop: true,
  autoplay: {
      delay: 2000,
      disableOnInteraction: false,
  },
  speed: 1000,
});

const favActive = (event) =>{
  event.preventDefault();
  var favIcon = document.getElementsByClassName('fav-icon')[0];
  favIcon.classList.toggle('fa-regular');
  favIcon.classList.toggle('fa-solid');
}