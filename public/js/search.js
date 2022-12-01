const search = document.getElementById("search");
let searchItem = document.getElementById("search-item");

setInterval(() => {
    if (document.activeElement != search) {
        searchItem.classList.add("d-none");
    }
}, 600); 

search.addEventListener("input", () => {
    fetch(`/search?search=${search.value}`).then((res) => {
        res.json().then(json => {

            if (document.activeElement == search && json.length > 0) {
                searchItem.innerHTML = "";

                for(let i = 0; i < json.length; i++) {
                    searchItem.innerHTML += `<a class="text-decoration-none" href="/product/view/${json[i].id}"><li class="list-group-item">${json[i].name}</li></a>`;
                }

                searchItem.classList.remove("d-none");
            } else {
                searchItem.classList.add("d-none");
            }
        });
    });
});


