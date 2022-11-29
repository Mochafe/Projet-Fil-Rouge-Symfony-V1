const addressAdd = document.getElementById("addressAdd");
const number = document.getElementById("number");
const street = document.getElementById("street");
const zipcode = document.getElementById("zipcode");
const city = document.getElementById("city");
const country = document.getElementById("country");
const addressError = document.getElementById("address-error");


addressAdd.addEventListener("click", (event) => {
    event.preventDefault();

    if(number.value == "" 
    || street.value == "" 
    || zipcode.value == "" 
    || city.value == "" 
    || country.value == ""
    ) {
        addressError.classList.remove("d-none");
        addressError.classList.add("d-block");
        return;
    }

    fetch("/address/add", {
        method: 'POST',
        body: JSON.stringify({
            "number": number.value,
            "street": street.value,
            "zipcode": zipcode.value,
            "city": city.value,
            "country": country.value
        })
    }).then(() => {
        location.reload(true);
    })
});