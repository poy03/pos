@extends('layouts.main')

@section('title', 'Sales')


@section('content')
<div class='col-sm-12'>
  <div class='col-sm-10'>
    <div class="row">
      <div class='col-sm-6'>
        <label>Add Item:</label>
        <div class = "form-group">
           <input type = "text" class = "form-control" name='itemname' id='item-add-cart' autocomplete='off' placeholder='Type for Item Name Or Item Code'>
        </div>
      </div>    
      <div class='col-sm-6'>
        <label>Add Item:</label>
        <div class = "form-group">
           <input type = "text" class = "form-control" name='itemname' id='itemsearch_cat' autocomplete='off' placeholder='Type for Category'>
        </div>    
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class='table table-hover' id="dr-table">
            <thead>
              <tr>
                <th></th>
                <th>Item Name</th>
                <th>Item Code</th>
                <th>Remaining</th>
                <th>Cost Price</th>
                <th>Quantity</th>
                <th>Price</th>
                <th style='text-align:right'>Line Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>


  <div class='col-sm-2'>
    <form action="/sales" method="post" id="sales_dr-form">
    {{ csrf_field() }}

      <div class="form-group">
        <label>Delivery Receipt</label>
        @if($has_dr)
        <input type='number' class='form-control' name='dr_number' value="{{++$dr_data->orderID}}" disabled>
        @else
        <input type='number' class='form-control' name='dr_number' value="{{$dr_data["orderID"]}}" id="dr_number">
        @endif
      </div>

      <label>Customer:</label>
      <div class="input-group">
        @if($has_customer)
        <input tabindex="-1" type="text" class="form-control" name="customer" placeholder="Type for Customer Name" autocomplete="off" value="{{$customer_data['customer_name']}}" disabled>
        <span class="input-group-btn" id="customer-cart-btn">
          <button class="btn btn-danger" type="button" id="customer-cart-remove-btn" data-balloon="Remove Customer" data-balloon-pos="up">&times;</button>
        </span>
        @else
        <input tabindex="-1" type="text" class="form-control" id="customer-add-cart" name="customer" placeholder="Type for Customer Name" value="" autocomplete="off">
        <span class="input-group-btn" id="customer-cart-btn">
          <button class="btn btn-success btn-add-customers" type="button">Add</button>
        </span>
        @endif
      </div>

      <label>Salesman:</label>
      <div class="input-group">
        @if($has_salesman)
        <input type='text' id='salesman-add-cart' class='form-control' placeholder='Type for Salesman Name' value="{{$salesman_data['salesman_name']}}" disabled>
        <span class="input-group-btn" id="salesman-cart-btn">
          <button class="btn btn-danger" type="button" id="salesman-cart-remove-btn" data-balloon="Remove Customer" data-balloon-pos="up">&times;</button>
        </span>
        @else
        <input type='text' id='salesman-add-cart' class='form-control' placeholder='Type for Salesman Name'>
        <span class="input-group-btn" id="salesman-cart-btn">
          <button class="btn btn-success btn-add-salesman" type="button">Add</button>
        </span>
        @endif
      </div>

      <div class="form-group">
        <label>Type of Price:</label>
        <select id='type_price' name="type_price" class='form-control'>
          <option value='srp' {{ ($type_price=="srp"?'selected="selected"':false) }}>Suggested Retail Price</option>
          <option value='price_to_distributors' {{ ($type_price=="price_to_distributors"?'selected="selected"':false) }}>Price to Distributors</option>
        </select>
      </div>

      
      <div class="form-group">
        <label>Terms:</label>
        <input type='number' min='0' name='term' value="{{$term}}" class='form-control' id='term' placeholder='Number of Days' value='0'>
      </div>
      <div class="form-group">
        <label>Comments:</label>
        <textarea name='comments' class='form-control' id="comments">{{$comments}}</textarea>
      </div>
      <div class="form-group">
        <label>Sales Register:</label>
        <button type="submit" class='btn btn-primary btn-block' form="sales_dr-form">
          <span class='glyphicon glyphicon-floppy-disk'></span> Save & Continue
        </button>
        <button type="button" class='btn btn-danger btn-block' id='clear_items'>
          <span class='glyphicon glyphicon-trash'></span> Clear All Items
        </button>
        <button type="button" class='btn btn-danger btn-block' id='clear_cart'>
          <span class='glyphicon glyphicon-trash'></span> Clear Sales Cart
        </button>
      </div>

      <div class="form-group">
        <label>TS Number:</label>
        <input type='text' class='form-control' id='search_ts' placeholder='TS Number' autocomplete='off' name='ts_orderID'>
      </div>
      <div class="form-group">
        <label>Utilities:</label>
        <button class='btn btn-info btn-block' id='reset_price'>
          <span class='glyphicon glyphicon-refresh'></span> Reset All Prices
        </button>
        <button class='btn btn-info btn-block' id='reset_costprice'>
          <span class='glyphicon glyphicon-refresh'></span> Reset All Cost Price
        </button>
      </div>
    </form>
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