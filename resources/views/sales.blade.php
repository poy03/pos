@extends('layouts.main')

@section('title', 'Sales')

@section('content')
<div class='col-sm-12'>
  <div class='col-sm-10'>
    <div class="row">
      <div class='col-sm-6'>
        <label>Add Item:</label>
        <div class = "form-group">
           <input type = "text" class = "form-control itemsearch" name='itemname' id='itemsearch' autocomplete='off' placeholder='Type for Item Name Or Item Code'>
        </div>
      </div>    
      <div class='col-sm-6'>
        <label>Add Item:</label>
        <div class = "form-group">
           <input type = "text" class = "form-control" name='itemname' id='itemsearch_cat' autocomplete='off' placeholder='Type for Category'>
        </div>    
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12">
        <table class='table table-hover'>
          <thead>
            <tr>
              <th>Item Name</th>
              <th>Remaining</th>
              <th>Cost Price</th>
              <th>Quantity</th>
              <th>Price</th>
              <th style='text-align:right'>Line Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </div>
    </div>
  </div>


  <div class='col-sm-2'>
    <div class="form-group">
      <label>TS Number:</label>
      <input tabindex='-1' type='text' class='form-control search' id='search_ts' placeholder='TS Number' autocomplete='off' name='ts_orderID'>
    </div>
    <div class="form-group">
      <label>Utilities:</label>
      <a class='btn btn-primary btn-block' href='sales'><span class='glyphicon glyphicon-refresh'></span> Refresh Page</a>
      <a class='btn btn-info btn-block' id='reset'><span class='glyphicon glyphicon-refresh'></span> Reset All Prices</a>
      <a class='btn btn-info btn-block' id='reset_cost'><span class='glyphicon glyphicon-refresh'></span> Reset All Cost Price</a>
      <a tabindex='-1' class='btn btn-info btn-block' name='delete' href='sales-re'><span class='glyphicon glyphicon-shopping-cart'></span> Sales Search</a>  
    </div>
  </div>
</div>

@endsection

@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(e) {
  $( "#itemsearch" ).autocomplete({
      source: '/search/items/sales',
      select: function(event, ui){
        $.ajax({
          type: "GET",
          url: "/items",
          data: "id="+ui.item.data,
          cache: false,
          success: function(data) {
            alert(data);
          }
        });
      }
  }); 
});
</script>
@endsection