const profileMenu = document.querySelector('.nav-items-right li:nth-last-child(2) a');
const profileDropdown = profileMenu.nextElementSibling;

profileMenu.addEventListener('mouseenter', () => {
  profileDropdown.classList.remove('hidden');
  if (!cartDropdown.classList.contains('hidden')) {
    cartDropdown.classList.add('hidden');
  }
  if (!searchDropdown.classList.contains('hidden')) {
    searchDropdown.classList.add('hidden');
  }
});

// profileMenu.addEventListener('mouseleave', () => {
//   profileDropdown.classList.add('hidden');
// });

// Add this event listener to toggle visibility on click
profileMenu.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent default link behavior
  profileDropdown.classList.toggle('hidden');
});

const cartMenu = document.querySelector('.nav-items-right li:last-child a');
const cartDropdown = cartMenu.nextElementSibling;

cartMenu.addEventListener('mouseenter', () => {
  cartDropdown.classList.remove('hidden');
  if (!profileDropdown.classList.contains('hidden')) {
    profileDropdown.classList.add('hidden');
  }
  if (!searchDropdown.classList.contains('hidden')) {
    searchDropdown.classList.add('hidden');
  }
});

// cartMenu.addEventListener('mouseleave', () => {
//   cartDropdown.classList.add('hidden');
// });

// Add this event listener to toggle visibility on click
cartMenu.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent default link behavior
  cartDropdown.classList.toggle('hidden');
});

const searchBar = document.querySelector('.nav-items-right .search-form .search');
const searchDropdown = document.querySelector('.nav-items-right .search-form .search-hidden');

searchDropdown.addEventListener('click', (event) => {
  event.preventDefault();
  searchBar.classList.toggle('hidden');
  if (!profileDropdown.classList.contains('hidden')) {
    profileDropdown.classList.add('hidden');
  }
  if (!cartDropdown.classList.contains('hidden')) {
    cartDropdown.classList.add('hidden');
  }
});

window.addEventListener('resize', () => {

  const windowWidth = window.innerWidth;

  if (windowWidth < 1540) {
    searchBar.classList.add('hidden');
  }
  if (searchBar.classList.contains('hidden') && windowWidth > 1540) {
    searchBar.classList.remove('hidden');
  }
});

