/*
 * File Name: custom.js
 * UX Developer: Chandan Mistry
 * UI Designer: Amit Mondal
 */

/* Follow Bootstrap  v5.2.3 */

var $ = jQuery.noConflict();
$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

});

const number_format = (num, decimals = 2) => parseFloat(num).toLocaleString('en', {
  minimumFractionDigits: decimals,
  maximumFractionDigits: decimals,
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('.img').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}