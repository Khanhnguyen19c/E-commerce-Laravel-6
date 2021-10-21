<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//change langue
Route::get('lang/{loacale}', function ($locale) {
    if(! in_array($locale, ['vi','en','cn'] )) {
        abort(404); 
    }
    session()->put('locale',$locale);
    return Redirect()->back();
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/404','HomeController@erros_page');
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
//Thay đổi ngôn ngữ

//Danh Muc San Pham Trang Chu
Route::get('/danh-muc-san-pham/{slug_category}','CategoryProduct@show_category_home');
//Thuong Hieu San Pham
Route::get('/thuong-hieu-san-pham/{slug_brand}','BrandProduct@show_brand_home');
//danh mục bài viét
Route::get('/danh-muc-bai-viet/{post_slug}','PostController@danh_muc_tin_tuc');
//chi tiet bai viet
Route::get('/tin-tuc/{post_slug}','PostController@tin_tuc');
//Chi tiet san pham
Route::get('/chi-tiet-san-pham/{slug_product}', 'ProductController@details_Product' );
//Yêu Thích
Route::get('/yeu-thich', 'HomeController@yeu_thich' );
//Liên hệ
Route::get('/contact', 'ContactController@contact' );
Route::get('/info', 'ContactController@info' );
Route::get('/information','ContactController@information' );
Route::get('/list-nut','ContactController@list_nut' );
Route::get('/delete-icons','ContactController@delete_icons' );
Route::get('/list-doitac','ContactController@list_doitac' );

Route::post('/add-doitac','ContactController@add_doitac' );
Route::post('/add-nut','ContactController@add_nut' );
Route::post('/save-info','ContactController@save_info' );
Route::post('/update-info/{info_id}','ContactController@update_info' );
//xem nhanh sản phẩm
Route::post('/quickview','ProductController@quickview');
Route::get('/comment','ProductController@list_comment');
Route::post('/quickview','ProductController@quickview');
Route::post('/load-comment','ProductController@load_comment');
Route::post('/send-comment','ProductController@send_comment');
Route::post('/allow-comment','ProductController@allow_comment');
Route::post('/reply-comment','ProductController@reply_comment');
Route::post('/insert-rating','ProductController@insert_rating');
Route::get('/delete-comment/{comment_id}','ProductController@delete_comment');
Route::get('/delete-rep/{comment_id}','ProductController@delete_rep');
//BackEnd
Route::get('/admin', 'AdminController@index' );
Route::get('/dashboard', 'AdminController@show_dashboard' );
Route::get('/logout', 'AdminController@log_out' );
Route::post('/admin-dashboard', 'AdminController@dashboard' );
Route::post('/filter-by-date','AdminController@filter_by_date');

Route::get('/order-date','AdminController@order_date');
Route::post('/dashboard-filter','AdminController@dashboard_filter');
Route::post('/days-order','AdminController@days_order');
//tags
Route::get('/tag/{product_tag}','ProductController@tag');
//Category Product
//search ajax
Route::post('/autocomplete-ajax','HomeController@autocomplete_ajax');

Route::post('/product-tabs', 'CategoryProduct@product_tabs' );
Route::post('/export-csv','CategoryProduct@export_csv');
Route::post('/import-csv','CategoryProduct@import_csv');
Route::get('/add-CategoryProduct', 'CategoryProduct@add_categoryProduct' )->middleware('auth.roles');
Route::get('/all-CategoryProduct', 'CategoryProduct@all_categoryProduct' );
Route::post('/save-CategoryProduct', 'CategoryProduct@save_categoryProduct' )->middleware('auth.roles');
Route::get('/edit-CategoryProduct/{category_product_id}', 'CategoryProduct@edit_categoryProduct' )->middleware('auth.roles');
Route::post('/delete-CategoryProduct', 'CategoryProduct@delete_categoryProduct' )->middleware('auth.roles');
Route::get('/unactive-CategoryProduct/{category_product_id}', 'CategoryProduct@unactive_categoryProduct' );
Route::get('/active-CategoryProduct/{category_product_id}', 'CategoryProduct@active_categoryProduct' );
Route::post('/update-CategoryProduct/{category_product_id}', 'CategoryProduct@update_categoryProduct' )->middleware('auth.roles');
Route::post('/arrange-category', 'CategoryProduct@arrange_category' )->middleware('auth.roles'); //kéo thả sắp xếp
//Brand Product
Route::post('/arrange-brand', 'BrandProduct@arrange_brand' )->middleware('auth.roles'); //kéo thả sắp xếp
Route::post('/export-brand','BrandProduct@export_csv');
Route::post('/import-brand','BrandProduct@import_csv');
Route::get('/add-BrandProduct', 'BrandProduct@add_BrandProduct' )->middleware('auth.roles');
Route::get('/all-BrandProduct', 'BrandProduct@all_BrandProduct' );
Route::post('/save-BrandProduct', 'BrandProduct@save_BrandProduct' )->middleware('auth.roles');
Route::get('/edit-BrandProduct/{brand_id}', 'BrandProduct@edit_BrandProduct' )->middleware('auth.roles');
Route::post('/delete-BrandProduct', 'BrandProduct@delete_BrandProduct' )->middleware('auth.roles');
Route::get('/unactive-BrandProduct/{brand_id}', 'BrandProduct@unactive_BrandProduct' );
Route::get('/active-BrandProduct/{brand_id}', 'BrandProduct@active_BrandProduct' );
Route::post('/update-BrandProduct/{brand_id}', 'BrandProduct@update_BrandProduct' )->middleware('auth.roles');
//category_post
Route::get('/add-CategoryPost', 'CategoryPost@add_CategoryPost' )->middleware('auth.roles');
Route::get('/all-CategoryPost', 'CategoryPost@all_CategoryPost' );
Route::get('/edit-CategoryPost/{post_id}', 'CategoryPost@edit_CategoryPost' )->middleware('auth.roles');
Route::post('/save-CategoryPost', 'CategoryPost@save_CategoryPost' )->middleware('auth.roles');
Route::get('/delete-CategoryPost/{post_id}', 'CategoryPost@delete_CategoryPost' )->middleware('auth.roles');
Route::get('/unactive-CategoryPost/{post_id}', 'CategoryPost@unactive_CategoryPost' );
Route::get('/active-CategoryPost/{post_id}', 'CategoryPost@active_CategoryPost' );
Route::post('/update-CategoryPost/{post_id}', 'CategoryPost@update_CategoryPost' )->middleware('auth.roles');

//Post
Route::get('/add-Post', 'PostController@add_Post' )->middleware('auth.roles');
Route::get('/all-Post', 'PostController@all_Post' );
Route::get('/edit-post/{post_id}', 'PostController@edit_Post' )->middleware('auth.roles');
Route::post('/save-Post', 'PostController@save_Post' )->middleware('auth.roles');
Route::get('/delete-post/{post_id}', 'PostController@delete_Post' )->middleware('auth.roles');
Route::get('/unactive-post/{post_id}', 'PostController@unactive_Post' );
Route::get('/active-post/{post_id}', 'PostController@active_Post' );
Route::post('/update-post/{post_id}', 'PostController@update_Post' )->middleware('auth.roles');
//Product

Route::POST('/delete-document', 'ProductController@delete_document');
Route::get('/add-Product', 'ProductController@add_Product' )->middleware('auth.roles');
Route::get('/edit-Product/{product_id}', 'ProductController@edit_Product' )->middleware('auth.roles');
Route::get('/all-Product', 'ProductController@all_Product' );
Route::post('/export-product','ProductController@export_csv');
Route::post('/import-product','ProductController@import_csv');
Route::post('/save-Product', 'ProductController@save_Product' )->middleware('auth.roles');
Route::post('/delete-Product', 'ProductController@delete_Product' )->middleware('auth.roles');
Route::get('/unactive-Product/{product_id}', 'ProductController@unactive_Product' );
Route::get('/active-Product/{product_id}', 'ProductController@active_Product' );
Route::post('/update-Product/{product_id}', 'ProductController@update_Product' )->middleware('auth.roles');
//mã vận chuyển 
Route::get('/all-delivery', 'DeliveryController@all_delivery' )->middleware('auth.roles');
Route::post('/select-delivery', 'DeliveryController@select_delivery' )->middleware('auth.roles');
Route::post('/insert-delivery', 'DeliveryController@insert_delivery' )->middleware('auth.roles');
Route::post('/load-delivery', 'DeliveryController@load_delivery' )->middleware('auth.roles');
Route::post('/update-delivery', 'DeliveryController@update_delivery' )->middleware('auth.roles');
//mã giảm giá
Route::get('/unset-coupon', 'CouponController@unset_coupon' );
Route::post('/save-Coupon', 'CouponController@save_Coupon' );
Route::post('/check-coupon', 'CartController@check_coupon' );
Route::get('/add-coupon', 'CouponController@add_coupon' )->middleware('auth.roles');
Route::get('/all-coupon', 'CouponController@show_coupon' );
Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon' )->middleware('auth.roles');
Route::post('/select-delivery-home', 'CartController@select_delivery_home' );
Route::post('/delivery-fee', 'CartController@delivery_fee' );

//them vao gio hang
Route::get('/cart-quantity-delete/{session_id}', 'CartController@cart_quantity_delete' );
Route::post('/save-cart', 'CartController@save_cart' );
Route::post('/update-cart', 'CartController@update_cart' );
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax' );
Route::get('/show-cart','CartController@show_cart_menu'); 
Route::get('/hover-cart','CartController@hover_cart'); 
Route::get('/remove-item','CartController@remove_item'); 
Route::get('/gio-hang','CartController@gio_hang'); 
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart'); 
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity' );
Route::get('/delete-all-product','CartController@delete_all_product'); 
Route::get('/cart-session','CartController@cart_session'); 
Route::post('/load-more-product','HomeController@load_more_product'); 
Route::get('/show-quick-cart','CartController@show_quick_cart'); 
Route::post('/update-quick-cart','CartController@update_quick_cart'); 
Route::GET('/del-product/{session_id}','CartController@delete_product'); 
//check out
Route::get('/unset-delivery', 'CheckoutController@unset_delivery' );
Route::post('/check-coupon', 'CheckoutController@check_coupon' );
Route::get('/dang-nhap','CheckoutController@login_checkout'); 
Route::get('/logout-checkout','CheckoutController@logout_checkout'); 
Route::post('/add-customer','CheckoutController@add_customer'); 
Route::get('/check-out','CheckoutController@check_out'); 
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer'); 
Route::post('/login-customer','CheckoutController@login_customer'); 
Route::post('/confirm-order','CheckoutController@confirm_order'); 
//Dat hang
Route::post('/order-place','CheckoutController@order_place'); 
//quan ly don hang
Route::get('/manage-order','OrderController@manage_order'); 
 Route::get('/view-order/{order_code}','OrderController@view_order'); 
 Route::get('/print-order/{order_code}','OrderController@print_order'); 
 Route::post('/update-order-qty','OrderController@update_order_qty')->middleware('auth.roles');
 Route::post('/update-qty','OrderController@update_qty')->middleware('auth.roles');
 Route::get('/delete-order/{order_code}','OrderController@order_code')->middleware('auth.roles');
//send mail
//quen mat khau
Route::get('/quen-mat-khau','MailController@quen_mat_khau');
Route::get('/update-new-pass','MailController@update_new_pass');
Route::post('/recover-pass','MailController@recover_pass');
Route::post('/reset-new-pass','MailController@reset_new_pass');
//gui mail
Route::get('/mail-example','MailController@mail_example');
Route::get('/send-mail','HomeController@send_mail'); 
//Login facebook
Route::get('/login-facebook','LoginController@login_facebook');
Route::get('/admin/callback','LoginController@callback_facebook');
//Login google
Route::get('/login-google','LoginController@login_google');
Route::get('/google/callback','LoginController@callback_google');
//banner
Route::get('/manage-slider','BannerController@manage_slider');
Route::get('/add-slider','BannerController@add_slier')->middleware('auth.roles');
Route::post('/save-slider','BannerController@save_slider');
Route::get('/unactive-slider/{slider_id}', 'BannerController@unactive_slider' );
Route::get('/active-slider/{slider_id}', 'BannerController@active_slider' );
Route::get('/delete-slider/{slider_id}', 'BannerController@delete_slider' )->middleware('auth.roles');

//Authentication roleS
Route::post('/login', 'AuthController@login' );
Route::get('/logout-auth', 'AuthController@logout_auth' );
Route::get('/list-user', 'UserController@index' )->middleware('admin.roles');
Route::post('/assign-roles', 'UserController@assign_roles' )->middleware('auth.roles');
Route::get('/delete-user-roles/{admin_id}', 'UserController@delete_user_roles' );
Route::get('/add-user', 'UserController@add_user' )->middleware('admin.roles');
Route::post('/save-admin', 'UserController@save_admin' )->middleware('admin.roles');
Route::get('/impersonate/{admin_id}', 'UserController@impersonate' )->middleware('admin.roles');
Route::get('/impersonate-destroy', 'UserController@impersonate_destroy' );

//Gallery
Route::get('add-gallery/{product_id}','GalleryController@add_gallery')->middleware('auth.roles');
Route::post('select-gallery','GalleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','GalleryController@insert_gallery')->middleware('auth.roles');
Route::post('update-gallery-name','GalleryController@update_gallery_name')->middleware('auth.roles');
Route::post('delete-gallery','GalleryController@delete_gallery')->middleware('auth.roles');
Route::post('update-gallery','GalleryController@update_gallery')->middleware('auth.roles');
//Videos
Route::get('video','VideoController@video');
Route::get('video-shop','VideoController@video_shop');
Route::post('select-video','VideoController@select_video');
Route::post('insert-video','VideoController@insert_video')->middleware('auth.roles');
Route::post('update-video','VideoController@update_video')->middleware('auth.roles');
Route::post('delete-video','VideoController@delete_video')->middleware('auth.roles');
Route::post('update-video-image','VideoController@update_video_image')->middleware('auth.roles');
Route::post('watch-video','VideoController@watch_video');
// video front end

//Document
Route::get('upload_file','DocumentController@upload_file')->middleware('auth.roles');
Route::get('upload_image','DocumentController@upload_image')->middleware('auth.roles');
Route::get('upload_video','DocumentController@upload_video')->middleware('auth.roles');
Route::get('download_document/{path}/{name}','DocumentController@download_document')->middleware('auth.roles');
Route::get('create_document','DocumentController@create_document')->middleware('auth.roles');

Route::get('delete_document/{path}','DocumentController@delete_document')->middleware('auth.roles');
//Folder
Route::get('create_folder','DocumentController@create_folder')->middleware('auth.roles');
Route::get('rename_folder','DocumentController@rename_folder')->middleware('auth.roles');
Route::get('delete_folder','DocumentController@delete_folder')->middleware('auth.roles');
Route::get('list_document','DocumentController@list_document')->middleware('auth.roles');
Route::get('read_data','DocumentController@read_data');
//Send Mail Cho Khách Hàng
Route::get('/send-coupon-vip/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','MailController@send_coupon_vip')->middleware('auth.roles');
Route::get('/send-coupon/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','MailController@send_coupon')->middleware('auth.roles');

//login customer by google
Route::get('/login-customer-google','LoginController@login_customer_google');
Route::get('/customer/google/callback','LoginController@callback_customer_google');
Route::get('/login-facebook-customer','LoginController@login_facebook_customer');
Route::get('/customer/facebook/callback','LoginController@callback_facebook_customer');
//history

Route::get('/view-history-order/{order_code}','OrderController@view_history_order');
Route::get('/history','OrderController@history');
Route::post('/huy-don-hang','OrderController@huy_don_hang');

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});