<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Slider;
use App\Category_Post;
use App\Category_product;
use App\Icons;
use App\Product;
use Carbon\Carbon;
use App\Visitors;
use App\Brand;
use Symfony\Component\VarDumper\VarDumper;

session_start();
class HomeController extends Controller
{
    public function erros_page()
    {
        return view('erros.404');
    }
    public function index(Request $request)
    {
        // START SEO
        $meta_desc = "K-Shopper Shop Quần Áo Thời Trang Nam Nữ Đẹp Tp.HCM. Chuyên Các Dòng Áo Khoác, Quần Áo Nam Nữ Đẹp Được Ưa Chuộng Của Giới Trẻ.";
        $meta_keywords = "Shop Phụ Kiện Pc Online";
        $meta_title = "Home | K-Shopper";
        $url_canonical = $request->url();
        $image_og = url('public/FontEnd/Images/blog/img_og.jpg');
        //END SEO
        //category post
        $category_post = Category_Post::orderBy('category_post_id', 'DESC')->get();
        $slider = Slider::OrderBy('slider_id', 'DESC')->where('slider_status', 0)->take(4)->get();
        $cate_product = Category_product::where('category_status', '0')->orderBy('category_order', 'ASC')->get();
        // SELECT brand.brand_id,brand.brand_name,COUNT(product.product_id) AS total FROM tbl_product product INNER JOIN tbl_brand_product brand ON product.brand_id =brand.brand_id GROUP BY brand.brand_id;
        $brand_product = DB::table('tbl_product')->select(DB::raw("brand_name,slug_brand,COUNT(product_quantity) as total"))
            ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')->where('brand_status', '0')
            ->orderBy('brand_desc', 'desc')
            ->groupBy(DB::raw("tbl_brand_product.brand_id"))
            ->get();
        $icons = Icons::whereNull('category')->orderBy('icon_id')->get();
        $all_product = Product::where('product_status', '0')->orderby('product_id', 'desc')->paginate(6);
        return view('pages.home')->with('icons', $icons)->with('category', $cate_product)->with('brand', $brand_product)->with('category_post', $category_post)->with('slider', $slider)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('image_og', $image_og)->with('all_product', $all_product);
    }
    public function search(Request $request)
    {
        $meta_desc = "Tìm Kiếm Sản Phẩm";
        $meta_keywords = "Shop Phụ Kiện PC Online";
        $meta_title = "Home | K-Shopper";
        $image_og = '';
        $url_canonical = $request->url();
        $keywords = $request->keywords_submit;
        $category_post = Category_Post::orderBy('category_post_id', 'DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();
        return view('pages.sanpham.search')->with('category_post', $category_post)->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('image_og', $image_og);
    }
    //send mail
    public function send_mail()
    {
        //send mail
        $to_name = "Khanh Nguyen";
        $to_email = "khanhlunn224@gmail.com"; //send to this email

        $data = array("name" => "Mail Từ Tài Khoản Của Khách Hàng", "body" => "Mail Gửi Về Vấn Đề hàng hoá"); //body of mail.blade.php

        Mail::send('pages.send_mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('test mail nhé'); //send this mail with subject
            $message->from($to_email, $to_name); //send from this mail
        });
        //--send mail
        return Redirect('/')->with('message', '');
    }
    public function autocomplete_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {

            $product = Product::where('product_status', 0)->where('product_name', 'LIKE', '%' . $data['query'] . '%')->get();

            $output = '
            <ul class="dropdown-menu" style="margin-left: 40px;
            display: block;
            margin-top: 5px;">';

            foreach ($product as $key => $val) {
                $output .= '
             <li class="li_search_ajax"><a href="#">' . $val->product_name . '</a></li>
             ';
            }

            $output .= '</ul>';
            echo $output;
        }
    }
    public function yeu_thich(Request $request)
    {
        //category post
        $category_post = Category_Post::orderBy('category_post_id', 'DESC')->get();

        //slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        //seo
        $meta_desc = "Yêu thích";
        $meta_keywords = "Yêu thích";
        $meta_title = "Yêu thích";
        $url_canonical = $request->url();
        //--seo

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_parent', 'desc')->orderby('category_order', 'ASC')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status', '0')->orderByRaw('RAND()')->paginate(6);

        return view('pages.yeuthich.yeuthich')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider', $slider)->with('category_post', $category_post); //1

    }
    public function load_more_product(Request $request)
    {

        $data = $request->all();

        if ($data['id'] > 0) {
            $all_product = Product::where('product_status', '0')->where('product_id', '<', $data['id'])->orderby('product_id', 'DESC')->take(6)->get();
        } else {
            $all_product = Product::where('product_status', '0')->orderby('product_id', 'DESC')->take(6)->get();
        }

        $output = '';
        if (!$all_product->isEmpty()) {
            foreach ($all_product as $key => $pro) {
                $last_id = $pro->product_id;
                $price_promotion =$pro->product_price*$pro->price_promotion/100;
				$total_price = $pro->product_price - $price_promotion;
                $output .= '<div class="col-sm-4">
            <div class="product-image-wrapper">

            <div class="single-products">
            <div class="productinfo text-center">
            <div >
            <span class="promotion_title">'.number_format($pro->product_price,0,',','.').' VNĐ</span>
            <span class="promotion">-'.$pro->price_promotion.'%</span>

                 </div>

            <input type="hidden" value="' . $pro->product_id . '" class="cart_product_id_' . $pro->product_id . '">

            <input type="hidden" class="cart_product_name_'.$pro->product_id . '" id="wishlist_productname' . $pro->product_id . '" value="' . $pro->product_name . '" >

            <input type="hidden" value="' . $pro->product_quantity . '" class="cart_product_quantity_' . $pro->product_id . '">

            <input type="hidden" value="' . $pro->product_image . '" class="cart_product_image_' . $pro->product_id . '">

            <input type="hidden" id="wishlist_productprice' . $pro->product_id . '" value="' . number_format($total_price, 0, ',', '.') . ' VNĐ">


            <input type="hidden" value="' . $total_price . '" class="cart_product_price_' . $pro->product_id . '">

            <input type="hidden" value="1" class="cart_product_qty_' . $pro->product_id . '">

            <a id="wishlist_producturl' . $pro->product_id . '"  href="' . url('chi-tiet-san-pham/' . $pro->slug_product) . '">


            <img id="wishlist_productimage' . $pro->product_id . '" src="' . url('public/uploads/product/' . $pro->product_image) . '" alt="' . $pro->product_name . '" />

            <h2>Giá bán: ' . number_format($total_price, 0, ',', '.') . ' VNĐ</h2>
            <p>' . $pro->product_name . '</p>

            </a>

            <div class="product-overlay">
            <div class="overlay-content">
            <h2>' . number_format($total_price, 0, ',', '.') . ' VNĐ</h2>
               '. $pro->product_desc . '
                <button class="btn btn-default cart-add home_cart_' . $pro->product_id . '" id="' . $pro->product_id . '" onclick="Addtocart(this.id);"><i class="fa fa-shopping-cart"></i> ' . __('lang.themgiohang') . '</button>
                <button style="display:none" class="btn btn-danger del-cart rm_home_cart_' . $pro->product_id . '" id="' . $pro->product_id . '" onclick="Deletecart(this.id);"><i class="fa fa-shopping-cart"></i>  ' . __('lang.xoagiohang') . '</button>
                <input style="margin-left:0px;margin-bottom:30px"  type="button" data-toggle="modal" data-target="#xemnhanh" onclick="XemNhanh(this.id);"  value=" '  . __('lang.xemnhanh') . '"  class="btn btn-default watch-sp" id="' . $pro->product_id . '" name="add-to-cart">
                </div>
        </div>




            </div>

            </div>

            <div class="choose">
            <ul class="nav nav-pills nav-justified">


            <li>



            <button class="button_wishlist" id="' . $pro->product_id . '" onclick="add_wistlist(this.id);"><span><i class="fa fa-star" aria-hidden="true"></i> ' . __('lang.themyeuthich') . '</span></button>

            </li>

            <li ><a style="cursor: pointer;" onclick="add_compare(' . $pro->product_id . ')" ><i class="fa fa-plus-square"></i> ' . __('lang.themsosanh') . '</a></li>

            </ul>

            </div>
            <a href="'.url('chi-tiet-san-pham/'.$pro->slug_product).'"> <button style="float: right;
            margin-top: 5px;" type="button" class="btn btn-default watch-sp"><i class="fa fa-info-circle"></i> '  . __('lang.xemchitiet') . '</button> </a>
            </div>
            </div>';
            }
            $output .= '
            <div id="load_more">
                <button type="button" name="load_more_button" style="margin:40px;" class="btn btn-primary form-control" data-id="' . $last_id . '" id="load_more_button"> ' . __('lang.load') . '
                </button>
            </div>
        ';
        } else {
            $output .= '
            <div id="load_more">
                <button type="button" name="load_more_button" style="margin:40px;" class="btn btn-default form-control">Dữ liệu đang cập nhật thêm...
                </button>
            </div>
        ';
        }
        echo $output;
    }
}
