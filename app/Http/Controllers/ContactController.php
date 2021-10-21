<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Category_Post;
use App\Category_product;
use App\Slider;
use Toastr;
use App\Brand;
use App\Icons;
session_start();
class ContactController extends Controller
{

    public function contact(Request $request){
         // START SEO
         $meta_desc = "K-Shopper Shop Quần Áo Thời Trang Nam Nữ Đẹp Tp.HCM. Chuyên Các Dòng Áo Khoác, Quần Áo Nam Nữ Đẹp Được Ưa Chuộng Của Giới Trẻ.";
         $meta_keywords = "Shop Bán Quần Áo Online";
         $meta_title ="Liên Hệ | K-Shopper";
         $url_canonical =$request->url();

         $image_og =url('public/FontEnd/Images/blog/img_og.jpg');
         $cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();
         $brand_product= Brand::where('brand_status','0')->orderby('brand_id','desc')->get();

         //END SEO
         //category post
         $contact = Contact::where('info_id',1)->get();
         $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
         $slider = Slider::OrderBy('slider_id','DESC')->where('slider_status',0)->take(4)->get();
    return view('pages.contact.contact')->with('contact',$contact)->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og', $image_og);
    }
    public function info(){
        $contact = Contact::where('info_id',1)->get();
    	return view('admin.contact.add_contact')->with(compact('contact'));
    }
    public function update_info(Request $request,$info_id){
    	$data = $request->all();
    	$contact = Contact::find($info_id);
    	$contact->info_contact = $data['info_contact'];
        $contact->slogan_logo = $data['slogan_logo'];
    	$contact->info_map = $data['info_map'];
    	$contact->info_fanpage = $data['info_fanpage'];
    	$get_image = $request->file('info_image');
    	$path = 'public/uploads/contact/';
    	if($get_image){
    		unlink($path.$contact->info_logo);
    		$get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
    	}

    	$contact->save();
        Toastr::success('Cập nhật thông tin website thành công','Thông báo');
    	return redirect()->back();
    }
    public function save_info(Request $request){
    	$data = $request->all();
    	$contact = new Contact();
    	$contact->info_contact = $data['info_contact'];
    	$contact->info_map = $data['info_map'];
    	$contact->info_fanpage = $data['info_fanpage'];
    	$get_image = $request->file('info_image');
    	$path = 'public/uploads/contact/';
    	if($get_image){
    		$get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
    	}

    	$contact->save();
        Toastr::success('Cập nhật thông tin website thành công','Thông báo');
    	return redirect()->back();

    }
    public function add_doitac(Request $request){
        $data = $request->all();
        $icons = new Icons();
        $name = $data['name'];
        $link = $data['link'];
        $get_image = $request->file('file');

        $path = './public/FrontEnd/Images/icon/';

        //them hinh anh
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $icons->icon_image = $new_image;

        }
        $icons->icon_name = $name;
        $icons->icon_link = $link;
        $icons->category = 'doitac';

        $icons->save();

    }
    public function add_nut(Request $request){

        $data = $request->all();
        $icons = new Icons();
        $name = $data['name'];
        $link = $data['link'];
        $get_image = $request->file('file');

        $path = './public/FrontEnd/Images/icon/';

        //them hinh anh
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $icons->icon_image = $new_image;

        }
        $icons->icon_name = $name;
        $icons->icon_link = $link;
        // $icons->category = 'icons';

        $icons->save();

    }
    public function delete_icons(){
        $id = $_GET['id'];
        $icons = Icons::find($id);
        $icons->delete();
    }

    public function list_doitac(){
        $admin = new Admin();
        $icons = Icons::where('category','doitac')->orderBy('icon_id','DESC')->get();
        // dd($icons);
        $output = '';
        $output .= '<table class="table table-hover">
            <thead>
              <tr>
                <th>Tên đối tác</th>
                <th>Hình ảnh đối tác</th>
                <th>Link đối tác</th>
                <th>Quản lý</th>
              </tr>
              </tr>
            </thead>
            <tbody>';
            foreach($icons as $ico){

             $output .= ' <tr>
                <td>'.$ico->icon_name.'</td>
                <td><img height="80px" width="150px" src="'.url('./public/FrontEnd/Images/icon/'.$ico->icon_image).'"></td>
                <td>'.$ico->icon_link.'</td>
                 <td>
                 '. $admin -> hasrole(['admin','author']){ '
                 <button id="'.$ico->icon_id.'" class="btn btn-warning" onclick="delete_icons(this.id)">Xóa đối tác</button>
                 '}.'
                 </td>
              </tr>';

             }
             $output .= '</tbody>
          </table>';
          echo $output;
    }
    public function list_nut(){
        $admin = new Admin();
        $icons = Icons::whereNull('category')->orderBy('icon_id','ASC')->get();
        // dd($icons);
        $output = '';
        $output .= '<table class="table table-hover">
            <thead>
              <tr>
                <th>Tên nút</th>
                <th>Hình ảnh</th>
                <th>Link</th>
                <th>Quản lý</th>
              </tr>
              </tr>
            </thead>
            <tbody>';
            foreach($icons as $ico){
             $output .= ' <tr>
                <td>'.$ico->icon_name.'</td>
                <td><img height="32px" width="40px" src="'.url('./public/FrontEnd/Images/icon/'.$ico->icon_image).'"></td>
                <td>'.$ico->icon_link.'</td>

                 <td>
                 '. $admin -> hasrole(['admin','author']){ '
                 <button id="'.$ico->icon_id.'" class="btn btn-danger" onclick="delete_icons(this.id)">Xóa Nút</button>
                 '}.'
                 </td>
              </tr>';

             }
             $output .= '</tbody>
          </table>';
          echo $output;
    }
}

