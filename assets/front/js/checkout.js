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
    box.addEventListener('click', function() {
        itemTypeBoxes.forEach((otherBox) => {
            otherBox.classList.remove('selected');
        });
        

        this.classList.add('selected');
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

// ---------------------------------------checkout------------------------

const prices = [24.00, 24.00, 24.00];
const quantities = [10, 12, 8];

function updateSubTotal(index) {
    const qty = parseInt(document.getElementById(`qty-${index}`).value);
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
    const qtyInput = document.getElementById(`qty-${index}`);
    let qty = parseInt(qtyInput.value);
    qty++;
    qtyInput.value = qty;
    updateSubTotal(index);
}

function decreaseQty(index) {
    const qtyInput = document.getElementById(`qty-${index}`);
    let qty = parseInt(qtyInput.value);
    if (qty > 1) {
        qty--;
        qtyInput.value = qty;
        updateSubTotal(index);
    }
}


// ------------------ payment section  -----------------------
document.querySelectorAll('input[name="payment-method"]').forEach((input) => {
    input.addEventListener('change', function() {
        const selectedMethod = this.value;
        console.log('Selected payment method:', selectedMethod);
        // Add your logic here for switching between payment methods
    });
});
