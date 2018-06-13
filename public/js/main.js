const menuBtn = document.querySelector('.hide-menu');
const headerNav = document.querySelector('.header-nav');

menuBtn.addEventListener('click', function() {
	headerNav.classList.toggle('header-nav-mobile'),
	menuBtn.classList.toggle('hide-menu-active');
})

const loginBtn = document.querySelector('.profile');
const popup = document.querySelector('.login-popup');
const loginCloseBtn = document.querySelector('.popup-close-button');

loginBtn.addEventListener('click', function() {
	popup.classList.toggle('popup-show');
})
 
loginCloseBtn.addEventListener('click', function() {
	if (popup.classList.contains('popup-show')) {
		popup.classList.remove('popup-show');
	}
})
let basket = document.querySelector('.header-basket-value');
let basketValue = +basket.textContent.slice(1);
let addToBasket = document.querySelectorAll('.basket');
const basketShow = document.querySelector('.basket-items');
const basketBtn = document.querySelector('.header-basket');

for(let i = 0; i < addToBasket.length; i++) {
	addToBasket[i].addEventListener('click', function(e) {
		e.preventDefault();
		let newValue = Math.round(this.closest('.product-item').getAttribute('data-cost'));
		basketValue += newValue;
		basket.innerHTML = `$${basketValue}.00`;

		let li = document.createElement('li');
		li.innerHTML = `${this.closest('.product-item').getAttribute('data-name')} : $${newValue}.00`;
		basketShow.appendChild(li);
	})
}

basketBtn.addEventListener('mouseover', function() {
	basketShow.classList.add('basket-items-show');
})
basketBtn.addEventListener('mouseout', function() {
	basketShow.classList.remove('basket-items-show');
})

const favoriteItems = document.querySelector('.favorite-items');
const headerFavBtn = document.querySelector('.header-favorites');

let addToFavorite = document.querySelectorAll('.favorites');
for(let i = 0; i < addToFavorite.length; i++) {
	addToFavorite[i].addEventListener('click', function(e) {
		e.preventDefault();
		let li = document.createElement('li');
		li.innerHTML = `${this.closest('.product-item').getAttribute('data-name')}`;
		favoriteItems.appendChild(li);
	})
}
headerFavBtn.addEventListener('mouseover', function(e) {
	favoriteItems.classList.add('favorite-items-show');
})
headerFavBtn.addEventListener('mouseout', function() {
	favoriteItems.classList.remove('favorite-items-show');
})