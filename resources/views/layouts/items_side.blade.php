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