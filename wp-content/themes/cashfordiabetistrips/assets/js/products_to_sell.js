$(document).ready(function () {  
  let label = getPaymentMethodLabel($("#payment_method input[type='radio']:checked"));  

  $("input[name='quantity[]']").on("change", function(){
    setCustomerTotalEarned();    
  });

  $("#payment_method input[type='radio']").on("change", function () {
    label = getPaymentMethodLabel($(this));
    $("label[for='pm_val']").html(label);
    $("#pm_label").removeClass("d-none");
  });

  if (label != "") {
    $("label[for='pm_val']").html(label);
    $("#pm_label").removeClass("d-none");
  }

  $("#tos").on("change", function(){
    showTos();
  });
  setCustomerTotalEarned();
  uncheckTosAgreement();
});

function uncheckTosAgreement(){
  $("#tos").is(":checked") ? $("#tos").prop("checked", false) : '';
}

function setItemSubtotal($quantityElem, subtotal){
  $quantityElem.closest(".breakdown").find('.subtotal + br + span').html(subtotal);
}

function setCustomerTotalEarned(){
  let total_earned = 0;
  $("input[name='quantity[]']").each(function(){
    let pattern = new RegExp("[0-9]*");
    let box_count = $(this).val();
    let breakdown = $(this).closest('.breakdown');
    let subtotal = breakdown.find("input[name='price[]']").val() * box_count;
    subtotal = subtotal ? subtotal : 0;

    // Should be numbers only
    if(box_count.match(pattern) == box_count){
      setItemSubtotal($(this), subtotal);
      total_earned += subtotal; 
      breakdown.find('.error').html("");
    } else {
      breakdown.find('.error').html("Please input a number");
    }      
  });

  $("#total_earned").html(`$${total_earned}`);
}

function showTos(){
  if($("#tos").prop("checked") == true){
    $("#submit").removeClass("d-none");
  }else{
    $("#submit").addClass("d-none");
  }
}

function getPaymentMethodLabel(input_pm) {  
  let label = '';
  if (input_pm.val() === "check") {
    label = "Name on check:";
  } else if (input_pm.val() === "paypal") {
    label = "PayPal - account email address:";
  } else if (input_pm.val() === "zelle") {
    label = "Please enter the phone or email associated with your Zelle account here:";
  } else if (input_pm.val() === "cash app") {
    label = "Please Provide Cash App handle that starts with $:";
  }
  return label;
}
