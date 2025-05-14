let lastScrollTop = 0;
const navbar = document.getElementById("navbar");

window.addEventListener("scroll", function () {
  const currentScroll =
    window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop && currentScroll > 100) {
    // Scrolling down
    navbar.classList.add("hide");
  } else {
    // Scrolling up
    navbar.classList.remove("hide");
  }
  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});
