let elem_price = $("#price");
let error = {};

$(document).ready(function () {
  elem_price.on("change", checkPrice);

  elem_price.on("keyup", function () {
    $.get(
      cashfordiabetistrips_js_globals.ajax_url,
      {
        action: "cashfordiabetistrips_validate_price",
        _ajax_nonce: cashfordiabetistrips_js_globals.nonce,
        price: elem_price.val(),
      },
      function (res) {
        res = JSON.parse(res);
        if (res.status_code === "error") {            
          error.price = true;
        } else {
          error.price = false;
        }
      }
    );
  });

  $("body").on("submit", "form#add_product", function (ev) {
    if(error.length === 0){
        alert("Please complete the form fields");
        return false;
    }

    for (var key in error) {
      if (error[key] === true) {
        alert("Please fix the error/s above.");
        return false;
      }
    }

    return true;
  });
});

function checkPrice() {
  $.get(
    cashfordiabetistrips_js_globals.ajax_url,
    {
      action: "cashfordiabetistrips_validate_price",
      _ajax_nonce: cashfordiabetistrips_js_globals.nonce,
      price: elem_price.val(),
    },
    function (res) {
      res = JSON.parse(res);
      if (res.status_code === "error") {
        if (!elem_price.prev(".error_message").hasClass("error_message")) {
          elem_price.before(error_message("Invalid price value"));
        }
      } else {
        elem_price.prev(".error_message").remove();
      }
    }
  );
}
