$(document).ready(function(){
  $('.ui.dropdown').dropdown({
    forceSelection: false
  });
  $(document).on("click",".btn-add-items",function(e) {
    $('#add-items-modal').modal('show');
  });
  $(document).on("click",".btn-add-customers",function(e) {
    $('#add-customers-modal').modal('show');
  });
  $(document).on("click",".btn-add-salesman",function(e) {
    $('#add-salesman-modal').modal('show');
  });
  $(document).on("click",".btn-add-suppliers",function(e) {
    $('#add-suppliers-modal').modal('show');
  });
  $(document).on("click",".btn-add-users",function(e) {
    $('#add-users-modal').modal('show');
  });
});