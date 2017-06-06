<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Users;

class App_controller extends Controller
{
  public function index(Request $request)
  {
    $users = new Users;
    $data["user_data"] = $users->where("accountID",$request->session()->get('user'))->first();
    return view('home',$data);
  }

  public function login(Request $request)
  {
    $this->validate($request, [
      'username' => 'alpha_num|required',
      'password' => 'required|login:'.$request->username.','.$request->password,
    ],["login"=>"Username or Password is not valid. Try again."]);

    $users = new Users;
    $data = $users->where("username",$request->username);
    $data->where("password",md5($request->password));
    $data->where("deleted",0);
    $request->session()->put('user', $data->first()->value("accountID"));
    return redirect($request->redirect);
  }
  public function logout(Request $request)
  {
    $request->session()->flush();
    return redirect('');
  }

  public function settings(Request $request)
  {
    $this->validate($request, [
      'company_name' => 'required|max:100',
      'address' => 'required|max:100',
      'contact_number' => 'required|max:100',
      'logo' => 'max:500|image',
    ]);

  }
}
