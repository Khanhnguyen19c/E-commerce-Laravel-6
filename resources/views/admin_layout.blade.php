<!DOCTYPE html>
<head>
<title>Trang Quản Trị</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEriCSSon, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-CSS -->
<link rel="stylesheet" href="{{asset('public/BackEnd/CSS/bootstrap.min.CSS')}}" >
<link  rel="icon" type="image/x-icon" href="{{asset('public/BackEnd/Images/logo.png')}}" />
<meta name="csrf-token" content="{{csrf_token()}}">
<!-- //bootstrap-CSS -->

<!-- Custom CSS -->
<link href="{{asset('public/BackEnd/CSS/style.CSS')}}" rel='stylesheet' type='text/CSS' />
<link href="{{asset('public/BackEnd/CSS/style-responsive.CSS')}}" rel="stylesheet"/>
<link href="{{asset('public/BackEnd/CSS/jquery.dataTables.min.CSS')}}" rel="stylesheet"/>
<link href="{{asset('public/BackEnd/CSS/formValidation.min.CSS')}}" rel="stylesheet"/>
<link href="{{asset('public/BackEnd/JS/dataTables/dataTables.bootstrap.css')}}" rel='stylesheet' type='text/CSS' />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.CSS">

<!-- font CSS -->

<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('public/BackEnd/CSS/unicon.CSS') }}">
<link rel="stylesheet" href="{{asset('public/BackEnd/CSS/font.CSS')}}" type="text/CSS"/>
<link href="{{asset('public/BackEnd/CSS/font-awesome.CSS')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('public/BackEnd/CSS/bootstrap-tagsinput.CSS')}}" type="text/CSS"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('public/BackEnd/CSS/sweetalert.css')}}" rel="stylesheet">

<link rel="icon" href="{{asset('public/frontend/images/logo-mail.png')}}" type="image/gif" sizes="32x32">
<!-- calendar -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/BackEnd/js/bootstrap-tagsinput.js')}}"></script>
<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- //calendar -->
<!-- //font-awesome icons -->


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.CSS">

</head>
<body onload="load()">
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
       K-Shopper
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success">8</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class="">You have 8 pending tasks</p>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>25% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Product Delivery</h5>
                                <p>45% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Payment collection</h5>
                                <p>87% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>33% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>

                <li class="external">
                    <a href="#">See All Tasks</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-important">4</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">You have 4 Mails</p>
                </li>


                <li>
                    <a href="#">See all messages</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 overloaded.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{('public/BackEnd/images/avt.jpg')}}">
            <span class="username">
            <?php
                    if(Session()->get('login_normal')){
                        $name = Session()->get('admin_name');
                    }else{
                        $name = Auth()->user()->admin_name;
                    }
                    if($name){
                        echo $name;
                    }
                    ?>

                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                    <i class="uil uil-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL::to('/info')}}">
                    <i class="uil uil-map-marker-info"></i>
                        <span>Thông Tin Liên Hệ</span>
                    </a>
                </li>
                <li class="sub-menu">
                <a href="{{URL::to('/manage-order')}}">
                <i class="fab fa-wpexplorer"></i>
                        <span>Quản Lý Đơn Hàng</span>
                    </a>

                </li>
                <li class="sub-menu">
                <a href="{{URL::to('/all-coupon')}}">
                <i class="uil uil-qrcode-scan"></i>
                        <span>Quản lý mã giảm giá</span>
                    </a>

                </li>
                <li class="sub-menu">
                <a href="{{URL::to('/all-delivery')}}">
                <i class="uil uil-truck"></i>
                        <span>Quản Lý Mã Vận Chuyển</span>
                    </a>

                </li>
                <li class="sub-menu">
                <a href="{{URL::to('/comment')}}">
                <i class="uil uil-comment-alt-dots"></i>
                        <span>Bình Luận Khách Hàng</span>
                    </a>
                </li>
                <li class="sub-menu">
                <a href="{{URL::to('/manage-slider')}}">
                <i class="uil uil-sliders-v"></i>
                        <span>Quản Lý Banner</span>
                    </a>

                </li>
                <li class="sub-menu">
                <a href="{{URL::to('/video')}}">

                        <span> <i class="uil uil-video"></i>Quản Lý Videos</span>
                    </a>

                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="uil uil-postcard"></i>
                        <span>Quản Lý Bài Viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-CategoryPost')}}"> Danh Mục Bài Viết</a></li>
                        <li><a href="{{URL::to('/all-Post')}}"> Bài Viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="uil uil-university"></i>
                        <span>Danh Muc Sp</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-CategoryProduct')}}">Quản Lý Danh Mục Sản Phẩm</a></li>
                        <li><a href="{{URL::to('/all-BrandProduct')}}">Quản Lý Thương Hiệu Sản Phẩm</a></li>
                        <li><a href="{{URL::to('/all-Product')}}">Quản Lý Sản Phẩm</a></li>
                    </ul>
              </li>
              <li>
                    <a class="active" href="{{URL::to('/read_data')}}">
                    <i class="uil uil-money-withdrawal"></i>
                        <span>List Google Drive</span>
                    </a>
                </li>
              <!-- lay o blade provider -->
              @hasrole(['admin'])
              <li class="sub-menu">
              <a href="{{URL::to('/list-user')}}">
              <i class="uil uil-user-md"></i>
                        <span>Quản Lý Admin</span>
                    </a>

                </li>
            @endhasrole
            @impersonate
            <li> </i><span> <a href="{{url('impersonate-destroy')}}"> Chuyển Lại Admin </a> </span></li>

            @endimpersonate
            </ul>     </li>
                 </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
  	@yield('admin_content')


  </section>
</section>

</section>
<!--main content end-->
</section>

<script src="{{asset('public/backend/JS/bootstrap.js')}}"></script>
<script src="{{asset('public/BackEnd/JS/jquery.dcjqaccordion.2.7.js')}}"></script>

<script src="{{asset('public/BackEnd/JS/scripts.js')}}"></script>
<script src="{{asset('public/BackEnd/JS/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/BackEnd/JS/jquery.nicescroll.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="{{asset('public/BackEnd/JS/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/BackEnd/JS/simple.money.format.js')}}"></script>
<script src="{{asset('public/BackEnd/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/BackEnd/ckeditor/ckfinder/ckfinder.js')}}"></script>
<script src="{{asset('public/BackEnd/JS/formValidation.min.js')}}"></script>
<script src="{{asset('public/BackEnd/JS/sweetalert.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <!-- DATA TABLE SCRIPTS -->
 <script src="{{asset('public/BackEnd/JS/dataTables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('public/BackEnd/JS/dataTables/dataTables.bootstrap.js')}}"></script>
 <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
 {!! Toastr::message() !!}
 <script>
     $(document).ready(function() {
    $('.selecter').select2();
});
 </script>
 <!-- xoá brand product -->
 <script>
    $(document).ready(function() {
      $('.btn_delete_brand').click(function() {
        var brand_id = $(this).data("brand_delete");
        var _token = $('input[name="_token"]').val();
                swal({
                        title: "Xác Nhận Xoá",
                        text: "Xoá Sẽ không thể khôi phục, bạn có muốn xoá không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Xác Nhận Xoá",
                        cancelButtonText: "Huỷ Bỏ",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                        $.ajax({
                                url: "{{url('/delete-BrandProduct')}}",
                                method: 'post',
                                data: {
                                    brand_id:brand_id,
                                    _token:_token
                                },
                                success: function() {
                                    swal("Thông Báo", "Bạn Đã Xoá Thành Công", "success");

                                  window.setTimeout(function() {
                                      location.reload();
                                  }, 2000);
                                }
                            });
                        }else {
                            swal("Huỷ Bỏ", "", "error");
                        }
                    });
                });
            });
 </script>
  <!-- xoá category product -->
  <script>
    $(document).ready(function() {
      $('.btn_delete_category').click(function() {
        var category_id = $(this).data("category_delete");
        var _token = $('input[name="_token"]').val();
                swal({
                        title: "Xác Nhận Xoá",
                        text: "Xoá Sẽ không thể khôi phục, bạn có muốn xoá không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Xác Nhận Xoá",
                        cancelButtonText: "Huỷ Bỏ",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                        $.ajax({
                                url: "{{url('/delete-CategoryProduct')}}",
                                method: 'POST',
                                data: {
                                    category_id:category_id,
                                    _token:_token
                                },
                                success: function() {
                                    swal("Thông Báo", "Bạn Đã Xoá Thành Công", "success");

                                  window.setTimeout(function() {
                                      location.reload();
                                  }, 2000);
                                }
                            });
                        }else {
                            swal("Huỷ Bỏ", "", "error");
                        }
                    });
                });
            });
 </script>
  <!-- xoá  product -->
  <script>
    $(document).ready(function() {
      $('.btn_delete_product').click(function() {
        var product_id = $(this).data("product_delete");
        var _token = $('input[name="_token"]').val();
                swal({
                        title: "Xác Nhận Xoá",
                        text: "Xoá Sẽ không thể khôi phục, bạn có muốn xoá không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Xác Nhận Xoá",
                        cancelButtonText: "Huỷ Bỏ",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                        $.ajax({
                                url: "{{url('/delete-Product')}}",
                                method: 'post',
                                data: {
                                    product_id:product_id,
                                    _token:_token
                                },
                                success: function() {
                                    swal("Thông Báo", "Bạn Đã Xoá Thành Công", "success");

                                  window.setTimeout(function() {
                                      location.reload();
                                  }, 2000);
                                }
                            });
                        }else {
                            swal("Huỷ Bỏ", "", "error");
                        }
                    });
                });
            });
 </script>
 <!-- thống kê bằng morris js-->
 <script type="text/javascript">
    $(document).ready(function(){
        chart60daysorder();
        var chart = new Morris.Bar({

              element: 'chart',
              //option chart
              lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['order','quantity','sales','profit'],
                labels: ['Đơn hàng','Số lượng','Doanh số','Lợi nhuận']

            });
        function chart60daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/days-order')}}",
                method:"POST",
                dataType:"JSON",
                data:{_token:_token},

                success:function(data)
                    {
                        chart.setData(data);
                    }
            });
        }

    $('.dashboard-filter').change(function(){
        var dashboard_value = $(this).val();
        var _token = $('input[name="_token"]').val();
        // alert(dashboard_value);
        $.ajax({
            url:"{{url('/dashboard-filter')}}",
            method:"POST",
            dataType:"JSON",
            data:{dashboard_value:dashboard_value,_token:_token},

            success:function(data)
                {
                    chart.setData(data);
                }
            });

    });

    $('#btn-dashboard-filter').click(function(){

        var _token = $('input[name="_token"]').val();

        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();

         $.ajax({
            url:"{{url('/filter-by-date')}}",
            method:"POST",
            dataType:"JSON",
            data:{from_date:from_date,to_date:to_date,_token:_token},

            success:function(data)
                {
                    chart.setData(data);
                }
        });

     });

});

</script>
<script type="text/javascript">

   $( function() {
     $( "#start_coupon" ).datepicker({
         prevText:"Tháng trước",
         nextText:"Tháng sau",
         dateFormat:"dd/mm/yy",
         dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
         duration: "slow"
     });
     $( "#end_coupon" ).datepicker({
         prevText:"Tháng trước",
         nextText:"Tháng sau",
         dateFormat:"dd/mm/yy",
         dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
         duration: "slow"
     });
   } );

</script>


 <!-- chart product order index -->
<script type="text/javascript">
    var colorDanger = "#FF1744";
    Morris.Donut({
    element: 'donut',
    resize: true,
    colors: [
        '#E0F7FA',
        '#B2EBF2',
        '#80DEEA',
        '#4DD0E1',
        '#26C6DA',
        '#00BCD4',
        '#00ACC1',
        '#0097A7',
        '#00838F',
        '#006064'
    ],
    //labelColor:"#cccccc", // text color
    //backgroundColor: '#333333', // border color
    data: [
        {label:"Sản Phẩm", value:<?php echo $app_product ?>},
        {label:"Bài Viết", value:<?php echo $app_post ?>},
        {label:"Đơn Hàng", value:<?php echo $app_order ?>},
        {label:"Video", value:<?php echo $app_video ?>},
        {label:"Khách Hàng", value:<?php echo $app_customer ?>}
    ]
    });

</script>
<script>

 let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#datepicker2").value = today;


</script>


 </script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
<script>
    var options = {
    filebrowserImageBrowseUrl: 'laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
    filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token='
  };
</script>
 <!-- ckeditor -->
<script>

   CKEDITOR.replace('ckeditor1', options);
    //     filebrowserBrowseUrl: '../public/ckeditor/ckfinder/ckfinder.html',
    //     filebrowserImageBrowseUrl: '../public/BackEnd/ckeditor/ckfinder/ckfinder.html?type=Images',
    // });
     CKEDITOR.replace( 'ckeditor', options);
    //     filebrowserBrowseUrl: '../public/ckeditor/ckfinder/ckfinder.html',
    //     filebrowserImageBrowseUrl: '../public/BackEnd/ckeditor/ckfinder/ckfinder.html?type=Images',
    // });

    </script>

   <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
  <!-- update quantity order -->
<script type="text/javascript">
  $('.update_quantity_order').change(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url : "{{url('/update-qty')}}",

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                   swal('Thông Báo',"Cập nhật số lượng thành công", "success");

                    window.setTimeout(function(){
                            location.reload();
                        } ,3000);



                }
        });

    });
</script>
    <!-- change order details -->
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        //lay ra so luong
        quantity = [];
        $("input[name='product_save_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    swal('Thông Báo',"Số lượng bán trong kho không đủ","btn-danger");
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){

                $.ajax({
                        url : "{{url('/update-order-qty')}}",
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                swal('Thông Báo',"Thay đổi tình trạng đơn hàng thành công", "success");
                                window.setTimeout(function(){
                              location.reload();
                                } ,3000);
                            }
                });

        }

    });
</script>
<!-- xoá file pdf -->
<script type="text/javascript">
    $('.btn-delete-document').click(function(){

        var product_id = $(this).data('document_id');
        var _token = $('input[name="_token"]').val();
         $.ajax({
                url:"{{url('/delete-document')}}",
                method:"POST",

                data:{_token:_token,product_id:product_id},

                success:function(data)
                    {
                        swal('thông báo','Xóa file thành công','success');
                        location.reload();
                    }
            });
    });
</script>
 <!-- huy don hàng -->
 <script type="text/javascript">
        function Huydonhang(id){
            var order_code = id;
            var lydo = $('.lydohuydon').val();

            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{url('/huy-don-hang')}}",
                method:"POST",
                data:{order_code:order_code, lydo:lydo, _token:_token},
                success:function(data){
                    alert('Hủy đơn hàng thành công');
                    location.reload();
                }

            });
        }
    </script>
 <!-- format tien form  -->
 <script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
    $('.price_format_cost').simpleMoneyFormat();
</script>
        <!-- load delivery -->
  <script type="text/javascript">
    $(document).ready(function(){

        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{url('/load-delivery')}}",
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                  $('#load_delivery').html(data);

                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{url('/update-delivery')}}",
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value,_token:_token},
                success:function(data){
                    swal("Thông Báo","Update Mã Vận Chuyển Thành Công","success");
                }
            });
        });
        $('.add_delivery').click(function(){
            var fee_ship = $('.fee_ship').val();
            var province = $('.province').val();
            var city = $('.city').val();
            var wards = $('.wards').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url : "{{url('/insert-delivery')}}",
                method: 'POST',
                data:{city:city, wards:wards, province:province, fee_ship:fee_ship, _token:_token},
                success:function(data){
                    swal("Thông Báo","Thêm Mã Vận Chuyển Thành Công","success");
                }
            });
        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : "{{url('/select-delivery')}}",
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('.'+result).html(data);
                }
            });
        });


    })
  </script>
    <!-- Chart Index -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
            behaveLikeLine: true,
            gridEnabled: false,
            gridLineColor: '#dddddd',
            axes: true,
            resize: true,
            smooth:true,
            pointSize: 0,
            lineWidth: 0,
            fillOpacity:0.85,
                data: [
                    {period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
                    {period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
                    {period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
                    {period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
                    {period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
                    {period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
                    {period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
                    {period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
                    {period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},

                ],
                lineColors:['#eb6f6f','#926383','#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>

        <script type="text/javascript" src="js/monthly.js"></script>
        <script type="text/javascript">
            $(window).load( function() {

                $('#mycalendar').monthly({
                    mode: 'event',

                });

                $('#mycalendar2').monthly({
                    mode: 'picker',
                    target: '#mytarget',
                    setWidth: '250px',
                    startHidden: true,
                    showTrigger: '#mytarget',
                    stylePast: true,
                    disablePast: true
                });

            switch(window.location.protocol) {
            case 'http:':
            case 'https:':
            // running on a server, should be good.
            break;
            case 'file:':
            alert('Just a heads-up, events will not work when run locally.');
            }

            });
        </script>

<!-- load gallery -->
 <script type="text/javascript">

    load_gallery();

    function load_gallery(){
        var pro_id = $('.pro_id').val();
        var _token = $('input[name="_token"]').val();
        // alert(pro_id);
        $.ajax({
            url:"{{url('/select-gallery')}}",
            method:"POST",
            data:{pro_id:pro_id,_token:_token},
            success:function(data){
                $('#gallery_load').html(data);
            }
        });
    }

    $('#file').change(function(){
        var error = '';
        var files = $('#file')[0].files;

        if(files.length>5){
            error+='<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
        }else if(files.length==''){
            error+='<p>Bạn không được bỏ trống ảnh</p>';
        }else if(files.size > 2000000){
            error+='<p>File ảnh không được lớn hơn 2MB</p>';
        }

        if(error==''){

        }else{
            $('#file').val('');
            swal("Thông Báo",""+error+"","success");
            return false;
        }

    });

    $(document).on('blur','.edit_gal_name',function(){
        var gal_id = $(this).data('gal_id');
        var gal_text = $(this).text();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/update-gallery-name')}}",
            method:"POST",
            data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
            success:function(data){
                load_gallery();
                swal("Thông Báo","Cập nhật tên hình ảnh thành công", "success");
            }
        });
    });

    $(document).on('click','.delete-gallery',function(){
        var gal_id = $(this).data('gal_id');

        var _token = $('input[name="_token"]').val();
        if(confirm('Bạn muốn xóa hình ảnh này không?')){
            $.ajax({
                url:"{{url('/delete-gallery')}}",
                method:"POST",
                data:{gal_id:gal_id,_token:_token},
                success:function(data){
                    load_gallery();
                    swal("Thông Báo","Xóa hình ảnh thành công", "success");

                }
            });
        }
    });

    $(document).on('change','.file_image',function(){

        var gal_id = $(this).data('gal_id');
        var image = document.getElementById("file-"+gal_id).files[0];

        var form_data = new FormData();

        form_data.append("file", document.getElementById("file-"+gal_id).files[0]);
        form_data.append("gal_id",gal_id);



            $.ajax({
                url:"{{url('/update-gallery')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:form_data,

                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    load_gallery();
                    swal("Thông Báo","Cập Nhật hình ảnh thành công", "success");
                }
            });

    });




</script>
 <!-- load video -->
<script type="text/javascript">
    $(document).ready(function(){
    load_video();

    function load_video(){

            $.ajax({
                url:"{{url('/select-video')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data){
                    $('#video_load').html(data);
                }
            });
        }

        $(document).on('click','.btn-delete-video',function(){
            var video_id = $(this).data('video_id');
            if(confirm('Bạn muốn xóa video này không?')){
                $.ajax({
                    url:"{{url('/delete-video')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{video_id:video_id},
                    success:function(data){
                        load_video();
                        swal("Thông Báo","Xoá Video thành công", "success");
                    }
                });
            }


        });
        $(document).on('blur','.video_edit',function(){
            var video_type = $(this).data('video_type');
            var video_id = $(this).data('video_id');
            //alert(video_type);
            if(video_type=='video_title'){
                var video_edit = $('#'+video_type+'_'+video_id).text();
                var video_check = video_type;
            }else if(video_type=='video_desc'){
                var video_edit = $('#'+video_type+'_'+video_id).text();
                var video_check = video_type;
            }else if(video_type=='video_link'){
                var video_edit = $('#'+video_type+'_'+video_id).text();
                var video_check = video_type;
            }else{
                var video_edit = $('#'+video_type+'_'+video_id).text();
                var video_check = video_type;
            }

            $.ajax({
                url:"{{url('/update-video')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{video_check:video_check,video_edit:video_edit,video_id:video_id},
                success:function(data){
                    load_video();
                    swal("Thông Báo","Cập Nhật Video thành công", "success");
                }
            });

        });

        $(document).on('change','.file_img_video',function(){

            var video_id = $(this).data('video_id');
            var image = document.getElementById("file-video-"+video_id).files[0];

            var form_data = new FormData();

            form_data.append("file", document.getElementById("file-video-"+video_id).files[0]);
            form_data.append("video_id",video_id);



                $.ajax({
                    url:"{{url('/update-video-image')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,

                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(data){
                        load_video();
                        swal("Thông Báo","Cập Nhật hình ảnh Video thành công", "success");
                    }
                });

        });



    });

</script>
 <!-- load video -->
<script type="text/javascript">
    load_video();
    function load_video(){

        $.ajax({
            url:"{{url('/select-video')}}",
            method:"POST",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success:function(data){
                $('#video_load').html(data);
            }
        });
    }
	 $(document).on('click','#btn-add-video', function(){
            var video_title = $('.video_title').val();
            var video_slug = $('.video_slug').val();
            var video_desc = $('.video_desc').val();
            var video_link = $('.video_link').val();

            var form_data = new FormData();

            form_data.append("file", document.getElementById("file_img_video").files[0]);
            form_data.append("video_title",video_title);
            form_data.append("video_slug",video_slug);
            form_data.append("video_desc",video_desc);
            form_data.append("video_link",video_link);

            $.ajax({
                url:"{{url('/insert-video')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data:form_data,

                contentType:false,
                cache:false,
                processData:false,

                success:function(data){
                    load_video();
                    swal("Thông Báo","Thêm Video thành công", "success");
                }
            });


        });
</script>
        <!-- coment user -->
<script type="text/javascript">
    $('.comment_duyet_btn').click(function(){
        var comment_status = $(this).data('comment_status');

        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        if(comment_status==0){
            var alert = 'Thay đổi thành duyệt thành công';
        }else{
            var alert = 'Thay đổi thành không duyệt thành công';
        }
          $.ajax({
                url:"{{url('/allow-comment')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    window.setTimeout(function(){
                            location.reload();
                        } ,3000);
                    swal("Thông Báo",""+alert+"","success");

                }
            });


    });
    $('.btn-reply-comment').click(function(){
        var comment_id = $(this).data('comment_id');

        var comment = $('.reply_comment_'+comment_id).val();



        var comment_product_id = $(this).data('product_id');



          $.ajax({
                url:"{{url('/reply-comment')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    $('.reply_comment_'+comment_id).val('');
                    swal("Thông Báo","Trả Lời Bình Luận Thành Công","success");

                }
            });


    });
</script>
 <!-- kéo thả sắp xếp bằng ui jquery -->
<script type="text/javascript">
    $(document).ready(function(){

        $('#category_order').sortable({
            placeholder: 'ui-state-highlight',
             update  : function(event, ui)
              {
                var page_id_array = new Array();
                var _token = $('input[name="_token"]').val();

                $('#category_order tr').each(function(){
                    page_id_array.push($(this).attr("id"));
                });

                $.ajax({
                        url:"{{url('/arrange-category')}}",
                        method:"POST",
                        data:{page_id_array:page_id_array,_token:_token},
                        success:function(data)
                        {
                            swal("Thông Báo",""+data+"","success");
                        }
                });

              }
        });


    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#brand_order').sortable({
            placeholder: 'ui-state-highlight',
             update  : function(event, ui)
              {
                var page_id_array = new Array();
                var _token = $('input[name="_token"]').val();

                $('#brand_order tr').each(function(){
                    page_id_array.push($(this).attr("id"));
                });

                $.ajax({
                        url:"{{url('/arrange-brand')}}",
                        method:"POST",
                        data:{page_id_array:page_id_array,_token:_token},
                        success:function(data)
                        {
                            swal("Thông Báo",""+data+"","success");
                        }
                });

              }
        });


    });
</script>
 <!-- icon nút mạng xã hội -->
<script type="text/javascript">

    list_nut();
    function delete_icons(id){
         $.ajax({
                url:"{{url('/delete-icons')}}",
                method:"GET",
                data:{id:id},
                success:function(data)
                    {
                        swal("Thông Báo","Xoá Nút Thành Công","success");
                        list_nut();
                        list_doitac();
                    }
            });
    }
    function list_nut(){

          $.ajax({
                url:"{{url('/list-nut')}}",
                method:"GET",
                success:function(data)
                    {
                        $('#list_nut').html(data);
                    }
            });
    }
    $('.add-nut').click(function(){

         var name = $('#name').val();
         var link = $('#link').val();
         var image = $('#image_nut')[0].files[0];
         var form_data = new FormData();

            form_data.append('file',image);
            form_data.append('name',name);
            form_data.append('link',link);




       $.ajax({
                url:"{{url('/add-nut')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,

                data:form_data,
                success:function(data)
                    {
                        swal("Thông Báo","Thêm nút thành công","success");
                        list_nut();
                        $('#name').val('');
                        $('#link').val('');

                    }
            });
    })
</script>
<!-----------------List đối tác-------------------->
<script type="text/javascript">
    list_doitac();
    function list_doitac(){

          $.ajax({
                url:"{{url('/list-doitac')}}",
                method:"GET",
                success:function(data)
                    {
                        $('#list_doitac').html(data);
                    }
            });
    }
    $('.add-doitac').click(function(){

         var name = $('#name_doitac').val();
         var link = $('#link_doitac').val();
         var image = $('#image_doitac')[0].files[0];
         var form_data = new FormData();

            form_data.append('file',image);
            form_data.append('name',name);
            form_data.append('link',link);




       $.ajax({
                url:"{{url('/add-doitac')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,

                data:form_data,
                success:function(data)
                    {
                        swal("Thông Báo","Thêm đối tác thành công","success");

                       list_doitac();


                    }
            });
    });
</script>
    <!-- change slug -->

<script type="text/javascript">

    function ChangeToSlug()
        {
            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }




</script>
</body>
</html>
