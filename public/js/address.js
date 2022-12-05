const addressAdd = document.getElementById("addressAdd");
const number = document.getElementById("number");
const street = document.getElementById("street");
const zipcode = document.getElementById("zipcode");
const city = document.getElementById("city");
const cityDataList = document.getElementById("city-datalist");
const country = document.getElementById("country");
const addressError = document.getElementById("address-error");

const urlApi = "https://apicarto.ign.fr/api/codes-postaux/communes/";

zipcode.addEventListener("keyup", () => {
    fetch(urlApi + zipcode.value.trim()).then(response => {
        response.json().then(json => {
            cityDataList.innerHTML = "";
            for(let i = 0; i < json.length; i++) {
                cityDataList.innerHTML += `<option value="${json[i].nomCommune}">`;
            }
        });
    });
});


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