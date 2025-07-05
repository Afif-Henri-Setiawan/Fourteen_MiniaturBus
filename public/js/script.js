  const header = document.querySelector("header");
  const hamburger = document.querySelector("#hamburger");
  const navMenu = document.querySelector("#nav-menu");

  if (header) {
    const fixedNav = header.offsetTop;
    window.onscroll = function () {
      if (window.pageYOffset > fixedNav) {
        header.classList.add("navbar-fix");
      } else {
        header.classList.remove("navbar-fix");
      }
    };
  }

  if (hamburger && navMenu) {
    hamburger.addEventListener("click", function () {
      hamburger.classList.toggle("hamburger-active");
      navMenu.classList.toggle("hidden");
    });
  }

