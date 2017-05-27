<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Validator;
use App\Users;

class Users_controller extends Controller
{
    public function index($value='')
    {
    	return view('users');
    }
    public function store(Request $request)
    {
    	$this->validate($request, [
    	    'username' => 'alpha_num|required|min:5|max:10|available:tbl_users,username',
    	    'password' => 'required|min:5|max:16',
    	    'employee_name' => 'required|max:50',
    	]);


    	$users = new Users;
    	$users->username = $request->username;
    	$users->password = md5($request->password);
    	$users->employee_name = htmlspecialchars(trim($request->employee_name));
    	$users->type = $request->type;

    	$users->items = ($request->items||$request->type="admin"?1:0);
    	$users->customers = ($request->customers||$request->type="admin"?1:0);
    	$users->sales = ($request->sales||$request->type="admin"?1:0);
    	$users->receiving = ($request->receiving||$request->type="admin"?1:0);
    	$users->users = ($request->users||$request->type="admin"?1:0);
    	$users->reports = ($request->reports||$request->type="admin"?1:0);
    	$users->suppliers = ($request->suppliers||$request->type="admin"?1:0);
    	$users->credits = ($request->credits||$request->type="admin"?1:0);
    	$users->expenses = ($request->expenses||$request->type="admin"?1:0);
    	$users->items_modify = ($request->items_modify||$request->type="admin"?1:0);
    	$users->customers_modify = ($request->customers_modify||$request->type="admin"?1:0);
    	$users->suppliers_modify = ($request->suppliers_modify||$request->type="admin"?1:0);
    	$users->users_modify = ($request->users_modify||$request->type="admin"?1:0);
    	$users->salesman = ($request->salesman||$request->type="admin"?1:0);
    	$users->salesman_modify = ($request->salesman_modify||$request->type="admin"?1:0);
    	$users->items_add = ($request->items_add||$request->type="admin"?1:0);
    	$users->customers_add = ($request->customers_add||$request->type="admin"?1:0);
    	$users->suppliers_add = ($request->suppliers_add||$request->type="admin"?1:0);
    	$users->users_add = ($request->users_add||$request->type="admin"?1:0);
    	$users->salesman_add = ($request->salesman_add||$request->type="admin"?1:0);
    	$users->accounts_payable = ($request->accounts_payable||$request->type="admin"?1:0);
    	$users->payroll = ($request->payroll||$request->type="admin"?1:0);
    	$users->save();
    	return $users->orderBy("accountID","DESC")->first();
    }

    public function get_list(Request $request)
    {
        DB::enableQueryLog();
        $page = $request->page;
        $maxitem = $request->maxitem;
        $limit = ($page*$maxitem)-$maxitem;
        $users = new Users;
        $result = $users->where('deleted', 0);
        $result->orderBy('username', 'ASC');
        $result->skip($limit);
        $result->take($maxitem);
        $result = $result->get();
        $result_count = $result->count();
        $data["getQueryLog"] = DB::getQueryLog();
        $data["result"] = $result;
        $count = $users->where('deleted', 0);
        $count->orderBy('username', 'ASC');
        $count = ($result_count==0?0:$count->count());
        $data["paging"] = paging($page,$count,$maxitem);
        return $data;
    }

    public function show($accountID)
    {
        $users = new Users;
        $data = $users->where('accountID',$accountID)->first();
        $data->username = $data->username;
        $data->employee_name = htmlspecialchars_decode($data->employee_name);
        return $data;
    }
    
    public function update($accountID,Request $request)
    {
        $this->validate($request, [
        	'username' => 'alpha_num|required|min:5|max:10|available:tbl_users,username,accountID,'.$accountID,
        	'password' => 'required|min:5|max:16',
        	'employee_name' => 'required|max:50',
        ]);
        $users = new Users;
        $users
        ->where('accountID',$accountID)
        ->update([
        	'username' => $request->username,
        	'password' => md5($request->password),
        	'employee_name' => htmlspecialchars(trim($request->employee_name)),
        	'type' => $request->type,
        	'items' => ($request->items||$request->type=="admin"?1:0),
        	'customers' => ($request->customers||$request->type=="admin"?1:0),
        	'sales' => ($request->sales||$request->type=="admin"?1:0),
        	'receiving' => ($request->receiving||$request->type=="admin"?1:0),
        	'users' => ($request->users||$request->type=="admin"?1:0),
        	'reports' => ($request->reports||$request->type=="admin"?1:0),
        	'suppliers' => ($request->suppliers||$request->type=="admin"?1:0),
        	'credits' => ($request->credits||$request->type=="admin"?1:0),
        	'expenses' => ($request->expenses||$request->type=="admin"?1:0),
        	'items_modify' => ($request->items_modify||$request->type=="admin"?1:0),
        	'customers_modify' => ($request->customers_modify||$request->type=="admin"?1:0),
        	'suppliers_modify' => ($request->suppliers_modify||$request->type=="admin"?1:0),
        	'users_modify' => ($request->users_modify||$request->type=="admin"?1:0),
        	'salesman' => ($request->salesman||$request->type=="admin"?1:0),
        	'salesman_modify' => ($request->salesman_modify||$request->type=="admin"?1:0),
        	'items_add' => ($request->items_add||$request->type=="admin"?1:0),
        	'customers_add' => ($request->customers_add||$request->type=="admin"?1:0),
        	'suppliers_add' => ($request->suppliers_add||$request->type=="admin"?1:0),
        	'users_add' => ($request->users_add||$request->type=="admin"?1:0),
        	'salesman_add' => ($request->salesman_add||$request->type=="admin"?1:0),
        	'accounts_payable' => ($request->accounts_payable||$request->type=="admin"?1:0),
        	'payroll' => ($request->payroll||$request->type=="admin"?1:0),
            ]);
        return $users->where('accountID',$accountID)->first();
    }
}
