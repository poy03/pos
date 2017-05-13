@extends('layouts.main')

@section('title', 'Accounts Receivables')

@section('content')
@include('layouts.ar_side')
<div class="col-sm-10">
  <div class="table-responsive">
  <table class='table table-hover' id='customers-table'>
    <thead>
      <tr>
        <th><input type="checkbox" id="select-all" class='select' value='all'> All</th>
        <th>Company Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Contact Person</th>
        <th>TIN ID</th>
        <th>Credit Limit</th>
        <th>Credit Term</th>
      </tr>
    </thead>
    <tbody>

    </tbody>

    </table>
  </div>
</div>
@endsection