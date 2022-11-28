const cartItems = document.getElementsByName("quantity");
const prices = document.getElementsByName("prices");

cartItems.forEach((cartItem, index) => {
    cartItem.addEventListener("change", () => {
        prices[index].innerHTML = `${cartItem.value * cartItem.dataset.price} €`;
        fetch(`/cart/update?cartDetail=${cartItem.dataset.id}&quantity=${cartItem.value}`);
    });
});