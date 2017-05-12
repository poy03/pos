@extends('layouts.main')

@section('title', 'Suppliers')

@section('content')
@include('layouts.suppliers_side')
<div class="col-sm-10">
  <div class="table-responsive">
  <table class='table table-hover' id='customers-table'>
    <thead>
      <tr>
       <th><input type="checkbox" id="select-all" value='all'> All</th>
       <th>Contact Person</th>
       <th>Company Name</th>
       <th>Contact Number</th>
       <th>Address</th>
      </tr>
    </thead>
    <tbody>

    </tbody>

    </table>
  </div>
</div>
@endsection