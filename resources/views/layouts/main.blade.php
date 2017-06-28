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

@yield('css')
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

      @if(isset($user_data)&&$user_data['items']==1)
      <li><a href="/items">Items</a></li>
      @endif
      @if(isset($user_data)&&$user_data['sales']==1)
      <li><a href="/sales">Sales</a></li>
      @endif
      @if(isset($user_data)&&$user_data['receiving']==1)
      <li><a href="/purchases">Purchases</a></li>
      @endif
      @if(isset($user_data)&&$user_data['credits']==1)
      <li><a href="/receivables">Receivables</a></li>
      @endif
      @if(isset($user_data)&&$user_data['expenses']==1)
      <li><a href="/expenses">Expenses</a></li>
      @endif
      @if(isset($user_data)&&$user_data['accounts_payable']==1)
      <li><a href="/payables">Payables</a></li>
      @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
    @if(isset($user_data)&&$user_data['reports']==1)
    <li><a href="/reports">Reports</a></li>
    @endif
    @if(isset($user_data))
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="caret"></span></a>
      <ul class="dropdown-menu">
      @if(isset($user_data)&&$user_data['customers']==1)
        <li><a href="/customers">Customers</a></li>
        @endif
        @if(isset($user_data)&&$user_data['salesman']==1)
        <li><a href="/salesman">Salesman</a></li>
        @endif
        @if(isset($user_data)&&$user_data['suppliers']==1)
        <li><a href="/suppliers">Suppliers</a></li>
        @endif
        @if(isset($user_data)&&$user_data['users']==1)
        <li><a href="/users">Users</a></li>
        @endif

        <li><a href="#" id="app-settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
        <li><a href="/maintenance" id="app-settings"><span class="glyphicon glyphicon-cog"></span> Maintenance</a></li>
        <li><a href="/logout" id="app-settings"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </li>
    @else
    <li><a href="/login" id="app-settings"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    @endif
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
          <label for="category" class='col-sm-2'>Category:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control search' id='category' name='category' placeholder='Category' autocomplete='off'>
            <p class="help-block" id="category-help-block"></p>
          </div>

        </div>

        <div class='form-group'>
          <label for="itemname" class='col-sm-2'>Item Name:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='itemname' placeholder='Item Name'>
            <p class="help-block" id="itemname-help-block"></p>
          </div>
        </div>


        <div class='form-group'>
          <label for="item_code" class='col-sm-2'>Item Code:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='item_code' placeholder='Item Code'>
            <p class="help-block" id="item_code-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplierID" class='col-sm-2'>SupplierID:</label>
          <div class='col-sm-10'>
            <select name="supplierID" class="form-control">
              <option value="">Select SupplierID</option>
              <option value="1">1</option>
            </select>
            <p class="help-block" id="supplierID-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="unit_of_measure" class='col-sm-2'>Unit of Measurement:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='unit_of_measure' placeholder='Unit of Measurement'>
            <p class="help-block" id="unit_of_measure-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="costprice" class='col-sm-2'>Sub Cost Price:</label>
          <div class='col-sm-10'>
            <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='costprice' placeholder='Sub Cost Price'>
            <p class="help-block" id="costprice-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="srp" class='col-sm-2'>WPP:</label>
          <div class='col-sm-10'>
            <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='srp' placeholder='WPP'>
            <p class="help-block" id="srp-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="price_to_distributors" class='col-sm-2'>Price to Distributors:</label>
          <div class='col-sm-10'>
            <input step='0.01' min='0' max='99999999' type='number' class='form-control' name='price_to_distributors' placeholder='Price to Distributors'>
            <p class="help-block" id="price_to_distributors-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="quantity" class='col-sm-2'>Quantity:</label>
          <div class='col-sm-10'>
            <input min='0' max='99999999' type='number' class='form-control' name='quantity' placeholder='Quantity'>
            <p class="help-block" id="quantity-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="reorder" class='col-sm-2'>Reorder Level:</label>
          <div class='col-sm-10'>
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
          <label for="companyname" class="col-sm-2">Company Name:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="companyname" placeholder="Company Name">
            <p class="help-block" id="companyname-help-block"></p>
          </div>
        </div>
        
        <div class="form-group">
          <label for="address" class="col-sm-2">Address:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="address" placeholder="Address">
            <p class="help-block" id="address-help-block"></p>
          </div>
        </div>
        
        <div class="form-group">
          <label for="email" class="col-sm-2">Email:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="email" placeholder="Email">
            <p class="help-block" id="email-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="phone" class="col-sm-2">Contact Number:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="phone" placeholder="Contact Number">
            <p class="help-block" id="phone-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="contactperson" class="col-sm-2">Contact Person:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="contactperson" placeholder="Contact Person">
            <p class="help-block" id="contactperson-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="contactperson" class="col-sm-2">TIN ID:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="tin_id" placeholder="TIN ID">
            <p class="help-block" id="tin_id-help-block"></p>
          </div>
        </div>


        <div class="form-group">
          <label for="credit_limit" class="col-sm-2">Credit Limit:</label>
          <div class="col-sm-10">
            <input type="number" step="0.01" min="0" class="form-control" name="credit_limit" placeholder="Credit Limit">
            <p class="help-block" id="credit_limit-help-block"></p>
          </div>
        </div>

        <div class="form-group">
          <label for="credit_limit" class="col-sm-2">Credit Terms:</label>
          <div class="col-sm-10">
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
      <h4 class="modal-title">Add Salesman</h4>
    </div>
      <div class="modal-body">
        <form action="salesman" method="post" class="form-horizontal" id="add-salesman-form">  
        {{ csrf_field() }}

        <div class='form-group'>
          <label for="salesman_name" class='col-sm-2'>Salesman's Name:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='salesman_name' placeholder="Salesman's Name">
            <p class="help-block" id="salesman_name-help-block"></p>
          </div>
        </div>
        
        
        <div class='form-group'>
          <label for="salesman_contact_number" class='col-sm-2'>Contact Number:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='salesman_contact_number' placeholder='Contact Number'>
            <p class="help-block" id="salesman_contact_number-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="salesman_address" class='col-sm-2'>Salesman's Address:</label>
          <div class='col-sm-10'>
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
          <label for="supplier_company" class='col-sm-2'>Supplier's Company:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='supplier_company' placeholder="Supplier's Company Name">
            <p class="help-block" id="supplier_company-help-block"></p>
          </div>
        </div>
        
        <div class='form-group'>
          <label for="supplier_name" class='col-sm-2'>Contact Person:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='supplier_name' placeholder="Supplier's Name">
            <p class="help-block" id="supplier_name-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplier_number" class='col-sm-2'>Contact Number:</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' name='supplier_number' placeholder='Contact Number'>
            <p class="help-block" id="supplier_number-help-block"></p>
          </div>
        </div>

        <div class='form-group'>
          <label for="supplier_address" class='col-sm-2'>Supplier's Address:</label>
          <div class='col-sm-10'>
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

<!--Add Users -->
<div id="add-users-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add User</h4>
    </div>
      <div class="modal-body">
        <form action="/users" method="post" class="form-horizontal" id="add-users-form">  
        {{ csrf_field() }}

          <div class='form-group'>
            <label for='type' class='col-sm-2'>Previlages:</label>
              <div class='col-sm-10'>
              <select class='form-control' name='type' id='type'>
                <option value='user'>User</option>
                <option value='admin'>Admin</option>
              </select>
            </div>
          </div>
          
          
          <div class='form-group'>
            <label for='username' class='col-sm-2'>Username:</label>
            <div class='col-sm-10'>
              <input type='text' name='username' placeholder='Username' class='form-control' autocomplete="off">
              <p class="help-block" id="username-help-block"></p>
            </div>
          </div>
          
          <div class='form-group'>
            <label for='password' class='col-sm-2'>Password:</label>
            <div class='col-sm-10'>
              <input type='password' name='password' placeholder='Password' class='form-control' autocomplete="off">
            <p class="help-block" id="password-help-block"></p>
            </div>
          </div>
          
          <div class='form-group'>
            <label for='name' class='col-sm-2'>Full Name:</label>
            <div class='col-sm-10'>
              <input type='text' name='employee_name' placeholder='Full Name' class='form-control' autocomplete="off">
            <p class="help-block" id="employee_name-help-block"></p>
            </div>
          </div>  
          
          <div id='admin'>
            <span><b>Access to modules:</b></span>
            <div class='row'>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' name='items' value='1' class='module'>Items</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' name='items_add' value='1' class='module'>Add Items</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' name='items_modify' value='1' class='module'>Modify Items</label>
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' name='customers' value='1' class='module'>Customers</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' name='customers_add' value='1' class='module'>Add Customers</label>
                <br>      
                &nbsp;&nbsp;<label><input type='checkbox' name='customers_modify' value='1' class='module'>Modify Customers</label>      
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' name='sales' value='1' class='module'>Sales</label>
              </div>
              <div class="checkbox col-sm-2">
                  <label><input type='checkbox' name='salesman' value='1' class='module'>Salesman</label>
                  <br>
                  &nbsp;&nbsp;<label><input type='checkbox' name='salesman_add' value='1' class='module'>Add Salesman</label>
                  <br>      
                  &nbsp;&nbsp;<label><input type='checkbox' name='salesman_modify' value='1' class='module'>Modify Salesman</label>      
                </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' name='suppliers' value='1' class='module'>Suppliers</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' name='suppliers_add' value='1' class='module'>Add Suppliers</label>
                <br>      
                &nbsp;&nbsp;<label><input type='checkbox' name='suppliers_modify' value='1' class='module'>Modify Suppliers</label>      
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' name='users' value='1' class='module'>Users</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' name='users_add' value='1' class='module'>Add Users</label>
                <br>      
                &nbsp;&nbsp;<label><input type='checkbox' name='users_modify' value='1' class='module'>Modify Users</label>      
              </div>
              </div>
              <hr>
            <div class='row'>
            <div class="checkbox col-sm-2">
                <label> <input type='checkbox' name='reports' value='1' class='module'>Reports</label>
              </div>
            <div class="checkbox col-sm-2">
                <label> <input type='checkbox' name='credits' value='1' class='module'>Accounts Receivable</label>
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' name='expenses' value='1' class='module'>Expenses</label>
              </div>
            <div class="checkbox col-sm-2">
              <label><input type='checkbox' name='receiving' value='1' class='module'>Receiving</label>
            </div> 
            <div class="checkbox col-sm-2">
              <label><input type='checkbox' name='accounts_payable' value='1' class='module'>Accounts Payable</label>
            </div> 
            </div>

          </div>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="add-users-form">Save</button>
      </div>
    </div>

  </div>
</div>


<!--Settings Modal -->
<div id="settings-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Settings</h4>
    </div>
      <div class="modal-body">
        <form action="/settings" method="post" class="form-horizontal" id="settings-form" enctype='multipart/form-data'>
        {{ csrf_field() }}

          <div class='form-group'>
            <label for='app_company_name' class='col-sm-2'>Company Name:</label>
            <div class='col-sm-10'>
              <input type='text' class='form-control' name='company_name' value="">
              <p class="help-block" id="app_company_name-help-block"></p>
            </div>
          </div>

          <div class='form-group'>
            <label for='address' class='col-sm-2'>Address:</label>
            <div class='col-sm-10'>
              <input type='text' class='form-control' name='address' value="">
              <p class="help-block" id="app_address-help-block"></p>
            </div>
          </div>

          <div class='form-group'>
            <label for='contact_number' class='col-sm-2'>Contact Number:</label>
            <div class='col-sm-10'>
              <input type='text' class='form-control' name='contact_number' value="">
              <p class="help-block" id="app_contact_number-help-block"></p>
            </div>
          </div>

          <div class='form-group'>
            <label for='type_of_payments' class='col-sm-2'>Logo:</label>
            <div class='col-sm-10'>
              <input type='file' name='logo' accept="image/*" capture="camera">
              <i style='font-size:75%;'>* .JPG,.PNG,.GIF Allowed.</i>
              <p class="help-block" id="app_logo-help-block"></p>
            </div>
          </div>


          <h3 style='text-align: center;'>Personal Preference</h3>

          <div class='form-group'>
            <label for='themes' class='col-sm-2'>Select Theme:</label>
            <div class='col-sm-10'>
            <select name='themes' class='form-control'>
              <option value='bootstrap.min.css'  >Default Theme</option>
              <option value='cosmo-bootstrap.min.css'  >Cosmo Theme</option>
              <option value='cerulean-bootstrap.min.css'  >Cerulean Theme</option>
              <option value='simplex-bootstrap.min.css'  >Simplex Theme</option>
              <option value='lumen-bootstrap.min.css'  >Lumen Theme</option>
              <option value='flatly-bootstrap.min.css'  >Flatly Theme</option>
              <option value='sandstone-bootstrap.min.css' selected='selected' >Sandstone Theme</option>
              <option value='united-bootstrap.min.css'  >United Theme</option>
              <option value='spacelab-bootstrap.min.css'  >Spacelab Theme</option>
            </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="settings-form">Save</button>
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
<script type="text/javascript" src="/assets/js/angular.min.js"></script>
<script type="text/javascript" src="/assets/js/angular-sanitize.js"></script>
<script type="text/javascript" src="/assets/js/core.js"></script>

@yield('scripts')
</body>
</html>