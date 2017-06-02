<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Items;
use App\Customers;
use App\Salesman;
use App\Http\Requests;

class Search_controller extends Controller
{
    public function items(Request $request, $arg='')
    {
      $items = new Items;
      if($arg=="sales"){
        $q = htmlspecialchars(trim($request->term));
        $data = array();
        $search_results = $items->select('quantity', 'itemname', 'item_code', 'itemID');
        $search_results->where(function ($query) use ($q) {
          $query->where('itemname', 'like', '%'.$q.'%')
                ->orWhere('item_code', 'like', '%'.$q.'%');
        });
        
        $search_results->where('deleted',0);
        $search_results->where('quantity','>',0);
        $search_results->orderBy('itemname','ASC');

        $search_results = $search_results->get();

        foreach ($search_results as $result) {
          $item_code = '['.htmlspecialchars_decode($result->item_code).']';
          $data[] = array("label"=>htmlspecialchars_decode($result->itemname).$item_code,"data"=>$result->itemID);
        }
        echo json_encode($data);
      }
    }

    public function customers(Request $request, $arg='')
    {
      $customers = new Customers;
      if($arg=="sales"){
        $q = htmlspecialchars(trim($request->term));
        $data = array();
        $search_results = $customers->select('companyname','customerID');
        $search_results->where('companyname', 'like', '%'.$q.'%');
        $search_results->where('deleted',0);
        $search_results->orderBy('companyname','ASC');

        $search_results = $search_results->get();

        foreach ($search_results as $result) {
          $data[] = array("label"=>htmlspecialchars_decode($result->companyname),"data"=>$result->customerID);
        }
        echo json_encode($data);
      }
    }

    public function salesman(Request $request, $arg='')
    {
      $salesman = new Salesman;
      if($arg=="sales"){
        $q = htmlspecialchars(trim($request->term));
        $data = array();
        $search_results = $salesman->select('salesman_name','salesmanID');
        $search_results->where('salesman_name', 'like', '%'.$q.'%');
        $search_results->where('deleted',0);
        $search_results->orderBy('salesman_name','ASC');

        $search_results = $search_results->get();

        foreach ($search_results as $result) {
          $data[] = array("label"=>htmlspecialchars_decode($result->salesman_name),"data"=>$result->salesmanID);
        }
        echo json_encode($data);
      }
    }
}
