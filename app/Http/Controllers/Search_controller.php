<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Items;
use App\Http\Requests;

class Search_controller extends Controller
{
    public function items(Request $request, $arg='')
    {
      $items = new Items;
      if($arg=="sales"){
        $q = $request->term;
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
          $item_code = '['.$result->item_code.']';
          $data[] = array("label"=>$result->itemname.$item_code,"data"=>$result->itemID);
        }
        echo json_encode($data);
      }
    }
}
