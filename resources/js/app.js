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
        $("#track-order").prop('disabled', false);
        $("#search-item").prop('disabled', true);
        $('#form-header-search').attr('action', '#');
    });

    $('#search-item-title').click(function () {
        console.log('click')
        $('#track-order-title').removeClass('title-active');
        $('#search-item-title').addClass('title-active');
        $('#track-order').css('display', 'none');
        $('#search-item').css('display', 'block');
        $("#track-order").prop('disabled', true);
        $("#search-item").prop('disabled', false);
        $('#form-header-search').attr('action', 'shop/index-search');
        
    });
});

function addToCart(product_id) {
    var qty = $("#qty_input").val();
    var size = $("#size_input").val();
    let formData = $('form').serializeArray();
    $.ajax({    
      type: "POST",
      data: {_token:$('#token').val(), size_id:size, quantity:qty},
      url: URL + '/shop/addToCart/' + product_id,
      success: function(result) {
         alert("Success add to cart");
         location.reload();
      },
      error: function (request, status, error) {
        alert("Add to cart fail, " + request.responseJSON.message);
      }
    });
}

function paymentLoggedIn() {
    var shippingCost = $('#total-shipping-cost-usage').val();
    if(shippingCost==""){
        return 0;
    }
    var orderId = $('#order-id').val();    
    snap.show();
    $.ajax({
      type: "POST",
      data: {_token:$('#token').val(), shipping:shippingCost, orderId:orderId},
      url: URL + '/payment/newToken',
      success: function(result) {
        processSnap(result, orderId);
      },
      error: function (request, status, error) {
        snap.hide();
        alert("Fail get Token, " + error);
      }
    });
}

function processSnap(token, orderId){
    snap.pay(token, {
      onSuccess: function(result){
        successSnap(orderId);
      },
      onPending: function(result){
        processPendingVA(result, orderId);
      }
    })
}

function processPendingVA(resultSnap, orderId){
    //"bank_transfer"
    console.log(resultSnap);
    var paymentType = resultSnap.payment_type;
    var accountVa = resultSnap.bca_va_number;
    $.ajax({
      type: "POST",
      data: {_token:$('#token').val(), accountVa:accountVa, paymentType:paymentType, orderId:orderId},
      url: '/payment/pending/',
      success: function(result) {
        console.log("updated va request");
        successSnap(orderId);
      },
      error: function (request, status, error) {
        console.log("Fail get update pending, " + error);
      }
    });
}

function successSnap(orderId){
    location.href = '/payment/success?orderId='+orderId;
}

$(document).ready(function() {
    $('select[name="provinsi"]').on('change', function(){
        var provinsi_id = $(this).val();
        if(provinsi_id) {
            $.ajax({
                url: URL + '/shipping/city?province='+provinsi_id,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {
                    $('select[name="city"]').empty();
                    var option = "";
                    var li = "";
                    $.each(data["rajaongkir"]["results"], function(key, value, x){
                        option = option + '<option value="'+ value["city_id"] +'">' + value['type'] + ' ' + value["city_name"] + '</option>';
                        li = li + '<li data-value="'+ value["city_id"] +'" class="option">' + value['type'] + ' ' + value["city_name"] + '</li>';
                    });

                    $('select[name="city"]').parent().html('<select name="city" class="form-control auth city" style="display: none;"> '+option+' </select> <div class="nice-select form-control auth city" tabindex="0"> <span class="current"></span> <ul class="list"> '+li+' </ul> </div>');
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="club_id"]').empty();
        }

    });

    $('ul.list-shipping-courier-checkout li').on('click',function(){ 
        var shippingCost = $(this).attr('data-value');

        var reverseshippingCost = shippingCost.toString().split('').reverse().join(''),
        ribuanshippingCost  = reverseshippingCost.match(/\d{1,3}/g);
        ribuanshippingCost  = ribuanshippingCost.join('.').split('').reverse().join('');

        var shippingCostInCurrencyString = 'Rp '+ribuanshippingCost;
        $('#total-shipping-cost-checkout').val(shippingCostInCurrencyString);
        $('#total-shipping-cost-usage').val(shippingCost);
        
        var totalPrice = $('#total-price-checkout-usage').val();
        var grandPrice = parseFloat(totalPrice) + parseFloat(shippingCost);

        var reverseGrandPrice = grandPrice.toString().split('').reverse().join(''),
        ribuanGrandPrice  = reverseGrandPrice.match(/\d{1,3}/g);
        ribuanGrandPrice  = ribuanGrandPrice.join('.').split('').reverse().join('');

        var GrandPriceInCurrencyString = 'Rp '+ribuanGrandPrice;
        $('#grand-price-checkout').val(GrandPriceInCurrencyString);
    });
});
