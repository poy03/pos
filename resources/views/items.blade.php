@extends('layouts.main')

@section('title', 'Items')

@section('content')
@include('layouts.items_side')
<div class="col-sm-10">
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
      <h4 class="modal-title">Add studentsss</h4>
    </div>
      <div class="modal-body">
        <p>
        <form action="/items" method="post" class="form-horizontal" id="add-items-form">

        <div class='form-group ui-widget'>
          <label for="category" class='col-md-2'>Category:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control search' id='category' name='category' placeholder='Category' autocomplete='off'>
        </div>

        </div>

        <div class='form-group'>
          <label for="itemname" class='col-md-2'>Item Name:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control' name='itemname' placeholder='Item Name'>
        </div>
        </div>


        <div class='form-group'>
          <label for="item_code" class='col-md-2'>Item Code:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control' name='item_code' placeholder='Item Code'>
        </div>
        </div>

        <div class='form-group'>
          <label for="supplier" class='col-md-2'>Supplier:</label>
        <div class='col-md-10'>
          <select name="supplier" class="form-control">
            <option>Select Supplier</option>
                </select>
        </div>
        </div>

        <div class='form-group'>
          <label for="unit_of_measure" class='col-md-2'>Unit of Measurement:</label>
        <div class='col-md-10'>
          <input type='text' class='form-control' name='unit_of_measure' placeholder='Unit of Measurement'>
        </div>
        </div>

        <div class='form-group'>
          <label for="sub_costprice" class='col-md-2'>Sub Cost Price:</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='sub_costprice' placeholder='Sub Cost Price'>
        </div>
        </div>

        <div class='form-group'>
          <label for="srp" class='col-md-2'>WPP:</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='srp' placeholder='WPP'>
        </div>
        </div>

        <div class='form-group'>
          <label for="std_price_to_trade_terms" class='col-md-2'>STD Price to Trade (Terms):</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='std_price_to_trade_terms' placeholder='STD Price to Trade (Terms)'>
        </div>
        </div>

        <div class='form-group'>
          <label for="std_price_to_trade_cod" class='col-md-2'>STD Price to Trade (COD):</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='std_price_to_trade_cod' placeholder='STD Price to Trade (COD)'>
        </div>
        </div>

        <div class='form-group'>
          <label for="price_to_distributors" class='col-md-2'>Price to Distributors:</label>
        <div class='col-md-10'>
          <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='price_to_distributors' placeholder='Price to Distributors'>
        </div>
        </div>

        <div class='form-group'>
          <label for="quantity" class='col-md-2'>Quantity:</label>
        <div class='col-md-10'>
          <input min='0' max='99999999' type='number' class='form-control' name='quantity' placeholder='Quantity'>
        </div>
        </div>

        <div class='form-group'>
          <label for="quantity" class='col-md-2'>Reorder Level:</label>
        <div class='col-md-10'>
          <input min='0' max='99999999' type='number' class='form-control' name='reorder' placeholder='Reorder Level'>
        </div>

        </form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-items-form">Save</button>
      </div>
    </div>

  </div>
</div>

@endsection