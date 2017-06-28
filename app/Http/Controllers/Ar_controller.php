<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Sales_dr;
use App\Sales_dr_detail;
use App\Salesman;
use App\Payments;

class Ar_controller extends Controller
{
    public function index(Request $request)
    {
    	$tab = explode("/", $request->path());
    	$tab = ($request->path()=="receivables"?"ar":$tab[1]);
    	return view("ar_".$tab,["tab"=>$tab]);
    }

    public function ar_list(Request $request)
    {
        $salesman = new Salesman;
        $payments = new Payments;
    	$page = $request->page;
    	$maxitem = $request->maxitem;
    	$limit = ($page*$maxitem)-$maxitem;

    	$sales_dr = new Sales_dr;
    	$result = $sales_dr->where("deleted",0);
    	$result->where("fully_paid",0);
    	$result->skip($limit);
    	$result->take($maxitem);
    	$result = $result->get();
    	$result_count = $result->count();

        foreach ($result as $dr_data) {
            $payment_data = $payments->where([
                "orderID"=>$dr_data->orderID,
                "type_payment"=>"pdc",
                "status"=>"",
                "not_valid"=> 0,
                ])->orderBy("paymentID","DESC")->first();
            $dr_data->date_ordered = date("m/d/Y",$dr_data->date_ordered);
            $dr_data->date_due = date("m/d/Y",$dr_data->date_due);
            $dr_data->salesman_name = ($dr_data->salesmanID != 0 ? $salesman->where("salesmanID",$dr_data->salesmanID)->value("salesman_name") : "") ;
            $dr_data->terms = ($dr_data->terms==0?"COD":$dr_data->terms);
            $dr_data->pdc_date = ($payment_data != NULL?date("m/d/Y",$payment_data->pdc_date):""); 
            $dr_data->pdc_check_number = ($payment_data != NULL?$payment_data->pdc_check_number:""); 
            $dr_data->pdc_bank = ($payment_data != NULL?$payment_data->pdc_bank:""); 

        }
    	$data["result"] = $result;

    	$count = $sales_dr->where("deleted",0);
    	$count->where("fully_paid",0);

    	$count = ($result_count==0?0:$count->count());
    	$data["paging"] = paging($page,$count,$maxitem,"",["ng-click"=>'$parent.test()']);

    	return $data;
    }
}
