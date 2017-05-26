<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Validator;
use App\Suppliers;

class Suppliers_controller extends Controller
{
    public function index($value='')
    {
    	return view("suppliers");
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    	    'supplier_company' => 'required|max:100|available:tbl_suppliers,supplier_company',
    	    'supplier_name' => 'max:50',
    	    'supplier_number' => 'max:50',
    	    'supplier_address' => 'max:50',
    	    'contactperson' => 'max:50',
    	]);


    	$suppliers = new Suppliers;
    	$suppliers->supplier_name = htmlspecialchars(trim($request->supplier_name));
    	$suppliers->supplier_company = htmlspecialchars(trim($request->supplier_company));
        $suppliers->supplier_number = htmlspecialchars(trim($request->supplier_number));
        $suppliers->supplier_address = htmlspecialchars(trim($request->supplier_address));
    	$suppliers->save();
    	return $suppliers->orderBy("supplierID","DESC")->first();
    }

    public function get_list(Request $request)
    {
        DB::enableQueryLog();
        $page = $request->page;
        $maxitem = $request->maxitem;
        $limit = ($page*$maxitem)-$maxitem;
        $suppliers = new suppliers;
        $result = $suppliers->where('deleted', 0)
           ->orderBy('supplier_company', 'ASC')
           ->skip($limit)
           ->take($maxitem)
           ->get();
        foreach ($result as $supplier_data) {
            $supplier_data->supplier_name = $supplier_data->supplier_name;
            $supplier_data->supplier_company = $supplier_data->supplier_company;
            $supplier_data->supplier_number = $supplier_data->supplier_number;
            $supplier_data->supplier_address = $supplier_data->supplier_address;
        }
        $data["getQueryLog"] = DB::getQueryLog();
        $data["result"] = $result;
        $data["count"] = $suppliers->where('deleted', 0)
            ->orderBy('supplier_company', 'ASC')
            ->count();

        return $data;
    }

    public function show($supplierID)
    {
        $suppliers = new Suppliers;
        $data = $suppliers->where('supplierID',$supplierID)->first();
        $data->supplier_name = htmlspecialchars_decode($data->supplier_name);
        $data->supplier_company = htmlspecialchars_decode($data->supplier_company);
        $data->supplier_number = htmlspecialchars_decode($data->supplier_number);
        $data->supplier_address = htmlspecialchars_decode($data->supplier_address);
        return $data;
    }
    
    public function update($supplierID,Request $request)
    {
        $this->validate($request, [
            'supplier_company' => 'required|max:100|available:tbl_suppliers,supplier_company,supplierID,'.$supplierID,
            'supplier_name' => 'max:50',
            'supplier_number' => 'max:50',
            'supplier_address' => 'max:50',
        ]);
        $suppliers = new Suppliers;
        $suppliers
        ->where('supplierID',$supplierID)
        ->update([
            'supplier_name' => htmlspecialchars(trim($request->supplier_name)),
            'supplier_company' => htmlspecialchars(trim($request->supplier_company)),
            'supplier_number' => htmlspecialchars(trim($request->supplier_number)),
            'supplier_address' => htmlspecialchars(trim($request->supplier_address)),
            ]);
        return $suppliers->where('supplierID',$supplierID)->first();
    }
}
