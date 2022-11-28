const cartItems = document.getElementsByName("quantity");
const prices = document.getElementsByName("prices");
const subtotal = document.getElementById("subtotal");
const vat = document.getElementById("vat-price");
const total = document.getElementById("total");


cartItems.forEach((cartItem, index) => {
    updateCalculation(index, cartItem);
    cartItem.addEventListener("change", () => {
        updateCalculation(index, cartItem);
        fetch(`/cart/update?cartDetail=${cartItem.dataset.id}&quantity=${cartItem.value}`);
    });
});

function updateCalculation(index, cartItem) {
    let sum = 0;
    cartItems.forEach(cartItem => {
        sum += Number(cartItem.dataset.price * cartItem.value);
    });

    console.log(sum);

    prices[index].innerHTML = `${cartItem.value * cartItem.dataset.price} €`;
    subtotal.innerText = sum.toFixed(2);
    vat.innerHTML = (sum * (vat.dataset.vat / 100)).toFixed(2);
    total.innerHTML = (sum * ((vat.dataset.vat / 100) + 1) + 4.99).toFixed(2);
}