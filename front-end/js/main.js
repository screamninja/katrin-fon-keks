document.addEventListener("DOMContentLoaded", function() { 
	var cakeIcon = document.querySelector('.header-cake-icon span');
	var header = document.querySelector('.page-header');
	var headerLogoCat = document.querySelector('.page-logo-cat');
	var footerColumnForImage = document.querySelector('.footer-icon');
	var headerBurgerBtn = document.querySelector('.header-burger');
	var headerNav = document.querySelector('.header-nav');
	var headerLinkDropdown = document.querySelector('.header-link-dropdown');
	var headerDropdownMenu = document.querySelector('.header-dropdown-menu');

	headerLinkDropdown.addEventListener('click', function(e) {
		e.preventDefault();
		headerDropdownMenu.classList.toggle('header-dropdown-menu-show');
	})

	headerBurgerBtn.addEventListener('click', function() {
		headerNav.classList.toggle('header-nav-show');
		this.classList.toggle('header-burger-open');
	})

	function getRandomArbitrary(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	function scrollMenu() {
		var headerCoords = header.getBoundingClientRect().bottom;
		if(headerCoords < 400 ) {
			headerLogoCat.style.width = '100px';
			headerLogoCat.style.height = '125px';
			headerLogoCat.style.transform = 'translateX(60px)';
		} else {
			headerLogoCat.style.width = '200px';
			headerLogoCat.style.height = '250px';
			headerLogoCat.style.transform = 'translate(0,0)';
		}
	}
	window.onscroll = function() {
		if (window.innerWidth >= 1280) {
			scrollMenu();
		}
	};
	window.onresize = function() {
		if(window.innerWidth <= 1280) {
			headerLogoCat.style.width = '100px';
			headerLogoCat.style.height = '125px';
		} else {
			headerLogoCat.style.width = '200px';
			headerLogoCat.style.height = '250px';
		}
	}
	 if (window.innerWidth >= 500) {
    footerColumnForImage.innerHTML =
      '<svg class="footer-animate-icon"><use xlink:href="#icon-cake-' +
      getRandomArbitrary(1, 6) +
      '" /></svg>';
  }
  cakeIcon.innerHTML =
    '<svg><use xlink:href="#icon-cake-' +
    getRandomArbitrary(1, 6) +
    '" /></svg>';
		
});
