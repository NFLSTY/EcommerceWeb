// Navbar scroll behavior
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



// // Change price to a proper format
// const input = document.getElementById("product-price");

// input.addEventListener("input", function (e) {
//   let value = e.target.value.replace(/[^0-9]/g, "");
//   if (value) {
//     e.target.value = formatRupiah(value);
//   } else {
//     e.target.value = "";
//   }
// });

// function formatRupiah(number) {
//   return "Rp" + number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
// }
