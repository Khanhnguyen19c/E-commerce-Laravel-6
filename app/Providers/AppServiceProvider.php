<?php

namespace App\Providers;
use App\Product;
use App\Videos;
use App\Customer;
use App\Post;
use App\Order;
use App\Icons;
use App\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view) {
            //get information 
            $post_footer = Post::orderBy('post_id','ASC')->take(2)->get();
                //get information 
                 $video_footer = Videos::orderBy('video_id','ASC')->take(2)->get();
                //get information 
                $contact_footer = Contact::where('info_id',1)->get();
                //get icons social
                $icons = Icons::whereNull('category')->orderBy('icon_id','DESC')->get();
                //get icons doi tac
                $icons_doitac = Icons::where('category','doitac')->orderBy('icon_id','DESC')->get();

            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');

            $min_price_range = $min_price;
            $max_price_range = $max_price + 10000000;
            
            $product = Product::all()->count();
            $post = Post::all()->count();
            $order = Order::all()->count();
            $video = Videos::all()->count();
            $customer = Customer::all()->count();
            
            $brand_product = DB::table('tbl_product')->select(DB::raw("brand_name,slug_brand,slug_brand,tbl_brand_product.brand_id,COUNT(product_quantity) as total"))
            ->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('brand_status','0')
            ->orderBy('brand_desc','desc')
            ->groupBy(DB::raw("tbl_brand_product.brand_id"))
            ->get();
            $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
            $view->with('cate_product',$cate_product)->with('brand',$brand_product)->with('min_price', $min_price )->with('post_footer',$post_footer)->with('video_footer',$video_footer)->with('contact_footer',$contact_footer)->with('icons_doitac',$icons_doitac)->with('icons',$icons)->with('max_price', $max_price )->with('min_price_range', $min_price_range )->with('max_price_range', $max_price_range )->with('app_product', $product )->with('app_post', $post )->with('app_order', $order )->with('app_video', $video )->with('app_customer', $customer );

        });
    }
}
