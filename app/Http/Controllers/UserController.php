<?php

namespace App\Http\Controllers;
use app\Roles;
use App\Admin;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;
session_start();
class UserController extends Controller
{
    public function index(){
        $admin = Admin::With('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.list_users')->with(compact('admin'));
    }
    public function add_user(){
        return view('admin.users.add_user');
    }
    public function save_admin(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name=$data['admin_name'];
        $admin->admin_email=$data['admin_email'];
        $admin->admin_phone=$data['admin_phone'];
        $admin->admin_password=md5($data['admin_password']);
        if( $admin->admin_email == $data['admin_email'])
        {
            Toastr::error('Email Đã Được Đăng Ký Vui Lòng Kiểm Tra Lại','Thông báo');
            return redirect()->back();
        }else{
            $admin->save();
            $admin->roles()->attach(Roles::where('name','user')->first());
            Toastr::success('Thêm Admin thành công','Thông báo');
            return redirect::to('list-user');
        }

    }
    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
            Toastr::error('Không Thể Tự Phân Quyền Cho Admin Đang Đăng Nhập','Thông báo');
            return redirect()->back();
        }
        $user=Admin::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach(); // attach ket hop user voi roles detach xoa quyen

        if($request['author_role']){
            $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('name','admin')->first());
        }
        if($request['user_role']){
            $user->roles()->attach(Roles::where('name','user')->first());
        }
        Toastr::info('Cấp Quyền Cho Admin Thành Công','Thông báo');
        return redirect()->back();
    }
    public function delete_user_roles($admin_id){
        if(Auth::id() == $admin_id){
            Toastr::warning('Không Thể Xoá Admin Đang Đăng Nhập','Thông báo');
            return redirect()->back();
        }else{
            $admin =  Admin::find($admin_id);
            if($admin){
                $admin->roles()->detach(); //xoá hết quyền nó đi
                $admin->delete();
            }
            Toastr::success('Xoá Admin Thành Công','Thông báo');
            return redirect()->back();
        }


    }
    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/list-user');
    }
    public function impersonate($admin_id){
        $admin = Admin::where('admin_id',$admin_id)->first();
        if($admin){
            session()->put('impersonate',$admin->admin_id);
        }
            return redirect('/list-user');
    }
}
