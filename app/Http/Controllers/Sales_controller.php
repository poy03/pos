<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;
use App\Items;
use App\Customers;

class Sales_controller extends Controller
{
    public function index(Request $request)
    {
      $data["has_customer"] = FALSE;
      if($request->session()->has('sales_dr.customer_data')&&$request->session()->get('sales_dr.customer_data')!=array()){
        $data["has_customer"] = TRUE;
        $data["customer_data"] = $request->session()->get('sales_dr.customer_data');
      }
      return view('sales',$data);
    }

    public function drcart_store(Request $request)
    {
      if($request->type&&$request->type=="items"){
        $items = new Items;
        if ($request->session()->has('sales_dr.items.'.$request->id)&&$request->session()->get('sales_dr.items.'.$request->id)!=array()) {
          $data = $request->session()->get('sales_dr');
          $data["items"][$request->id] = [
            'quantity'=> $data["items"][$request->id]['quantity']+1,
            'price' => 0,
            'costprice' => 0,
          ];
          $data["type_price"] = 'srp';
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
          $data["type_price"] = 'srp';
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
      }
        
    }    

    public function drcart(Request $request)
    {
      // dd($request->session()->get('sales_dr'));
      // exit;
      $items = new Items;
      $cart_data = $request->session()->get('sales_dr');
        if ($request->session()->has('sales_dr.items')&&$request->session()->get('sales_dr.items')!=array()) {
          $cart_data["total"] = 0;
          foreach ($cart_data["items"] as $key => $cart_data_item) {
            $item_data = $items->where("itemID",$key)->first();
            $cart_data["items"][$key]["itemname"] = $item_data->itemname;
            $cart_data["items"][$key]["item_code"] = $item_data->item_code;
            $cart_data["items"][$key]["remaining_quantity"] = $item_data->quantity;
            if($cart_data["items"][$key]["price"]==0){
                $cart_data["items"][$key]["price"] = $item_data->$cart_data["type_price"];
            }
            if($cart_data["items"][$key]["costprice"]==0){
                $cart_data["items"][$key]["costprice"] = $item_data->costprice;
            }
            $cart_data["items"][$key]["line_total"] = $cart_data["items"][$key]["price"]*$cart_data["items"][$key]["quantity"];
            $cart_data["items"][$key]["line_total_int"] = $cart_data["items"][$key]["line_total"];
            $cart_data["items"][$key]["line_total"] = number_format($cart_data["items"][$key]["line_total"],2);
            $cart_data["total"] += $cart_data["items"][$key]["line_total_int"];
          }
          $cart_data["total_int"] = $cart_data["total"];
          $cart_data["total"] = number_format($cart_data["total"],2);
        }
      return $cart_data;
    }

    public function drcart_t(Request $request)
    {
      dd($request->session()->get('sales_dr'));
      // exit;
      $items = new Items;
      $cart_data = $request->session()->get('sales_dr');
      if ($request->session()->has('sales_dr.items')) {
        $cart_data["total"] = 0;
        foreach ($cart_data["items"] as $key => $cart_data_item) {
          $item_data = $items->where("itemID",$key)->first();
          $cart_data["items"][$key]["itemname"] = $item_data->itemname;
          $cart_data["items"][$key]["item_code"] = $item_data->item_code;
          $cart_data["items"][$key]["remaining_quantity"] = $item_data->quantity;
          $cart_data["items"][$key]["costprice"] = $item_data->costprice;
          if($cart_data["items"][$key]["price"]==0){
              $cart_data["items"][$key]["price"] = $item_data->$cart_data["type_price"];
          }
          $cart_data["items"][$key]["line_total"] = $cart_data["items"][$key]["price"]*$cart_data["items"][$key]["quantity"];
          $cart_data["total"] += $cart_data["items"][$key]["line_total"];
        }
      }
      return $cart_data;
    }

    public function drcart_destroy(Request $request)
    {
      if($request->type&&$request->type=="items"){
        if($request->id){
          $request->session()->forget('sales_dr.items.'.$request->id);
        }else{
          $request->session()->forget('sales_dr');
        }
      }elseif ($request->type&&$request->type=="customers") {
        $request->session()->forget('sales_dr.customer_data');
      }
    }

    public function drcart_d(Request $request)
    {
      $request->session()->forget('sales_dr');
    }
}
