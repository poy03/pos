@extends('layouts.main')

@section('title', 'Delivery Receipt')

@section('css')
<style type="text/css">
  .order_details th, .order_details td{
    border-color:black;border-style:solid;border-width:2pt;
  }
  .item:hover{
    cursor:pointer;
  }
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0;
  }
  .dr{
    border-width: 2pt;
    border-color: black;
    border-style: solid;
    padding: 2pt;
  }

  @media print {
    input {
      border: none;
      background: transparent;
    }
    .prints{
      display:none;
    }
    .content{
      border-color:white;
    }
  }

  th, td{
    font-size: 12pt;
    padding-left: 2px;
    padding-right: 2px;
  }

  table {
      border-collapse: collapse;
  }

</style>
@endsection

@section('content')
<div class='col-md-12'>
    <center class='davao' style='font-size:16pt;font-weight:bold;'><u>{{ $app->app_company_name }}</u></center>
    <center style='font-size:12pt;text-align:center'>{{ $app->address }}</center>
    <center style='font-size:12pt;text-align:center;margin-bottom: 5pt;'>TEL. <i class='fa fa-phone' aria-hidden='true'></i> {{ $app->contact_number }}</center>
    <div class='dr'>
    <table style='width:100%'>
      <tr>
        <th colspan='20'>DELIVERY RECEIPT<img src='logo.png' style='height:50px;position:absolute;right:0;padding-right:25px'></th>
      </tr>

      <tr>
        <th>No <span id="orderID">{{ $sales_dr->orderID }}</span></th>
        <th></th>
        <th>TS-0000-00-000</th>
      </tr>
      <tr>
        <th></th>
        <th style='text-align:right;'>Account Specialist:</th>
        <th>{{ $sales_dr->salesman_name }}</th>
      </tr>
      <tr>
        <th>Date:</th>
        <th style='width:30%;border-bottom-width:2px;border-bottom-style:solid'>{{ date("F d, Y",$sales_dr->date_ordered) }}</th>
        <th style='width:50%;'></th>
      </tr>
      <tr>
        <th>Customer Name</th>
        <th style='border-bottom-width:2px;border-bottom-style:solid' colspan='2'>{{ $sales_dr->customer }}</th>
      </tr>
      <tr>
        <th>Delivery Address</th>
        <th style='border-bottom-width:2px;border-bottom-style:solid' colspan='2'>{{ $sales_dr->address }}</th>
      </tr>
      <tr>
        <th colspan='20'>TRANSACTION DETAILS</th>
      </tr>
      <tr>
        <th colspan='20'>Transaction Proposed:</th>
      </tr>
    </table>
    <table style='width:98%;margin-left:auto;margin-right:auto;' class='order_details'>
      <thead>
      <tr>
        <th style='border-width:0px'>Amount</th>
        <th class='update_footer total_text' style='border-right-width:0px;border-top-width:0px;border-left-width:0px;'>{{ number_format($sales_dr->total,2) }}</th>
      </tr>
      <tr>
        <th style='border-width:0px'>Credit Terms</th>
        <th class='update_footer total_text' style='border-right-width:0px;border-top-width:0px;border-left-width:0px;'>{{ ($sales_dr->terms==0?"Cash On Delivery":$sales_dr->terms) }}</th>
      </tr>
      <tr>
        <th style='border-width:0px'>Delivery Date</th>
        <th style='border-right-width:0px;border-top-width:0px;border-left-width:0px;'><input type='text' class='update_dr' id="date_delivered" value="{{ date('m/d/Y',$sales_dr->date_delivered) }}" style='width:100%' readonly></th>
      </tr>
      <tr>
        <th style='border-width:0px'>&nbsp;<br>Order Details</th>
      </tr>
      <tr>
        <th style='text-align:center'>SKU CODE</th>
        <th style='text-align:center'>SKU Description</th>
        <th style='text-align:center'>Unit</th>
        <th style='text-align:center'>Qty</th>
        <th style='text-align:center'>Selling Price</th>
        <th style='text-align:center'>Total Amount</th>
      </tr>
      </thead>
      <tbody>

        @foreach($sales_dr->sales_dr_details as $dr_items)
        <tr>
          <td>{{ $dr_items->item_code }}</td>
          <td>{{ $dr_items->itemname }}</td>
          <td style='text-align:center'>{{ $dr_items->unit_of_measure }}</td>
          <td style='text-align:center'>{{ $dr_items->quantity }}</td>
          <td style='text-align:right'>{{ number_format($dr_items->price,2) }}</td>
          <td style='text-align:right'>{{ number_format($dr_items->price*$dr_items->quantity,2) }}</td>
        </tr>
        @endforeach


        @for($x=1;$x<=9-count($sales_dr->sales_dr_details);$x++)
        
        <tr>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        @endfor
      </tbody>
      <tfoot>
        <tr>
          <th style="text-align:right" colspan="5">TOTAL:</th>
          <th class="update_footer total_text" style="text-align:right"><span id="total">{{ number_format($sales_dr->total,2) }}</span></th>
        </tr>
        <tr>
          <th colspan="20" style="border-width:0px;text-align:center">RECEIVED THE PRODUCTS / ITEMS IN GOOD CONDITION</th>
        </tr>
      </tfoot>
    </table>
    </div>
    <div class="dr" style="position:relative;top:-2pt">
    <table  style="width:98%;margin-left:auto;margin-right:auto;">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <th style="width:20%">Prepared By:</th>
        <th style="width:20%"></th>
        <th style="width:20%">Received By:</th>
      </tr>
      <tr>
        <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" class="update_dr" id="prepared_by" style="width:100%;text-align:center" value="{{ htmlspecialchars_decode($sales_dr->prepared_by) }}"></td>
        <td>&nbsp;</td>
        <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" class="update_dr" id="received_by" style="width:100%;text-align:center" value="{{ htmlspecialchars_decode($sales_dr->received_by) }}"></td>
      </tr>

      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <td style="text-align:center"><small>SIGNATURE OVER PRINTED NAME</small></td>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <th>Released By:</th>
        <th></th>
        <th>Delivered By:</th>
      </tr>
      <tr>
        <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" class="update_dr" id="released_by" style="width:100%;text-align:center" value="{{ htmlspecialchars_decode($sales_dr->released_by) }}"></td>
        <td>&nbsp;</td>
        <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" class="update_dr" id="delivered_by" style="width:100%;text-align:center" value="{{ htmlspecialchars_decode($sales_dr->delivered_by) }}"></td>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <th>Approved By:</th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" class="update_dr" id="approved_by" style="width:100%;text-align:center" value="{{ htmlspecialchars_decode($sales_dr->approved_by) }}"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    </table>
  </div>
  <div class="printhide">
      <div class="btn-group btn-group-lg" role="group">
        <button type="button" class="btn btn-danger" id="dr-delete">
          <span class="glyphicon glyphicon-trash"></span> Delete
        </button>
        <button type="button" class="btn btn-info" id="dr-print">
          <span class="glyphicon glyphicon-print"></span> Print
        </button>
        <button type="button" class="btn btn-success" id="dr-paycash" onclick="$('#cash-payment-modal').modal('show')">
          <span class="glyphicon glyphicon-shopping-cart"></span> Cash Payment
        </button>
        <button type="button" class="btn btn-success" id="dr-paypdc">
          <span class="glyphicon glyphicon-calendar"></span> PDC Payment
        </button>
        <button type="button" class="btn btn-primary" id="dr-itemreturn">
          <span class="glyphicon glyphicon-edit"></span> Return Items
        </button>
      </div>
  </div>
</div>

@endsection

@section('modals')

<!--Cash Payment Modal -->
<div id="cash-payment-modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Cash Payment</h4>
    </div>
      <div class="modal-body">
        <form action="/sales/payment" method="post" class="form" id="cash-payment-form">
          {{ csrf_field() }}
          <input type="hidden" name="type" value="cash">
          <div class='form-group'>
            <label for="total">Total:</label>
            <input type='text' class='form-control' value="{{ number_format($sales_dr->balance,2) }}" readonly>
          </div>

          <div class='form-group'>
            <label for="amount">Amount:</label>
            <input type='text' class='form-control' id="amount" name="amount" placeholder='Amount' autocomplete='off'>
            <p class="help-block" id="amount-help-block"></p>
          </div>

          <div class='form-group'>
            <label for="ar_number">AR Number:</label>
            <input type='text' class='form-control' id="ar_number" name="ar_number" placeholder='AR Number' autocomplete='off'>
            <p class="help-block" id="ar_number-help-block"></p>
          </div>

          <div class='form-group'>
            <label for="date_payment">Date Payment:</label>
            <input type='text' class='form-control' id="date_payment" name="date_payment" placeholder='Date Payment' value="{{ date('m/d/Y') }}" readonly>
            <p class="help-block" id="date_payment-help-block"></p>
          </div>

          <div class='form-group'>
            <label for="change">Change:</label>
            <input type='text' class='form-control' id="change" placeholder='Change' value="{{ number_format(0,2) }}" readonly>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="cash-payment-form">Confirm</button>
      </div>
    </div>

  </div>
</div>



@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(e) {
  var orderID = {{ $sales_dr->orderID }};
  $("#date_delivered,#date_payment").datepicker();
  $(document).on("change keyup",".update_dr",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/dr/"+orderID,
      data: "_token=<?php echo csrf_token(); ?>"+"&type="+e.target.id+"&value="+e.target.value,
      cache: false
    });
  });
});
</script>
@endsection