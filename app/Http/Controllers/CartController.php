<?php

namespace App\Http\Controllers;

use App\Brand;
use App\User;
USE Symfony\Component\HttpFoundation\Session\Session;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Category_product;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Category_Post;
use App\Coupon;
use Carbon\Carbon;
session_start();
class CartController extends Controller
{
   
    
   public function add_cart_ajax(Request $request){
    $data = $request->all();
    $session_id = substr(md5(microtime()),rand(0,26),5);
    $cart = Session()->get('cart');
    if($cart==true){
        $is_avaiable = 0;
        foreach($cart as $key => $val){
            if($val['product_id']==$data['cart_product_id']){
                $is_avaiable++;
            }
        }
        if($is_avaiable == 0){
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_quantity' => $data['cart_product_quantity'],
            );
        }
        Session()->put('cart',$cart);
    }
    else{
        $cart[] = array(
            'session_id' => $session_id,
            'product_name' => $data['cart_product_name'],
            'product_id' => $data['cart_product_id'],
            'product_image' => $data['cart_product_image'],
            'product_qty' => $data['cart_product_qty'],
            'product_price' => $data['cart_product_price'],
            'product_quantity' => $data['cart_product_quantity'],
            // $data['cart_product_qty']= $data['cart_product_qty'] + $data['cart_product_qty'];  
            // $data['cart_product_price'] = $data['cart_product_price'] + $data['cart_product_price'];
        );
        Session()->put('cart',$cart);
    }
    Session()->save();
}   

   public function gio_hang(Request $request){
    $meta_desc = "Trang Mua H??ng";
    $meta_keywords = "Shop B??n Qu???n ??o Online";
    $meta_title ="Gi??? H??ng C???a B???n";
    $url_canonical =$request->url();
    $image_og =url('public/FontEnd/Images/blog/img_og.jpg');
    $city = City::orderBy('matp','ASC')->get();
    $category_post = Category_Post::orderBy('category_post_id','DESC')->get();
    $cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();
    $brand_product= Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
    return view('pages.cart.show_cart-ajax')->with('category_post',$category_post)->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('image_og', $image_og);
}
public function cart_quantity_delete($session_id){
    $cart =Session()->get('cart');
    if($cart==true){
        foreach($cart as $key =>$val){
            if($val['session_id']==$session_id){
                unset($cart[$key]); //xoa $cart theo ID
            }
        }
        Session()->put('cart',$cart);
        return redirect()->back()->with('message','Xo?? S???n Ph???m Th??nh C??ng');
    }else{
        return redirect()->back()->with('message','Xo?? S???n Ph???m Th???t B???i');
    }
}
public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session()->get('cart');
        if($cart==true){
            $message = '';
    
            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
    
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
    
                    $cart[$session]['product_qty'] = $qty;

                }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                    $message.='C???p nh???t s??? l?????ng : '.$cart[$session]['product_name'].' th???t b???i';
                }

            }

        }

        Session()->put('cart',$cart);
        return redirect()->back()->with('message','C???p nh???t s??? l?????ng Th??nh C??ng');
    }else{
        return redirect()->back()->with('message','C???p nh???t s??? l?????ng th???t b???i');
    }
}
public function delete_all_product(){
    $cart = Session()->get('cart');
    if($cart==true){
        Session()->forget('cart');
        Session()->forget('coupon');
    }
    $cart = Session()->put('cart');
    return redirect()->back()->with('message','X??a h???t gi??? th??nh c??ng');
}

public function select_delivery_home(Request $request){
    $data = $request->all();
    if($data['action']){
        $output = '';
        if($data['action']=="city"){
            $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output.='<option>---Ch???n qu???n huy???n---</option>';
            foreach($select_province as $key => $province){
                $output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
            }

        }else{
            $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
            $output.='<option>---Ch???n x?? ph?????ng---</option>';
            foreach($select_wards as $key => $ward){
                $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
            }
        }
        echo $output;
    }
}
public function delivery_fee(Request $request){
    $data=$request->all();
    Session()->put('fee');
    if($data['matp']){
        $feeship =Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
        if($feeship){
            $count_feeship=$feeship->count();
            if($count_feeship>0){
                foreach($feeship as $key=>$val){
                    Session()->put('fee',$val->fee_feeship);
                    Session()->save();
                    }
             }else{
                Session()->put('fee',25000);
                    Session()->save();
            }
        }
       
        }
    }
    public function show_cart_menu(){
        $cart = Count(Session()->get('cart'));
        $output='';
        if($cart > 0 or $cart == Null){
            $output.='<span class="badges">'.$cart.'</span>';
        }else{
            $output.='<span class="badges"> 0 </span>';
            
        }
        echo $output;
    }
    public function remove_item(Request $request){
        $data = $request->all();
        $cart = Session()->get('cart');
           
        if($cart==true){
    
            foreach($cart as $key => $val){
                if($val['product_id']==$data['id']){
                    unset($cart[$key]);
                }
            }
            
            Session()->put('cart',$cart);
        
        }
    }
    public function cart_session(){
        $output ='';
        if(Session()->get('cart')==true){
            foreach(Session()->get('cart') as $key => $value){
                $output.= '<input type="hidden" class="cart_id" value="'.$value['product_id'].'">';
            }
        }
        echo $output;
    }
    public function show_quick_cart(){
        $output ='';
        $output.=' <table class="table table-condensed" >
        <thead>
            <tr class="cart_menu">
                <td class="image"style="width: 17%;">H??nh ???nh</td>
                <td class="description">T??n s???n ph???m</td>
                <td class="price">Gi?? s???n ph???m</td>
                <td class="quantity">S??? l?????ng</td>
                <td class="total">Th??nh ti???n</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>';

    if(Session()->get('cart')==true)
    {
                $total = 0;
                $subtotal =0;
           
    
        foreach(Session()->get('cart') as $key => $cart)
        {
                $subtotal = $cart['product_price']*$cart['product_qty'];
                $total+=$subtotal;
                
            
          
           $output .=' <tr style="paading:5px">
           <td class="">
               <img src="'.url('public/uploads/product/'.$cart['product_image']).'" width="100%" alt="'.$cart['product_name'].'" />
           </td>
           <td class="cart_description">
               <h4><a href=""></a></h4>
               <p>'.$cart['product_name'].'</p>
           </td>
           <td class="cart_price">
               <p>'.number_format($cart['product_price'],0,',','.').' VN??</p>
           </td>
           <td class="cart_quantity">
               <div class="cart_quantity_button">
               
               <input class="cart_qty_update" type="number" data-session_id="'.$cart['session_id'].'" min="1" value="'.$cart['product_qty'].'" >
            <style>
            .cart_qty_update{
               width: 60px;
               height: 30px;
               text-align: center;
               font-size: 18px;}
                .cart_price{
               width: 120px;}
               </style>
                   
               </div>
           </td>
           <td class="cart_total">
               <p class="cart_total_price">
                   '.number_format($subtotal,0,',','.').' VN??

               </p>
           </td>
           <td class="cart_delete">
           <a class="cart_quantity_delete" style="cursor:pointer" id="'.$cart['session_id'].'" onclick="DeleteItemCart(this.id)">
           <i class="fa fa-times"></i>
       </a>
           </td></tr>';
        }
       $output .=' </tbody>
       
        </form>
    </table>
    <a class="btn btn-default check_out" href="'.url('/delete-all-product').'">Xo?? T???t C??? S???n Ph???m</a>';
   
        $customer_id = Session()->get('customer_id');
        if ($customer_id != NULL ) {   
            $output .='<a style="float: right;" class="btn btn-default check_out" href="'.url('/check-out').'">Thanh to??n</a>';
       }else{
        $output .='<a style="float: right;" class="btn btn-default check_out" href="'.url('/dang-nhap').'">Thanh to??n</a>
        </div>
        </section>';
        }
 
    }else{
       $output .='<th colspan="4" style="text-align: center;">*Vui l??ng th??m s???n ph???m v??o gi??? h??ng</td>
       </table>
       </div>
       </section>';
   }
   echo $output;
    }
    public function delete_product($session_id){
        $cart = Session()->get('cart');
            // echo '<pre>';
            // print_r($cart);
            // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session()->put('cart',$cart);
            return redirect()->back()->with('message','X??a s???n ph???m th??nh c??ng');
    
        }else{
            return redirect()->back()->with('message','X??a s???n ph???m th???t b???i');
        }
    
    }
    public function update_quick_cart(Request $request){

        $data = $request->all();
        $cart = Session()->get('cart');
        if($cart==true){
    
                foreach($cart as $session => $val){
    
                    if($val['session_id']==$data['session_id']){
                        $cart[$session]['product_qty'] = $data['quantity'];
                    }
                }
    
            Session()->put('cart',$cart);
           echo "C???p Nh???t Gi??? H??ng Th??nh C??ng";
        }
    }
}
