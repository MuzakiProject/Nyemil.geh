const navbar = document.getElementById('mainNavbar');
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
  const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop && currentScroll > 100) {
    // Scroll ke bawah
    navbar.classList.remove('navbar-visible');
    navbar.classList.add('navbar-hidden');
  } else {
    // Scroll ke atas
    navbar.classList.remove('navbar-hidden');
    navbar.classList.add('navbar-visible');
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Menghindari negatif
});