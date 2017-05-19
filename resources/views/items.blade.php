@extends('layouts.main')

@section('title', 'Items')

@section('content')
<div class="col-sm-2">
  <label>Controls:</label>
  <button class="btn btn-primary btn-block" onclick="$('#add-items-modal').modal('show')"><span class="glyphicon glyphicon-briefcase"></span> Add Items</button> 
  <button class="btn btn-primary btn-block" type="button"><span class="glyphicon glyphicon-edit"></span> Edit Items</button>
  <button class="btn btn-danger btn-block" type="button" id="delete"><span class="glyphicon glyphicon-trash"></span> Delete Items</button>


  <label>Category:</label>
  <select class='form-control' id='cat'>
    <option value='all'>All</option>
  </select>

  <label>Supplier:</label>
  <select class="form-control" id="supplier">
    <option value="all">All</option>
  </select>



  <label>Sort:</label>
  <select class='form-control' id='sort'>
    <option value='A-Z' selected>A-Z</option>
    <option value='Z-A' >Z-A</option>
    <option value='Q-R' >Quantity < Reorder Level</option>
    <option value='Q-D' >Quantity DESC</option>
    <option value='Q-A' >Quantity ASC</option>
  </select>


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
        <th>Remaining Quantity</th>
        <th>Sub Cost Price</th>
        <th>Total Cost Price</th>
        <th>WPP</th>
        <th>STD Price to Trade (Terms):</th>
        <th>STD Price to Trade (COD):</th>
        <th>Price to Distributors:</th>
        <th class='prints'>Reorder Level</th>
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
<div id="add-items-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Items</h4>
    </div>
      <div class="modal-body">
        <p>
        <form action="/items" method="post" class="form-horizontal" id="add-items-form">
        {{ csrf_field() }}
        <div class='form-group ui-widget'>
          <label for="category" class='col-md-2'>Category:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control search' id='category' name='category' placeholder='Category' autocomplete='off'>
          <p class="help-block" id="category-help-block"></p>
        </div>

        </div>

        <div class='form-group'>
          <label for="itemname" class='col-md-2'>Item Name:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control' name='itemname' placeholder='Item Name'>
          <p class="help-block" id="itemname-help-block"></p>
        </div>
        </div>


        <div class='form-group'>
          <label for="item_code" class='col-md-2'>Item Code:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control' name='item_code' placeholder='Item Code'>
          <p class="help-block" id="item_code-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="supplierID" class='col-md-2'>SupplierID:</label>
        <div class='col-md-10'>
          <select name="supplierID" class="form-control">
            <option value="">Select SupplierID</option>
            <option value="1">1</option>
          </select>
          <p class="help-block" id="supplierID-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="unit_of_measure" class='col-md-2'>Unit of Measurement:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control' name='unit_of_measure' placeholder='Unit of Measurement'>
          <p class="help-block" id="unit_of_measure-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="costprice" class='col-md-2'>Sub Cost Price:</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='costprice' placeholder='Sub Cost Price'>
          <p class="help-block" id="costprice-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="srp" class='col-md-2'>WPP:</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='srp' placeholder='WPP'>
          <p class="help-block" id="srp-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="std_price_to_trade_terms" class='col-md-2'>STD Price to Trade (Terms):</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='std_price_to_trade_terms' placeholder='STD Price to Trade (Terms)'>
          <p class="help-block" id="std_price_to_trade_terms-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="std_price_to_trade_cod" class='col-md-2'>STD Price to Trade (COD):</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='std_price_to_trade_cod' placeholder='STD Price to Trade (COD)'>
          <p class="help-block" id="std_price_to_trade_cod-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="price_to_distributors" class='col-md-2'>Price to Distributors:</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='price_to_distributors' placeholder='Price to Distributors'>
          <p class="help-block" id="price_to_distributors-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="quantity" class='col-md-2'>Quantity:</label>
        <div class='col-md-10'>
          <input min='0' max='99999999' type='number' class='form-control' name='quantity' placeholder='Quantity'>
          <p class="help-block" id="quantity-help-block"></p>
        </div>
        </div>

        <div class='form-group'>
          <label for="reorder" class='col-md-2'>Reorder Level:</label>
        <div class='col-md-10'>
          <input min='0' max='99999999' type='number' class='form-control' name='reorder' placeholder='Reorder Level'>
          <p class="help-block" id="reorder-help-block"></p>
        </div>

        </form>
        </p>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-items-form">Save</button>
      </div>
    </div>

</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {  $("#add-items-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#add-items-form").attr("action"),
      data: $("#add-items-form").serialize(),
      cache: false,
      dataType: "json",
      success: function(data) {
        alertify.success(data.itemname + " has been successfuly added.");
        $("#add-items-form")[0].reset();
        show_items();
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
      }
    });
  });

  show_items();
  function show_items(page = 1) {
    $.ajax({
      type: "GET",
      url: "/items/list",
      data: "page="+page+"&maxitem="+50,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#items-table tbody").html("");
      },
      success: function(data) {
        $.each(data.result, function(i, item) {
          $('#items-table tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].itemID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].category+'</td>\
              <td style="text-align:center;">'+data.result[i].supplierID+'</td>\
              <td style="text-align:left;">'+data.result[i].itemname+'</td>\
              <td style="text-align:center;">'+data.result[i].item_code+'</td>\
              <td style="text-align:center;">'+data.result[i].unit_of_measure+'</td>\
              <td style="text-align:center;">'+data.result[i].quantity+'</td>\
              <td style="text-align:right;">'+data.result[i].costprice+'</td>\
              <td style="text-align:right;">'+data.result[i].total_costprice+'</td>\
              <td style="text-align:right;">'+data.result[i].srp+'</td>\
              <td style="text-align:right;">'+data.result[i].std_price_to_trade_terms+'</td>\
              <td style="text-align:right;">'+data.result[i].std_price_to_trade_cod+'</td>\
              <td style="text-align:right;">'+data.result[i].price_to_distributors+'</td>\
              <td style="text-align:center;">'+data.result[i].reorder+'</td>\
            </tr>\
            ');
        });
      }
    });
  }
});
</script>
@endsection