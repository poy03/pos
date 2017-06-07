<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use App\Items;
use App\Users;
use App\Suppliers;
use App\Items_history;

class Items_controller extends Controller
{
    public function index(Request $request)
    {
        $users = new Users;
        $data["user_data"] = $users->where("accountID",$request->session()->get('user'))->first();
        // return $data["user_data"];
        return view('items',$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|max:100',
            'itemname' => 'required|max:50',
            'item_code' => 'max:200|available:tbl_items,item_code',
            'unit_of_measure' => 'required|max:100',
            'costprice' => 'required|numeric',
            'srp' => 'required|numeric',
            'price_to_distributors' => 'required|numeric',
            'quantity' => 'required|numeric',
            'reorder' => 'required|numeric',
        ]);

        $items = new Items;
        $items->category = htmlspecialchars(trim($request->category));
        $items->itemname = htmlspecialchars(trim($request->itemname));
        $items->item_code = htmlspecialchars(trim($request->item_code));
        $items->supplierID = htmlspecialchars(trim($request->supplierID));
        $items->unit_of_measure = htmlspecialchars(trim($request->unit_of_measure));
        $items->costprice = htmlspecialchars(trim($request->costprice));
        $items->srp = htmlspecialchars(trim($request->srp));
        $items->price_to_distributors = htmlspecialchars(trim($request->price_to_distributors));
        $items->quantity = htmlspecialchars(trim($request->quantity));
        $items->reorder = htmlspecialchars(trim($request->reorder));

        $items->save();
        $item_data = $items->orderBy("itemID","DESC")->first();

        $history = new Items_history;
        $history->itemID = $item_data->itemID;
        $history->quantity = $item_data->quantity;
        $history->type = "Add";
        $history->remarks = "Manual edit";
        $history->ref_id = 0;
        $history->date_time = strtotime(date("m/d/Y"));
        $history->accountID = $request->session()->get('user');
        $history->save();

        return $item_data;
    }

    public function get_list(Request $request)
    {
        DB::enableQueryLog();
        $page = $request->page;
        $maxitem = $request->maxitem;
        $limit = ($page*$maxitem)-$maxitem;
        $items = new Items;
        $suppliers = new Suppliers;
        $result = $items->where('deleted', 0);
        if($request->sort_category != "all"){
            $result->where('category', htmlspecialchars($request->sort_category));
        }
        if($request->sort_supplier != "all"){
            $result->where('supplierID', $request->sort_supplier);
        }
        if($request->sort_general != ""){
            switch ($request->sort_general) {
                case "Z-A":
                    $result->orderBy('itemname', 'DESC');
                    break;
                case 'Q-D':
                    $result->orderBy('quantity', 'DESC');
                    break;
                case 'Q-A':
                    $result->orderBy('quantity', 'ASC');
                    break;
                default:
                    $result->orderBy('itemname', 'ASC');
                    break;
            }
        }else{
            $result->orderBy('itemname', 'ASC');
        }
        $result->skip($limit);
        $result->take($maxitem);
        $result = $result->get();
        $result_count = $result->count();
        foreach ($result as $item_data) {
           $item_data->total_costprice = number_format($item_data->costprice * $item_data->quantity,2);
           $item_data->quantity = number_format($item_data->quantity);
           $item_data->costprice = number_format($item_data->costprice,2);
           $item_data->srp = number_format($item_data->srp,2);
           $item_data->price_to_distributors = number_format($item_data->price_to_distributors,2);
           $item_data->reorder = number_format($item_data->reorder);
           $item_data->supplier_company = ($item_data->supplierID==0?"":$suppliers->where("supplierID",$item_data->supplierID)->value("supplier_company"));
        }
        $data["getQueryLog"] = DB::getQueryLog();
        $data["result"] = $result;
        $count = $items->where('deleted', 0);
        if($request->sort_category != "all"){
            $count->where('category', htmlspecialchars($request->sort_category));
        }
        if($request->sort_supplier != "all"){
            $count->where('supplierID', $request->sort_supplier);
        }
        $count = ($result_count==0?0:$count->count());
        $data["paging"] = paging($page,$count,$maxitem);
        return $data;
    }

    public function get_categories($value='')
    {
        $items = new Items;
        return $items->select('category')->where("deleted",0)->distinct()->get();
    }

    public function show($itemID)
    {
        $items = new Items;
        $data = $items->where("itemID",$itemID);
        if($data->count()==0){
            $data = [
                'category' => '',
                'itemname' => '',
                'item_code' => '',
            ];
            return $data;
        }
        $data = $data->first();
        $data->category = htmlspecialchars_decode($data->category);
        $data->itemname = htmlspecialchars_decode($data->itemname);
        $data->item_code = htmlspecialchars_decode($data->item_code);
        return $data;
    }

    public function update($itemID,Request $request)
    {
        $this->validate($request, [
            'category' => 'required|max:100',
            'itemname' => 'required|max:50',
            'item_code' => 'max:200|available:tbl_items,item_code,itemID,'.$itemID,
            'unit_of_measure' => 'required|max:100',
            'costprice' => 'required|numeric',
            'srp' => 'required|numeric',
            'price_to_distributors' => 'required|numeric',
            'quantity' => 'required|numeric',
            'reorder' => 'required|numeric',
        ]);

        $items = new Items;
        $items->where('itemID', $itemID)
              ->update([
                'category' => htmlspecialchars(trim($request->category)),
                'itemname' => htmlspecialchars(trim($request->itemname)),
                'item_code' => htmlspecialchars(trim($request->item_code)),
                'supplierID' => $request->supplierID,
                'unit_of_measure' => htmlspecialchars(trim($request->unit_of_measure)),
                'costprice' => $request->costprice,
                'srp' => $request->srp,
                'price_to_distributors' => $request->price_to_distributors,
                'quantity' => $request->quantity,
                'reorder' => $request->reorder,
                ]);

        $item_data = $items->where('itemID', $itemID)->get()->first();

        $history = new Items_history;
        $history->itemID = $itemID;
        $history->quantity = $item_data->quantity;
        $history->type = "Edit";
        $history->remarks = "Manual edit";
        $history->ref_id = 0;
        $history->date_time = strtotime(date("m/d/Y"));
        $history->save();

        return $item_data;
    }
}
