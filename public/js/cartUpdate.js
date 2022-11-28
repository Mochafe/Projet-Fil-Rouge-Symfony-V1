const cartItems = document.getElementsByName("quantity");

cartItems.forEach(cartItem => {
    cartItem.addEventListener("change", () => {
        fetch(`/cart/update?cartDetail=${cartItem.dataset.id}&quantity=${cartItem.value}`);
    });
});