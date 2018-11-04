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

// $(".owl-carousel").owlCarousel({
//     loop: true,
//     margin: 10,
//     nav: true,
//     responsive: {
//         0: {
//             items: 1
//         },
//         600: {
//             items: 3
//         },
//         1000: {
//             items: 5
//         }
//     }
// });

$("#login-register .close").click(function() {
    $("#login-register .dropdown.categorie-search-box").fadeOut("slow");
    // $("#login-register .dropdown.categorie-search-box").css("display", "none");
});

$(document).ready(function() {
    $("#qty_input").prop("disabled", true);
    $("#plus-btn").click(function() {
        $("#qty_input").val(parseInt($("#qty_input").val()) + 1);
    });
    $("#minus-btn").click(function() {
        $("#qty_input").val(parseInt($("#qty_input").val()) - 1);
        if ($("#qty_input").val() == 0) {
            $("#qty_input").val(1);
        }
    });
});
