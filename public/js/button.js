function search(){
    let search = document.getElementById('search');
    let filters = document.getElementById('filters');
    if(search == "flex" && filters == "flex"){
        search.style.display = "none";
        filters.style.display = "none";
    }
    else{
        search.style.display = "flex";
        filters.style.display = "flex";
    }
}