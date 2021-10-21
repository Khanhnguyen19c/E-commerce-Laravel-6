<?php

namespace App\Http\Controllers;
use App\Social; //sử dụng model Social
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;//sử dụng Socialite
use App\Login; //sử dụng model Login
use App\Customer;
use Toastr;
use Laravel\Socialite\Contracts\User;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\SocialCustomers;
session_start();
class LoginController extends Controller
{

    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateUser($users,'google');
        if($authUser){
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session()->put('admin_name',$account_name->admin_name);
            Session()->put('login_normal',true);
            Session()->put('admin_id',$account_name->admin_id);
        }elseif($customer_new){
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session()->put('admin_name',$account_name->admin_name);
            Session()->put('login_normal',true);
            Session()->put('admin_id',$account_name->admin_id);
        }

        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }
    public function findOrCreateUser($users, $provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $orang = Login::where('admin_email',$users->email)->first();

            if(!$orang){

                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_phone' => '',
                    'admin_status' => 1

                ]);
            }

            $customer_new->login()->associate($orang);

            $customer_new->save();
            return $customer_new;
        }

    }
    public function login_customer_google(){
        config( ['services.google.redirect' => env('GOOGLE_CLIENT_URL')] );
        return Socialite::driver('google')->redirect();
    }
    public function callback_customer_google(){

        config( ['services.google.redirect' => env('GOOGLE_CLIENT_URL')] );

        $users = Socialite::driver('google')->stateless()->user();

        $authUser = $this->findOrCreateCustomer($users, 'google');

        if($authUser){
            $account_name = Customer::where('customer_id',$authUser->user)->first();
            Session()->put('customer_id',$account_name->customer_id);
            Session()->put('customer_picture',$account_name->customer_picture);
            Session()->put('customer_name',$account_name->customer_name);

        }elseif($customer_new){
            $account_name = Customer::where('customer_id',$authUser->user)->first();
            Session()->put('customer_id',$account_name->customer_id);
            Session()->put('customer_picture',$account_name->customer_picture);
            Session()->put('customer_name',$account_name->customer_name);
        }

        return redirect('/dang-nhap')->with('message', 'Đăng nhập bằng tài khoản google <span style="color:red">'.$account_name->customer_email.'</span> thành công');
    }
    public function findOrCreateCustomer($users, $provider){
        $authUser = SocialCustomers::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{
            $customer_new = new SocialCustomers([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $customer = Customer::where('customer_email',$users->email)->first();

            if(!$customer){

                $customer = Customer::create([
                    'customer_name' => $users->name,
                    'customer_picture' => $users->avatar,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }

            $customer_new->customer()->associate($customer);

            $customer_new->save();
            return $customer_new;
        }

    }
    public function login_facebook_customer(){
        config( ['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')] );
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook_customer(){
        config( ['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')] );
        $provider = Socialite::driver('facebook')->user();

        $account = SocialCustomers::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

        if($account!=NULL){
           $account_name = Customer::where('customer_id',$account->user)->first();
           Session()->put('customer_id',$account_name->customer_id);
           Session()->put('customer_name',$account_name->customer_name);
           return redirect('/dang-nhap')->with('message', 'Đăng nhập bằng tài khoản facebook <span style="color:red">'.$account_name->customer_email.'</span> thành công');

       }elseif($account==NULL){
           $customer_login = new SocialCustomers([
            'provider_user_id' => $provider->getId(),
            'provider_user_email' => $provider->getEmail(),
            'provider' => 'facebook'
            ]);

           $customer = Customer::where('customer_email',$provider->getEmail())->first();

           if(!$customer){
            $customer = Customer::create([
                'customer_name' => $provider->getName(),
                'customer_email' => $provider->getEmail(),
                'customer_picture' => '',
                'customer_password' => '',
                'customer_phone' => ''
            ]);
        }
        $customer_login->customer()->associate($customer);
        $customer_login->save();

        $account_new = Customer::where('customer_id',$customer_login->user)->first();
        Session()->put('customer_id',$account_new->customer_id);
        Session()->put('customer_name',$account_new->customer_name);


        return redirect('/dang-nhap')->with('message', 'Đăng nhập bằng tài khoản facebook <span style="color:red">'.$account_new->customer_email.'</span> thành công');


    }



}
public function login_facebook(){

    return Socialite::driver('facebook')->redirect();
}

public function callback_facebook(){

    $provider = Socialite::driver('facebook')->user();
    $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

    if($account!=NULL){

        $account_name = Login::where('admin_id',$account->user)->first();
        Session()->put('admin_name',$account_name->admin_name);
        Session()->put('login_normal',true);
        Session()->put('admin_id',$account_name->admin_id);
        Toastr::success('Đăng Nhập Admin Thành Công','Thông báo');
        return redirect('/dashboard');

    }elseif($account==NULL){

        $admin_login = new Social([
            'provider_user_id' => $provider->getId(),
            'provider_user_email' => $provider->getEmail(),
            'provider' => 'facebook'
        ]);

        $orang = Login::where('admin_email',$provider->getEmail())->first();

        if(!$orang){
            $orang = Login::create([
                'admin_name' => $provider->getName(),
                'admin_email' => $provider->getEmail(),
                'admin_password' => '',
                'admin_phone' => ''

            ]);
        }
        $admin_login->login()->associate($orang);
        $admin_login->save();

        $account_name = Login::where('admin_id',$admin_login->user)->first();
        Session()->put('admin_name',$admin_login->admin_name);
        Session()->put('login_normal',true);
        Session()->put('admin_id',$admin_login->admin_id);
        Toastr::success('Đăng Nhập Admin Thành Công','Thông báo');
        return redirect('/dashboard');

    }


}

}
