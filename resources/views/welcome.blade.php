<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$meta_title}}</title>
    <!-- SEO -->
    <link rel="canonical" href="{{$url_canonical}}" />
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="{{asset('public/FrontEnd/Images/icon/logo.png')}}" />

    <!------------Share fb------------------>
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="articles" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:site_name" content="{{$meta_title}}" />
    <meta property="og:description" content="{{$meta_desc}}" />

    <!--//-------Seo--------->
    <!-- //SEO -->
    <link href="{{asset('public/FrontEnd/CSS/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/vlite.css')}}" rel="stylesheet">
    <link href="{{asset('public/FrontEnd/CSS/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('public/FrontEnd/CSS/owl.theme.default.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<!--/head-->

<body onload="load()" class="preloading">
    <!-- <div class="preloader"></div>
    <script>
        $(window).on('load', function(event) {
            $('body').removeClass('preloading');
            // $('.load').delay(1000).fadeOut('fast');
            $('.preloader').fadeOut('fast');
        });
    </script> -->
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="tel:0772879116"><i class="fa fa-phone"></i> +84 77 287 79 116</a></li>
                                <li><a href="mailto:khanhlunn224@gmail.com"><i class="fa fa-envelope"></i> khanhlunn224@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">

                            <ul class="nav navbar-nav">


                                <li class="cart-hover"><a href="{{url('gio-hang')}}"><i class="fa fa-shopping-cart" style="font-size:20px"></i>
                                        @lang('lang.giohang')

                                        <span class="show-cart"></span>

                                        <div class="clearfix"></div>




                                    </a>

                                </li>

                                @php
                                $customer_id = Session::get('customer_id');
                                if($customer_id!=NULL){
                                @endphp

                                <li>
                                    <a href="{{URL::to('history')}}"><i class="fa fa-bell"></i> @lang('lang.lichsu') </a>

                                </li>


                                @php
                                }
                                @endphp

                                <?php
                                $customer_id = Session()->get('customer_id');
                                if ($customer_id != NULL) {
                                ?>

                                    <li>
                                        <a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> {{__('lang.logout')}} : </a>

                                        <img width="15%" src="{{Session::get('customer_picture')}}"> {{Session::get('customer_name')}}

                                    </li>


                                <?php
                                } else {
                                ?>
                                    <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> {{__('lang.login')}}</a></li>
                                <?php
                                }
                                ?>


                            </ul>
                        </div>
                    </div>

                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                @foreach ($icons as $key=>$icon )
                                <li><a target="_blank" title="{{$icon->name}}" href="{{$icon->icon_link}}">
                                        <img style="width:50px;height:50px;margin:2px;" src="{{asset('public/FrontEnd/Images/icon/'.$icon->icon_image)}}" alt="{{$icon->name}}">
                                    </a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4" style="border:none;box-shadow:none;min-height:auto;">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/Trang-chu')}}"><img src="{{asset('./public/frontend/images/home/LOGO1.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">



                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom" id="navbar">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">

                                <li><a href="{{URL::to('/trang-chu')}}" class="active">@lang('lang.home')</a></li>
                                <li class="dropdown"><a href="#">{{__('lang.product')}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key => $cate)
                                        @if($cate->category_parent==0)
                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category)}}">{{$cate->category_name}}</a></li>
                                        @foreach($category as $key => $cate_sub)

                                        @if($cate_sub->category_parent==$cate->category_id)
                                        <ul class="cate_sub">
                                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->slug_category)}}">{{$cate_sub->category_name}}</a></li>
                                        </ul>
                                        @endif

                                        @endforeach
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="dropdown"><a href="#">{{__('lang.tintuc')}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category_post as $key => $danhmucbaiviet)
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->category_post_slug)}}">{{$danhmucbaiviet->category_post_name}}</a></li>
                                        @endforeach

                                    </ul>
                                </li>

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart" style="font-size:20px"></i> {{__('lang.giohang')}}

                                        <span class="show-cart"></span>

                                    </a>

                                </li>
                                <li><a href="{{URL::to('/video-shop')}}">{{__('lang.videos')}}</a></li>
                                <li><a href="{{URL::to('/contact')}}">{{__('lang.contact')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST">
                            {{csrf_field()}}
                            <div class="search_box">

                                <input type="text" style="width: 55%;margin-right: 5px" name="keywords_submit" id="keywords" placeholder="{{__('lang.timkiemsanpham')}}" />
                                <div id="search_ajax"></div>

                                <input type="submit" style="margin-top:0;color:#fff" name="search_items" class="btn btn-primary btn-sm" value="{{__('lang.timkiem')}}">
                                <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    @lang('lang.languge')
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('lang/vi')}}"><img class="icon-lang" src="{{asset('./public/frontend/images/icon/anh.png')}}" alt=""> Tiếng Anh</a></li>
                                    <li><a href="{{url('lang/en')}}"><img class="icon-lang" src="{{asset('./public/frontend/images/icon/vietnam.png')}}" alt=""> Tiếng Việt</a></li>
                                    <li><a href="{{url('lang/cn')}}"><img class="icon-lang" src="{{asset('./public/frontend/images/icon/han.png')}}" alt=""> Tiếng Hàn</a></li>
                                </ul>
                            </div>
                            </div>

                        </form>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->

    </header>
    <!--/header-->
    <!--/header-->


    @yield('slider')
    @yield('brand_top')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2> @lang('lang.danhmucsanpham')</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach ($category as $key =>$cate )
                            <div class="panel panel-default">
                                @if ($cate->category_parent==0)
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category}}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            <a href="{{URL::To('danh-muc-san-pham/'.$cate->slug_category)}}">{{$cate->category_name}}</a>
                                        </a>
                                    </h4>

                                </div>
                                <div id="{{$cate->slug_category}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach ($category as $key =>$cat )
                                            @if ($cat ->category_parent==$cate->category_id)
                                            <li><a href="{{URL::To('danh-muc-san-pham/'.$cat->slug_category)}}">{{$cat->category_name}} </a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            </div>

                            @endforeach
                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2> @lang('lang.thuonghieusanpham')</h2>
                            <div class="brands-name" style="text-align: center;">
                                <ul class="nav nav-pills nav-stacked">
                                    @php

                                    @endphp
                                    @foreach ($brand as $key =>$brand )

                                    <li><a href="{{URL::To('thuong-hieu-san-pham/'.$brand->slug_brand)}}"><span class="pull-right">

                                            </span>{{$brand->brand_name}}  ({{ $brand->total }}) </a></li>



                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--/brands_products-->
                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>@lang('lang.daxem')</h2>
                            <button class="btn btn-primary delete_viewd none" style="font-size: 13px;position: absolute;right: 1px;top: 14%;z-index:999"><i class="fa fa-times"></i></button>
                            <div class="brands-name">

                                <div id="row_viewed">

                                </div>
                            </div>
                        </div>
                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>@lang('lang.dayeuthich')</h2>
                            <button class="btn btn-primary delete_allwish none" style="font-size: 13px;position: absolute;right: 1px;top: 12%;z-index:999"><i class="fa fa-times"></i></button>
                            <div class="brands-name">

                                <div id="row_wishlist">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-8 padding-right">

                    @yield('content')

                </div>

                <style>
                    #img-thum {
                        height: 30px;
                        width: 76px;
                    }
                </style>



            </div>
        </div>
    </section>
<!-- Modal -->
<div class="modal fade" id="quick-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Giỏ Hàng Của Bạn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
            <div id="Show-quick-cart"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
    <footer id="dk-footer" class="dk-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="dk-footer-box-info">
                        <a href="index.html" class="footer-logo">
                            <img style="max-width:175px" src="{{asset('public/frontend/images/home/LOGO1.png')}}" alt="footer_logo" class="img-fluid">
                        </a>
                        <p class="footer-info-text">
                            @foreach($contact_footer as $key => $logo)
                            {{$logo->slogan_logo}}


                            @endforeach
                        </p>
                        <div class="footer-social-link">
                            <h3>Follow us</h3>
                            <ul>
                                @foreach ($icons as $key => $iconn )
                                <img style="width:50px;height:50px;margin:2px;" src="{{asset('public/FrontEnd/Images/icon/'.$iconn->icon_image)}}" alt="">
                                </a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Social link -->
                    </div>
                    <!-- End Footer info -->
                    <div class="footer-awarad">
                        <div class="row">
                            @foreach ($video_footer as $key =>$video_footer)
                            <form>
                                @csrf
                                <div class=" col-md-6 video-gallery text-center">
                                    <a class="xemvideo" data-target="#xemvideo" id="{{$video_footer->video_id}}" data-toggle="modal">
                                        <div class="iframe-img">
                                            <img class="img-video" src="{{asset('public/uploads/videos/'.$video_footer->video_image)}}" alt="{{$video_footer->video_title}}" />
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                    <p>{{$video_footer->video_name}}</p>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- End Col -->
                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-us">
                                <div class="contact-icon">
                                    <i class="fa fa-map-o" aria-hidden="true"></i>
                                </div>
                                <!-- End contact Icon -->
                                <div class="contact-info">
                                    <h1 style="color: #fff;">{{__('lang.info')}}</h1>
                                    @foreach($contact_footer as $key => $contact_foo)
                                    <h3>{!!$contact_foo->info_contact!!}</h3>

                                </div>
                                <!-- End Contact Info -->
                            </div>
                            <!-- End Contact Us -->
                        </div>
                        <!-- End Col -->
                        <div class="col-md-6">
                            <h1 style="color: #fff;">Fanpage</h1>
                            <h3>{!!$contact_foo->info_fanpage!!}</h3>
                            @endforeach
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Contact Row -->
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="footer-widget footer-left-widget">
                                <div class="section-heading">
                                    <h3>{{__('lang.lienket')}}</h3>
                                    <span class="animate-border border-black"></span>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#">{{__('lang.gioithieu')}}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{__('lang.dichvu')}}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{__('lang.sp')}}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{__('lang.chinhsach')}}</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a href="#">{{__('lang.lienhe')}}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{__('lang.baiviet')}}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{__('lang.huongdan')}}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{__('lang.cauhoi')}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Footer Widget -->
                        </div>
                        <!-- End col -->
                        <div class="col-md-12 col-lg-6">
                            <div class="footer-widget">
                                <div class="section-heading">
                                    <h3>{{__('lang.phanhoi')}}</h3>
                                    <span class="animate-border border-black"></span>
                                </div>
                                <p>
                                    <!-- Don’t miss to subscribe to our new feeds, kindly fill the form below. -->
                                    {{__('lang.footer-text')}}
                                </p>
                                <form action="#">
                                    <div class="form-row">
                                        <div class="col dk-footer-form">
                                            <input type="email" class="form-control" placeholder="Email Address">
                                            <button type="submit">
                                                <i class="fa fa-send"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End form -->
                            </div>
                            <!-- End footer widget -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Widget Row -->
        </div>
        <!-- End Contact Container -->

        <div class="modal fade" id="xemvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="video_titlee"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        </button>
                    </div>

                    <div class="modal-body">
                        <div id="video_linkk"></div>
                        <div id="video_descc"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_video" class="btn btn-secondary" data-dismiss="modal">Đóng video</button>

                    </div>
                </div>
            </div>
        </div>

               <!-- End Copyright -->
        <!-- Back to top -->
        <div id="fb-root" style="z-index: 1000000;"></div>
        <div id="back-to-top" class="back-to-top">
            <!-- <button class="btn btn-dark" title="Back to Top" style="display: block;">
                <i class="fa fa-angle-up"></i>
            </button> -->
        </div>
        <!-- End Back to top -->
    </footer>

    <!--/Footer-->
    <script src="{{asset('public/FrontEnd/JS/jquery.js')}}"></script>

    <script src="{{asset('public/FrontEnd/JS/bootstrap.min.js')}}"></script>

    <script src="{{asset('public/FrontEnd/JS/jquery.scrollUp.min.js')}}"></script>

    <script src="{{asset('public/FrontEnd/JS/price-range.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/jquery.prettyPhoto.js')}}"></script>

    <script src="{{asset('public/FrontEnd/JS/main.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/lightslider.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/prettify.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/vlite.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/simple.money.format.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/owl.autoplay.js')}}"></script>
    <script src="{{asset('public/FrontEnd/JS/owl.carousel.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
     $(document).ready(function() {
    $('.selecter').select2();
});
 </script>
    <div id="paypal-button"></div>
    <!-- paypal -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <!-- thanh toán online -->
    <script>
        var usd = document.getElementById("vnd_to_usd").value;
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'demo_sandbox_client_id',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: `${usd}`,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    swal('Thông Báo', 'Cảm Ơn Bạn Đã Đặt Hàng Tại Website Của Chúng Tôi!', 'success');
                });
            }
        }, '#paypal-button');
    </script>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>
    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "152051286978850");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v11.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- hien menu khi cuộn trang -->
    <script type="text/javascript">
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {
            sticky_navbar()
        };

        // Get the navbar
        var navbar = document.getElementById("navbar");

        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function sticky_navbar() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
    <!-- //load trang -->

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
    </script>
    <!-- fb -->

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=391401119062608&autoLogAppEvents=1" nonce="n8mpGGEM"></script>
    <script src="{{asset('public/BackEnd/JS/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/BackEnd/JS/dataTables/dataTables.bootstrap.js')}}"></script>
    <!-- doi tac carousel -->
    <script type="text/javascript">
        var owl = $('.owl-carousel');

        owl.owlCarousel({
            loop: true,
            margin: 10,
            nav:false,
            dots:true,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            items:3,
        onInitialize: function (event) {
        var items     = event.item.count;     // Number of items
        if (items <= 1) {
            items:1,
           this.settings.loop = false;
        }else{
            items:3,
        this.settings.items= 2;
        }
    }
        });
        $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [1000])
        })
        $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
        })

    </script>

    <!-- nút xoá add to cart và load thêm sản phẩm -->
    <script type="text/javascript">
        load_more_product();

        cart_session();

        function cart_session() {
            $.ajax({
                url: "{{url('/cart-session')}}",
                method: "GET",
                success: function(data) {
                    $('#cart_session').html(data);
                }

            });
        }
        htmlLoaded();

        function htmlLoaded() {

            $(window).load(function() {

                var id = [];

                $(".cart_id").each(function() {
                    id.push($(this).val());
                    //alert(id);

                });

                for (var i = 0; i < id.length; i++) {

                    $('.home_cart_' + id[i]).hide();
                    $('.rm_home_cart_' + id[i]).show();

                }

            });
        }

        function load_more_product(id = '') {
            $.ajax({
                url: "{{url('/load-more-product')}}",
                method: "POST",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data: {
                    id: id
                },
                success: function(data) {
                    $('#load_more_button').remove();

                    $('#all_product').append(data);

                    var id = [];

                    $(".cart_id").each(function() {
                        id.push($(this).val());
                        //alert(id);

                    });

                    for (var i = 0; i < id.length; i++) {

                        $('.home_cart_' + id[i]).hide();
                        $('.rm_home_cart_' + id[i]).show();

                    }


                }

            });
        }
        $(document).on('click', '#load_more_button', function() {
            var id = $(this).data('id');
            $('#load_more_button').html('<b>{{__('lang.loading') }}</b>');
            load_more_product(id);


        })
    </script>
    <!-- data table -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- ẩn hiện nút đọc thêm ẩn bớt -->
    <script>
        $(document).ready(function() {
            $('.readmore').click(function() {
                $('.show-content').css('height', 'auto');
                $('.readmore').css('display', 'none');
                $('.hiden_content').css('display', 'block');
            });
            $('.btn-secondary').click(function() {
                $('.quickview-content').css('height', '180px');
                $('.readmoree').css('display', 'block');
                $('.hiden_content').css('display', 'none');
            });
            $('.readmoree').click(function() {
                $('.quickview-content').css('height', 'auto');
                $('.readmoree').css('display', 'none');
                $('.hiden_content').css('display', 'block');
            });
            $('.hiden_content').click(function() {
                $('.show-content').css('height', '180px');
                $('.quickview-content').css('height', '180px');
                $('.readmore').css('display', 'block');
                $('.readmoree').css('display', 'block');
                $('.hiden_content').css('display', 'none');
            });
        });
    </script>
    <!-- slider sản phẩm -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                auto: true,
                speed: 1500,
                pause:  6000,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <!-- tìm kiếm sản phẩm nhắc tên sản phảm -->
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var query = $(this).val();

            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/autocomplete-ajax')}}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });

            } else {

                $('#search_ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_search_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <!-- thêm sản phẩm vào giỏ hàng full -->
    <script type="text/javascript">
        // hover_cart();
        show_cart();
        cart_session();

        // function hover_cart() {
        //     $.ajax({
        //         url: "{{url('/hover-cart')}}",
        //         method: "GET",
        //         success: function(data) {
        //             $('.giohang-hover').html(data);

        //         }

        //     });
        // }

        //show cart quantity
        function show_cart() {
            $.ajax({
                url: "{{url('/show-cart')}}",
                method: "GET",
                success: function(data) {
                    $('.show-cart').html(data);
                }
            });
        }
        function Deletecart(id) {
            var id = id;
            // alert(id);
            $.ajax({
                url: "{{url('/remove-item')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    swal('Thông Báo', 'Xóa sản phẩm trong giỏ hàng thành công', 'success');
                    document.getElementsByClassName("home_cart_" + id)[0].style.display = "block";
                    document.getElementsByClassName("rm_home_cart_" + id)[0].style.display = "none";
                    // hover_cart();
                    show_cart();
                    cart_session();

                }

            });
        }
    </script>

     <!-- modal giỏ hàng -->
     <script type="text/javascript">

         function show_quick_cart(){
            $.ajax({
                    url: "{{url('/show-quick-cart')}}",
                    method: 'GET',
                    success: function(data) {
                        $('#Show-quick-cart').html(data);
                        $('#quick-cart').modal();
                    }

        });
        }
        function DeleteItemCart($session_id){
            var session_id = $session_id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                        url: "{{url('/del-product')}}" + '/' +session_id,
                        method: 'GET',
                        data:{_token:_token},

                        success:function(){
                            swal("Thông Báo","Xoá Giỏ Hàng Thành Công","success");
                            Deletecart();
                            window.setTimeout(function() {

                                        location.reload();
                                    }, 6000);


                                    show_quick_cart();
                        }

                    });

        }

        $(document).on('input', '.cart_qty_update', function(){

            var quantity = $(this).val();
            var session_id = $(this).data('session_id');

            var _token = $('input[name="_token"]').val();
            // alert(quantity);
            // alert(session_id);
            $.ajax({
                        url: "{{url('/update-quick-cart')}}",
                        method: 'POST',
                        data:{quantity:quantity, session_id:session_id, _token:_token},

                        success:function(data){
                            swal("Thông Báo",""+data+"","success");
                            show_quick_cart();
                        }

                    });
        })


         function Addtocart($product_id){
                var id = $product_id;
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url("/add-cart-ajax")}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},

                        success:function(){
                            show_quick_cart();
                            show_cart();
            document.getElementsByClassName("home_cart_" + id)[0].style.display = "none";
            document.getElementsByClassName("rm_home_cart_" + id)[0].style.display = "block";

                        }

                    });
                }
            }

    </script>
     </script>
    <!-- ajax quận huyện  -->
    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: "{{url('/select-delivery-home')}}",
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('.' + result).html(data);
                    }
                });
            });
        });
    </script>
    <!-- huỷ đơn hàng  -->
    <script type="text/javascript">
        function Huydonhang(id) {
            var order_code = id;
            var lydo = $('.lydohuydon').val();

            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/huy-don-hang')}}",
                method: "POST",

                data: {
                    order_code: order_code,
                    lydo: lydo,
                    _token: _token
                },
                success: function(data) {
                    swal("Thông Báo",""+data+"","success");
                    window.setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                }

            });
        }
    </script>
    <!-- check mã giảm giá -->
    <script>
        $(document).ready(function() {

            $('.check_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    swal("Thông Báo", "Bạn Chưa Chọn Nơi Nhận Hàng", "success");
                } else {
                    $.ajax({
                        url: "{{url('/delivery-fee')}}",
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function(data) {
                            sessionStorage.setItem("tamp", 'tamp');
                            location.reload();
                        }
                    });
                }

            });
        });
    </script>
    <!-- load trang get du liệu tỉnh huyện xã -->
    <script>
        window.onload = function() {
            // If sessionStorage is storing default values (ex. name), exit the function and do not restore data
            if (sessionStorage.getItem('city') == "city") {
                return;
            }
            // If values are not blank, restore them to the fields
            var tamp = sessionStorage.getItem('tamp');
            var city = sessionStorage.getItem('city');
            if (city !== null) $('#make_text1').val(city);
            var province = sessionStorage.getItem('province');
            if (province !== null) $('#make_text2').val(province);

            var ward = sessionStorage.getItem('ward');
            if (ward !== null) $('#make_text3').val(ward);
            if (ward !== 'undefined' && city !== 'undefined' && province !== 'undefined' && tamp !== 'undefined')
            {
                $('#shipping_address').val(ward+', '+province+', '+city);
            }
            else
            $('#shipping_address').val('Vui Lòng Chọn Nơi Giao Hàng');
        }

        // lưu session trước khi load lại trang
        window.onbeforeunload = function() {
            sessionStorage.setItem("city", $('#make_text1').val());
            sessionStorage.setItem("province", $('#make_text2').val());
            sessionStorage.setItem("ward", $('#make_text3').val());

        }
    </script>
    <!-- xác nhận đặt hàng -->
    <script>
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Cảm ơn, Mua hàng",
                        cancelButtonText: "Huỷ Bỏ",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        var shipping_address = $('.shipping_address').val();
                        if (isConfirm) {
                            if(shipping_address =='Vui Lòng Chọn Nơi Giao Hàng'){
                                swal("Lỗi Rồi", "Bạn Chưa Chọn Nơi Gửi Hàng", "error");
                            }else{
                                var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();

                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: "{{url('/confirm-order')}}",
                                method: 'post',
                                data: {
                                    shipping_address: shipping_address,
                                    shipping_email: shipping_email,
                                    shipping_name: shipping_name,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    _token: _token,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_method: shipping_method
                                },
                                success: function() {
                                    swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                                    sessionStorage.setItem("tamp",'undefined');
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 7000);
                                }
                            });
                            }



                        } else {
                            swal("Đóng", "Đơn hàng chưa được gửi, Mời Bạn Tham Khảo Thêm Sản Phẩm Khác", "error");

                        }

                    });


            });
        });
    </script>
    <!-- xem video trên trang video -->
    <script>
        $(document).on('click', '.watch-video', function() {
            var video_id = $(this).attr('id'); //lấy id của nút nhấn
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/watch-video')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {
                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                    $('#video_desc').html(data.video_desc);
                    var playerYT = new vlitejs({
                        selector: '#my_yt_video',
                        options: {
                            // auto play
                            autoplay: false,

                            // enable controls
                            controls: true,

                            // enables play/pause buttons
                            playPause: true,

                            // shows progress bar
                            progressBar: true,

                            // shows time
                            time: true,

                            // shows volume control
                            volume: true,

                            // shows fullscreen button
                            fullscreen: true,

                            // path to poster image
                            poster: null,

                            // shows play button
                            bigPlay: true,

                            // hide the control bar if the user is inactive
                            autoHide: false,

                            // keeps native controls for touch devices
                            nativeControlsForTouch: false
                        },
                        onReady: (player) => {
                            // callback function here
                        }
                    });

                }

            });
        });
    </script>
    <!-- xem video trên trang Home -->
    <script>
        $(document).on('click', '.xemvideo', function() {
            var video_id = $(this).attr('id'); //lấy id của nút nhấn
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/watch-video')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {
                    $('#video_titlee').html(data.video_title);
                    $('#video_linkk').html(data.video_link);
                    $('#video_descc').html(data.video_desc);
                    var playerYT = new vlitejs({
                        selector: '#my_yt_video',
                        options: {
                            // auto play
                            autoplay: false,

                            // enable controls
                            controls: true,

                            // enables play/pause buttons
                            playPause: true,

                            // shows progress bar
                            progressBar: true,

                            // shows time
                            time: true,

                            // shows volume control
                            volume: true,

                            // shows fullscreen button
                            fullscreen: true,

                            // path to poster image
                            poster: null,

                            // shows play button
                            bigPlay: true,

                            // hide the control bar if the user is inactive
                            autoHide: false,

                            // keeps native controls for touch devices
                            nativeControlsForTouch: false
                        },
                        onReady: (player) => {
                            // callback function here
                        }
                    });

                }

            });
        });
    </script>
    <!-- xem nhanh san pham json ajax -->
    <script>
        $('.watch-sp').click(function() {
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/quickview')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#imageGallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);

                }
            });

        });
    </script>
    <script>
   $(document).ready(function(){

            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                          show_cart();
                          hover_cart();
                          cart_session();
                        }

                    });
                }


            });

        });
    </script>

    <!-- thêm sản phẩm vào giỏ hàng nhanh tren home -->
    <script type="text/javascript">
        $(document).on('click', '.add-to-cart-quicky', function() {
            var id = $('#product_quickview_id').html();
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_').val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var _token = $('input[name="_token"]').val();

            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                swal("Sorry !!!", "Vui Lòng Chọn Số Lượng Nhỏ Hơn " + cart_product_quantity + " Sản Phẩm", "error");
            } else {
                $.ajax({
                    url: "{{url('/add-cart-ajax')}}",
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        cart_product_quantity: cart_product_quantity,
                        _token: _token
                    },
                    beforeSend: function() {
                        $("#beforesend_quickview").html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                    },
                    success: function() {
                        $("#beforesend_quickview").html("<p class='text text-success'>Sản phẩm đã thêm vào giỏ hàng</p>");
                        // hover_cart();
                        show_cart();
                        cart_session();
                    document.getElementsByClassName("home_cart_" + id)[0].style.display = "none";
                    document.getElementsByClassName("rm_home_cart_" + id)[0].style.display = "block";
                    }

                });
            }


        });
        $(document).on('click', '.redirect-cart', function() {

            window.location.href = "{{url('/gio-hang')}}";
        });
    </script>
    <!-- Load Comment -->
    <script type="text/javascript">
        $(document).ready(function() {

            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/load-comment')}}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {

                        $('#comment_show').html(data);
                    }
                });
            }
            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/send-comment')}}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        _token: _token
                    },
                    success: function(data) {
                        $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                        load_comment();
                        $('#notify_comment').fadeOut(9000);
                        $('.comment_name').val('');
                        $('.comment_content').val('');
                    }
                });
            });
        });
    </script>
    <!-- đánh giá sao -->
    <script type="text/javascript">
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }
        //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });
        //nhả chuột ko đánh giá
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            remove_background(product_id);
            //alert(rating);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //click đánh giá sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('insert-rating')}}",
                method: "POST",
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'done') {
                        swal("Đánh Giá", "Bạn đã đánh giá " + index + " trên 5 Sao", "success");
                    } else {
                        swal("Lỗi đánh giá");
                    }
                }
            });

        });
    </script>
    <!-- ẩn hiện nút rep comment -->
    <script>
        $(document).on('click', '.addclass', function() {
            var id = $(this).data('id_comment'); //this= add-to-cart , data-id_product
            $(".rep_comment_" + id).removeClass('none');
            $(".rep_comment_" + id).addClass('block');
            $(".addclass_" + id).addClass('none');
            $(".addclass_" + id).removeClass('block');
            $("#demo_" + id).html("<button type='button' id='show' class='hidden_" + id + "'  data-id_comment=" + id + " class='text text-success block' >Ân</button>");

        });
    </script>
    <script>
        $(document).on('click', '#show', function() {
            var id = $(this).data('id_comment'); //this= add-to-cart , data-id_product

            $(".rep_comment_" + id).removeClass('block');
            $(".rep_comment_" + id).addClass('none');
            $(".addclass_" + id).addClass('block');
            $(".addclass_" + id).removeClass('none');
            $(".hidden_" + id).removeClass('block');
            $(".hidden_" + id).addClass('none');

        });
    </script>
    <!-- tag -->
    <script type="text/javascript">
        $(document).ready(function() {

            var cate_id = $('.tabs_pro').data('id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/product-tabs')}}",
                method: "POST",
                data: {
                    cate_id: cate_id,
                    _token: _token
                },
                success: function(data) {
                    $('#tabs_product').html(data);

                }

            });

            $('.tabs_pro').click(function() {

                var cate_id = $(this).data('id');

                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/product-tabs')}}",
                    method: "POST",
                    data: {
                        cate_id: cate_id,
                        _token: _token
                    },

                    success: function(data) {
                        $('#tabs_product').html(data);
                    }

                });

            });



        });
    </script>

    <!-- sản phẩm đã xem localstorage -->
    <script type="text/javascript">



        function viewed() {


            if (localStorage.getItem('viewed') != null) {

                var data = JSON.parse(localStorage.getItem('viewed'));

                data.reverse();

                document.getElementById('row_viewed').style.overflow = 'scroll';
                document.getElementById('row_viewed').style.height = '333px';

                for (i = 0; i < data.length; i++) {

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row_viewed').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' + image + '"></div><div class="col-md-8 info_wishlist"><p>' + name + '</p><p style="color: #b90c0c;font-weight: 600;padding: 5px;">' + price + '</p><a href="' + url + '"<button class="btn btn-info" style="font-size: 11px;"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</Button></a></div>');
                }
                $('.delete_viewd').removeClass('none');
            }

        }
        viewed();
        product_viewed();

        function product_viewed() {
            var id_product = $('#product_viewed_id').val();
            if (id_product != undefined) {
                var id = id_product;
                var name = document.getElementById('viewed_productname_' + id).value;
                var url = document.getElementById('viewed_producturl_' + id).value;
                var price = document.getElementById('viewed_productprice_' + id).value;
                var image = document.getElementById('viewed_productimage_' + id).value;


                var newItem = {
                    'url': url,
                    'id': id,
                    'name': name,
                    'price': price,
                    'image': image
                }

                if (localStorage.getItem('viewed') == null) {
                    localStorage.setItem('viewed', '[]');
                }

                var old_data = JSON.parse(localStorage.getItem('viewed'));

                var matches = $.grep(old_data, function(obj) {
                    return obj.id == id;
                })

                if (matches.length) {


                } else {

                    old_data.push(newItem);

                    $('#row_viewed').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' + newItem.image + '"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name + '</p><p style="color: #b90c0c;font-weight: 600;padding: 5px;">' + newItem.price + '</p><a href="' + newItem.url + '"<button class="btn btn-info" style="font-size: 11px;"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</Button></a></div>');
                    $('.delete_viewd').removeClass('none');
                }

                localStorage.setItem('viewed', JSON.stringify(old_data));
            }





        }
    </script>
    <!-- xem nhanh sản phẩm bằng localStorage  -->
    <script type="text/javascript">
        function XemNhanh(id) {
            var product_id = id;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/quickview')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_promotion').html(data.product_promotion);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            });
        }
    </script>
    <!-- sản phẩm yeu thich localstorage -->
    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {

                var data = JSON.parse(localStorage.getItem('data'));

                data.reverse();

                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '333px';

                for (i = 0; i < data.length; i++) {

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row_wishlist').append('<div class="row" style="margin:10px 10px"><div class="col-md-4"><img width="100%" src="' + image + '"></div><div class="col-md-8 info_wishlist"><p>' + name + '</h4><p style="color: #b90c0c;font-weight: 600;padding: 5px;">' + price + '</p><a href="' + url + '"><button class="btn btn-info" style="font-size: 11px;"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</Button></a></div>');

                }
                $('.delete_allwish').removeClass('none');
            }

        }
        view();
        add_wistlist();
        function add_wistlist(clicked_id) {
            var id = clicked_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
            }

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]'); //nếu chưa thì tạo data
            }

            var old_data = JSON.parse(localStorage.getItem('data')); //có data chuyển về json


            document.getElementById('row_wishlist').style.overflow = 'scroll';
            document.getElementById('row_wishlist').style.height = '333px';
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {
                swal('Thông Báo', "Sản phẩm bạn đã yêu thích Rồi", "success");
            } else {

                old_data.push(newItem);
                $('#row_wishlist').append('<div class="row" style="margin:10px 10px"><div class="col-md-4"><img width="100%" src="' + newItem.image + '"></div><div class="col-md-8 info_wishlist"><h4>' + newItem.name + '</h4><p style="color: #b90c0c;font-weight: 600;padding: 5px;">' + newItem.price + '</p><a href="' + newItem.url + '"><button class="btn btn-info" style="font-size: 11px;"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</Button></a></div>');
                $('.delete_allwish').removeClass('none');
            }

            localStorage.setItem('data', JSON.stringify(old_data));

        }
    </script>
    <!-- xoá sản phẩm yêu thích đã xem -->
    <script>
        $(document).on('click', '.delete_allwish', function(event) {
            localStorage.removeItem('data');
            location.reload();
        });
        $(document).on('click', '.delete_viewd', function(event) {
            localStorage.removeItem('viewed');
            location.reload();
        });
    </script>
    <!-- so sánh sản phẩm -->
    <script type="text/javascript">
        function delete_compare(id) {

            if (localStorage.getItem('compare') != null) {

                var data = JSON.parse(localStorage.getItem('compare'));

                var index = data.findIndex(item => item.id === id);

                data.splice(index, 1);

                localStorage.setItem('compare', JSON.stringify(data));
                //remove element by id
                document.getElementById("row_compare" + id).remove();

            }
        }
        sosanh();

        function sosanh() {


            if (localStorage.getItem('compare') != null) {

                var data = JSON.parse(localStorage.getItem('compare'));


                for (i = 0; i < data.length; i++) {

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    var id = data[i].id;

                    $('#row_compare').find('tbody').append(`
                                                         <tr id="row_compare` + id + `">
                                                            <td>` + name + `</td>
                                                            <td>` + price + `</td>
                                                            <td><img width="200px" src="` + image + `"></td>
                                                            <td></td>
                                                            <td><a href="` + url + `"><button class="btn btn-success">Xem sản phẩm</button></a></td>
                                                            <td><a style="cursor:pointer" onclick="delete_compare(` + id + `)"><button class="btn btn-danger">Xóa so sánh</button></a></td>
                                                          </tr>


                `);
                }

            }

        }


        function add_compare(product_id) {

            document.getElementById('title-compare').innerText = '* Chỉ cho phép so sánh tối đa 4 sản phẩm';

            var id = product_id;

            var name = document.getElementById('wishlist_productname' + id).value;
            // var content = document.getElementById('wishlist_productcontent'+id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
                // 'content':content
            }

            if (localStorage.getItem('compare') == null) {
                localStorage.setItem('compare', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('compare'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {

            } else {
                if (old_data.length <= 3) {

                    old_data.push(newItem);

                    $('#row_compare').find('tbody').append(`
                                                         <tr id="row_compare` + id + `">
                                                            <td>` + newItem.name + `</td>
                                                            <td>` + newItem.price + `</td>
                                                            <td><img width="200px" src="` + newItem.image + `"></td>
                                                            <td></td>
                                                            <td><a href="` + url + `"><button class="btn btn-success">Xem sản phẩm</button></a></td>
                                                            <td><a style="cursor:pointer" onclick="delete_compare(` + id + `)"><button class="btn btn-danger">Xóa so sánh</button></a></td>
                                                          </tr>


                `);
                }


            }

            localStorage.setItem('compare', JSON.stringify(old_data));
            $('#sosanh').modal();

        }
    </script>
 <!-- lọc giá sản phẩm -->
<script type="text/javascript">
        $(document).ready(function(){

           $( "#slider-range" ).slider({
              orientation: "horizontal",
              range: true,

              min:{{$min_price_range}},
              max:{{$max_price_range}},

              steps:10000,
              values: [ {{$min_price}}, {{$max_price}} ],

              slide: function( event, ui ) {
                $( "#amount_start" ).val(ui.values[ 0 ]).simpleMoneyFormat();
                $( "#amount_end" ).val(ui.values[ 1 ]).simpleMoneyFormat();


                $( "#start_price" ).val(ui.values[ 0 ]);
                $( "#end_price" ).val(ui.values[ 1 ]);

              }

            });

            $( "#amount_start" ).val($( "#slider-range" ).slider("values",0)).simpleMoneyFormat();
            $( "#amount_end" ).val($( "#slider-range" ).slider("values",1)).simpleMoneyFormat();

        });
</script>
<script type="text/javascript">
        $(document).ready(function(){

            $('#sort').on('change',function(){

                var url = $(this).val();
                // alert(url);
                  if (url) {
                      window.location = url;
                  }
                return false;
            });

        });
</script>
</body>
</html>
