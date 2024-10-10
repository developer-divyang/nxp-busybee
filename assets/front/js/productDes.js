



// ----------------product Slider ------------------- 
var swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
// ----------------product Slider ------------------- 


// ----------------related Slider ------------------- 
var swiper = new Swiper(".relatedSwiper", {
    slidesPerView: 'auto',
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
  });


document.addEventListener('DOMContentLoaded', function () {
    initializeSliders();
});

function initializeSliders() {
    const prodImages = document.querySelectorAll('.prod-image-slider');

    prodImages.forEach((prodImage) => {
        const slides = prodImage.querySelectorAll('.prod-image-slide');
        let currentIndex = 0;

        slides[currentIndex].classList.add('active');

        const prevButton = prodImage.parentNode.querySelector('.prod-image-prev');
        const nextButton = prodImage.parentNode.querySelector('.prod-image-next');

        prevButton.addEventListener('click', () => {
            changeSlide(-1);
        });

        nextButton.addEventListener('click', () => {
            changeSlide(1);
        });

        function changeSlide(direction) {
            slides[currentIndex].classList.remove('active');

            currentIndex = (currentIndex + direction + slides.length) % slides.length;

            slides[currentIndex].classList.add('active');
        }
    });
}

// ----------------related Slider ------------------- 


document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".content");

    tabs.forEach(tab => {
        tab.addEventListener("click", function() {

            tabs.forEach(tab => tab.classList.remove("active"));
            

            tab.classList.add("active");
            
   
            contents.forEach(content => content.classList.remove("active"));
            
          
            const target = tab.getAttribute("data-target");
            console.log(`Activating content for: ${target}`);
            document.getElementById(target).classList.add("active");
        });
    });
});



// ---------tab content---------
var acc = document.getElementsByClassName("accordion-toggle");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("faqactive");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

// -----------------increment and decrement ------------------

document.querySelector('.decrement').addEventListener('click', function() {
    let value = parseInt(document.querySelector('.counter-value').textContent);
    if (value > 0) {
        document.querySelector('.counter-value').textContent = value - 1;
    }
});

document.querySelector('.increment').addEventListener('click', function() {
    let value = parseInt(document.querySelector('.counter-value').textContent);
    document.querySelector('.counter-value').textContent = value + 1;
});


