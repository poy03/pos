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