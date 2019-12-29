/* WOW.js init */
new WOW().init();
// Tooltips Initialization
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
$(document).ready(function() {
  $('.mdb-select').materialSelect();
  if (text.length > 0){
    toastr.info(text);
  }
});
$(".button-collapse").sideNav();