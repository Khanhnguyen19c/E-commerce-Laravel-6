<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Toastr;
class CouponController extends Controller
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
   public function add_coupon(){
    $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
    return view('admin.coupon.add_Coupon');
   }
   public function save_Coupon(Request $request){
    $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
    $data=$request->all();
    $coupon = new Coupon();
    $coupon->coupon_name = $data['coupon_name'];
    $coupon->coupon_number = $data['coupon_number'];
    $coupon->coupon_code = $data['coupon_code'];
    $coupon->coupon_time = $data['coupon_time'];
    $coupon->coupon_condition = $data['coupon_condition'];
    $coupon->coupon_date_start = $data['coupon_date_start'];
    $coupon->coupon_date_end = $data['coupon_date_end'];
    $coupon->save();
    Toastr::success('Thêm Mã Giảm Gía Thành Công','Thông báo');
        return redirect::to('add-coupon');
}
public function show_coupon(){
    $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
    $coupon=Coupon::orderBy('coupon_id','DESC')->get();
    $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
    return view('admin.coupon.all_Coupon')->with(compact('coupon','today'));
}
public function delete_coupon($coupon_id){
    $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
    $coupon= Coupon::find($coupon_id); //chỉ sử dụng với id nếu muốn so cột khác dùng Coupon::where('',$)->get()
    $coupon->delete();
    Toastr::success('Xoá Mã Giảm Gía Thành Công','Thông báo');
    return redirect::to('all-coupon');

}
public function unset_coupon(){
    $coupon = Session()->get('coupon');
    if($coupon==true){
        Session()->forget('coupon');
        return Redirect()->back()->with('message','Xoá Mã Thành Công');
    }
}
}
