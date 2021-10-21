<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportsBrand;
use App\Imports\BrandImport;
use App\User;
USE Symfony\Component\HttpFoundation\Session\Session;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Brand;
use Toastr;
use App\Category_product;
use App\Category_Post;
use App\Product;
use App\Slider;
use Illuminate\Support\Facades\Auth;
session_start();
class BrandProduct extends Controller
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
    public function add_BrandProduct(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        return view('admin.add_BrandProduct');
    }
    public function all_BrandProduct(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        // $all_brand_product = DB::table('tbl_brand_product')->get(); static huong doi tuong
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get(); // ::all(); lay het ->take(1) lay 1 thuong hieu paginate(5)
        $manager_category_product = view('admin.all_BrandProduct')->with('all_BrandProduct',$all_brand_product);
        return view('admin_layout')->with('admin.all_BrandProduct',$manager_category_product);
    }
    public function save_BrandProduct (Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name=$data['brand_name'];
        $brand->brand_desc=$data['brand_desc'];
        $brand->slug_brand=$data['slug_brand'];
        $brand->brand_status=$data['brand_status'];
        $brand->save();
        Toastr::success('Thêm Thương Hiệu Sản Phẩm Thành Công','Thông báo');
         return redirect::to('all-BrandProduct');
    }
    public function unactive_BrandProduct($brand_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
       Brand::where('brand_id',$brand_id) -> update(['brand_status' => 1]);
       Toastr::success('Tắt Hiển Thị Thương Hiệu Thành Công','Thông báo');
        return redirect::to('all-BrandProduct');
    }
    public function active_BrandProduct($brand_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
       Brand::where('brand_id',$brand_id) -> update(['brand_status' => 0]);
       Toastr::success('Hiển Thị Thương Hiệu Thành Công','Thông báo');
        return redirect::to('all-BrandProduct');
    }
    public function edit_BrandProduct($brand_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        // $edit_BrandProduct = DB::table('tbl_brand_product')->where('brand_id',$brand_id) ->get();
        $edit_BrandProduct = Brand::find($brand_id);
       $manager_category_product = view('admin.edit_BrandProduct')->with('edit_BrandProduct',$edit_BrandProduct );
          return view('admin_layout')->with('admin.edit_BrandProduct',$manager_category_product);
      }

      public function delete_BrandProduct(Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $brand_id = $request->brand_id;
          DB::table('tbl_brand_product')->where('brand_id',$brand_id) -> delete();

      }

      public function update_BrandProduct(Request $request,$brand_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $brand =Brand::find($brand_id);
        $brand->brand_name=$data['brand_name'];
        $brand->brand_desc=$data['brand_desc'];
        $brand->slug_brand=$data['slug_brand'];
        $brand->save();
        Toastr::success('Cập Nhật Thương Hiệu Thành Công','Thông báo');
          return redirect::to('all-BrandProduct');
      }
      //ket thuc BRAND BACKEND

      public function show_brand_home(Request $request, $slug_brand){
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        $cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        $brand_name= Brand::where('tbl_brand_product.slug_brand',$slug_brand)->limit(1)->get();
        $brand_by_id = Brand::join('tbl_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('tbl_brand_product.slug_brand',$slug_brand)->paginate(6);
        $brand_by_slug = Brand::where('slug_brand',$slug_brand)->get();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');

        $min_price_range = $min_price ;
        $max_price_range = $max_price + 10000000;

        foreach($brand_by_slug as $key => $brand){
            $brand_id = $brand->brand_id;
        }

        if(isset($_GET['sort_by'])){

            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                //appends(request()->query() phân trang với yêu cầu đường dẫn không reset khi qua trang khác
                $brand_by_id = Product::with('brand')->where('brand_id',$brand_id)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());

            }elseif($sort_by=='tang_dan'){

              $brand_by_id = Product::with('brand')->where('brand_id',$brand_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());

          }elseif($sort_by=='kytu_za'){

           $brand_by_id = Product::with('brand')->where('brand_id',$brand_id)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());


       }elseif($sort_by=='kytu_az'){

        $brand_by_id = Product::with('brand')->where('brand_id',$brand_id)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
    }

}elseif(isset($_GET['start_price']) && $_GET['end_price']){

    $min_price = $_GET['start_price'];
    $max_price = $_GET['end_price'];

    $brand_by_id = Product::with('brand')->whereBetween('product_price',[$min_price,$max_price])->where('brand_id',$brand_id)->orderBy('product_price','ASC')->paginate(6);

}else{
    $brand_by_id = Product::with('brand')->where('brand_id',$brand_id)->orderBy('product_id','DESC')->paginate(6);
}

        foreach($brand_by_slug as $key =>$value){
            $meta_desc = $value->brand_desc;
            $meta_keywords = $value->slug_brand;
            $meta_title =$value->brand_name;
            $url_canonical =$request->url();

        }
        $image_og =url('public/FrontEnd/Images/blog/img_og.jpg');
        $category_name=  Category_product::where('tbl_category_product.slug_category',$slug_brand)->limit(1)->get();
        return view('pages.brand.show_brand')->with('slider',$slider)->with('category',$cate_product)->with('image_og',$image_og)->with('brand_by_id',$brand_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('brand_name',$brand_name)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
    }
    public function export_csv(){
        return Excel::download(new ExportsBrand, 'Brand.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new BrandImport, $path);
        return back();
    }
    public function arrange_brand(Request $request){

        $this->AuthLogin();

        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = Brand::find($value);
            $category->brand_order = $key;
            $category->save();
        }
        echo 'Di Chuyển Thành Công';
    }
  }
