@extends('layouts.main')

@section('title', 'Sales')

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
        <center class='davao' style='font-size:16pt;font-weight:bold;'><u>DAVAO JARMS MARKETING INCORPORATED</u></center>
        <center style='font-size:12pt;text-align:center'>DOOR 8 TRISTAR CENTER 2,NEW DIVERSION ROAD,BUHANGIN,DAVAO CITY</center>
        <center style='font-size:12pt;text-align:center;margin-bottom: 5pt;'>TEL. <i class='fa fa-phone' aria-hidden='true'></i> 291-6638</center>
        <div class='dr'>
        
        
        <table style='width:100%'>
          <tr>
            <th colspan='20'>DELIVERY RECEIPT<img src='logo.png' style='height:50px;position:absolute;right:0;padding-right:25px'></th>
          </tr>

          <tr>
            <th>No 2630</th>
            <th></th>
            <th>TS-0000-00-000</th>
          </tr>
          <tr>
            <th></th>
            <th style='text-align:right;'>Account Specialist:</th>
            <th>EMPLOYEES ACCOUNT</th>
          </tr>
          <tr>
            <th>Date:</th>
            <th style='width:30%;border-bottom-width:2px;border-bottom-style:solid'>June 05, 2017</th>
            <th style='width:50%;'></th>
          </tr>
          <tr>
            <th>Customer Name</th>
            <th style='border-bottom-width:2px;border-bottom-style:solid' colspan='2'>AKLAN HARDWARE ELECTRICAL AND AUTO SUPPLY</th>
          </tr>
          <tr>
            <th>Delivery Address</th>
            <th style='border-bottom-width:2px;border-bottom-style:solid' colspan='2'>J14 MIRANDA ST. PUBLIC MARKET,POB. POLOMOLOK,SOUTH</th>
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
            <th class='update_footer total_text' style='border-right-width:0px;border-top-width:0px;border-left-width:0px;'><span id='total_amount'></span></th>
          </tr>
          <tr>
            <th style='border-width:0px'>Credit Terms</th>
            <th class='update_footer total_text' style='border-right-width:0px;border-top-width:0px;border-left-width:0px;'>Cash On Delivery</th>
          </tr>
          <tr>
            <th style='border-width:0px'>Delivery Date</th>
            <th style='border-right-width:0px;border-top-width:0px;border-left-width:0px;'><input type='text' class='date_delivered  total_text' id='2630' value='06/05/2017' style='width:100%' readonly></th>
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
            <tr>
              <td>TR-RF-002</td>
              <td>12.00-20 FLAPS AND TUBES</td>
              <td style='text-align:center'>SET/S</td>
              <td style='text-align:center'>1</td>
              <td style='text-align:right'>0.00</td>
              <td style='text-align:right'>0.00</td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
          </tbody>
          <tfoot>
            <tr>
              <th style="text-align:right" colspan="5">TOTAL:</th>
              <th class="update_footer total_text" style="text-align:right"><span id="total">0.00</span></th>
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
            <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" title="prepared_by" style="width:100%;text-align:center"></td>
            <td>&nbsp;</td>
            <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" title="received_by" style="width:100%;text-align:center"></td>
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
            <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" title="released_by" style="width:100%;text-align:center"></td>
            <td>&nbsp;</td>
            <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" title="delivered_by" style="width:100%;text-align:center"></td>
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
            <td style="border-bottom-width:2px;border-bottom-color:black;border-bottom-style:solid;"><input type="text" title="approved_by" style="width:100%;text-align:center"></td>
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
</div>

@endsection

@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(e) {
  $("#item-add-cart").autocomplete({
      source: '/search/items/sales',
      select: function(event, ui){
        $.ajax({
          type: "POST",
          url: "/sales/drcart",
          data: "_token=<?php echo csrf_token(); ?>"+"&id="+ui.item.data+"&type=items",
          cache: false,
          dataType: "json",
          complete: function() {
            show_cart();
            $("#item-add-cart").val("");
          }
        });
      }
  });

  $("#customer-add-cart").autocomplete({
      source: '/search/customers/sales',
      select: function(event, ui){
        $.ajax({
          type: "POST",
          url: "/sales/drcart",
          data: "_token=<?php echo csrf_token(); ?>"+"&id="+ui.item.data+"&type=customer",
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#customer-add-cart").prop("disabled",true);
            $("#customer-cart-btn").html('<button class="btn btn-danger" type="button" id="customer-cart-remove-btn" data-balloon="Remove Customer" data-balloon-pos="up">&times;</button>');
          }
        });
      }
  });

  $("#salesman-add-cart").autocomplete({
      source: '/search/salesman/sales',
      select: function(event, ui){
        $.ajax({
          type: "POST",
          url: "/sales/drcart",
          data: "_token=<?php echo csrf_token(); ?>"+"&id="+ui.item.data+"&type=salesman",
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#salesman-add-cart").prop("disabled",true);
            $("#salesman-cart-btn").html('<button class="btn btn-danger" type="button" id="salesman-cart-remove-btn" data-balloon="Remove Customer" data-balloon-pos="up">&times;</button>');
          }
        });
      }
  });

  $(document).on("click","#customer-cart-remove-btn",function(e) {
    $.ajax({
      type: "DELETE",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&type=customers",
      cache: false,
      success: function(data) {
        $("#customer-add-cart").prop("disabled",false);
        $("#customer-add-cart").val("");
        $("#customer-cart-btn").html('<button class="btn btn-success btn-add-customers" type="button">Add</button>');
      }
    });
  });

  $(document).on("click","#salesman-cart-remove-btn",function(e) {
    $.ajax({
      type: "DELETE",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&type=salesman",
      cache: false,
      success: function(data) {
        $("#salesman-add-cart").prop("disabled",false);
        $("#salesman-add-cart").val("");
        $("#salesman-cart-btn").html('<button class="btn btn-success btn-add-customers" type="button">Add</button>');
      }
    });
  });

  $(document).on("change keyup",".price",function(e) {
    var id = e.target.id;
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&id="+id+"&price="+e.target.value,
      cache: false,
      beforeSend: function() {

      },
      success: function(data) {
        $.ajax({
          url: "/sales/drcart",
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#"+id+".line_total").html(data.items[id].line_total);
            $("#total").html(data.total);
          }
        });
      },
      complete: function() {

      }
    });
  });

  $(document).on("change keyup",".quantity",function(e) {
    var id = e.target.id;
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&id="+id+"&quantity="+e.target.value,
      cache: false,
      beforeSend: function() {

      },
      success: function(data) {
        $.ajax({
          url: "/sales/drcart",
          cache: false,
          dataType: "json",
          success: function(data) {
            $("#"+id+".line_total").html(data.items[id].line_total);
            $("#total").html(data.total);
          }
        });
      },
      complete: function() {
       
      }
    });
  });


  $(document).on("change keyup",".costprice",function(e) {
    var id = e.target.id;
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&id="+id+"&costprice="+e.target.value,
      cache: false,
      dataType: "json",
      beforeSend: function() {

      },
      success: function(data) {

      },
      complete: function() {

      }
    });
  });

  $(document).on("change","#type_price",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&type_price="+e.target.value,
      cache: false,
      beforeSend: function() {

      },
      success: function(data) {
        show_cart();
      },
      complete: function() {
       
      }
    });
  });

  $(document).on("keyup change","#term",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&term="+e.target.value,
      cache: false
    });
  });

  $(document).on("keyup change","#dr_number",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&dr_number="+e.target.value,
      cache: false
    });
  });

  $(document).on("keyup change","#comments",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&comments="+e.target.value,
      cache: false
    });
  });

  $(document).on("click","#reset_price",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&type=reset_price",
      cache: false,
      success: function() {
        show_cart();
      }
    });
  }); 

  $(document).on("click","#reset_costprice",function(e) {
    $.ajax({
      type: "PUT",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&type=reset_costprice",
      cache: false,
      success: function() {
        show_cart();
      }
    });
  }); 

  $(document).on("click","#clear_cart",function(e) {
    alertify.confirm(
      'Clear All Items',
      'Are you sure you want to clear all data in the sales cart? This action is irreversible.',
      function(){
        $.ajax({
          type: "DELETE",
          url: "/sales/drcart",
          data: "_token=<?php echo csrf_token(); ?>"+"&type=cart",
          cache: false
        });
        var msg = alertify.success('All data in the sales cart are cleared. Reloading the page.');
        msg.callback = function (isClicked) {
          if(isClicked){
            location.reload();
          }
          else{  
            location.reload();
          }
        };
      },
      function(){
        alertify.error('Cancel');
      }
    );
  }); 

  $(document).on("click","#clear_items",function(e) {

    alertify.confirm(
      'Clear All Items',
      'Are you sure you want to clear all items in the sales cart? This action is irreversible.',
      function(){
        $.ajax({
          type: "DELETE",
          url: "/sales/drcart",
          data: "_token=<?php echo csrf_token(); ?>"+"&type=items",
          cache: false,
          success: function() {
            show_cart();
          }
        });
        alertify.success('Items in the sales cart are cleared');
      },
      function(){
        alertify.error('Cancel');
      }
    );

  });


  $(document).on("click",".delete_cart_item",function(e) {
    var id = e.target.id;
    $.ajax({
      type: "DELETE",
      url: "/sales/drcart",
      data: "_token=<?php echo csrf_token(); ?>"+"&id="+id+"&type=items",
      cache: false,
      success: function(data) {
        show_cart();
      }
    });
  });

  $(document).on("submit","#sales_dr-fosrm",function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#sales_dr-form").attr("action"),
      data: $("#sales_dr-form").serialize(),
      cache: false,
      beforeSend: function(){
        $('button[form="sales_dr-form"]').prop("disabled",true);
      },
      success: function(data){
        console.log(data)
      },
      error: function(e) {
        
      },
      complete: function() {
        $('button[form="sales_dr-form"]').prop("disabled",false);
      }
    });
  })

  show_cart();
  function show_cart() {
    var selector = "#dr-table";
    $.ajax({
      url: "/sales/drcart",
      cache: false,
      dataType: "json",
      beforeSend: function() {
        $(selector+" tbody").html("");
        $(selector+" tfoot").html("");
      },
      success: function(data) {
        if(typeof data.items != "undefined" && data.items.length != 0){
          for (var i in data.items) {
            if (data.items.hasOwnProperty(i)) {
              $(selector+" tbody").append('<tr>\
                <td><a class="delete_cart_item" id="'+i+'" href="#">&times</a></td>\
                <td>'+data.items[i].itemname+'</td>\
                <td>'+data.items[i].item_code+'</td>\
                <td>'+data.items[i].remaining_quantity+'</td>\
                <td><input type="number" class="costprice" id="'+i+'" value="'+data.items[i].costprice+'"></td>\
                <td><input type="number" class="quantity" id="'+i+'" value="'+data.items[i].quantity+'" max="'+data.items[i].remaining_quantity+'"></td>\
                <td><input type="number" class="price" id="'+i+'" value="'+data.items[i].price+'"></td>\
                <td style="text-align:right"><span class="line_total" id="'+i+'">'+data.items[i].line_price_total+'</span></td>\
                </tr>');
            }
          }
          $(selector+" tfoot").html('<tr>\
            <th colspan="7" style="text-align:right">Total:</th>\
            <th style="text-align:right"><span id="total">'+data.total_sales+'</span></th>\
            </tr>'); 
        }
      }
    });
  }
});
</script>
@endsection