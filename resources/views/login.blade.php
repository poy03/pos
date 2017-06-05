@extends('layouts.main')

@section('title', 'Items')
@section('css')
<style type="text/css">
  #login-container{
    margin-top: 20vh;
    border: 1px solid grey;
    padding: 1rem 1rem 1rem 1rem;
  }
</style>
@endsection

@section('content')
<div class="col-sm-8 col-md-4 col-lg-4 col-sm-push-2 col-md-push-4 col-lg-push-4">
<div id="login-container" style="background-color: white;">
  <form action="/login" class="form-horizontal" id="login" method="post">
    <input type="hidden" name="redirect" value="{{ session('redirect') }}">
    {{ csrf_field() }}
    <div class="form-group">
      <label class="col-sm-2 col-xs-4 col-md-3" for="email">username:</label>
      <div class="col-sm-10 col-xs-8 col-md-9">
      <div class="ui left icon input fluid">
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="{{ old('username') }}">
        <i class="user icon"></i>
      </div>
      <p class="help-block" id="username-help-block">{{ $errors->first('username') }}</p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 col-xs-4 col-md-3" for="pwd">Password:</label>
      <div class="col-sm-10 col-xs-8 col-md-9"> 
        <div class="ui left icon input fluid">
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
          <i class="lock icon"></i>
        </div>
        <p class="help-block" id="password-help-block">{{ $errors->first('password') }}</p>
      </div>
    </div>
    <div class="form-group"> 
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </div>
    </div>
  </form>
</div>

</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(e) {
    $("#loginss").submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: $("#login").attr("action"),
        data: $("#login").serialize(),
        cache: false,
        beforeSend: function() {
          // body...
        },
        success: function(data) {
          
        },
        error: function(data) {
          if(data.status = 422){
            var errors = data.responseJSON;
            $("#username-help-block").html(errors.username);
            $("#password-help-block").html(errors.password);
          }
        },
        complete: function() {
          
        }
      });
    });
  });
</script>
@endsection