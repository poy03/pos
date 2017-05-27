@extends('layouts.main')

@section('title', 'Customers')

@section('content')
<div class="col-sm-2">
  <div class="form-group">
    <label>Controls:</label>
    <button class="btn btn-primary btn-block btn-add-customers">
      <span class="glyphicon glyphicon-user"></span> Add Customer
    </button>
    <button class="btn btn-danger btn-block" type="button" id="delete">
      <span class="glyphicon glyphicon-trash"></span> Delete Customers
    </button>
  </div>
  <form action="/customers/list" method="get" id="customer-sort-form">
    <div class="form-group">
       <select class="ui search selection dropdown fluid" id="customer-select" name="customerID">
        <option value="">Search for Customer Name</option>
       </select>
       <button class="btn btn-danger btn-block" type="button" style="display: none;" id="btn-clear-selection">
         Clear Selection
       </button>
    </div>
  </form>
</div>

<div class="col-sm-10">
  <div class="table-responsive">
  <table class="table table-hover" id="customers-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="select-all" class="select" value="all"> All</th>
        <th>Company Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Contact Person</th>
        <th>TIN ID</th>
        <th>Credit Limit</th>
        <th>Credit Term</th>
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

<!--Add Customer -->
<div id="edit-customers-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
        <form action="customers" method="post" class="form-horizontal" id="edit-customers-form">  
        {{ csrf_field() }}
        <input type="hidden" name="customerID">
        <div class="form-group">
          <label for="companyname" class="col-md-2">Company Name:</label>
          <div class="col-md-10">
            <input type="text" class="form-control edit-field" name="companyname" placeholder="Company Name">
            <p class="help-block" id="edit-companyname-help-block"></p>
          </div>
        </div>
        
        <div class="form-group">
          <label for="address" class="col-md-2">Address:</label>
          <div class="col-md-10">
            <input type="text" class="form-control edit-field" name="address" placeholder="Address">
            <p class="help-block" id="edit-address-help-block"></p>
          </div>
        </div>
        
        <div class="form-group">
          <label for="email" class="col-md-2">Email:</label>
          <div class="col-md-10">
            <input type="text" class="form-control edit-field" name="email" placeholder="Email">
            <p class="help-block" id="edit-email-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="phone" class="col-md-2">Contact Number:</label>
          <div class="col-md-10">
            <input type="text" class="form-control edit-field" name="phone" placeholder="Contact Number">
            <p class="help-block" id="edit-phone-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="contactperson" class="col-md-2">Contact Person:</label>
          <div class="col-md-10">
            <input type="text" class="form-control edit-field" name="contactperson" placeholder="Contact Person">
            <p class="help-block" id="edit-contactperson-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="contactperson" class="col-md-2">TIN ID:</label>
          <div class="col-md-10">
            <input type="text" class="form-control edit-field" name="tin_id" placeholder="TIN ID">
            <p class="help-block" id="edit-tin_id-help-block"></p>
          </div>
        </div>


        <div class="form-group">
          <label for="credit_limit" class="col-md-2">Credit Limit:</label>
          <div class="col-md-10">
            <input type="number" step="0.01" min="0" class="form-control edit-field" name="credit_limit" placeholder="Credit Limit">
            <p class="help-block" id="edit-credit_limit-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="credit_limit" class="col-md-2">Credit Terms:</label>
          <div class="col-md-10">
            <input type="number" step="0.01" min="0" class="form-control edit-field" name="term" placeholder="Credit Terms">
            <p class="help-block" id="edit-term-help-block"></p>
          </div>
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="edit-customers-form">Save</button>
      </div>
    </div>

</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  $("#add-customers-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#add-customers-form").attr("action"),
      data: $("#add-customers-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="add-customers-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.companyname + " has been successfuly added.");
        $("#add-customers-form")[0].reset();
        show_customers($(".paging-active a").html());
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#companyname-help-block").html(errors.companyname);
          $("#address-help-block").html(errors.address);
          $("#email-help-block").html(errors.email);
          $("#phone-help-block").html(errors.phone);
          $("#contactperson-help-block").html(errors.contactperson);
          $("#tin_id-help-block").html(errors.tin_id);
          $("#credit_limit-help-block").html(errors.credit_limit);
          $("#term-help-block").html(errors.term);
        }
      },
      complete: function() {
        $('button[form="add-customers-form"]').prop("disabled",false);
      }
    });
  });


  $("#edit-customers-form").submit(function(e) {
    e.preventDefault();
    var customerID = $('input[name="customerID"]').val();
    $.ajax({
      type: "PUT",
      url: "/customers/customer/"+customerID,
      data: $("#edit-customers-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="edit-customers-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.companyname + " has been updated.");
        $("#edit-customers-form")[0].reset();
        show_customers($(".paging-active a").html());
        $("#edit-customers-modal").modal("hide");
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#edit-companyname-help-block").html(errors.companyname);
          $("#edit-address-help-block").html(errors.address);
          $("#edit-email-help-block").html(errors.email);
          $("#edit-phone-help-block").html(errors.phone);
          $("#edit-contactperson-help-block").html(errors.contactperson);
          $("#edit-tin_id-help-block").html(errors.tin_id);
          $("#edit-credit_limit-help-block").html(errors.credit_limit);
          $("#edit-term-help-block").html(errors.term);
        }
      },
      complete: function() {
        $('button[form="edit-customers-form"]').prop("disabled",false);
      }
    });
  });

  $(document).on("click",".paging",function(e) {
    show_customers(e.target.id);
  });

  $(document).on("click",".edit",function(e) {
    $.ajax({
      type: "GET",
      url: "/customers/customer/"+e.target.id,
      cache: false,
      dataType: "json",
      success: function(data) {
        $('input[name="customerID"]').val(data.customerID);
        $('input[name="companyname"].edit-field').val(data.companyname);
        $('input[name="address"].edit-field').val(data.address);
        $('input[name="email"].edit-field').val(data.email);
        $('input[name="phone"].edit-field').val(data.phone);
        $('input[name="contactperson"].edit-field').val(data.contactperson);
        $('input[name="tin_id"].edit-field').val(data.tin_id);
        $('input[name="credit_limit"].edit-field').val(data.credit_limit);
        $('input[name="term"].edit-field').val(data.term);
        $("#edit-customers-modal").modal("show");
      }
    })
  });
  $(document).on("change","#customer-select",function(e) {
    show_customers();
    $("#btn-clear-selection").css("display","block");
  });
  $("#btn-clear-selection").click(function(e) {
    $("#customer-select").dropdown("clear");
    $("#btn-clear-selection").css("display","none");
  });
  show_customers();
  show_companynames();
  function show_customers(page = 1) {
    $.ajax({
      type: "GET",
      url: "/customers/list",
      data: $("#customer-sort-form").serialize()+"&page="+page+"&maxitem="+1,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#customers-table tbody").html("");
      },
      success: function(data) {
        for (var i = 0; i < data.result.length; i++) {
          $('#customers-table tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].customerID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].companyname+'</td>\
              <td>'+data.result[i].address+'</td>\
              <td>'+data.result[i].email+'</td>\
              <td>'+data.result[i].phone+'</td>\
              <td>'+data.result[i].contactperson+'</td>\
              <td>'+data.result[i].tin_id+'</td>\
              <td style="text-align:right">'+data.result[i].credit_limit+'</td>\
              <td>'+data.result[i].term+'</td>\
              <td><a href="#" id="'+data.result[i].customerID+'" class="edit">Edit</a></td>\
            </tr>\
            ');
        }
        $("#customers-table tfoot").html(data.paging);
        $("#customers-table tfoot").append('<tr><th></th></tr>');
      }
    });
  }
  function show_companynames() {
    $.ajax({
      type: "GET",
      url: "/customers/companynames",
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#customer-select").html("");
        $("#customer-select").append('<option value="">Search for Customer Name</option>');
      },
      success: function(data) {
        for (var i = 0; i < data.length; i++) {
          $("#customer-select").append('<option value="'+data[i].customerID+'">'+data[i].companyname+'</option>');
        }
      }
    });
  }
});
</script>
@endsection