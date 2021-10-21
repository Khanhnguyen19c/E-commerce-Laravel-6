<?php

namespace App\Http\Controllers;

use App\Brand;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExports;
use App\Imports\ExcelImport;
use Symfony\Component\HttpFoundation\Session\Session;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use App\Category_product;
use  Illuminate\Support\Facades\App;
use App\YourExport;
use App\Product;
use Toastr;
use App\Slider;
use Illuminate\Support\Facades\Auth;
use App\Category_Post;
session_start();
class CategoryProduct extends Controller
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
    public function add_CategoryProduct(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $cate_product = Category_product::where('category_parent',0)->orderBy('category_id','DESC')->get();
        return view('admin.add_CategoryProduct')->with('category',$cate_product);
    }

    public function all_CategoryProduct(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $cate_product = Category_product::where('category_parent',0)->orderBy('category_id','DESC')->get();
        $all_category_product =  Category_product::orderBy('category_parent','DESC')->orderBy('category_order','ASC')->paginate(10);
        $manager_category_product = view('admin.all_CategoryProduct')->with('all_CategoryProduct',$all_category_product)->with('cate_product',$cate_product);
        return view('admin_layout')->with('admin.all_CategoryProduct',$manager_category_product);
    }
    public function save_CategoryProduct(Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $category = new Category_product();
        $category->category_name=$data['category_product_name'];
        $category->category_desc=$data['category_product_desc'];
        $category->slug_category=$data['slug_category'];
        $category->category_keywords=$data['category_product_keywords'];
        $category->category_status=$data['category_product_status'];
        $category->category_parent=$data['category_parent'];
        $category->save();
        Toastr::success('Thêm Danh Mục Sản Phẩm Thành Công','Thông báo');
         return redirect::to('all-CategoryProduct');
    }
    public function unactive_categoryProduct($category_product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Category_product::where('category_id',$category_product_id) -> update(['category_status' => 1]);
        Toastr::success('Tắt Hiển Thị Danh Mục Sản Phẩm Thành Công','Thông báo');
        return redirect::to('all-CategoryProduct');
    }
    public function active_categoryProduct($category_product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        Category_product::where('category_id',$category_product_id) -> update(['category_status' => 0]);
        Toastr::success('Hiển Thị Danh Mục Sản Phẩm Thành Công','Thông báo');
        return redirect::to('all-CategoryProduct');
    }
    public function edit_categoryProduct($category_product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $cate_product = Category_product::where('category_parent',0)->orderBy('category_id','DESC')->get();
      $edit_CategoryProduct = DB::table('tbl_category_product')->where('category_id',$category_product_id) ->get();
     $manager_category_product = view('admin.edit_CategoryProduct')->with('edit_CategoryProduct',$edit_CategoryProduct)->with('category',$cate_product);
        return view('admin_layout')->with('admin.edit_CategoryProduct',$manager_category_product);
    }

    public function delete_categoryProduct(Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $cate = $request->category_id;
        DB::table('tbl_category_product')->where('category_id',$cate)-> delete();
    }

    public function update_categoryProduct(Request $request,$category_product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data = $request->all();
        $category =Category_product::find($category_product_id);
        $category->category_name=$data['category_product_name'];
        $category->category_desc=$data['category_product_desc'];
        $category->slug_category=$data['slug_category'];
        $category->category_keywords=$data['category_product_keywords'];
        $category->category_parent=$data['category_parent'];
        $category->save();
        Toastr::success('Cập Nhật Danh Mục Sản Phẩm Thành Công','Thông báo');
        return redirect::to('all-CategoryProduct');
    }
     // KẾT THÚC CATEGORY
     public function show_category_home(Request $request,$slug_category){
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        $cate_product = Category_product::where('category_status','0')->orderBy('category_order','ASC')->get();
        $brand_product = DB::table('tbl_product')->select(DB::raw("brand_name,slug_brand,COUNT(product_quantity) as total"))
        ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('brand_status','0')
        ->orderBy('brand_desc','desc')
        ->groupBy(DB::raw("tbl_brand_product.brand_id"))
        ->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();

        $category_by_slug = Category_product::where('slug_category',$slug_category)->get();

        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');

        $min_price_range = $min_price ;
        $max_price_range = $max_price + 10000000;

        foreach($category_by_slug as $key => $cate){
            $category_id = $cate->category_id;
        }

        $category_by_slug_parent = Category_product::where('slug_category',$slug_category)->where('category_parent',0)->first();
        if($category_by_slug_parent){
            $category_by_id = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_category_product.slug_category',$slug_category)->ORwhere('category_parent',$category_by_slug_parent->category_id)->paginate(6);
        }else{
            $category_by_id = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_category_product.slug_category',$slug_category)->paginate(6);
        }
        if(isset($_GET['sort_by'])){

            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                //appends(request()->query() phân trang với yêu cầu đường dẫn không reset khi qua trang khác
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());

            }elseif($sort_by=='tang_dan'){

              $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());

          }elseif($sort_by=='kytu_za'){

           $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());


       }elseif($sort_by=='kytu_az'){

        $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
    }

}elseif(isset($_GET['start_price']) && $_GET['end_price']){

    $min_price = $_GET['start_price'];
    $max_price = $_GET['end_price'];

    $category_by_id = Product::with('category')->whereBetween('product_price',[$min_price,$max_price])->where('category_id',$category_id)->orderBy('product_price','ASC')->paginate(6);

}else{
    $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','DESC')->paginate(6);
}


        foreach($category_by_slug as $key =>$value){
            $meta_desc = $value->category_desc;
            $meta_keywords = $value->category_keywords;
            $meta_title =$value->category_name;
            $url_canonical =$request->url();

        }
        $image_og =url('public/FrontEnd/Images/blog/img_og.jpg');
        $category_name=  Category_product::where('tbl_category_product.slug_category',$slug_category)->limit(1)->get();
        return view('pages.category.show_category')->with('slider',$slider)->with('category',$cate_product)->with('image_og',$image_og)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
    }

    public function export_csv(){
        return Excel::download(new ExcelExports, 'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImport, $path);
        return back();
    }
    public function arrange_category(Request $request){

        $this->AuthLogin();

        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = Category_product::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo 'Di Chuyển Thành Công';
    }
    public function product_tabs(Request $request){

        $data = $request->all();

        $output = '';

        $subcategory = Category_product::where('category_parent',$data['cate_id'])->get();

        $sub_array = array();
        foreach($subcategory as $key => $sub){
            $sub_array[] = $sub->category_id;
        }
        array_push($sub_array, $data['cate_id']);
        // print_r($sub_array);

        $product = Product::whereIn('category_id',$sub_array)->orderBy('product_id','DESC')->get();

        $product_count = $product->count();

        if($product_count>0){

            $output.= ' <div class="tab-content">
            <div class="tab-pane fade active in" id="tshirt" >
            ';
            foreach($product as $key => $val) {
                $output.='
                <form>

                  <input type="hidden" value="'.$val->product_id.'" class="cart_product_id_'.$val->product_id.'">

                                                <input type="hidden" id="wishlist_productname'.$val->product_id.'" value="'.$val->product_name.'" class="cart_product_name_'.$val->product_id.'">

                                                <input type="hidden" value="'.$val->product_quantity.'" class="cart_product_quantity_'.$val->product_id.'">

                                                <input type="hidden" value="'.$val->product_image.'" class="cart_product_image_'.$val->product_id.'">

                                                <input type="hidden" id="wishlist_productprice'.$val->product_id.'" value="'.number_format($val->product_price,0,',','.').'VNĐ">

                                                <input type="hidden" value="'.$val->product_price.'" class="cart_product_price_'.$val->product_id.'">

                                                <input type="hidden" value="1" class="cart_product_qty_'.$val->product_id.'">

                                                <a id="wishlist_producturl'.$val->product_id.'"  href="'.url('chi-tiet-san-pham/'.$val->slug_product).'">



                <a href="'.url('chi-tiet-san-pham/'.$val->slug_product).'">
                <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                <img src="'.url('public/uploads/product/'.$val->product_image).'" alt="'.$val->product_name.'" />
                <h2>'.number_format($val->product_price,0,',','.').' VNĐ</h2>
                <p>'.$val->product_name.'</p>
                </a>
                <button type="button" class="btn btn-default add-to-cart" id="'.$val->product_id.'" name="add-to-cart" onclick="Addtocart(this.id);"><i class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                <a href="'.url('chi-tiet-san-pham/'.$val->slug_product).'"> <button type="button"  class="btn btn-default watch-sp">Xem Thêm</button> </a>
                </form>

                    </div>

                    </div>
                    <div class="choose">
                    <ul class="nav nav-pills nav-justified " id="choose-li">
                        <li ><a href="#"><i class="far fa-star"></i>Thêm Yêu Thích</a></li>
                        <li><a href="#"><i class="fas fa-compress-arrows-alt"></i>Thêm So Sánh</a></li>
                    </ul>
                </div>
            </div>
                </div>';
            }

            $output.= '
            </div>
            </div>
            ';

        }else{
           $output.= ' <div class="tab-content">

           <div class="tab-pane fade active in" id="tshirt" >

           <div class="col-sm-12s">
           <p style="color:red;text-align:center;">Hiện chưa có sản phẩm trong danh mục này</p>
           </div>


           </div>

           ';
       }


       echo $output;
    }

}
