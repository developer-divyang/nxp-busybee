



const productsPerPage = 12;
let currentPage = 1;







function updatePaginationControls(products) {
    const totalPages = Math.ceil(products.length / productsPerPage);
    const paginationContainer = document.querySelector('.pagination');
    
    paginationContainer.innerHTML = ''; // Clear existing pagination buttons

    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = 'page-btn';
        pageBtn.textContent = i;

        if (i === currentPage) {
            pageBtn.classList.add('active');
        }

        pageBtn.addEventListener('click', () => {
            currentPage = i;
            // renderProducts(products, currentPage);
            // updatePaginationControls(products);
        });

        paginationContainer.appendChild(pageBtn);
    }

    if (currentPage < totalPages) {
        const nextBtn = document.createElement('button');
        nextBtn.className = 'page-btn';
        nextBtn.innerHTML = '&raquo;'; // Right arrow

        nextBtn.addEventListener('click', () => {
            currentPage++;
            // renderProducts(products, currentPage);
            // updatePaginationControls(products);
        });

        paginationContainer.appendChild(nextBtn);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // renderProducts(products, currentPage);
    // updatePaginationControls(products);
});


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('ul.left-menu li > ul').forEach(function(subMenu) {
        subMenu.style.display = 'none';
    });

    document.querySelectorAll('ul.left-menu li').forEach(function(menuItem) {
        menuItem.addEventListener('click', function(e) {
            const subMenu = this.querySelector('ul');
            if (subMenu) {
                if (subMenu.style.display === 'none' || subMenu.style.display === '') {
                    subMenu.style.display = 'block';
                } 
            }
        });
    });

    document.querySelectorAll('ul.left-menu li a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const subMenu = this.querySelector('ul');
            if (subMenu) {
                if (subMenu.style.display === 'none' || subMenu.style.display === '') {
                    subMenu.style.display = 'block';
                }else{
                    subMenu.style.display = 'block';

                }
            }
        });
    });
});

const minRange = document.getElementById('minRange');
const maxRange = document.getElementById('maxRange');
const rangeMinValue = document.getElementById('rangeMinValue');
const rangeMaxValue = document.getElementById('rangeMaxValue');
const sliderTrack = document.querySelector('.slider-track');

function updateSlider() {
  let minValue = parseInt(minRange.value);
  let maxValue = parseInt(maxRange.value);

  if (maxValue - minValue <= 10) {
    if (this === minRange) {
      minRange.value = maxValue - 10;
    } else {
      maxRange.value = minValue + 10;
    }
  }

  rangeMinValue.textContent = `$${minRange.value}.00`;
  rangeMaxValue.textContent = `$${maxRange.value}.00`;

  let percent1 = ((minRange.value - minRange.min) / (minRange.max - minRange.min)) * 100;
  let percent2 = ((maxRange.value - maxRange.min) / (maxRange.max - maxRange.min)) * 100;

  sliderTrack.style.background = `linear-gradient(to right, #ccc ${percent1}%, #d87b1a ${percent1}%, #d87b1a ${percent2}%, #ccc ${percent2}%)`;
}

minRange.addEventListener('input', updateSlider);
maxRange.addEventListener('input', updateSlider);

updateSlider();



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





































