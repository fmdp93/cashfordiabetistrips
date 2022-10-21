AOS.init({});

let Login_Modal = new Modal(
  $("#login_modal input[name='modal_id']").val(),
  $("#login_modal input[name='display']").val()
);

$(window).on("load", function () {
  //   $("#signup_form").modal(signup_modal_display_state);
  $("#login_modal").modal(Login_Modal.display_state);
});

$(document).ready(function () {
  $(".close-btn").on("click", function () {
    $(".modal").modal("hide");
  });

  $(document).on("click", "#login_btn", "", function () {
    Login_Modal.showModal();
  });
});

let flatpickrDefaultTime = new Date("January 20, 2020 00:05");

flatpickr("#preparation_time, #cooking_time", {
  enableTime: true,
  noCalendar: true,
  time_24hr: true,
  dateFormat: "H:i",
  defaultDate: flatpickrDefaultTime,
});

function error_message(message) {
  return `<div class="row error_message">
              <div class="col alert alert-danger m-3">
                  ${message}
              </div>
          </div>`;
}

$(".card-img-top").height($(".card-img-top").width());