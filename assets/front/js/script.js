const slider = document.querySelector('.work-slider');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});

slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;  
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 1; 
    slider.scrollLeft = scrollLeft - walk;
});



const categoryItems = document.querySelectorAll('.category-item');
const underline = document.querySelector('.underline');

categoryItems.forEach((item, index) => {
  item.addEventListener('click', () => {
    categoryItems.forEach(cat => cat.classList.remove('active'));
    
    item.classList.add('active');
    
    const itemPosition = item.getBoundingClientRect();
    const menuPosition = document.querySelector('.category-menu').getBoundingClientRect();
    
    
    const leftPosition = itemPosition.left - menuPosition.left + 5;
    const itemWidth = item.offsetWidth;
    
    underline.style.left = `${leftPosition}px`;
    underline.style.width = `${itemWidth}px`;
  });
});

const initialActiveItem = document.querySelector('.category-item.active');
if (initialActiveItem) {
  const initialPosition = initialActiveItem.getBoundingClientRect();
  const initialLeft = initialPosition.left - document.querySelector('.category-menu').getBoundingClientRect().left + 10;
  underline.style.left = `${initialLeft}px`;
  // underline.style.width = `${initialActiveItem.offsetWidth}px`;
  // underline.style.width = `${initialActiveItem.offsetWidth}px`;
}

document.querySelectorAll('.category-header').forEach(header => {
  header.addEventListener('click', function() {
    const subcategory = this.nextElementSibling;
    const toggle = this.querySelector('.toggle');
    
    if (subcategory.style.display === 'none' || subcategory.style.display === '') {
      subcategory.style.display = 'block';
      toggle.textContent = '-';
    } else {
      subcategory.style.display = 'none';
      toggle.textContent = '+';
    }
  });
});


// ---------------active nav---------------

// Apply the navActive class on page load based on localStorage
document.addEventListener('DOMContentLoaded', function() {
  var activePage = localStorage.getItem('activePage');
  if (activePage) {
      document.querySelectorAll('.center-nav ul li').forEach(function(navItem) {
          navItem.classList.remove('navActive');
      });
      document.querySelector(`.center-nav ul li[data-page="${activePage}"]`).classList.add('navActive');
  }
});

// Add event listener to set navActive class and store in localStorage
document.querySelectorAll('.center-nav ul li').forEach(function(navItem) {
  navItem.addEventListener('click', function() {
      var page = this.getAttribute('data-page');
      localStorage.setItem('activePage', page);
  });
});
