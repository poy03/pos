@extends('layouts.main')

@section('title', 'Suppliers')

@section('content')
<div class="col-sm-2">
  
<div class="form-group">
<label>Controls:</label>
  <button class="btn btn-primary btn-block btn-add-suppliers" type="button">
    <span class="glyphicon glyphicon-phone"></span> Add Suppliers
  </button>
  <button class="btn btn-danger btn-block" type="button">
    <span class="glyphicon glyphicon-trash"></span> Delete Suppliers
  </button>
</div>
<form action="/suppliers/list" method="get" id="supplier-sort-form">
<div class="form-group">
   <select class="ui search selection dropdown fluid" id="supplier-select" name="supplierID">
    <option value="">Search for Supplier</option>
   </select>
   <button class="btn btn-danger btn-block" type="button" style="display: none;" id="btn-clear-selection">
     Clear Selection
   </button>
</div>
</form>

</div>

<div class="col-sm-10">
  <div class="table-responsive">
  <table class='table table-hover' id='suppliers-table'>
    <thead>
      <tr>
       <th><input type="checkbox" id="select-all" value='all'> All</th>
       <th>Contact Person</th>
       <th>Company Name</th>
       <th>Contact Number</th>
       <th>Address</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>

    </tfoot>

    </table>
  </div>
</div>
@endsection
@section('modals')

<!--Add Supplier -->
<div id="edit-suppliers-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
        <form action="suppliers" method="post" class="form-horizontal" id="edit-suppliers-form">  
        {{ csrf_field() }}
        <input type="hidden" name="supplierID">
        <div class='form-group'>
          <label for="supplier_company" class='col-md-2'>Supplier's Company:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='supplier_company' placeholder="Supplier's Company Name">
            <p class="help-block" id="edit-supplier_company-help-block"></p>
          </div>
        </div>
        
        <div class='form-group'>
          <label for="supplier_name" class='col-md-2'>Contact Person:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='supplier_name' placeholder="Supplier's Name">
            <p class="help-block" id="edit-supplier_name-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplier_number" class='col-md-2'>Contact Number:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='supplier_number' placeholder='Contact Number'>
            <p class="help-block" id="edit-supplier_number-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplier_address" class='col-md-2'>Supplier's Address:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='supplier_address' placeholder="Supplier's Address">
            <p class="help-block" id="edit-supplier_address-help-block"></p>
          </div>
        </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="edit-suppliers-form">Save</button>
      </div>
    </div>

  </div>
</div>



@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  $("#add-suppliers-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#add-suppliers-form").attr("action"),
      data: $("#add-suppliers-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="add-suppliers-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.supplier_name + " has been successfuly added.");
        $("#add-suppliers-form")[0].reset();
        show_suppliers($(".paging-active a").html());
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#supplier_name-help-block").html(errors.supplier_name);
          $("#supplier_company-help-block").html(errors.supplier_company);
          $("#supplier_number-help-block").html(errors.supplier_number);
          $("#supplier_address-help-block").html(errors.supplier_address);
        }
      },
      complete: function() {
        $('button[form="add-suppliers-form"]').prop("disabled",false);
      }
    });
  });
  $("#edit-suppliers-form").submit(function(e) {
    e.preventDefault();
    var supplierID = $('input[name="supplierID"]').val();
    $.ajax({
      type: "PUT",
      url: "/suppliers/supplier/"+supplierID,
      data: $("#edit-suppliers-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="edit-suppliers-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.supplier_name + " has been updated.");
        $("#edit-suppliers-form")[0].reset();
        show_suppliers($(".paging-active a").html());
        $("#edit-suppliers-modal").modal("hide");
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#edit-supplier_name-help-block").html(errors.supplier_name);
          $("#edit-supplier_company-help-block").html(errors.supplier_company);
          $("#edit-supplier_number-help-block").html(errors.supplier_number);
          $("#edit-supplier_address-help-block").html(errors.supplier_address);
        }
      },
      complete: function() {
        $('button[form="edit-suppliers-form"]').prop("disabled",false);
      }
    });
  });
  $(document).on("click",".edit",function(e) {
    $.ajax({
      type: "GET",
      url: "/suppliers/supplier/"+e.target.id,
      cache: false,
      dataType: "json",
      success: function(data) {
        $('input[name="supplierID"]').val(data.supplierID);
        $('input[name="supplier_name"].edit-field').val(data.supplier_name);
        $('input[name="supplier_company"].edit-field').val(data.supplier_company);
        $('input[name="supplier_number"].edit-field').val(data.supplier_number);
        $('input[name="supplier_address"].edit-field').val(data.supplier_address);
        $('input[name="contactperson"].edit-field').val(data.contactperson);
        $("#edit-suppliers-modal").modal("show");
      }
    })
  });
  $(document).on("click",".paging",function(e) {
    show_suppliers(e.target.id);
  });
  $(document).on("change","#supplier-select",function(e) {
    show_suppliers();
    $("#btn-clear-selection").css("display","block");
  });
  $("#btn-clear-selection").click(function(e) {
    $("#supplier-select").dropdown("clear");
    $("#btn-clear-selection").css("display","none");
  });
  show_suppliers();
  show_supplier_companies();
  function show_suppliers(page = 1) {
    $.ajax({
      type: "GET",
      url: "/suppliers/list",
      data: $("#supplier-sort-form").serialize()+"&page="+page+"&maxitem="+1,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#suppliers-table tbody").html("");
      },
      success: function(data) {
        for (var i = 0; i < data.result.length; i++) {
          $('#suppliers-table tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].supplierID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].supplier_name+'</td>\
              <td>'+data.result[i].supplier_company+'</td>\
              <td>'+data.result[i].supplier_number+'</td>\
              <td>'+data.result[i].supplier_address+'</td>\
              <td><a href="#" id="'+data.result[i].supplierID+'" class="edit">Edit</a></td>\
            </tr>\
            ');
        }
        $("#suppliers-table tfoot").html(data.paging);
        $("#suppliers-table tfoot").append('<tr><th></th></tr>');
      }
    });
  }
  function show_supplier_companies() {
    $.ajax({
      type: "GET",
      url: "/suppliers/suppliers",
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#supplier-select").html("");
        $("#supplier-select").append('<option value="">Search for Supplier</option>');
      },
      success: function(data) {
        for (var i = 0; i < data.length; i++) {
          $("#supplier-select").append('<option value="'+data[i].supplierID+'">'+data[i].supplier_company+'</option>');
        }
      }
    });
  }
});
</script>
@endsection