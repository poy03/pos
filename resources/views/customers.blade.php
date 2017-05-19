@extends('layouts.main')

@section('title', 'Customers')

@section('content')
<div class="col-sm-2">
  <label>Controls:</label>
  <span class="btn btn-primary btn-block" onclick="$('#add-customers-modal').modal('show')"><span class="glyphicon glyphicon-user"></span> Add Customer</span>  
  <button class="btn btn-primary btn-block" type="button"><span class="glyphicon glyphicon-edit"></span> Edit Customers</button>
  <button class="btn btn-danger btn-block" type="button" id="delete"><span class="glyphicon glyphicon-trash"></span> Delete Customers</button>
  <input type="text" placeholder="Search for Customer" class="form-control">
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

    </table>
  </div>
</div>
@endsection

@section('modals')


<!--Add Items -->
<div id="add-customers-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
        <p>
        <form action="customers" method="post" class="form-horizontal" id="add-customers-form">  
        {{ csrf_field() }}

        <div class="form-group">
          <label for="companyname" class="col-md-2">Company Name:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="companyname" placeholder="Company Name">
          <p class="help-block" id="companyname-help-block"></p>
        </div>
        </div>
        
        <div class="form-group">
          <label for="address" class="col-md-2">Address:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="address" placeholder="Address">
          <p class="help-block" id="address-help-block"></p>
        </div>
        </div>
        
        <div class="form-group">
          <label for="email" class="col-md-2">Email:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="email" placeholder="Email">
          <p class="help-block" id="email-help-block"></p>
        </div>
        </div>

        <div class="form-group">
          <label for="phone" class="col-md-2">Contact Number:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="phone" placeholder="Contact Number">
          <p class="help-block" id="phone-help-block"></p>
        </div>
        </div>

        <div class="form-group">
          <label for="contactperson" class="col-md-2">Contact Person:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="contactperson" placeholder="Contact Person">
          <p class="help-block" id="contactperson-help-block"></p>
        </div>
        </div>

        <div class="form-group">
          <label for="contactperson" class="col-md-2">TIN ID:</label>
        <div class="col-md-10">
          <input type="text" class="form-control" name="tin_id" placeholder="TIN ID">
          <p class="help-block" id="tin_id-help-block"></p>
        </div>
        </div>


        <div class="form-group">
          <label for="credit_limit" class="col-md-2">Credit Limit:</label>
        <div class="col-md-10">
          <input type="number" step="0.01" min="0" class="form-control" name="credit_limit" placeholder="Credit Limit">
          <p class="help-block" id="credit_limit-help-block"></p>
        </div>
        </div>

        <div class="form-group">
          <label for="credit_limit" class="col-md-2">Credit Terms:</label>
        <div class="col-md-10">
          <input type="number" step="0.01" min="0" class="form-control" name="term" placeholder="Credit Terms">
          <p class="help-block" id="term-help-block"></p>
        </div>
        </div>

        </form>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-customers-form">Save</button>
      </div>
    </div>

</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {  $("#add-customers-form").submit(function(e) {
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
        show_customers();
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

  show_customers();
  function show_customers(page = 1) {
    $.ajax({
      type: "GET",
      url: "/customers/list",
      data: "page="+page+"&maxitem="+50,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#customers-table tbody").html("");
      },
      success: function(data) {
        $.each(data.result, function(i, item) {
          $('#customers-table tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].itemID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].companyname+'</td>\
              <td>'+data.result[i].address+'</td>\
              <td>'+data.result[i].email+'</td>\
              <td>'+data.result[i].phone+'</td>\
              <td>'+data.result[i].contactperson+'</td>\
              <td>'+data.result[i].tin_id+'</td>\
              <td style="text-align:right">'+data.result[i].credit_limit+'</td>\
              <td>'+data.result[i].term+'</td>\
            </tr>\
            ');
        });
      }
    });
  }
});
</script>
@endsection