<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/assets/css/balloon.css">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="/assets/semantic-ui/semantic.css">
<link rel="stylesheet" type="text/css" href="/assets/semantic-ui/components/dropdown.css">
<link rel="stylesheet" type="text/css" href="/assets/semantic-ui/components/transition.css">
<link rel="stylesheet" type="text/css" href="/assets/css/alertify-css/alertify.css">
<link rel="stylesheet" type="text/css" href="/assets/css/alertify-css/themes/default.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/core.css">
<link rel="stylesheet" type="text/css" href="/assets/jqueryui/jquery-ui.min.css">
<style>
@yield('css')
</style>
</head>
<body>
<nav class="navbar navbar-default nav-stacked">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#pos-navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">POS</a>
    </div>
    <div class="collapse navbar-collapse" id="pos-navbar">
    <ul class="nav navbar-nav">
      <li><a href="/">Home</a></li>
      <li><a href="/items">Items</a></li>
      <li><a href="/sales">Sales</a></li>
      <li><a href="/purchases">Purchases</a></li>
      <li><a href="/receivables">Receivables</a></li>
      <li><a href="/expenses">Expenses</a></li>
      <li><a href="/payables">Payables</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li><a href="/reports">Reports</a></li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="/customers">Customers</a></li>
        <li><a href="/salesman">Salesman</a></li>
        <li><a href="/suppliers">Suppliers</a></li>
        <li><a href="/users">Users</a></li>

        <li><a href="#" id="app-settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
        <li><a href="#" id="app-settings"><span class="glyphicon glyphicon-cog"></span> Maintenance</a></li>
        <li><a href="#" id="app-settings"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </li>
    </ul>
    </div>
  </div>
</nav>


<div class="container-fluid">
	<div class="row">
		@yield('content')
	</div>

</div>

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
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-items-form">Save</button>
      </div>
    </div>

</div>
</div>



<!--Add Customer -->
<div id="add-customers-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-customers-form">Save</button>
      </div>
    </div>

</div>
</div>


<!--Add Salesman -->
<div id="add-salesman-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
        <form action="salesman" method="post" class="form-horizontal" id="add-salesman-form">  
        {{ csrf_field() }}

        <div class='form-group'>
          <label for="salesman_name" class='col-md-2'>Salesman's Name:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='salesman_name' placeholder="Salesman's Name">
            <p class="help-block" id="salesman_name-help-block"></p>
          </div>
        </div>
        
        
        <div class='form-group'>
          <label for="salesman_contact_number" class='col-md-2'>Contact Number:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='salesman_contact_number' placeholder='Contact Number'>
            <p class="help-block" id="salesman_contact_number-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="salesman_address" class='col-md-2'>Salesman's Address:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='salesman_address' placeholder="Salesman's Address">
            <p class="help-block" id="salesman_address-help-block"></p>
          </div>
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-salesman-form">Save</button>
      </div>
    </div>

</div>
</div>


<!--Add Supplier -->
<div id="add-suppliers-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Customers</h4>
    </div>
      <div class="modal-body">
        <form action="suppliers" method="post" class="form-horizontal" id="add-suppliers-form">  
        {{ csrf_field() }}
        
        <div class='form-group'>
          <label for="supplier_company" class='col-md-2'>Supplier's Company:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='supplier_company' placeholder="Supplier's Company Name">
            <p class="help-block" id="supplier_company-help-block"></p>
          </div>
        </div>
        
        <div class='form-group'>
          <label for="supplier_name" class='col-md-2'>Contact Person:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='supplier_name' placeholder="Supplier's Name">
            <p class="help-block" id="supplier_name-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplier_number" class='col-md-2'>Contact Number:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='supplier_number' placeholder='Contact Number'>
            <p class="help-block" id="supplier_number-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplier_address" class='col-md-2'>Supplier's Address:</label>
          <div class='col-md-10'>
            <input type='text' class='form-control' name='supplier_address' placeholder="Supplier's Address">
            <p class="help-block" id="supplier_address-help-block"></p>
          </div>
        </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-suppliers-form">Save</button>
      </div>
    </div>

  </div>
</div>

@yield('modals')
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<!-- <script type="text/javascript" src="/assets/semantic-ui/semantic.js"></script> -->
<script type="text/javascript" src="/assets/semantic-ui/components/dropdown.js"></script>
<script type="text/javascript" src="/assets/semantic-ui/components/transition.js"></script>
<script type="text/javascript" src="/assets/js/moment.js"></script>
<script type="text/javascript" src="/assets/js/alertify.js"></script>
<script type="text/javascript" src="/assets/js/core.js"></script>

@yield('scripts')

</body>
</html>