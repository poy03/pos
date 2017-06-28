@extends('layouts.main')

@section('title', 'Accounts Receivables')

@section('content')
@include('layouts.ar_side')
<div class="col-sm-10" ng-controller="ar_controller">
  <div class="table-responsive">
  <table class='table table-hover' id='customers-table'>
    <thead>
      <tr>
        <th>DR #</th>
        <th>Terms Delivery</th>
        <th>Date</th>
        <th>Customer</th>
        <th>Account Specialist</th>
        <th>Date Due</th>
        <th>Amount</th>
        <th>TS #</th>
        <th>PDC Date</th>
        <th>PDC Check Number</th>
        <th>PDC Amount</th>
        <th>balance</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="ar in result">
        <td>@{{ar.orderID}}</td>
        <td>@{{ar.terms}}</td>
        <td>@{{ar.date_ordered}}</td>
        <td>@{{ar.customer}}</td>
        <td>@{{ar.salesman_name}}</td>
        <td>@{{ar.date_due}}</td>
        <td>@{{ar.total|currency:""}}</td>
        <td>@{{ar.ts_orderID}}</td>
        <td>@{{ar.pdc_date}}</td>
        <td>@{{ar.pdc_check_number}}</td>
        <td>@{{ar.pdc_bank}}</td>
        <td>@{{ar.balance|currency:""}}</td>
      </tr>
    </tbody>
    <tfoot ng-bind-html="paging">
    </tfoot>
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  var app = angular.module('main', ['ngSanitize']);
  app.controller('ar_controller', function($scope,$http, $sce) {
    show_list();
    function show_list(page=1) {
      $http({
          method : "GET",
          params: {
            page: page,
            maxitem: 1
          },
          url : "/receivables/{{$tab}}/list",
      }).then(function mySuccess(response) {
          $scope.result = response.data.result;
          $scope.paging = $sce.trustAsHtml(response.data.paging);
          console.log(response.data.paging);
      }, function myError(response) {
          console.log(response.statusText);
      });
    }

    $scope.test = function() {
      alert("asdasda");
    }
  });

  angular.bootstrap(document, ['main']);
</script>
@endsection