@extends('layouts.main')

@section('title', 'Salesman')

@section('content')
<div class="col-sm-2">
  <div class="form-group">
    <label>Controls:</label>
    <button class="btn btn-primary btn-block btn-add-salesman" type="button">
      <span class="glyphicon glyphicon-phone"></span> Add Salesman
    </button>
    <button class="btn btn-danger btn-block" type="button">
      <span class="glyphicon glyphicon-trash"></span> Delete Salesman
    </button>
  </div>

  <form action="/suppliers/list" method="get" id="salesman-sort-form">
    <div class="form-group">
       <select class="ui search selection dropdown fluid" id="salesman-select" name="salesmanID">
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
  <table class="table table-hover" id="salesman-table">
    <thead>
      <tr>
       <th><input type="checkbox" id="select-all" value='all'> All</th>
       <th>Salesman's Name</th>
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

<!--Add Salesman -->
<div id="edit-salesman-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
        <form action="salesman" method="post" class="form-horizontal" id="edit-salesman-form">  
        {{ csrf_field() }}
        <input type="hidden" name="salesmanID">

        <div class='form-group'>
          <label for="salesman_name" class='col-md-2'>Salesman's Name:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='salesman_name' placeholder="Salesman's Name">
            <p class="help-block" id="edit-salesman_name-help-block"></p>
          </div>
        </div>
        
        
        <div class='form-group'>
          <label for="salesman_contact_number" class='col-md-2'>Contact Number:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='salesman_contact_number' placeholder='Contact Number'>
            <p class="help-block" id="edit-salesman_contact_number-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="salesman_address" class='col-md-2'>Salesman's Address:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='salesman_address' placeholder="Salesman's Address">
            <p class="help-block" id="edit-salesman_address-help-block"></p>
          </div>
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="edit-salesman-form">Save</button>
      </div>
    </div>

</div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  $("#add-salesman-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#add-salesman-form").attr("action"),
      data: $("#add-salesman-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="add-salesman-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.salesman_name + " has been successfuly added.");
        $("#add-salesman-form")[0].reset();
        show_salesman($(".paging-active a").html());
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#salesman_name-help-block").html(errors.salesman_name);
          $("#salesman_contact_number-help-block").html(errors.salesman_contact_number);
          $("#salesman_address-help-block").html(errors.salesman_address);
        }
      },
      complete: function() {
        $('button[form="add-salesman-form"]').prop("disabled",false);
      }
    });
  });

  $("#edit-salesman-form").submit(function(e) {
    e.preventDefault();
    var salesmanID = $('input[name="salesmanID"]').val();
    $.ajax({
      type: "PUT",
      url: "/salesman/salesman/"+salesmanID,
      data: $("#edit-salesman-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="edit-salesman-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.salesman_name + " has been updated.");
        $("#edit-salesman-form")[0].reset();
        show_salesman($(".paging-active a").html());
        $("#edit-salesman-modal").modal("hide");
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#edit-salesman_name-help-block").html(errors.salesman_name);
          $("#edit-salesman_contact_number-help-block").html(errors.salesman_contact_number);
          $("#edit-salesman_address-help-block").html(errors.salesman_address);
        }
      },
      complete: function() {
        $('button[form="edit-salesman-form"]').prop("disabled",false);
      }
    });
  });

  $(document).on("click",".paging",function(e) {
    show_salesman(e.target.id);
  });
  $(document).on("change","#salesman-select",function(e) {
    show_salesman(e.target.id);
    $("#btn-clear-selection").css("display","block");
  });
  $("#btn-clear-selection").click(function(e) {
    $("#salesman-select").dropdown("clear");
    $("#btn-clear-selection").css("display","none");
  });
  $(document).on("click",".edit",function(e) {
    $.ajax({
      type: "GET",
      url: "/salesman/salesman/"+e.target.id,
      cache: false,
      dataType: "json",
      success: function(data) {
        $('input[name="salesmanID"]').val(data.salesmanID);
        $('input[name="salesman_name"].edit-field').val(data.salesman_name);
        $('input[name="salesman_contact_number"].edit-field').val(data.salesman_contact_number);
        $('input[name="salesman_address"].edit-field').val(data.salesman_address);
        $("#edit-salesman-modal").modal("show");
      }
    })
  });

  show_salesman();
  show_names();
  function show_salesman(page = 1) {
    var selector = "#salesman-table";
    $.ajax({
      type: "GET",
      url: "/salesman/list",
      data: $("#salesman-sort-form").serialize()+"&page="+page+"&maxitem="+1,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(selector+" tbody").html("");
      },
      success: function(data) {
        for (var i = 0; i < data.result.length; i++) {
          $(selector+' tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].salesmanID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].salesman_name+'</td>\
              <td>'+data.result[i].salesman_contact_number+'</td>\
              <td>'+data.result[i].salesman_address+'</td>\
              <td><a href="#" id="'+data.result[i].salesmanID+'" class="edit">Edit</a></td>\
            </tr>\
            ');
        }
        $(selector+' tfoot').html(data.paging);
        $(selector+' tfoot').append('<tr><th></th></tr>');
      }
    });
  }
  function show_names() {
    $.ajax({
      type: "GET",
      url: "/salesman/names",
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#salesman-select").html('');
        $("#salesman-select").append('<option value="">Search Salesman</option>');
      },
      success: function(data){
        for (var i = 0; i < data.length; i++) {
          $("#salesman-select").append('<option value="'+data[i].salesmanID+'">'+data[i].salesman_name+'</option>');
        }
      }
    })
  }

});
</script>
@endsection