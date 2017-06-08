@extends('layouts.main')

@section('title', 'Items')

@section('content')
<div class="col-sm-2">
    
  <div class="form-group">
  <label>Controls:</label>
    <button class="btn btn-primary btn-block btn-add-items" type="button">
      <span class="glyphicon glyphicon-briefcase"></span> Add Items
    </button>
    <button class="btn btn-danger btn-block" type="button" id="delete">
      <span class="glyphicon glyphicon-trash"></span> Delete Items
    </button>
  </div>
  <form action="items/get_list" method="get" id="item-sort-form">
  <div class="form-group">
    <label>Category:</label>
    <select class='form-control' id="category-select" name="sort_category">
      <option value='all'>All</option>
    </select>
  </div>

  <div class="form-group">
    <label>Supplier:</label>
    <select class="form-control" id="supplier-select" name="sort_supplier">
      <option value="all">All</option>
    </select>
  </div>

  <div class="form-group">
    <label>Sort:</label>
    <select class='form-control' id="general-sort-select" name="sort_general">
      <option value='A-Z' selected>A-Z</option>
      <option value='Z-A' >Z-A</option>
      <option value='Q-A' >Quantity ASC</option>
      <option value='Q-D' >Quantity DESC</option>
    </select>
  </div>
  </form>

  <div class="form-group">
    <label>Export to Excel Including:</label>
    <input type="hidden" name="category" value="">
    <input type="hidden" name="supplier" value="">
    <div class="col-md-12">
        <label><input type="checkbox" name="sub_costprice" value="1" checked> Sub Cost Price</label>
      </div>
    <div class="col-md-12">
        <label><input type="checkbox" name="costprice" value="1" checked> Total Cost Price</label>
    </div>
    <div class="col-md-12">
        <label><input type="checkbox" name="srp" value="1" checked> WPP</label>
    </div>
    <div class="col-md-12">
        <label><input type="checkbox" name="std_price_to_trade_terms" value="1" checked> STD Price to Terms</label>
    </div>
      <div class="col-md-12">
        <label><input type="checkbox" name="std_price_to_trade_cod" value="1" checked> STD Price to COD</label>
    </div>
      <div class="col-md-12">
        <label><input type="checkbox" name="price_to_distributors" value="1" checked> Price to Distributors</label>
    </div>
      <button class="btn btn-block btn-primary" name="export" type="submit"><span class="glyphicon glyphicon-file"></span> Export</button>
    </div>
  </div>

<div class="col-sm-10">
<form action=""></form>
  <div class="table-responsive">
  <table class='table table-hover' id='items-table'>
    <thead>
      <tr>
        <th class='prints'><input type="checkbox" id="select-all" value='all'> All</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Item Name</th>
        <th>Item Code</th>
        <th>UOM</th>
        <th>Cost Price</th>
        <th>Total Cost Price</th>
        <th>SRP</th>
        <th>Dealers:</th>
        <th>Qty</th>
        <th class='prints'>Reorder Level</th>
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
<!--Edit Items -->
<div id="edit-items-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Items</h4>
    </div>
      <div class="modal-body">
        <form action="/items" method="post" class="form-horizontal" id="edit-items-form">
        {{ csrf_field() }}
        <div class='form-group ui-widget'>
        <input type='hidden' class='edit-field' name='itemID'>
          <label for="category" class='col-md-2'>Category:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control search edit-field' id='category' name='category' placeholder='Category' autocomplete='off'>
            <p class="help-block" id="edit-category-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="itemname" class='col-md-2'>Item Name:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='itemname' placeholder='Item Name'>
            <p class="help-block" id="edit-itemname-help-block"></p>
          </div>
        </div>


        <div class='form-group'>
          <label for="item_code" class='col-md-2'>Item Code:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='item_code' placeholder='Item Code'>
            <p class="help-block" id="edit-item_code-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplierID" class='col-md-2'>Supplier:</label>
          <div class='col-md-10'>
            <select name="supplierID" class="form-control edit-field">
            </select>
            <p class="help-block" id="edit-supplierID-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="unit_of_measure" class='col-md-2'>Unit of Measurement:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control edit-field' name='unit_of_measure' placeholder='Unit of Measurement'>
            <p class="help-block" id="edit-unit_of_measure-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="costprice" class='col-md-2'>Sub Cost Price:</label>
          <div class='col-md-10'>
            <input step='0.01' min='0' max='99999999' type='number' class='form-control edit-field' name='costprice' placeholder='Sub Cost Price'>
            <p class="help-block" id="edit-costprice-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="srp" class='col-md-2'>WPP:</label>
          <div class='col-md-10'>
            <input step='0.01' min='0' max='99999999' type='number' class='form-control edit-field' name='srp' placeholder='WPP'>
            <p class="help-block" id="edit-srp-help-block"></p>
          </div>
        </div>


        <div class='form-group'>
          <label for="price_to_distributors" class='col-md-2'>Price to Distributors:</label>
          <div class='col-md-10'>
            <input step='0.01' min='0' max='99999999' type='number' class='form-control edit-field' name='price_to_distributors' placeholder='Price to Distributors'>
            <p class="help-block" id="edit-price_to_distributors-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="quantity" class='col-md-2'>Quantity:</label>
          <div class='col-md-10'>
            <input min='0' max='99999999' type='number' class='form-control edit-field' name='quantity' placeholder='Quantity'>
            <p class="help-block" id="edit-quantity-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="reorder" class='col-md-2'>Reorder Level:</label>
          <div class='col-md-10'>
            <input min='0' max='99999999' type='number' class='form-control edit-field' name='reorder' placeholder='Reorder Level'>
            <p class="help-block" id="edit-reorder-help-block"></p>
          </div>
        </div>
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="edit-items-form">Save</button>
      </div>
    </div>

</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() { 
  $("#add-items-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#add-items-form").attr("action"),
      data: $("#add-items-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $('button[form="add-items-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.itemname + " has been successfuly added.");
        $("#add-items-form")[0].reset();
        $(".help-block").html("");
        show_items($("li.active.paging-active a").html());
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#category-help-block").html(errors.category);
          $("#itemname-help-block").html(errors.itemname);
          $("#item_code-help-block").html(errors.item_code);
          $("#supplierID-help-block").html(errors.supplierID);
          $("#unit_of_measure-help-block").html(errors.unit_of_measure);
          $("#costprice-help-block").html(errors.costprice);
          $("#srp-help-block").html(errors.srp);
          $("#std_price_to_trade_terms-help-block").html(errors.std_price_to_trade_terms);
          $("#std_price_to_trade_cod-help-block").html(errors.std_price_to_trade_cod);
          $("#price_to_distributors-help-block").html(errors.price_to_distributors);
          $("#quantity-help-block").html(errors.quantity);
          $("#reorder-help-block").html(errors.reorder);
        }
      },
      complete: function() {
        $('button[form="add-items-form"]').prop("disabled",false);
      }
    });
  });

  $("#edit-items-form").submit(function(e) {
    e.preventDefault();
    var itemID = $('input[name="itemID"]').val();
    $.ajax({
      type: "PUT",
      url: "/items/item/"+itemID,
      data: $("#edit-items-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $('button[form="edit-items-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.itemname + " has been updated.");
        $(".help-block").html("");
        show_items($("li.active.paging-active a").html());
        $("#edit-items-modal").modal("hide");
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#edit-category-help-block").html(errors.category);
          $("#edit-itemname-help-block").html(errors.itemname);
          $("#edit-item_code-help-block").html(errors.item_code);
          $("#edit-supplierID-help-block").html(errors.supplierID);
          $("#edit-unit_of_measure-help-block").html(errors.unit_of_measure);
          $("#edit-costprice-help-block").html(errors.costprice);
          $("#edit-srp-help-block").html(errors.srp);
          $("#edit-std_price_to_trade_terms-help-block").html(errors.std_price_to_trade_terms);
          $("#edit-std_price_to_trade_cod-help-block").html(errors.std_price_to_trade_cod);
          $("#edit-price_to_distributors-help-block").html(errors.price_to_distributors);
          $("#edit-quantity-help-block").html(errors.quantity);
          $("#edit-reorder-help-block").html(errors.reorder);
        }
      },
      complete: function() {
        $('button[form="edit-items-form"]').prop("disabled",false);
      }
    });
  });

  $(document).on("click",".edit",function(e) {
    $.ajax({
      type: "GET",
      url: "/items/item/"+e.target.id,
      cache: false,
      dataType: "json",
      success: function(data) {
        $('input[name="itemID"].edit-field').val(data.itemID);
        $('input[name="category"].edit-field').val(data.category);
        $('input[name="itemname"].edit-field').val(data.itemname);
        $('input[name="item_code"].edit-field').val(data.item_code);
        $('select[name="supplierID"].edit-field').val(data.supplierID);
        $('input[name="unit_of_measure"].edit-field').val(data.unit_of_measure);
        $('input[name="costprice"].edit-field').val(data.costprice);
        $('input[name="srp"].edit-field').val(data.srp);
        $('input[name="std_price_to_trade_terms"].edit-field').val(data.std_price_to_trade_terms);
        $('input[name="std_price_to_trade_cod"].edit-field').val(data.std_price_to_trade_cod);
        $('input[name="price_to_distributors"].edit-field').val(data.price_to_distributors);
        $('input[name="quantity"].edit-field').val(data.quantity);
        $('input[name="reorder"].edit-field').val(data.reorder);
        $("#edit-items-modal").modal("show");
      }
    })
  });

  $(document).on("change","#category-select,#supplier-select,#general-sort-select", function(e) {
    show_items();
  });

  $(document).on("click",".paging",function function_name(e) {
    show_items(e.target.id);
  });

  show_items();
  show_categories();
  show_supplier_companies(1);
  show_supplier_companies(2);
  function show_items(page = 1) {
    var selector = "#items-table";
    $.ajax({
      type: "GET",
      url: "/items/list",
      data: $("#item-sort-form").serialize()+"&page="+page+"&maxitem="+50,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(selector+" tbody").html("");
      },
      success: function(data) {
        for (var i = 0; i < data.result.length; i++) {
          $(selector+' tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].itemID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].category+'</td>\
              <td style="text-align:center;">'+data.result[i].supplier_company+'</td>\
              <td style="text-align:left;">'+data.result[i].itemname+'</td>\
              <td style="text-align:center;">'+data.result[i].item_code+'</td>\
              <td style="text-align:center;">'+data.result[i].unit_of_measure+'</td>\
              <td style="text-align:right;">'+data.result[i].costprice+'</td>\
              <td style="text-align:right;">'+data.result[i].total_costprice+'</td>\
              <td style="text-align:right;">'+data.result[i].srp+'</td>\
              <td style="text-align:right;">'+data.result[i].price_to_distributors+'</td>\
              <td style="text-align:center;">'+data.result[i].quantity+'</td>\
              <td style="text-align:center;">'+data.result[i].reorder+'</td>\
              <td><a href="#" class="edit" id="'+data.result[i].itemID+'">Edit</a></td>\
            </tr>\
            ');
        }
        $(selector+" tfoot").html(data.paging);
        $(selector+" tfoot").append('<tr><th></th></tr>');
      }
    });
  }
  function show_categories() {
    var selector = '#category-select';
    $.ajax({
      type: "GET",
      url: "/items/categories",
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(selector).html('<option value="all">All</option>');
      },
      success: function(data) {
        console.log(data);
        for (var i = 0; i < data.length; i++) {
          $(selector).append('<option value="'+data[i].category+'">'+data[i].category+'</option>');
        }
      }
    });
  }
  function show_supplier_companies(type=1) {
    if(type==1){
      var selector = 'select[name="supplierID"]';
      $.ajax({
        type: "GET",
        url: "/suppliers/suppliers",
        cache: false,
        dataType: "json",
        beforeSend: function() {
          $(selector).html("");
          $(selector).append('<option value="0">Select Supplier</option>');
        },
        success: function(data) {
          for (var i = 0; i < data.length; i++) {
            $(selector).append('<option value="'+data[i].supplierID+'">'+data[i].supplier_company+'</option>');
          }
        }
      });
    }else{
      var selector = 'select[name="sort_supplier"]';
      $.ajax({
        type: "GET",
        url: "/suppliers/suppliers",
        cache: false,
        dataType: "json",
        beforeSend: function() {
          $(selector).html("");
          $(selector).append('<option value="all">All Suppliers</option>');
        },
        success: function(data) {
          for (var i = 0; i < data.length; i++) {
            $(selector).append('<option value="'+data[i].supplierID+'">'+data[i].supplier_company+'</option>');
          }
        }
      });
    }
  }


});
</script>
@endsection