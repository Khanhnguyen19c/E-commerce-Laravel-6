<?php

namespace App\Http\Controllers;

use App\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Coupon;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Category_Post;
use Carbon\Carbon;
use App\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

session_start();

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(Request $request)
    {
        $meta_desc = "Đăng Nhập Mua Hàng";
        $meta_keywords = "Shop Bán Quần Áo Online";
        $meta_title = "Trang Đăng Nhập Mua Hàng";
        $url_canonical = $request->url();
        $image_og =url('public/FontEnd/Images/blog/img_og.jpg');
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.login_checkout')->with('category_post',$category_post)->with('brand', $brand_product)->with('category', $cate_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('image_og', $image_og);
    }
    public function add_customer(Request $request)
    {
        $data = $request->all();
        $customer = new Customer();

        $customer->customer_name=$data['customer_name'];
        $customer->customer_email=$data['customer_email'];
        $customer->customer_phone=$data['customer_phone'];
        $customer->customer_password=md5($data['customer_password']);
        $customer->customer_vip=0;

        if($customer->customer_email == $data['customer_email']){
            return redirect()->back()->with('error','Email Đã được Sử dụng ');
        }else{
            $customer->save();
           $id_customer = $customer->customer_id;
            Session()->put('customer_id', $id_customer);
            Session()->put('customer_name', $data['customer_name']);
            Session()->put('fee');
            return Redirect::to('/check-out');
        }

    }
    public function check_out(Request $request)
    {
        $meta_desc = "Thanh Toán Khi Mua Hàng";
        $meta_keywords = "Shop Bán Quần Áo Online";
        $meta_title = "Trang Thanh Toán Mua Hàng";
        $image_og =url('public/FontEnd/Images/blog/img_og.jpg');
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $city = City::orderBy('matp', 'ASC')->get();
        return view('pages.checkout.show_checkout')->with('category_post',$category_post)->with('brand', $brand_product)->with('category', $cate_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('city', $city)->with('image_og', $image_og);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = New Shipping();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;
        $data->save();
         $shipping_id= $data->shipping_id;
        Session()->put('shipping_id', $shipping_id);
        return Redirect::to('/show_checkout');
    }
    //đăng xuất huỷ biến session
    public function logout_checkout()
    {
        Session()->flush();
        return Redirect::To('dang-nhap');
    }
    public function login_customer(Request $request)
    {
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
        $result = DB::table('tbl_customer')->where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();

        if ($result) {
            Session()->put('customer_id', $result->customer_id);
            session()->put('customer_name',$result->customer_name);
            return redirect::to('/gio-hang');
        } else {
            Session()->put('message', '*Mật Khẩu Hoặc Tài Khoản Bị Sai.Vui Lòng Kiểm Tra Lại');
            return redirect::to('/dang-nhap');
        }
    }

    public function check_coupon(Request $request){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d');
        $data = $request->all();
        if(Session()->get('customer_id')){
           $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->where('coupon_used','LIKE','%'.Session()->get('customer_id').'%')->first();
           if($coupon){
            return redirect()->back()->with('error','Mã giảm giá đã sử dụng,vui lòng nhập mã khác');
            }else{
           $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->where('coupon_time','>',0)->first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon>0){
                        $coupon_session = Session()->get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable==0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,

                                );
                                Session()->put('coupon',$cou);
                            }
                        }else{
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,

                            );
                            Session()->put('coupon',$cou);
                        }
                        Session()->save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                    }


                }else{
                    return redirect()->back()->with('error','Mã giảm giá không đúng - hoặc đã hết hạn');
                }
        }
    }

    }
    public function unset_delivery()
    {
        Session()->forget('fee');
        return redirect()->back()->with('message', 'Xoá Mã Thành Công');
    }
    public function confirm_order(Request $request){
        $data = $request->all();
        $coupon_number=0;
         //get coupon
         if($data['order_coupon']!='no'){
          $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
          $coupon->coupon_used = $coupon->coupon_used.','.Session()->get('customer_id');
          $coupon->coupon_time = $coupon->coupon_time - 1;
          $coupon_mail = $coupon->coupon_code;
          $coupon->save();
         }else{
           $coupon_mail = 'không có sử dụng';
         }
        //get van chuyen
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

         //get order
        $order = new Order;
        $order->customer_id = Session()->get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');;
        $order->created_at = $today;
        $order->order_date = $order_date;
        $order->save();


        if(Session()->get('cart')==true){
         foreach(Session()->get('cart') as $key => $cart){
           $order_details = new OrderDetails;
           $order_details->order_code = $checkout_code;
           $order_details->product_id = $cart['product_id'];
           $order_details->product_name = $cart['product_name'];
           $order_details->product_price = $cart['product_price'];
           $order_details->product_save_quantity = $cart['product_qty'];
           $order_details->product_coupon =  $data['order_coupon'];
           $order_details->product_feeship = $data['order_fee'];
           $order_details->save();
         }
       }
       //send mail confirm
       $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

       $title_mail = "Đơn hàng xác nhận ngày".' '.$now;

       $customer = Customer::find(Session()->get('customer_id'));

       $data['email'][] = $customer->customer_email;
       //lay gio hang
       if(Session()->get('cart')==true){

         foreach(Session()->get('cart') as $key => $cart_mail){
            if($data['order_coupon']!='no'){
                if($coupon->coupon_condition==1){
                    $coupon_number = ($coupon->coupon_number * $cart_mail['product_price'])/100;
                }else{
                    $coupon_number =  $coupon->coupon_number;
                }
            }else{
                $coupon_number =0;
            }

           $cart_array[] = array(
             'product_name' => $cart_mail['product_name'],
             'product_price' => $cart_mail['product_price'],
             'product_qty' => $cart_mail['product_qty'],
             'coupon_number'=> $coupon_number
           );

         }

       }
       //lay shipping
       if(Session()->get('fee')==true){
         $fee = Session()->get('fee');
       }else{
         $fee = '25000';
       }

       $shipping_array = array(
         'fee' =>  $fee,
         'customer_name' => $customer->customer_name,
         'shipping_name' => $data['shipping_name'],
         'shipping_email' => $data['shipping_email'],
         'shipping_phone' => $data['shipping_phone'],
         'shipping_address' => $data['shipping_address'],
         'shipping_notes' => $data['shipping_notes'],
         'shipping_method' => $data['shipping_method']

       );
       //lay ma giam gia, lay coupon code
       $ordercode_mail = array(
         'coupon_code' => $coupon_mail,
         'order_code' => $checkout_code,
       );
     //send mail khách hàng
       Mail::send('pages.mail.mail_order',  ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array ,'code'=>$ordercode_mail] , function($message) use ($title_mail,$data){
           $message->to($data['email'])->subject($title_mail);//send this mail with subject
           $message->from($data['email'],$title_mail);//send from this mail
       });
       Session()->forget('coupon');
       Session()->forget('fee');
       Session()->forget('cart');
    }
}
