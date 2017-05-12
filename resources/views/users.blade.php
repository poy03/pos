@extends('layouts.main')

@section('title', 'Users')

@section('content')
@include('layouts.users_side')
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

    </table>
  </div>
</div>
@endsection