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


// ----------------- tabs ---------------------
const dashtabs = document.querySelectorAll('.dashtab');
const dashContents = document.querySelectorAll('.dashtab-content');
// const underline = document.querySelector('.underline');

// Function to remove active class from all dashtabs and content
function removeActiveClasses() {
    dashtabs.forEach(dashtab => dashtab.classList.remove('active'));
    dashContents.forEach(content => content.classList.remove('active'));
}

// Event listener for dashtab clicks
dashtabs.forEach(dashtab => {
    dashtab.addEventListener('click', (e) => {
        removeActiveClasses();
        
        // Activate the clicked dashtab
        dashtab.classList.add('active');
        
        // Display corresponding content
        const target = dashtab.getAttribute('data-target');
        document.getElementById(target).classList.add('active');

        // Move the underline to the clicked dashtab
        underline.style.left = `${dashtab.offsetLeft}px`;
        underline.style.width = `${dashtab.offsetWidth}px`;
    });
});

// Set initial active dashtab
dashtabs[0].classList.add('active');
dashContents[0].classList.add('active');
underline.style.width = `${dashtabs[0].offsetWidth}px`;
