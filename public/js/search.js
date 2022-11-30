const search = document.getElementById("search");

search.addEventListener("input", () => {
    fetch(`/search?search=${search.value}`).then((res) => {
        res.json().then(json => {
            console.log(json);
        });
    });
});