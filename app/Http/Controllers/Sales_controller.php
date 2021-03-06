<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;
use App\Sales_dr;
use App\Sales_dr_details;
use App\Payments;
use App\Customers;
use App\Salesman;
use App\Items;
use App\Users;
use App\Items_history;
use App\App_config;

class Sales_controller extends Controller
{
    public function index(Request $request)
    {
      $users = new Users;
      $data["user_data"] = $users->where("accountID",$request->session()->get('user'))->first();
      $data["has_customer"] = FALSE;
      $data["has_salesman"] = FALSE;
      $sales_dr = new Sales_dr;
      if($sales_dr->count()==0){
        $data["has_dr"] = FALSE;
        $data["dr_data"]["orderID"] = ($request->session()->has("sales_dr.dr_number")?$request->session()->get("sales_dr.dr_number"):"");
      }else{
        $data["has_dr"] = TRUE;
        $data["dr_data"] = $sales_dr->where("deleted",0)->orderBy("orderID","DESC")->first();
      }
      $data["type_price"] = ($request->session()->has('sales_dr.type_price')?$request->session()->get('sales_dr.type_price'):'srp');
      $data["term"] = ($request->session()->has('sales_dr.term')?$request->session()->get('sales_dr.term'):'');
      $data["comments"] = ($request->session()->has('sales_dr.comments')?$request->session()->get('sales_dr.comments'):'');
      if($request->session()->has('sales_dr.customer_data')&&$request->session()->get('sales_dr.customer_data')!=array()){
        $data["has_customer"] = TRUE;
        $data["customer_data"] = $request->session()->get('sales_dr.customer_data');
      }
      if($request->session()->has('sales_dr.salesman_data')&&$request->session()->get('sales_dr.salesman_data')!=array()){
        $data["has_salesman"] = TRUE;
        $data["salesman_data"] = $request->session()->get('sales_dr.salesman_data');
      }
      return view('salesdr',$data);
    }

    public function drcart_store(Request $request)
    {
      if($request->type&&$request->type=="items"){
        $items = new Items;
        if ($request->session()->has('sales_dr.items.'.$request->id)&&$request->session()->get('sales_dr.items.'.$request->id)!=array()) {
          $data = $request->session()->get('sales_dr');
          $data["items"][$request->id] = [
            'quantity'=> $data["items"][$request->id]['quantity']+1,
            'price' => $data["items"][$request->id]["price"],
            'costprice' => $data["items"][$request->id]["costprice"],
          ];
          $request->session()->put('sales_dr', $data);
        }else{
          if ($request->session()->has('sales_dr.items')&&$request->session()->get('sales_dr.items')!=array()) {
            $data = $request->session()->get('sales_dr');
            $data["items"][$request->id] = [
              'quantity'=> 1,
              'price' => 0,
              'costprice' => 0,
            ];
          }else{
            $data["items"][$request->id] = [
              'quantity'=> 1,
              'price' => 0,
              'costprice' => 0,
            ];
          }
          $data["type_price"] = ($request->session()->has('sales_dr.type_price')?$request->session()->get('sales_dr.type_price'):'srp');
          $data["term"] = ($request->session()->has('sales_dr.term')?$request->session()->get('sales_dr.term'):'');
          $data["dr_number"] = ($request->session()->has('sales_dr.dr_number')?$request->session()->get('sales_dr.dr_number'):'');
          $request->session()->put('sales_dr', $data);
        }
      }elseif ($request->type&&$request->type=="customer") {
        $customers = new Customers; 
        $customer_data = $customers->where("customerID",$request->id)->first();
        if($request->session()->has('sales_dr')&&$request->session()->get('sales_dr')!=array()){
          $data = $request->session()->get('sales_dr');
        }
        $data["customer_data"] = [
          "customerID" => $request->id,
          "customer_name" => $customer_data->companyname,
        ];
        $data["term"] = $customer_data->term; 
        $request->session()->put('sales_dr', $data);
      }elseif ($request->type&&$request->type=="salesman") {
        $salesman = new Salesman; 
        $salesman_data = $salesman->where("salesmanID",$request->id)->first();
        if($request->session()->has('sales_dr')&&$request->session()->get('sales_dr')!=array()){
          $data = $request->session()->get('sales_dr');
        }
        $data["salesman_data"] = [
          "salesmanID" => $request->id,
          "salesman_name" => $salesman_data->salesman_name,
        ];
        $request->session()->put('sales_dr', $data);
      }
      return $data;
    }

    public function drcart_update(Request $request)
    {
      $items = new Items;
      $data = $request->session()->get('sales_dr');
      if($request->price){
        $data["items"][$request->id]["price"] = abs($request->price);
        $request->session()->put('sales_dr', $data);
      }elseif ($request->quantity) {
        $data["items"][$request->id]["quantity"] = abs($request->quantity);
        $request->session()->put('sales_dr', $data);
      }elseif ($request->costprice) {
        $data["items"][$request->id]["costprice"] = abs($request->costprice);
        $request->session()->put('sales_dr', $data);
      }elseif ($request->type_price) {
        $data["type_price"] = $request->type_price;
        $request->session()->put('sales_dr', $data);
      }elseif ($request->term) {
        $data["term"] = $request->term;
        $request->session()->put('sales_dr', $data);
      }elseif ($request->dr_number) {
        $data["dr_number"] = $request->dr_number;
        $request->session()->put('sales_dr', $data);
      }elseif ($request->comments) {
        $data["comments"] = $request->comments;
        $request->session()->put('sales_dr', $data);
      }elseif ($request->type=="reset_price") {
        if($request->session()->get('sales_dr.items')!=array()){
          foreach ($request->session()->get('sales_dr.items') as $key => $value) {
            $data["items"][$key]["price"] = 0;
          }
          $request->session()->put('sales_dr', $data);
        }
      }elseif ($request->type=="reset_costprice") {
        if($request->session()->get('sales_dr.items')!=array()){
          foreach ($request->session()->get('sales_dr.items') as $key => $value) {
            $data["items"][$key]["costprice"] = 0;
          }
          $request->session()->put('sales_dr', $data);
        }
      }
        
    }    

    public function drcart(Request $request)
    {
      $items = new Items;
      $cart_data = $request->session()->get('sales_dr');
        if ($request->session()->has('sales_dr.items')&&$request->session()->get('sales_dr.items')!=array()) {
          $cart_data["total_sales"] = 0;
          $cart_data["total_costprice"] = 0;
          foreach ($cart_data["items"] as $key => $cart_data_item) {
            $item_data = $items->where("itemID",$key)->first();
            if($item_data->deleted==1){
              continue;
            }
            $cart_data["items"][$key]["id"] = $key;
            $cart_data["items"][$key]["itemname"] = $item_data->itemname;
            $cart_data["items"][$key]["item_code"] = $item_data->item_code;
            $cart_data["items"][$key]["remaining_quantity"] = $item_data->quantity;
            if($cart_data["items"][$key]["price"]==0){
                $cart_data["items"][$key]["price"] = $item_data->$cart_data["type_price"];
            }
            if($cart_data["items"][$key]["costprice"]==0){
                $cart_data["items"][$key]["costprice"] = $item_data->costprice;
            }
            $cart_data["items"][$key]["line_price_total"] = $cart_data["items"][$key]["price"]*$cart_data["items"][$key]["quantity"];
            $cart_data["items"][$key]["line_price_total_int"] = $cart_data["items"][$key]["line_price_total"];
            $cart_data["items"][$key]["line_price_total"] = $cart_data["items"][$key]["line_price_total"];
            $cart_data["total_sales"] += $cart_data["items"][$key]["line_price_total_int"];
            
            $cart_data["items"][$key]["line_costprice_total"] = $cart_data["items"][$key]["costprice"]*$cart_data["items"][$key]["quantity"];
            $cart_data["items"][$key]["line_costprice_total_int"] = $cart_data["items"][$key]["line_costprice_total"];
            $cart_data["items"][$key]["line_costprice_total"] = $cart_data["items"][$key]["line_costprice_total"];
            $cart_data["total_costprice"] += $cart_data["items"][$key]["line_costprice_total_int"];

          }
          $cart_data["total_sales_int"] = $cart_data["total_sales"];
          $cart_data["total_sales"] = $cart_data["total_sales"];

          $cart_data["total_costprice_int"] = $cart_data["total_costprice"];
          $cart_data["total_costprice"] = $cart_data["total_costprice"];
        }
      return $cart_data;
    }

    public function drcart_t(Request $request)
    {
      dd($request->session()->has('sales_dr'));
    }

    public function drcart_destroy(Request $request)
    {
      if($request->type&&$request->type=="items"){
        if($request->id){
          $request->session()->forget('sales_dr.items.'.$request->id);
        }else{
          $request->session()->forget('sales_dr.items');
        }
      }elseif ($request->type&&$request->type=="customers") {
        $request->session()->forget('sales_dr.customer_data');
      }elseif ($request->type&&$request->type=="salesman") {
        $request->session()->forget('sales_dr.salesman_data');
      }elseif ($request->type&&$request->type=="cart") {
        $request->session()->forget('sales_dr');
      }
    }

    public function dr_create(Request $request)
    {
      $items = new Items;
      $cart_data_session = $request->session()->get("sales_dr.items");
      if($cart_data_session != array()){
        foreach ($cart_data_session as $itemID => $item_cart) {
          $valid_items = TRUE;
          $item_data = $items->where("itemID",$itemID)->where("deleted",0)->first();
          if($item_data==NULL){
            $valid_items = FALSE;
            $data["error"] = "An item in the cart has been deleted. Please check the items in the sales cart or try Refreshing the page.";
            break;
          }
          if($item_data->quantity < $item_cart["quantity"]){
              $valid_items = FALSE;
              $data["error"] = "Invalid quantity. Please check the remaining quantity of the items.";
              break;
          }
          if(!$valid_items){
            break;
          }
        }
        if(!$valid_items){
          return response($data, 422);
        }
      }else{
        $data["error"] = "No items in the sales cart.";
        return response($data, 422);
      }

      $cart_data = $this->drcart($request);
      $sales_dr = new Sales_dr;
      if($sales_dr->count()==0){
        $sales_dr->orderID = $cart_data["dr_number"];
      }
      $sales_dr->date_ordered = strtotime(date("m/d/Y"));
      $sales_dr->date_delivered = strtotime(date("m/d/Y"));
      $sales_dr->time_ordered = strtotime(date("m/d/Y h:i:s A"));
      $sales_dr->total = $cart_data["total_sales_int"];
      $sales_dr->customer = (isset($cart_data["customer_data"])?$cart_data["customer_data"]["customer_name"]:($request->customer?$request->customer:""));
      $sales_dr->balance = $cart_data["total_sales_int"];
      $sales_dr->costprice = $cart_data["total_costprice_int"];
      $sales_dr->type_payment = "credit";
      $sales_dr->terms = $cart_data["term"];
      $sales_dr->comments = (isset($cart_data["comments"])?$cart_data["comments"]:"");
      $sales_dr->date_due = strtotime(date("m/d/Y")." + ".($cart_data["term"]==""?0:$cart_data["term"])." days");
      $sales_dr->overdue_date_1 = strtotime(date("m/d/Y", $sales_dr->date_due) . " +30 days");
      $sales_dr->overdue_date_2 = strtotime(date("m/d/Y", $sales_dr->date_due) . " +60 days");
      $sales_dr->customerID = (isset($cart_data["customer_data"])?$cart_data["customer_data"]["customerID"]:0);
      $sales_dr->salesmanID = (isset($cart_data["salesman_data"])?$cart_data["salesman_data"]["salesmanID"]:0);
      $sales_dr->accountID = $request->session()->get('user');
      $sales_dr->save();

      $dr_data = $sales_dr->orderBy("orderID","DESC")->first();

      foreach ($cart_data_session as $itemID => $item_cart) {
        $dr_details = new Sales_dr_details;
        $dr_details->itemID = $itemID;
        $dr_details->quantity = $cart_data["items"][$itemID]["quantity"];
        $dr_details->price = $cart_data["items"][$itemID]["price"];
        $dr_details->costprice = $cart_data["items"][$itemID]["costprice"];
        $dr_details->subtotal = $cart_data["items"][$itemID]["quantity"]*$cart_data["items"][$itemID]["price"];
        $dr_details->profit = ($cart_data["items"][$itemID]["line_price_total_int"]>$cart_data["items"][$itemID]["line_costprice_total_int"]?$cart_data["items"][$itemID]["line_price_total_int"]-$cart_data["items"][$itemID]["line_costprice_total_int"]:0);
        $dr_details->loss = ($cart_data["items"][$itemID]["line_costprice_total_int"]>$cart_data["items"][$itemID]["line_price_total_int"]?$cart_data["items"][$itemID]["line_costprice_total_int"]-$cart_data["items"][$itemID]["line_price_total_int"]:0);
        $dr_details->orderID = $dr_data->orderID;
        $dr_details->customerID = $dr_data->customerID;
        $dr_details->salesmanID = $dr_data->salesmanID;
        $dr_details->accountID = $request->session()->get('user');
        $dr_details->date_ordered = $dr_data->date_ordered;
        $dr_details->save();


        $items = new Items;
        $item_data = $items->where("itemID",$itemID)->first();
        $items->where("itemID",$itemID)->update(['quantity' => $item_data->quantity - $cart_data["items"][$itemID]["quantity"]]);

        $history = new Items_history;
        $history->itemID = $itemID;
        $history->quantity = 0-$cart_data["items"][$itemID]["quantity"];
        $history->type = "Out";
        $history->remarks = "Sales";
        $history->ref_id = $dr_data->orderID;
        $history->accountID = $request->session()->get('user');
        $history->date_time = strtotime(date("m/d/Y"));
        $history->save();
      }
      $data["dr"] = $dr_data->orderID;
      return $data;

    }

    public function dr(Request $request,$orderID)
    {
      // abort(404);
      $customers = new Customers;
      $items = new Items;
      $salesman = new Salesman;


      $app = new App_config;
      $data['app'] =  $app::find(1);

      $users = new Users;
      $data["user_data"] = $users->where("accountID",$request->session()->get('user'))->first();

      $sales_dr = new Sales_dr;
      $sales_dr = $sales_dr->where("orderID",$orderID)->first();
      
      $sales_dr_details = new Sales_dr_details;
      $sales_dr->sales_dr_details = $sales_dr_details->where("orderID",$orderID)->get();

      if($sales_dr->customer != "" && $sales_dr->customerID != 0){
        $sales_dr->customer = $customers->where("customerID",$sales_dr->customerID)->first()->value("companyname");
        $sales_dr->address = $customers->where("customerID",$sales_dr->customerID)->first()->value("address");
      }else{
        $sales_dr->address = "";
      }

      if($sales_dr->salesmanID != 0){
        $sales_dr->salesman_name = $salesman->where("salesmanID",$sales_dr->salesmanID)->first()->value("salesman_name");
      }else{
        $sales_dr->salesman_name = "";
      }


      foreach ($sales_dr->sales_dr_details as $dr_item) {
        $dr_item->itemname = $items->where("itemID",$dr_item->itemID)->first()->value("itemname");
        $dr_item->item_code = $items->where("itemID",$dr_item->itemID)->first()->value("item_code");
        $dr_item->unit_of_measure = $items->where("itemID",$dr_item->itemID)->first()->value("unit_of_measure");
      }
      $data["sales_dr"] = $sales_dr;
      // return $sales_dr;
      $payments = new Payments;
      $cash_payments = $payments->where("orderID",$orderID);
      $cash_payments->where("deleted",0);
      $cash_payments->where("type_payment","cash");
      if($cash_payments->count()!=0){
        $data["has_cash_payments"] = TRUE;
        $data["cash_payments"] = $cash_payments->get();
      }else{
        $data["has_cash_payments"] = FALSE;
      }

      $pdc_payments = $payments->where("orderID",$orderID);
      $pdc_payments->where("deleted",0);
      $pdc_payments->where("type_payment","pdc");
      if($pdc_payments->count()!=0){
      $data["has_pdc_payments"] = TRUE;
        $data["pdc_payments"] = $pdc_payments->get();
      }else{
        $data["has_pdc_payments"] = FALSE;
      }
      return view('salesdr_complete',$data); 
    }

    public function dr_updateinfo(Request $request,$orderID)
    {
      $sales_dr = new Sales_dr;
      $sales_dr->where("orderID",$orderID)->update([
        $request->type => ( $request->type=="date_delivered" ? strtotime($request->value):trim(htmlspecialchars($request->value)) )
        ]);
    }

    public function dr_payment(Request $request,$type)
    {
      DB::enableQueryLog();
      $payments = new Payments;
      if($type=="cash"){
        $this->validate($request, [
          'ar_number' => 'required|max:100',
          'amount' => 'required|numeric',
          'date_payment' => 'required|date',
        ]);


        $sales_dr = new Sales_dr;
        $dr_data = $sales_dr->where("orderID",$request->id)->first();
        $payments = new Payments;
        $payments->balance = $dr_data->balance;
        $payments->type_payment = "cash";
        $payments->amount = $request->amount;
        $excess = (($dr_data->balance - $request->amount)>=0?0:$request->amount - $dr_data->balance);
        $payments->excess = $excess;
        $payments->ar_number = $request->ar_number;
        $payments->date_payment = strtotime($request->date_payment);
        $payments->orderID = $request->id;
        $payments->accountID = $request->session()->get('user');
        $payments->save();

        $balance = ($dr_data->balance - $request->amount < 0 ? 0 : $dr_data->balance - $request->amount);
        $sales_dr->where("orderID",$request->id)->update([
            'balance' => $balance,
            'fully_paid' => ($balance==0?1:0),
          ]);
      }elseif($type=="pdc"){
        $this->validate($request, [
          'ar_number' => 'required|max:100',
          'pdc_bank' => 'required|max:100',
          'pdc_check_number' => 'required|max:100',
          'amount' => 'required|numeric',
          'pdc_date' => 'required|date',
        ]);

        $sales_dr = new Sales_dr;
        $dr_data = $sales_dr->where("orderID",$request->id)->first();
        $payments = new Payments;
        $payments->balance = $dr_data->balance;
        $payments->type_payment = "pdc";
        $payments->amount = $request->amount;
        $excess = (($dr_data->balance - $request->amount)>=0?0:$request->amount - $dr_data->balance);
        $payments->excess = $excess;
        $payments->ar_number = $request->ar_number;
        $payments->pdc_check_number = $request->pdc_check_number;
        $payments->pdc_bank = $request->pdc_bank;
        $payments->pdc_date = strtotime($request->pdc_date);
        $payments->date_payment = strtotime($request->date_payment);
        $payments->orderID = $request->id;
        $payments->accountID = $request->session()->get('user');
        $payments->save();
      }elseif($type=="check_deposit"){

        $payments = new Payments;
        $payments_data = $payments->where("paymentID",$request->id)->first();
        $payments->where("paymentID",$request->id)->update([
            'status' => 'Deposited on '.date("m/d/Y"),
          ]);
        $sales_dr = new Sales_dr;
        $dr_data = $sales_dr->where("orderID",$payments_data->orderID)->first();

        $balance = ($dr_data->balance - $payments_data->amount < 0 ? 0 : $dr_data->balance - $payments_data->amount);
        $sales_dr->where("orderID",$payments_data->orderID)->update([
            'balance' => $balance,
            'fully_paid' => ($balance==0?1:0),
          ]);
      }

    }
}
