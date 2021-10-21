<?php

namespace App\Http\Controllers;

use App\Brand;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportsProduct;
use App\Imports\ProductImport;
use App\Product;
use App\User;
use App\Slider;
use  Illuminate\Support\Facades\File;
use App\Comment;
use App\Ratting;
use Toastr;
USE Symfony\Component\HttpFoundation\Session\Session;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;
use Illuminate\Support\Facades\Auth;
use App\Category_Post;
use App\Gallery;
use App\Category_product;
session_start();
class ProductController extends Controller
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
    public function add_Product(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập


        return view('admin.add_Product');
    }
    //Gọi trang liệt kê
    public function all_Product(){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->get(); // câu lệnh sql
        $manager_product = view('admin.all_Product')->with('all_Product',$all_product);
        return view('admin_layout')->with('admin.all_Product',$manager_product);
    }
    //thêm sản phẩm mới
    public function save_Product (Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data =array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
        $data['slug_product'] = $request->product_slug;
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $product_price;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['price_cost'] =$price_cost;
        $data['price_promotion']= $request->price_promotion;
        $data['product_views']=0;
        $data['product_sold'] = $request->product_quantity;
        $data['brand_id'] = $request->product_brand;
        $data['category_id'] = $request->product_cate;
        $get_image = $request->file('product_image');
        $get_document = $request->file('document');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        $path_document = 'public/uploads/document/';
        if($get_image)
        {
            $get_name_image= $get_image->getClientOriginalName();  //lấy tên hình
            $name_image  =current(explode('.',$get_name_image)); // Phân Tách Chuỗi
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); //Lấy đuôi ảnh
            $get_image -> move($path,$new_image); //đưa vào thư mục
            File::copy($path.$new_image,$path_gallery.$new_image); //di chuyen anh tu product sang gallery
            $data['product_image'] = $new_image;

        }
        //them document
        if($get_document){
            $get_name_document = $get_document->getClientOriginalName();
            $name_document = current(explode('.',$get_name_document));
            $new_document =  $name_document.rand(0,99).'.'.$get_document->getClientOriginalExtension();
            $get_document->move($path_document,$new_document);
            $data['product_docs'] = $new_document;

        }
           $pro_id= DB::table('tbl_product')->insertGetId($data); //lây id
            $gallery= new Gallery();
            $gallery->gallery_image = $new_image;
            $gallery->gallery_name = $new_image;
            $gallery->product_id=$pro_id;
            $gallery->save();
            Toastr::success('Thêm Sản Phẩm thành công','Thông Báo');

             return redirect::to('all-Product');
    }

    public function unactive_Product($product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        DB::table('tbl_product')->where('product_id',$product_id) -> update(['product_status' => 1]);
        Toastr::success('Tắt Hiển Thị Sản Phẩm Thành Công','Thông báo');
        return redirect::to('all-Product');
    }

    public function active_Product($product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        DB::table('tbl_product')->where('product_id',$product_id) -> update(['product_status' => 0]);
        Toastr::success('Bật Hiển Thị Sản Phẩm Thành Công','Thông Báo');
        return redirect::to('all-Product');
    }
    //mở trang edit sản phẩm
    public function edit_Product($product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product= DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $edit_Product = DB::table('tbl_product')->where('product_id',$product_id) ->get();
       $manager_product = view('admin.edit_Product')->with('edit_Product',$edit_Product )->with('cate_product',$cate_product)->with('brand_product',$brand_product);
          return view('admin_layout')->with('admin.all-Product',$manager_product);
      }
      public function delete_Product(Request $request){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $pro = $request->product_id;
        $product = Product::find($pro)->first();
        $gallery = Gallery::where('product_id',$pro)->get();
        var_dump($gallery);
        $path_document = 'public/uploads/document/';
        if($product->product_docs != null)
        {
            unlink($path_document.$product->product_docs);
        }
        foreach($gallery as $ga)
        {
            $img = $ga->gallery_image;
        }
        unlink('public/uploads/gallery/'.$img);
        unlink('public/uploads/product/'.$product->product_image);
        DB::table('tbl_product')->where('product_id',$pro) -> delete();

      }
        //thực hiện lệnh update
      public function update_Product(Request $request,$product_id){
        $this->AuthLogin(); //không cho vào trang admin khi chưa đăng nhập
        $data =array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT); //lọc ký tự số
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $product_price;
        $data['product_tags'] = $request->product_tags;
        $data['price_cost'] =$price_cost;
        $data['price_promotion']= $request->price_promotion;
        $data['brand_id'] = $request->product_brand;
        $data['slug_product'] = $request->product_slug;
        $data['category_id'] = $request->product_cate;
        $get_image = $request->file('product_image');
        $get_document = $request->file('document');
        $path = 'public/uploads/product/';
        $path_document = 'public/uploads/document/';
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move($path,$new_image); //đưa vào thư mục
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Toastr::success('Cập nhật Sản Phẩm thành công','Thông Báo');
            return Redirect::to('all-Product');
        }
        //them document
        if($get_document){

            $get_name_document = $get_document->getClientOriginalName();
            $name_document = current(explode('.',$get_name_document));
            $new_document =  $name_document.rand(0,99).'.'.$get_document->getClientOriginalExtension();
            $get_document->move($path_document,$new_document);
            $data['product_docs'] = $new_document;

            //lay file old document
            $product = Product::find($product_id);
            if($get_image != $product->product_image){
                unlink($path.$product->product_image);
            }
        if($product->product_docs){
            unlink($path_document.$product->product_docs);
        }

}
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Toastr::success('Cập nhật Sản Phẩm thành công','Thông Báo');
         return redirect::to('all-Product');
      }

      public function delete_document(Request $request){
        //lay file old document
        $path_document = 'public/uploads/document/';
        $product = Product::find($request->product_id);
        unlink($path_document.$product->product_docs);
        $product->product_docs = '';
        $product->save();

    }
      // END PRODUCT BACK-END

      public function details_Product(Request $request, $slug_product){
        $cate_product = Category_product::where('category_status','0')->orderby('category_id','ASC')->get();
        $brand_product=Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        $slider = Slider::OrderBy('slider_id','DESC')->where('slider_status',0)->take(4)->get();
        $details_product = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.slug_product',$slug_product)->get();

        foreach($details_product as $key =>$value){
            $cate_slug= $value->slug_category;
            $product_cate = $value->category_name;
            $product_id = $value->product_id;
            $category_id = $value->category_id;
                //seo
                $meta_desc = $value->product_desc;
                $meta_keywords = $value->slug_product;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
                $image_og =url('public/uploads/product/'.$value->product_image);
        }
        $product = Product::where('product_id',$product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();
        $rating = Ratting::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
         $realated_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.slug_product',[$slug_product])->get(); // câu lệnh sql NotIn Trừ những sản phẩm đã xem
         
         $gallery = Gallery::where('product_id',$product_id)->take(3)->get();

         return view('pages.sanpham.show_details')->with('rating',$rating)->with('cate_slug',$cate_slug)->with('product_cate',$product_cate)->with('slider',$slider)->with('gallery',$gallery)->with('category_post',$category_post)->with('category',$cate_product)->with('brand',$brand_product)->with('deltais_product',$details_product)->with('realeted',$realated_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);

      }
    public function export_csv(){
        return Excel::download(new ExportsProduct, 'Product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ProductImport, $path);
        return back();
    }
    public function tag(Request $request, $product_tag){
         //category post
         $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get();


        $tag = str_replace("-"," ",$product_tag);
        $pro_tag = Product::where('product_status',0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orWhere('slug_product','LIKE','%'.$tag.'%')->get();
        $meta_desc = 'Tags tìm kiếm::'.$product_tag;
        $meta_keywords = 'Tags tìm kiếm:'.$product_tag;
        $meta_title = 'Tags tìm kiếm:'.$product_tag;
        $url_canonical = $request->url();


        return view('pages.sanpham.tag')->with('slider',$slider)->with('category_post',$category_post)->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);
    }
    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $gallery = Gallery::where('product_id',$product_id)->get();

        $output['product_gallery']='';
        foreach($gallery as $key => $gal){
            $output['product_gallery']= '<img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'">';
        }
        $price_promotion =$product->product_price*$product->price_promotion/100;
        $total_price = $product->product_price - $price_promotion;
     $output['product_name']=$product->product_name;
     $output['product_id']=$product->product_id;
     $output['product_price']=number_format($product->product_price,0,',','.').' VNĐ';
     $output['product_desc']=$product->product_desc;
     $output['product_content']=$product->product_content;
     $output['product_promotion']=number_format($total_price,0,',','.').' VNĐ';
     $output['product_image']='<img class="img-thumbnail" with="100%" src="public/uploads/product/'.$product->product_image.'">';

     $output['product_quickview_value'] = '

     <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">

     <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">

     <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">

     <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">

     <input type="hidden" value="'.$total_price.'" class="cart_product_price_'.$product->product_id.'">

     <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';

     echo json_encode($output); //chuyển thành dạnh json
    }
    public function reply_comment(Request $request){
        if(Session()->get('admin_name')){
            $name = Session()->get('admin_name');
        }else{
            $name = Auth::user()->admin_name;
        }
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = $name;
        $comment->save();

    }
    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }
    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',0)->limit(10)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= '
            <div class="row style_comment" style="position:relative;padding: 10px 10px;">

                                        <div class="col-md-2">
                                            <img width="100%" src="'.url('/public/frontend/images/icon/user.png').'" class="img img-responsive">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:green;">@'.$comm->comment_name.'</p>
                                            <p style="color:#000;">'.$comm->comment_date.'</p>
                                            <p>'.$comm->comment.'</p>

                                        </div>
                                        <div id="demo_'.$comm->comment_id.'"> </div>
                                        <button type="button" class=" addclass addclass_'.$comm->comment_id.' block" style="position: absolute; right: 1%;top: 16%;z-index: 1;background-color: #5456564f;" data-id_comment="'.$comm->comment_id.'" >Xem Câu Trả Lời</button>
                                        </div>

                                    ';
                                    foreach($comment_rep as $key => $rep_comment)  {
                                        if($rep_comment->comment_parent_comment==$comm->comment_id)  {
                                     $output.= ' <div class="row style_comment none rep_comment_'.$rep_comment->comment_parent_comment.'" style="margin:5px 40px;background: aquamarine;"" >

                                        <div class="col-md-2">
                                            <img width="80%" src="'.url('/public/frontend/images/icon/logo.PNG').'" class="img">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:blue;">@ '.$rep_comment->comment_name.'</p>
                                            <p style="color:#000;">'.$rep_comment->comment.'</p>
                                            <p></p>
                                        </div>
                                    </div><p></p>';
                                        }
                                    }
        }
        echo $output;

    }
    public function delete_comment($comment_id){
        Comment::where('comment_parent_comment',$comment_id)->delete();
        Comment::find($comment_id)->delete();
        Session()->put('message','Xoá Bình Luận Thành Công');
        return Redirect()->back();
    }
    public function delete_rep($comment_id){
        Comment::find($comment_id)->delete();
        Session()->put('message','Xoá Bình Luận Thành Công');
        return Redirect()->back();
    }


    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Ratting();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

  }
