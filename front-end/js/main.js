document.addEventListener("DOMContentLoaded", function() { 
	var cakeIcon = document.querySelector('.header-cake-icon span');
	var headerRow = document.querySelector('.header-row');
	var header = document.querySelector('.page-header');
	var headerDropDownLink = document.querySelector('.header-dropdown');
	var headerDropDownMenu = document.querySelector('.header-dropdown-menu-wrapper');
	var headerArrow = document.querySelector('.header-dropdown-icon');

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
		if(headerCoords <= 750 && headerCoords >= 200) {
			headerRow.style.opacity = 0;
		} else {
			headerRow.style.opacity = 1;
		}
	}
	window.onscroll = function() {
		scrollMenu();
	};
	cakeIcon.innerHTML = `<svg><use xlink:href="#icon-cake-${getRandomArbitrary(1,6)}" /></svg>`;
});
