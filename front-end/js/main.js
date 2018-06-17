document.addEventListener("DOMContentLoaded", function() { 
	var cakeIcon = document.querySelector('.header-cake-icon span');
	var headerRow = document.querySelector('.header-row');
	var header = document.querySelector('.page-header');

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


