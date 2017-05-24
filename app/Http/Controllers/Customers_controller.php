<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use App\Customers;

class Customers_controller extends Controller
{
    public function index($value='')
    {
    	 return view('customers');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    	    'companyname' => 'required|max:100',
    	    'address' => 'max:50',
    	    'email' => 'email|max:50',
    	    'phone' => 'max:50',
    	    'contactperson' => 'max:50',
    	    'tin_id' => 'max:200',
    	    'credit_limit' => 'numeric',
    	]);


    	$customers = new Customers;
    	$customers->companyname = $request->companyname;
    	$customers->address = $request->address;
    	$customers->email = $request->email;
    	$customers->phone = $request->phone;
    	$customers->contactperson = $request->contactperson;
    	$customers->tin_id = $request->tin_id;
    	$customers->credit_limit = $request->credit_limit;

    	$customers->save();
    	return $customers->orderBy("customerID","DESC")->get()->first();
    }

    public function get_list(Request $request)
    {
        DB::enableQueryLog();
        $page = $request->page;
        $maxitem = $request->maxitem;
        $limit = ($page*$maxitem)-$maxitem;
        $customers = new Customers;
        $result = $customers->where('deleted', 0)
           ->orderBy('companyname', 'ASC')
           ->skip($limit)
           ->take($maxitem)
           ->get();
        foreach ($result as $customer_data) {
        	$customer_data->credit_limit = number_format($customer_data->credit_limit,2);
        }
        $data["getQueryLog"] = DB::getQueryLog();
        $data["result"] = $result;
        $data["count"] = $customers->where('deleted', 0)
            ->orderBy('companyname', 'ASC')
            ->count();

        return $data;
    }

    public function show($customerID)
    {
        $customers = new Customers;
        return $customers->where('customerID',$customerID)->get();
    }
    public function update($customerID,Request $request)
    {
        $customers = new Customers;
        $customers
        ->where('customerID',$customerID)
        ->update([
            'companyname' => htmlspecialchars(trim($request->companyname)),
            'address' => htmlspecialchars(trim($request->address)),
            'email' => htmlspecialchars(trim($request->email)),
            'phone' => htmlspecialchars(trim($request->phone)),
            'contactperson' => htmlspecialchars(trim($request->contactperson)),
            'tin_id' => htmlspecialchars(trim($request->tin_id)),
            'credit_limit' => htmlspecialchars(trim($request->credit_limit)),
            ]);
        $customers = new Customers;
        return $customers->where('customerID',$customerID)->get();
    }
}
