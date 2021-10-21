<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
class BannerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if(isset($admin_id)){
           return Redirect::to('dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }
    public function manage_slider(){
        $all_slide = Slider::orderBy('slider_id','DESC')->get();
        return view('admin.list_slider')->with(compact('all_slide'));
    }
    public function add_slier (){
        return view('admin.add_slider');
    }
    public function save_slider(Request $request){
        // $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = new Slider();
        $data['Slider_name'] = $request->slider_name;
        $data['slider_desc'] = $request->slider_desc;
        $data['slider_status'] = $request->slider_status;
        $get_image = $request->file('slider_image');
        if($get_image)
        {
            $get_name_image= $get_image->getClientOriginalName();  //lấy tên hình
            $name_image  =current(explode('.',$get_name_image)); // Phân Tách Chuỗi
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //Lấy đuôi ảnh
            $get_image -> move('public/uploads/slider',$new_image); //đưa vào thư mục
            $data['slider_image'] = $new_image;
            $data->save();
            Toastr::success('Thêm Banner thành công','Thông Báo');
             return redirect::to('manage-slider');
        }else{
            $data['slider_image'] = '';
            $data->save();
            Toastr::success('Thêm Banner thành công','Thông Báo');
             return redirect::to('manage-slider');
        }


    }
    public function unactive_slider($slider_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
       Slider::where('slider_id',$slider_id) -> update(['slider_status' => 1]);
       Toastr::success('Tắt Hiển Thị Banner Thành Công','Thông Báo');

        return redirect::to('manage-slider');
    }

    public function active_slider($slider_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Slider::where('slider_id',$slider_id) -> update(['slider_status' => 0]);
        Toastr::success('Hiển Thị Banner Thành Công','Thông Báo');
      return redirect()->back();
    }
    public function delete_slider(Request $request, $slider_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $slider_id = $request->slider_id;
        $slider = Slider::find($slider_id);
        unlink('public/uploads/slider/'.$slider->slider_image);
        Slider::where('slider_id',$slider_id) ->delete();
        Toastr::success('Xoá Banner Thành Công','Thông Báo');
          return redirect()->back();
      }
}
