<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\Auth;
USE Symfony\Component\HttpFoundation\Session\Session;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Toastr;
use Illuminate\Support\Facades\DB;
session_start();
class AuthController extends Controller
{

    public function AuthLogin(){

        if(Session()->get('login_normal')){

            $admin_id = Session()->get('admin_id');
        }else{
            $admin_id = Auth::id();
        }
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }


    }

    public function validation($request){

        return $this->validate($request,[
            'admin_name'=> 'required|max:255',
            'admin_email'=> 'required|email|max:255',
            'admin_phone'=> 'required|max:255',
            'admin_password'=> 'required|max:70',
        ]);
    }
    public function login(Request $request){
        
        $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'
        ]);
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
          return redirect('/dashboard');
        }else{
            Toastr::success('Lỗi Đăng Nhập Auth','Thông Báo');
            return redirect('/admin');
        }

    }
    public function logout_auth(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Auth::logout();
          Session()->put('admin_name',null);
        Session()->put('admin_id',null);
        Session()->put('login_normal',null);
        return redirect('/admin')->with('message','Đăng Xuất Thành Công');
    }

}
