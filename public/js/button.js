function search(){
    let search = document.getElementById('search');
    if(search == "flex"){
        search.style.display = "none";
    }
    else{
        search.style.display = "flex";
    }
}

function filters(){
    let filters = document.getElementById('filters');
    if(filters == "flex"){
        filters.style.display = "none";
    }
    else{
        filters.style.display = "flex";
    }
}

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});