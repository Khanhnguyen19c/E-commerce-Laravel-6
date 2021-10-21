<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use App\Category_product;
use Toastr;
use  Illuminate\Support\Facades\App;
use App\Category_Post;
use Illuminate\Support\Facades\Auth;
session_start();
class CategoryPost extends Controller
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


}  public function add_CategoryPost(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        return view('admin.category_post.add_CategoryPost');
    }

    public function all_CategoryPost(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $all_category_post = Category_Post::orderBy('category_post_id','DESC')->paginate(10);
        $manager_category_product = view('admin.category_post.all_CategoryPost')->with('all_CategoryPost',$all_category_post);
        return view('admin_layout')->with('all_CategoryPost',$manager_category_product);
    }
    public function save_CategoryPost(Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $category_post = new Category_Post();
        $category_post->category_post_name=$data['post_name'];
        $category_post->category_post_desc=$data['post_desc'];
        $category_post->category_post_slug=$data['post_slug'];
        $category_post->category_post_status=$data['post_status'];
        $category_post->save();
        Session()->put('message','Thêm danh mục Bài Viết thành công!!!');
         return redirect::to('all-CategoryPost');
    }
    public function unactive_CategoryPost($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Category_Post::where('category_post_id',$post_id) -> update(['category_post_status' => 1]);
        Toastr::success('Tắt Hiển Thị Danh Mục Bài Viết Thành Công','Thông báo');
        return redirect::to('all-CategoryPost');
    }
    public function active_CategoryPost($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Category_Post::where('category_post_id',$post_id) -> update(['category_post_status' => 0]);
        Toastr::success('Hiển Thị Danh Mục Bài Viết Thành Công','Thông báo');
        return redirect::to('all-CategoryPost');
    }
    public function edit_CategoryPost($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
      $edit_CategoryPost = Category_Post::find($post_id);
     $manager_category_product = view('admin.category_post.edit_CategoryPost')->with('edit_CategoryPost',$edit_CategoryPost);
        return view('admin_layout')->with('admin.edit_CategoryPost',$manager_category_product);
    }

    public function delete_CategoryPost($post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Category_Post::where('category_post_id',$post_id) -> delete();
        Toastr::success('Xoá Danh Mục Bài Viết Thành Công','Thông báo');
        return redirect::to('all-CategoryPost');
    }
    public function update_CategoryPost(Request $request,$post_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $category_post =Category_Post::find($post_id);
        $category_post->category_post_name=$data['post_name'];
        $category_post->category_post_desc=$data['post_desc'];
        $category_post->category_post_slug=$data['post_slug'];
        $category_post->category_post_status=$data['post_status'];
        $category_post->save();
        Toastr::success('Cập Nhật Danh Mục Bài Viết Thành Công','Thông báo');
        return redirect::to('all-CategoryPost');
    }


}
