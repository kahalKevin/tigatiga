//=include ./vendor/jquery.min.js
//=include ./vendor/jquery.meanmenu.min.js
//=include ./vendor/jquery.scrollUp.js
//=include ./vendor/jquery.fancybox.min.js
//=include ./vendor/jquery.nice-select.min.js
//=include ./vendor/jquery-ui.min.js
//=include ./vendor/owl.carousel.min.js
//=include ./vendor/bootstrap.min.js
//=include ./vendor/plugins.js
//=include ./vendor/main.js

$(document).ready(function() {
    console.log("jQuery Ready!");
});

$("#login-register .close").click(function() {
    $("#login-register .dropdown.categorie-search-box").fadeOut("slow");
    // $("#login-register .dropdown.categorie-search-box").css("display", "none");
});
