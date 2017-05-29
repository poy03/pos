<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;
use App\Items;

class Sales_controller extends Controller
{
    public function index()
    {
    	return view('sales');
    }

    public function drcart_add(Request $request)
    {
        $items = new Items;
    	if ($request->session()->has('sales_dr.items.'.$request->id)) {
    		$data = $request->session()->get('sales_dr');
	    	$data["items"][$request->id] = [
                'quantity'=> $data["items"][$request->id]['quantity']+1,
                'price' => 0,
            ];
            $data["type_price"] = 'srp';
            $request->session()->put('sales_dr', $data);
        }else{

            if ($request->session()->has('sales_dr.items')) {
                $data = $request->session()->get('sales_dr');
                $data["items"][$request->id] = [
                    'quantity'=> 1,
                    'price' => 0,
                ];
            }else{
                $data["items"][$request->id] = [
                    'quantity'=> 1,
                    'price' => 0,
                ];
            }
            $data["type_price"] = 'srp';
	    	$request->session()->put('sales_dr', $data);
    	}
    	
    }

    public function drcart(Request $request)
    {
    	// dd($request->session()->get('sales_dr'));
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
    public function drcart_d(Request $request)
    {
    	$request->session()->forget('sales_dr');
    }
}
