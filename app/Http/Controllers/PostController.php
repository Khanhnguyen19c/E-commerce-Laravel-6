<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category_Post;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Redirect;
use App\Post;
use Illuminate\Support\Facades\DB;
use App\Slider;
use App\Brand;
use App\Category_product;
use Toastr;
use App\Product;

session_start();
class PostController extends Controller
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
    public function danh_muc_tin_tuc(Request $request,$slug_post){

        $slider = Slider::OrderBy('slider_id','DESC')->where('slider_status',0)->take(4)->get();
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        $catepost = Category_Post::where('category_post_slug',$slug_post)->take(1)->get();
        foreach($catepost as $key=>$cate){
            $meta_desc = $cate->category_post_desc;
            $meta_keywords =  $cate->category_post_slug;
            $meta_title = $cate->category_post_name;
            $cate_id = $cate ->category_post_id;
            $url_canonical =$request->url();

        }
        $image_og =url('public/FontEnd/Images/blog/img_og.jpg');
       $post = Post::with('cate_post')->where('post_status',0)->where('category_post_id',$cate_id)->paginate(5);
       $cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();
       $brand_product=Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
       $all_product =Product::where('product_status','0')->orderby('product_id','desc')->limit(6)->get();
       return view('pages.post.list_Post')->with('post',$post)->with('category',$cate_product)->with('brand',$brand_product)->with('category_post',$category_post)->with('slider',$slider)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og', $image_og);

    }
    public function tin_tuc(Request $request,$post_slug){
         //category post
         $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
         //slide
         $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();


         $cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();
         $brand_product= Brand::where('brand_status','0')->orderby('brand_id','desc')->get();

         $post_by_id = Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();

        foreach($post_by_id as $key => $pp){
            //seo
            $meta_desc = $pp->post_meta_desc;
            $meta_keywords = $pp->post_meta_keywords;
            $meta_title = $pp->post_title;
            $cate_id = $pp->category_post_id;
            $url_canonical = $request->url();
            $post_id = $pp->post_id;
             $image_og = url('public/uploads/post/'.$pp->post_image);
             //--seo

         }
         //update views
         $post = Post::where('post_id',$post_id)->first();
         $post->post_views = $post->post_views + 1;
         $post->save();

         //related post
         $related = Post::with('cate_post')->where('post_status',0)->where('category_post_id',$cate_id)->whereNotIn('post_slug',[$post_slug])->take(5)->get();
         return view('pages.post.baiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('post_by_id',$post_by_id)->with('category_post',$category_post)->with('related',$related)->with('image_og',$image_og);
    }
    //Post
    public function add_Post(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        return view('admin.post.add_Post')->with(compact('category_post'));
    }
    public function all_Post(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $all_post = Post::with('cate_post')->orderBy('category_post_id','DESC')->paginate(10);
        return view('admin.post.all_Post')->with(compact('all_post',$all_post));
    }
    public function save_Post(Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $Post = new Post();
        $name = Auth::user()->admin_name;
        $Post->post_author = $name;
        $Post->post_views=0;
        $Post->post_title=$data['post_title'];
        $Post->category_post_id=$data['category_post_id'];
        $Post->post_content=$data['post_content'];
        $Post->post_slug=$data['post_slug'];
        $Post->post_desc=$data['post_desc'];
        $Post->post_meta_desc=$data['post_meta_desc'];
        $Post->post_meta_keywords=$data['post_meta_keywords'];
        $Post->post_status=$data['post_status'];
        $get_image = $request->file('post_image');
        if($get_image)
        {
            $get_name_image= $get_image->getClientOriginalName();  //lấy tên hình
            $name_image  =current(explode('.',$get_name_image)); // Phân Tách Chuỗi
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //Lấy đuôi ảnh
            $get_image -> move('public/uploads/post',$new_image); //đưa vào thư mục
            $Post ->post_image=$new_image;
            $Post->save();
            Toastr::success('Thêm Bài Viết thành công','Thông báo');
            return redirect()->back();
        }else{
            Toastr::success('Thêm Bài Viết thành công','Thông báo');
            return redirect()->back();
        }
    }
    public function unactive_Post($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
         Post::where('post_id',$post_id) -> update(['post_status' => 1]);
         Toastr::success('Tắt Hiển Thị Bài Viết Thành Công','Thông báo');
        return redirect::to('all-Post');
    }
    public function active_Post($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Post::where('post_id',$post_id) -> update(['post_status' => 0]);
        Toastr::success('Hiển Thị Bài Viết Thành Công','Thông báo');
        return redirect::to('all-Post');
    }
    public function edit_Post($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
      $edit_Post = Post::find($post_id);
      $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
      return view('admin.post.edit_Post')->with(compact('edit_Post','category_post'));
    }
    public function delete_Post($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $delete_Post = Post::find($post_id);
        $delete_image = $delete_Post->post_image;
        if($delete_image){
            $path = 'public/uploads/post/'.$delete_image;
            unlink($path); // xoá hình trong thư mục
        }
        $delete_Post-> delete();
        Toastr::success('Xoá Bài Viết Thành Công','Thông báo');

        return redirect()->back();
    }
    public function update_Post(Request $request,$post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $Post = Post::find($post_id);
        $Post->post_title=$data['post_title'];
        $Post->category_post_id=$data['category_post_id'];
        $Post->post_content=$data['post_content'];
        $Post->post_slug=$data['post_slug'];
        $Post->post_desc=$data['post_desc'];
        $Post->post_meta_desc=$data['post_meta_desc'];
        $Post->post_meta_keywords=$data['post_meta_keywords'];
        $Post->post_status=$data['post_status'];
        $get_image = $request->file('post_image');
        if($get_image)
        {
            $get_name_image= $get_image->getClientOriginalName();  //lấy tên hình
            $name_image  =current(explode('.',$get_name_image)); // Phân Tách Chuỗi
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //Lấy đuôi ảnh
            $get_image -> move('public/uploads/post',$new_image); //đưa vào thư mục
            $Post ->post_image=$new_image;
            $Post->save();
            Toastr::success('Cập Nhật Bài Viết Thành Công','Thông báo');

            return redirect::to('all-Post');
        }else{
            $Post->save();
            Toastr::success('Cập Nhật Bài Viết Thành Công','Thông báo');
            return redirect::to('all-Post');
        }
}
}
