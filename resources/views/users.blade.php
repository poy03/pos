@extends('layouts.main')

@section('title', 'Users')

@section('content')
<div class="col-sm-2">
<label>Controls:</label>  
<button class="btn btn-primary btn-block btn-add-users" name="add"><span class="glyphicon glyphicon-user"></span> Add Users</button>
<button type="button" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Users</button>
<button type="button" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Delete Users</button>
</div>
<div class="col-sm-10">
  <div class="table-responsive">
  <table class="table table-hover" id="users-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="select-all"> All</th>
        <th>Privilages</th>
        <th>Display Name</th>
        <th>Username</th>
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
<!--Add Users -->
<div id="edit-users-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add User</h4>
    </div>
      <div class="modal-body">
        <form action="/users" method="post" class="form-horizontal" id="edit-users-form">  
        {{ csrf_field() }}
        <input type="hidden" name="accountID">

          <div class='form-group'>
            <label for='type' class='col-sm-2'>Previlages:</label>
              <div class='col-sm-10'>
              <select class='form-control edit-field' name='type' id='type'>
                <option value='user'>User</option>
                <option value='admin'>Admin</option>
              </select>
            </div>
          </div>
          
          <div class='form-group'>
            <label for='username' class='col-sm-2'>Username:</label>
            <div class='col-sm-10'>
              <input type='text' name='username' placeholder='Username' class='form-control edit-field' autocomplete="off">
              <p class="help-block" id="username-help-block"></p>
            </div>
          </div>
          
          <div class='form-group'>
            <label for='name' class='col-sm-2'>Full Name:</label>
            <div class='col-sm-10'>
              <input type='text' name='employee_name' placeholder='Full Name' class='form-control edit-field' autocomplete="off">
            <p class="help-block" id="employee_name-help-block"></p>
            </div>
          </div>  
          
          <div id='admin'>
            <span><b>Access to modules:</b></span>
            <div class='row'>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' class="edit-field" name='items' value='1' class='module'>Items</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='items_add' value='1' class='module'>Add Items</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='items_modify' value='1' class='module'>Modify Items</label>
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' class="edit-field" name='customers' value='1' class='module'>Customers</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='customers_add' value='1' class='module'>Add Customers</label>
                <br>      
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='customers_modify' value='1' class='module'>Modify Customers</label>      
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' class="edit-field" name='sales' value='1' class='module'>Sales</label>
              </div>
              <div class="checkbox col-sm-2">
                  <label><input type='checkbox' class="edit-field" name='salesman' value='1' class='module'>Salesman</label>
                  <br>
                  &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='salesman_add' value='1' class='module'>Add Salesman</label>
                  <br>      
                  &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='salesman_modify' value='1' class='module'>Modify Salesman</label>      
                </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' class="edit-field" name='suppliers' value='1' class='module'>Suppliers</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='suppliers_add' value='1' class='module'>Add Suppliers</label>
                <br>      
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='suppliers_modify' value='1' class='module'>Modify Suppliers</label>      
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' class="edit-field" name='users' value='1' class='module'>Users</label>
                <br>
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='users_add' value='1' class='module'>Add Users</label>
                <br>      
                &nbsp;&nbsp;<label><input type='checkbox' class="edit-field" name='users_modify' value='1' class='module'>Modify Users</label>      
              </div>
              </div>
              <hr>
            <div class='row'>
            <div class="checkbox col-sm-2">
                <label> <input type='checkbox' class="edit-field" name='reports' value='1' class='module'>Reports</label>
              </div>
            <div class="checkbox col-sm-2">
                <label> <input type='checkbox' class="edit-field" name='credits' value='1' class='module'>Accounts Receivable</label>
              </div>
            <div class="checkbox col-sm-2">
                <label><input type='checkbox' class="edit-field" name='expenses' value='1' class='module'>Expenses</label>
              </div>
            <div class="checkbox col-sm-2">
              <label><input type='checkbox' class="edit-field" name='receiving' value='1' class='module'>Receiving</label>
            </div> 
            <div class="checkbox col-sm-2">
              <label><input type='checkbox' class="edit-field" name='accounts_payable' value='1' class='module'>Accounts Payable</label>
            </div> 
            </div>

          </div>  
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="edit-users-form">Save</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(e) {
  $("#type").change(function(){
    var type=$(this).val();
    if(type=='user'){
      $(":checkbox").each(function(){
        this.checked = false;
        $(".module").removeAttr("disabled");      
      });
    }else{
      $(":checkbox").each(function(){
        this.checked = true;    
        $(".module").attr("disabled","disabled");     
      });
    }
  });

  $("#add-users-form").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#add-users-form").attr("action"),
      data: $("#add-users-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="add-users-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.username + " has been successfuly added.");
        $("#add-users-form")[0].reset();
        show_users($(".paging-active a").html());
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#username-help-block").html(errors.username);
          $("#password-help-block").html(errors.password);
          $("#employee_name-help-block").html(errors.employee_name);
        }
      },
      complete: function() {
        $('button[form="add-users-form"]').prop("disabled",false);
      }
    });
  });
 
  $("#edit-users-form").submit(function(e) {
    e.preventDefault();
    var accountID = $('input[name="accountID"]').val();
    $.ajax({
      type: "PUT",
      url: "/users/user/"+accountID,
      data: $("#edit-users-form").serialize(),
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(".help-block").html("");
        $('button[form="edit-users-form"]').prop("disabled",true);
      },
      success: function(data) {
        alertify.success(data.username + " has been successfuly added.");
        $("#edit-users-form")[0].reset();
        show_users($(".paging-active a").html());
      },
      error: function(data) {
        console.log(data);
        if(data.status = 422){
          var errors = data.responseJSON;
          $("#edit-username-help-block").html(errors.username);
          $("#edit-password-help-block").html(errors.password);
          $("#edit-employee_name-help-block").html(errors.employee_name);
        }
      },
      complete: function() {
        $('button[form="edit-users-form"]').prop("disabled",false);
      }
    });
  });

  $(document).on("click",".paging",function(e) {
    show_users(e.target.id);
  });

  $(document).on("click",".edit",function(e) {
    $.ajax({
      type: "GET",
      url: "/users/user/"+e.target.id,
      cache: false,
      dataType: "json",
      success: function(data) {
        $('input[name="username"].edit-field').val(data.username);
        $('input[name="employee_name"].edit-field').val(data.employee_name);
        $('input[name="type"].edit-field').val(data.type);
        if(data.items==1){
          $('input[name="items"].edit-field').prop("checked",true);
        }else{
          $('input[name="items"].edit-field').prop("checked",false);
        }
        if(data.customers==1){
          $('input[name="customers"].edit-field').prop("checked",true);
        }else{
          $('input[name="customers"].edit-field').prop("checked",false);
        }
        if(data.sales==1){
          $('input[name="sales"].edit-field').prop("checked",true);
        }else{
          $('input[name="sales"].edit-field').prop("checked",false);
        }
        if(data.receiving==1){
          $('input[name="receiving"].edit-field').prop("checked",true);
        }else{
          $('input[name="receiving"].edit-field').prop("checked",false);
        }
        if(data.users==1){
          $('input[name="users"].edit-field').prop("checked",true);
        }else{
          $('input[name="users"].edit-field').prop("checked",false);
        }
        if(data.reports==1){
          $('input[name="reports"].edit-field').prop("checked",true);
        }else{
          $('input[name="reports"].edit-field').prop("checked",false);
        }
        if(data.suppliers==1){
          $('input[name="suppliers"].edit-field').prop("checked",true);
        }else{
          $('input[name="suppliers"].edit-field').prop("checked",false);
        }
        if(data.credits==1){
          $('input[name="credits"].edit-field').prop("checked",true);
        }else{
          $('input[name="credits"].edit-field').prop("checked",false);
        }
        if(data.expenses==1){
          $('input[name="expenses"].edit-field').prop("checked",true);
        }else{
          $('input[name="expenses"].edit-field').prop("checked",false);
        }
        if(data.items_modify==1){
          $('input[name="items_modify"].edit-field').prop("checked",true);
        }else{
          $('input[name="items_modify"].edit-field').prop("checked",false);
        }
        if(data.suppliers_modify==1){
          $('input[name="suppliers_modify"].edit-field').prop("checked",true);
        }else{
          $('input[name="suppliers_modify"].edit-field').prop("checked",false);
        }
        if(data.customers_modify==1){
          $('input[name="customers_modify"].edit-field').prop("checked",true);
        }else{
          $('input[name="customers_modify"].edit-field').prop("checked",false);
        }
        if(data.users_modify==1){
          $('input[name="users_modify"].edit-field').prop("checked",true);
        }else{
          $('input[name="users_modify"].edit-field').prop("checked",false);
        }
        if(data.salesman==1){
          $('input[name="salesman"].edit-field').prop("checked",true);
        }else{
          $('input[name="salesman"].edit-field').prop("checked",false);
        }
        if(data.salesman_modify==1){
          $('input[name="salesman_modify"].edit-field').prop("checked",true);
        }else{
          $('input[name="salesman_modify"].edit-field').prop("checked",false);
        }
        if(data.items_add==1){
          $('input[name="items_add"].edit-field').prop("checked",true);
        }else{
          $('input[name="items_add"].edit-field').prop("checked",false);
        }
        if(data.items==1){
          $('input[name="items"].edit-field').prop("checked",true);
        }else{
          $('input[name="items"].edit-field').prop("checked",false);
        }
        if(data.customers_add==1){
          $('input[name="customers_add"].edit-field').prop("checked",true);
        }else{
          $('input[name="customers_add"].edit-field').prop("checked",false);
        }
        if(data.suppliers_add==1){
          $('input[name="suppliers_add"].edit-field').prop("checked",true);
        }else{
          $('input[name="suppliers_add"].edit-field').prop("checked",false);
        }
        if(data.users_add==1){
          $('input[name="users_add"].edit-field').prop("checked",true);
        }else{
          $('input[name="users_add"].edit-field').prop("checked",false);
        }
        if(data.salesman_add==1){
          $('input[name="salesman_add"].edit-field').prop("checked",true);
        }else{
          $('input[name="salesman_add"].edit-field').prop("checked",false);
        }
        if(data.salesman_add==1){
          $('input[name="salesman_add"].edit-field').prop("checked",true);
        }else{
          $('input[name="salesman_add"].edit-field').prop("checked",false);
        }
        if(data.accounts_payable==1){
          $('input[name="accounts_payable"].edit-field').prop("checked",true);
        }else{
          $('input[name="accounts_payable"].edit-field').prop("checked",false);
        }
        $("#edit-users-modal").modal("show");
      }
    });
  });

  show_users();
  function show_users(page = 1) {
    $.ajax({
      type: "GET",
      url: "/users/list",
      data: $("#user-sort-form").serialize()+"&page="+page+"&maxitem="+50,
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $("#users-table tbody").html("");
      },
      success: function(data) {
        for (var i = 0; i < data.result.length; i++) {
          $('#users-table tbody').append('\
            <tr>\
              <td><input type="checkbox" value="'+data.result[i].accountID+'" name="selected[]" class="select"></td>\
              <td>'+data.result[i].type+'</td>\
              <td>'+data.result[i].employee_name+'</td>\
              <td>'+data.result[i].username+'</td>\
              <td><a href="#" id="'+data.result[i].accountID+'" class="edit">Edit</a></td>\
            </tr>\
            ');
        }
        $("#users-table tfoot").html(data.paging);
        $("#users-table tfoot").append('<tr><th></th></tr>');
      }
    });
  }

})
</script>
@endsection