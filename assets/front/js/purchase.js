

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


// document.addEventListener("DOMContentLoaded", function () {
//     const tabs = document.querySelectorAll(".tab");
//     const contents = document.querySelectorAll(".content");

//     // Check if an active tab is saved in localStorage and activate both tab and content
//     tabs.forEach(tab => tab.classList.remove("active"));
//     contents.forEach(content => content.classList.remove("active"));
//     const savedTab = localStorage.getItem('activeTab');
//     // alert(savedTab);
//     if (savedTab) {
//         // Activate the saved tab
//         document.querySelector(`.tab[data-target="${savedTab}"]`).classList.add("active");
//         // Activate the corresponding content
//         document.getElementById(savedTab).classList.add("active");
//     } else {
//         // If no saved tab, activate the first tab and its content by default
//         tabs[0].classList.add("active");
//         contents[0].classList.add("active");
//     }

//     tabs.forEach(tab => {
//         tab.addEventListener("click", function () {
//             // Remove the active class from all tabs and contents
//             tabs.forEach(tab => tab.classList.remove("active"));
//             contents.forEach(content => content.classList.remove("active"));

//             // Add active class to the clicked tab
//             tab.classList.add("active");

//             // Add active class to the corresponding content
//             const target = tab.getAttribute("data-target");
//             document.getElementById(target).classList.add("active");

//             // Save the currently active tab to localStorage
//             localStorage.setItem('activeTab', target);
//         });
//     });
// });


document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".content");
    let currentIndex = localStorage.getItem('currentTabIndex') ? parseInt(localStorage.getItem('currentTabIndex')) : 0;
    let visitedTabs = new Set();

    tabs.forEach((tab, index) => {
        if (index !== 0) {
            tab.classList.add("disabled");
        } else {
            visitedTabs.add(index);
        }
    });

    function activateTab(index) {
        tabs.forEach((tab, i) => {
            if (i <= index || visitedTabs.has(i)) {
                tab.classList.remove("disabled");
            } else {
                tab.classList.add("disabled");
            }
            tab.classList.toggle("active", i === index);
        });

        contents.forEach((content, i) => {
            content.classList.toggle("active", i === index);
        });

        localStorage.setItem('currentTabIndex', index);
    }

    activateTab(currentIndex);

    function activateNextTab() {
        if (currentIndex < tabs.length - 1) {
            currentIndex++;
            visitedTabs.add(currentIndex);
            activateTab(currentIndex);
        }
    }

    const nextButtons = document.querySelectorAll(".next");
    nextButtons.forEach(button => {
        button.addEventListener("click", activateNextTab);
    });

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const tabIndex = Array.from(tabs).indexOf(tab);
            if (!tab.classList.contains("disabled")) {
                currentIndex = tabIndex;
                activateTab(currentIndex);
            }
        });
    });
});




// ---------tab content---------
// var acc = document.getElementsByClassName("accordion-toggle");
// var i;

// for (i = 0; i < acc.length; i++) {
//     acc[i].addEventListener("click", function () {
//         this.classList.toggle("faqactive");
//         var panel = this.nextElementSibling;
//         if (panel.style.maxHeight) {
//             panel.style.maxHeight = null;
//         } else {
//             panel.style.maxHeight = panel.scrollHeight + "px";
//         }
//     });
// }

//set active class on load in accordion
// document.addEventListener('DOMContentLoaded', function() {
//     const activeAccordion = document.querySelector('.accordion-toggle.faqactive');
//     if (activeAccordion) {
//         const panel = activeAccordion.nextElementSibling;
//         panel.style.maxHeight = panel.scrollHeight + 'px';
//     }
// });
document.addEventListener("DOMContentLoaded", function () {
    var acc = document.getElementsByClassName("accordion-toggle");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].classList.add("faqactive");

        var panel = acc[i].nextElementSibling;
        panel.style.maxHeight = panel.scrollHeight + "px";
        panel.classList.add("expanded");


        acc[i].addEventListener("click", function () {
            this.classList.toggle("faqactive");

            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
                panel.classList.remove("expanded");
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
                panel.classList.add("expanded");
            }
        });
    }
});



const itemTypeBoxes = document.querySelectorAll('.itemTypeBox');


itemTypeBoxes.forEach((box) => {
    box.addEventListener('click', function () {
        itemTypeBoxes.forEach((otherBox) => {
            otherBox.classList.remove('selected');
        });


        this.classList.add('selected');
        $('#next').show();
    });
});


// plus minus------------------------
const minusBtn = document.querySelector('.minus-btn');
const plusBtn = document.querySelector('.plus-btn');
const quantityInput = document.querySelector('.quantity-input');


minusBtn.addEventListener('click', () => {
    let currentValue = parseInt(quantityInput.value, 10);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
});


plusBtn.addEventListener('click', () => {
    let currentValue = parseInt(quantityInput.value, 10);
    quantityInput.value = currentValue + 1;
});


//tabs working with next button uisng jquery

function nextTab() {
    const tabs = document.querySelectorAll('.tab');
    const activeTab = document.querySelector('.tab.active');
    const nextTab = activeTab.nextElementSibling;

    if (nextTab) {
        activeTab.classList.remove('active');
        nextTab.classList.add('active');

        // Save the active tab to localStorage
        localStorage.setItem('activeTab', nextTab.getAttribute('data-target'));
    }

    const contents = document.querySelectorAll('.content');
    const activeContent = document.querySelector('.content.active');
    const nextContent = activeContent.nextElementSibling;

    if (nextContent) {
        activeContent.classList.remove('active');
        nextContent.classList.add('active');
    }

    window.location.reload();


}

function backTab() {
    const tabs = document.querySelectorAll('.tab');
    const activeTab = document.querySelector('.tab.active');
    const backTab = activeTab.previousElementSibling;

    if (backTab) {
        activeTab.classList.remove('active');
        backTab.classList.add('active');

        // Save the active tab to localStorage
        localStorage.setItem('activeTab', backTab.getAttribute('data-target'));
    }

    const contents = document.querySelectorAll('.content');
    const activeContent = document.querySelector('.content.active');
    const backContent = activeContent.previousElementSibling;

    if (backContent) {
        activeContent.classList.remove('active');
        backContent.classList.add('active');
    }
}





// plus minus------------------------




// ----------------embBox------------------
// function selectEmbBox(selectedBox) {
//     // Deselect all boxes
//     const boxes = document.querySelectorAll('.embBox');
//     boxes.forEach(box => {
//       box.classList.remove('selected');
//       box.querySelector('.checkbox').classList.remove('selected');
//     });

//     // Select the clicked box
//     selectedBox.classList.add('selected');
//     selectedBox.querySelector('.checkbox').classList.add('selected');
//   }
// ----------------embBox------------------
// ----------------embBox------------------
// function selectlogoBox(selectedBox) {
//     // Deselect all boxes
//     const boxes = document.querySelectorAll('.LogoBox');
//     boxes.forEach(box => {
//       box.classList.remove('logoselected');
//       box.querySelector('.checkbox').classList.remove('logoselected');
//     });

//     // Select the clicked box
//     selectedBox.classList.add('logoselected');
//     selectedBox.querySelector('.checkbox').classList.add('logoselected');
//   }
// ----------------embBox------------------

function selectEmbroBox(selectedBox) {
    const allBoxes = document.querySelectorAll('.embBox');
    allBoxes.forEach(box => {
        box.classList.remove('embroselected');
        box.querySelector('.checkbox').classList.remove('embroselected');
    });

    selectedBox.classList.add('embroselected');
    selectedBox.querySelector('.checkbox').classList.add('embroselected');
    
    //get data-value of checkbox class which have class embroselected
    var emr_type= $(selectedBox).data('value');
    $('.g3').val(emr_type);
    constantCalculation();
}


// ------------------------ logoPlace box ---------------------
function selectLogoPlaceBox(selectedBox) {
    const allBoxes = document.querySelectorAll('.LogoPlaceBox');
    allBoxes.forEach(box => {
        box.classList.remove('logoPlaceSelected');
        box.querySelector('.checkbox').classList.remove('logoPlaceSelected');
    });


    selectedBox.classList.add('logoPlaceSelected');
    selectedBox.querySelector('.checkbox').classList.add('logoPlaceSelected');

    var front_type = $(selectedBox).data('value');
    $('.h3').val(front_type);
    constantCalculation();

}


// ------------------------ logoPlace box ---------------------


function selectlogoBox(selectedBox) {
    const id = selectedBox.getAttribute('data-id');
    const container = document.querySelector('.Additionaltextarea');
    const textareaID = `textarea-${id}`;

    const headings = {
        logo1: 'right_logo',
        logo2: 'back_logo',
        logo3: 'left_logo'
    };

    if (selectedBox.classList.contains('logoselected')) {
        selectedBox.classList.remove('logoselected');
        selectedBox.querySelector('.checkbox').classList.remove('logoselected');

        const textareaToRemove = document.getElementById(textareaID);
        if (textareaToRemove) {
            textareaToRemove.remove();
            // Reset related fields
            if (id === 'logo2') {
                // If the "Back" logo is unselected
                // $('.k3').val('no');
                // $('.k3').trigger('change');
                // $('.l3').val(''); // Reset back embroidery location
            }
            // constantCalculation();
        }
    } else {
        selectedBox.classList.add('logoselected');
        selectedBox.querySelector('.checkbox').classList.add('logoselected');

        if (id === 'logo2') {
            // If the "Back" logo is selected
            // $('.k3').val('yes');
            // $('.k3').trigger('change');
            // $('.l3').val('center'); // Set the back embroidery location to center
        }

        // constantCalculation();

        if (!document.getElementById(textareaID)) {
            const newTextareaDiv = document.createElement('div');
            newTextareaDiv.classList.add('Additionaltextarea');
            newTextareaDiv.id = textareaID;

            const heading = headings[id] || 'Notes';
            let formattedHeading = heading
                .toLowerCase()
                .replace(/_/g, ' ')
                .replace(/\b\w/g, function (char) {
                    return char.toUpperCase();
                });

            newTextareaDiv.innerHTML = `
                <h4>${formattedHeading}</h4>
               <div style="width: 100%; min-height: 40px; flex-wrap: wrap; display: flex; align-items: center; gap: 10px;">
                    <textarea class="Additionaltextareamain" placeholder="Placement and Size Notes"></textarea>
                    <div class="upload-container">
                        <div class="upload-btn-wrapper">
                            <button class="btn" onclick="handleButtonClick(event);">Upload Your Logo</button>
                            <input type="file" name="${heading}" id="fileInput" onchange="showFileName()">
                        </div>
                        <span class="file-name" id="fileName">No File Selected</span>
                    </div>
                </div>
            `;

            container.appendChild(newTextareaDiv);
        }
    }

    // Logic to check and set "both" value for left and right selections
    const leftSelected = document.querySelector('.LogoBox[data-id="logo1"]').classList.contains('logoselected');
    const rightSelected = document.querySelector('.LogoBox[data-id="logo3"]').classList.contains('logoselected');

    if (leftSelected && rightSelected) {
        
        $('.j3').val('both');
        $('.i3').val('yes');  // Set side embroidery to "yes" when both sides are selected
    } else if (leftSelected || rightSelected) {
        $('.j3').val(leftSelected ? 'right' : 'left');
        $('.i3').val('yes');  // Set side embroidery to "yes" if either side is selected
    } else {
        $('.j3').val('na'); // No side embroidery selected
        $('.i3').val('no');  // Set side embroidery to "no"
    }

    // $('.j3').trigger('change');
    // $('.i3').trigger('change');

    // Logic to manage the back logo selection (id === 'logo2')
    const backSelected = document.querySelector('.LogoBox[data-id="logo2"]').classList.contains('logoselected');
    if (backSelected) {
        $('.k3').val('yes'); // Set back embroidery to "yes"
        $('.l3').val('center'); // Set back embroidery location to center
    } else {
        $('.k3').val('no'); // Set back embroidery to "no"
        $('.l3').val(''); // Clear the back location field
    }
    // $('.i3').trigger('change');
    // $('.k3').trigger('change');

    constantCalculation();
}


function handleButtonClick(event) {
    // Prevent default button behavior
    event.preventDefault();

    // Trigger file input click
    document.getElementById('fileInput').click();
}




function showFileName() {
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');

    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
    } else {
        fileName.textContent = 'No File Selected';
    }
}


//   upload logo

document.getElementById('logo-upload').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : 'No File Selected';
    document.querySelector('.file-name').textContent = fileName;
});




//   select Logo in artwork upload section 


function selectLogo(element) {
    const selectedLogo = document.querySelector('.logo-container.selected');
    if (selectedLogo) {
        selectedLogo.classList.remove('selected');
    }
    element.classList.add('selected');
}



// drag and drop button--------------
function selectLogo(element) {
    const selectedLogo = document.querySelector('.logo-container.selected');
    if (selectedLogo) {
        selectedLogo.classList.remove('selected');
    }
    element.classList.add('selected');
}

const dropArea = document.getElementById('drop-area');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => {
        dropArea.classList.add('highlight');
    });
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => {
        dropArea.classList.remove('highlight');
    });
});

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;
    handleFiles(files);
}

function handleFiles(files) {
    ([...files]).forEach(previewImage);
}

function previewImage(file) {
    const dropArea = document.getElementById('drop-area');

    // Only handle image files
    if (!file.type.startsWith('image/')) {
        alert("Please upload an image file.");
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.alt = file.name;
        img.style.maxWidth = '80px';  // Adjust the size of the image preview as needed
        img.style.maxHeight = '80px';

        // Ensure the uploaded image is not grayscale
        img.style.filter = 'none';

        // Clear previous content and append the new image
        dropArea.innerHTML = '';
        dropArea.appendChild(img);
    }

    reader.readAsDataURL(file);
}




// -----content change-------




document.addEventListener('DOMContentLoaded', () => {
    const contentOne = document.getElementById('contentOne');
    const contentTwo = document.getElementById('contentTwo');
    const previousRadio = document.getElementById('previousRadio');
    const firstTimeRadio = document.getElementById('firstTimeRadio');
    const modal = document.getElementById('myCustomModal');
    const closeModalBtn = document.querySelector('.custom-close');

    function updateContent() {
        // alert('show modal');
        if (previousRadio.checked) {
            contentTwo.style.display = 'block';
            contentOne.style.display = 'none';
            //if find class user_login in previous radio button then show modal
            if (previousRadio.classList.contains('user_login')) {
                // alert('show modal');
                modal.style.display = 'block';
            }
            

                
            
            document.body.classList.add('modal-open');
        } else {
            contentOne.style.display = 'block';
            contentTwo.style.display = 'none';
            modal.style.display = 'none';
        }
    }

    updateContent();

    previousRadio.addEventListener('change', updateContent);
    firstTimeRadio.addEventListener('change', updateContent);

    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        document.body.classList.remove('modal-open');
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const tabButtons = document.querySelectorAll('.custom-tab-button');
    const tabPanes = document.querySelectorAll('.custom-tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to the clicked button
            button.classList.add('active');

            // Hide all tab panes
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Show the associated tab pane
            const targetPane = document.getElementById(button.getAttribute('data-target'));
            targetPane.classList.add('active');
        });
    });

    // Handle modal close button
    const modal = document.getElementById('myCustomModal');
    const closeModalBtn = document.querySelector('.custom-close');

    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        document.body.classList.remove('modal-open');  // Enable page scroll
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');  // Enable page scroll
        }
    });
});






document.addEventListener('DOMContentLoaded', function () {
    const thread = document.querySelector('.thread');
    let isDown = false;
    let startX;
    let scrollLeft;

    thread.addEventListener('mousedown', (e) => {
        isDown = true;
        thread.classList.add('active');
        startX = e.pageX - thread.offsetLeft;
        scrollLeft = thread.scrollLeft;
    });

    thread.addEventListener('mouseleave', () => {
        isDown = false;
        thread.classList.remove('active');
    });

    thread.addEventListener('mouseup', () => {
        isDown = false;
        thread.classList.remove('active');
    });

    thread.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - thread.offsetLeft;
        const walk = (x - startX) * 2; // Adjust scroll speed here
        thread.scrollLeft = scrollLeft - walk;
    });

    // Touch events for mobile
    thread.addEventListener('touchstart', (e) => {
        isDown = true;
        startX = e.touches[0].pageX - thread.offsetLeft;
        scrollLeft = thread.scrollLeft;
    });

    thread.addEventListener('touchend', () => {
        isDown = false;
    });

    thread.addEventListener('touchmove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.touches[0].pageX - thread.offsetLeft;
        const walk = (x - startX) * 2; // Adjust scroll speed here
        thread.scrollLeft = scrollLeft - walk;
    });
});

// ---------------------------------------checkout------------------------

const prices = [24.00, 24.00, 24.00];
const quantities = [10, 12, 8];

function updateSubTotal(index) {
    const qty = parseInt(document.querySelector(`input[data-id="${index}"]`).value);
    const subtotal = prices[index] * qty;
    document.getElementById(`subtotal-${index}`).textContent = `$${subtotal.toFixed(2)}`;
    updateTotal();
}

function updateTotal() {
    let total = 0;
    for (let i = 0; i < quantities.length; i++) {
        total += prices[i] * parseInt(document.getElementById(`qty-${i}`).value);
    }
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}

function increaseQty(index) {

    
    const qtyInput = document.querySelector(`input[data-id="${index}"]`);
    let qty = parseInt(qtyInput.value);
    // alert(index);
    qty++;
    qtyInput.value = qty;
    // updateSubTotal (index);
    let color = $(qtyInput).data('color-id');
    let size = $(qtyInput).data('size-id');
    let pid = $(qtyInput).data('product-id');
    saveToLocalStorage(pid);
    // let size = $(quantityInput).data('size-id');
    qty = $(qtyInput).val();
    addCart(1, size, color);


    // alert(qty);
    constantCalculation(qty, pid, index);

}


function decreaseQty(index) {


    const qtyInput = document.querySelector(`input[data-id="${index}"]`);
    let qty = parseInt(qtyInput.value);
    if (qty > 1) {
    qty--;
    qtyInput.value = qty;
    // updateSubTotal (index);
    let color = $(qtyInput).data('color-id');
    let size = $(qtyInput).data('size-id');
    let pid = $(qtyInput).data('product-id');
    saveToLocalStorage(pid);
    // let size = $(quantityInput).data('size-id');
    qty = $(qtyInput).val();
    removeCart(size, color, pid);


    // alert(qty);
    constantCalculation(qty, pid, index);
    }

}

// function decreaseQty(index) {
//     const qtyInput = document.getElementById(`qty-${index}`);
//     let qty = parseInt(qtyInput.value);
//     if (qty > 1) {
//         qty--;
//         qtyInput.value = qty;
//         updateSubTotal(index);

//     }
// }


// ------------------ payment section  -----------------------
document.querySelectorAll('input[name="payment-method"]').forEach((input) => {
    input.addEventListener('change', function () {
        const selectedMethod = this.value;
        console.log('Selected payment method:', selectedMethod);
        // Add your logic here for switching between payment methods
    });
});

