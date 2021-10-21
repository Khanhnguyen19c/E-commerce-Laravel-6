<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Đăng Nhập Auth</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="public/BackEnd/CSS/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="public/BackEnd/CSS/style.css" rel='stylesheet' type='text/css' />
<link href="public/BackEnd/CSS/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="public/BackEnd/CSS/font.css" type="text/css"/>
<link href="public/BackEnd/CSS/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="public/BackEnd/js/jquery2.0.3.min.js"></script>
<base href="{{ asset('') }}">
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Sign Up Now</h2>
	<?php 
		$message = Session()->get('message');
		if($message)
		{
			echo '<span class="text-alert">'.$message. '</span>';
			Session()->put('message',null);
		}
	?>
		<form action="{{URL::to('/login')}}" method="POST">
		{{ csrf_field() }}
			<input type="email" class="ggg" name="admin_email" placeholder="Nhap Email" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Nhap Password" required="">
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="#">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In Auth" name="login">
		</form>
        <a href="{{URL::To('login-facebook')}}"><i class="fa fa-facebook"></i> Login Facebook||</a>
		<a href="{{URL::To('login-google')}}"><i class="fa fa-google"></i> Login Google</a>
        <a href="{{URL::To('register-auth')}}">|| Register Auth</a>
		<a href="{{URL::To('login-auth')}}">|| Auth</a>
		<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
		<br/>
		@if($errors->has('g-recaptcha-response'))
		<span class="invalid-feedback" style="display:block">
			<strong>{{$errors->first('g-recaptcha-response')}}</strong>
		</span>
		@endif

</div>
</div>
<script src="public/BackEnd/JS/bootstrap.js"></script>
<script src="public/BackEnd/JS/jquery.dcjqaccordion.2.7.js"></script>
<script src="public/BackEnd/JS/scripts.js"></script>
<script src="public/BackEnd/JS/jquery.slimscroll.js"></script>
<script src="public/BackEnd/JS/jquery.nicescroll.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="public/BackEnd/JS/jquery.scrollTo.js"></script>
</body>
</html>
