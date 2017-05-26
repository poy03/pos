$(document).ready(function(){
  $('.ui.dropdown').dropdown({
    forceSelection: false
  });
  $(".btn-add-items").click(function(e) {
    $('#add-items-modal').modal('show');
  });
  $(".btn-add-customers").click(function(e) {
    $('#add-customers-modal').modal('show');
  });
  $(".btn-add-salesman").click(function(e) {
    $('#add-salesman-modal').modal('show');
  });
  $(".btn-add-suppliers").click(function(e) {
    $('#add-suppliers-modal').modal('show');
  });
});