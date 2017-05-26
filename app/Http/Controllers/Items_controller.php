<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use App\Items;
use App\Items_history;

class Items_controller extends Controller
{
    public function index($value='')
    {
        return view('items');
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
        $result = $items
            ->where('deleted', 0)
            ->orderBy('itemname', 'ASC')
            ->skip($limit)
            ->take($maxitem)
            ->get();
        foreach ($result as $item_data) {
           $item_data->total_costprice = number_format($item_data->costprice * $item_data->quantity,2);
           $item_data->quantity = number_format($item_data->quantity);
           $item_data->costprice = number_format($item_data->costprice,2);
           $item_data->srp = number_format($item_data->srp,2);
           $item_data->price_to_distributors = number_format($item_data->price_to_distributors,2);
           $item_data->reorder = number_format($item_data->reorder);
        }
        $data["getQueryLog"] = DB::getQueryLog();
        $data["result"] = $result;
        $data["count"] = $items
            ->where('deleted', 0)
            ->orderBy('category', 'desc')
            ->count();

        return $data;
    }

    public function show($itemID)
    {
        $items = new Items;
        $data = $items->where("itemID",$itemID)->first();
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
