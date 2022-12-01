const search = document.getElementById("search");
let searchItem = document.getElementById("search-item");

setInterval(() => {
    if (document.activeElement != search) {
        searchItem.classList.add("d-none");
    }
}, 400);

search.addEventListener("input", ManageSearch);
search.addEventListener("click", ManageSearch);



function ManageSearch() {
    if(!search.value) return;
    
    fetch(`/search?search=${search.value}`).then((res) => {
        res.json().then(json => {

            if (document.activeElement == search && json.length > 0) {
                searchItem.innerHTML = "";
                const searchValue = search.value.toLowerCase();

                for (let i = 0; i < json.length; i++) {
                    const foundValue = json[i].name.toLowerCase();

                    const indexFound = foundValue.indexOf(searchValue);
                    const text = foundValue.slice(0, indexFound) + `<span class="fw-bold fs-5">` + foundValue.slice(indexFound, indexFound + searchValue.length) + `</span>` + foundValue.slice(indexFound + searchValue.length);

                    searchItem.innerHTML += `<a class="text-decoration-none" href="/product/view/${json[i].id}"><li class="list-group-item fw-normal">${text}</li></a>`;
                }

                searchItem.classList.remove("d-none");
            } else {
                searchItem.classList.add("d-none");
            }
        });
    });
}