document.addEventListener("DOMContentLoaded", function() { 
	var cakeIcon = document.querySelector('.header-cake-icon span');
	var headerRow = document.querySelector('.header-row');
	var header = document.querySelector('.page-header');
	var headerDropDownLink = document.querySelector('.header-dropdown');
	var headerDropDownMenu = document.querySelector('.header-dropdown-menu');
	var headerArrow = document.querySelector('.header-dropdown-icon');
	var headerLogoCat = document.querySelector('.logo-cat');
	var footerColumnForImage = document.querySelector('.footer-column-image');


	headerDropDownLink.addEventListener('mouseover', function() {
		headerDropDownMenu.style.opacity = 1;
		headerDropDownMenu.style.visibility = 'visible';
		this.style.backgroundColor = '#7507C9';
		this.children[0].style.color = '#fff';
		headerArrow.style.transform = 'rotate(180deg)';
		headerArrow.style.borderTopColor = '#fff';
	})
	headerDropDownLink.addEventListener('mouseout', function() {
		headerDropDownMenu.style.opacity = 0;
		headerDropDownMenu.style.visibility = 'hidden';
		this.style.backgroundColor = '#fff';
		this.children[0].style.color = '#7507C9';
		headerArrow.style.transform = 'rotate(0)';
		headerArrow.style.borderTopColor = '#7507C9';
	})
	function getRandomArbitrary(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	function scrollMenu() {
		var headerCoords = header.getBoundingClientRect().bottom;

		if(headerCoords < 400) {
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
		scrollMenu();
	};
	cakeIcon.innerHTML = `<svg><use xlink:href="#icon-cake-${getRandomArbitrary(1,6)}" /></svg>`;
	footerColumnForImage.innerHTML = `<svg class="footer-animate-icon"><use xlink:href="#icon-cake-${getRandomArbitrary(1,6)}" /></svg>`;
});
