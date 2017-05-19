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