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

$(document).ready(function () {
    console.log("jQuery Ready!");
});

// $("#login-register .close").click(function() {
//     $("#login-register .dropdown.categorie-search-box").fadeOut("slow");
//     $("#login-register .dropdown.categorie-search-box").css("display", "none");
// });

$(document).ready(function () {
    $("#qty_input").prop("disabled", true);
    $("#plus-btn").click(function () {
        var price_item = parseInt($("#price_per_item").val());
        var counter = parseInt($("#qty_input").val()) + 1;
        var priceTotal = document.getElementById("price_total");
        $("#qty_input").val(counter);
        priceTotal.innerHTML = (price_item * counter).toFixed(2).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
            });
    });
    $("#minus-btn").click(function () {
        var price_item = parseInt($("#price_per_item").val());
        var counter = parseInt($("#qty_input").val()) - 1;
        if( counter >= 1 ){
        var priceTotal = document.getElementById("price_total");
            console.log("lappet");
            $("#qty_input").val(counter);            
            priceTotal.innerHTML = (price_item * counter).toFixed(2).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });;         
        }
        
        if ($("#qty_input").val() == 0) {
                $("#qty_input").val(1);
            }
    });
});

$(document).ready(function () {
    $('#track-order-title').click(function () {
        console.log('click')
        $('#search-item-title').removeClass('title-active');
        $('#track-order-title').addClass('title-active');
        $('#search-item').css('display', 'none');
        $('#track-order').css('display', 'block');
    });

    $('#search-item-title').click(function () {
        console.log('click')
        $('#track-order-title').removeClass('title-active');
        $('#search-item-title').addClass('title-active');
        $('#track-order').css('display', 'none');
        $('#search-item').css('display', 'block');
    });
});

function addToCart(product_id) {
    var qty = $("#qty_input").val();
    var size = $("#size_input").val();
    let formData = $('form').serializeArray();
    $.ajax({    
      type: "POST",
      data: {_token:$('#token').val(), size_id:size, quantity:qty}, 
      url: '/shop/addToCart/' + product_id,
      success: function(result) {
         //location.reload();
      }
    });
  }
