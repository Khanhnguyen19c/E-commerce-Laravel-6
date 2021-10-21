
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Shopper</title>
    <!-- FAVIVON -->
    <link rel="icon" type="image/x-icon" href="{{asset('public/FrontEnd/Images/icon/logo.png')}}" />
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- APP CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
	<base href="{{ asset('') }}">
    <link rel="stylesheet" href="public/BackEnd/CSS/app.css">
</head>

<body class="preloading" onload="load()">
<div class="preloader"></div>
    <div class="container">
        <div class="main-container">
            <div class="main-content">
                <div class="slide-container" style="background-image: url(public/BackEnd/Images/slide/phone-frame.png);">
                    <div class="slide-content" id="slide-content">
                        <img src="{{url('public/BackEnd/Images/slide/slide (1).jpg')}}" alt="slide image" class="active">
                        <img src="{{url('public/BackEnd/Images/slide/slide (2).jpg')}}" alt="slide image">
                        <img src="{{url('public/BackEnd/Images/slide/slide (3).jpg')}}" alt="slide image">
                        <img src="{{url('public/BackEnd/Images/slide/slide (4).jpg')}}" alt="slide image">
                        <img src="{{url('public/BackEnd/Images/slide/slide (5).jpg')}}" alt="slide image">
                    </div>
                </div>
                <div class="form-container">
                    <div class="form-content box">
                        <div class="logo">
                            <img width="100%" src="{{url('public/BackEnd/Images/LOGO1.png')}}" alt="Instagram logo" class="logo-light">
                            <img  width="100%" src="{{url('public/BackEnd/Images/LOGO1.png')}}" alt="Instagram logo" class="logo-dark">
                        </div>
                        <div class="signin-form" id="signin-form">
                        <?php
		$message = Session()->get('message');

		if($message){
		echo "<script>";
		echo "function load(){";
		echo "swal("."'$message'".");";
		echo "}";
		echo "</script>";
		Session()->put('message', null);
		}
		?>
						<form action="{{URL::to('/login')}}" method="POST">
						{{ csrf_field() }}

                                <div class="form-group">
                                    <div class="animate-input active">
                                        <span>
                                            email
                                        </span>
										<input type="email" class="ggg" name="admin_email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="animate-input active">
                                        <span>
                                            Password
                                        </span>
										<input type="password" class="ggg" name="admin_password"  required>

                                    </div>

                                </div>

                                <div class="btn-group">

                                    <button class="btn-login" id="signin-btn" name="submit">
                                        Log In
                                    </button>

                                </div>
                            </form>

                            <div class="divine">
                                <div></div>
                                <div>OR</div>
                                <div></div>
                            </div>
                            <div class="btn-group">
							<a href="{{URL::To('login-facebook')}}">
                                <button class="btn-fb">
                                    <img src="{{url('public/BackEnd/Images/fb.png')}}" alt="">
                                    <span>Log in with Facebook</span>
                                </button>
							</a>
							<a href="{{URL::To('login-google')}}">
							<button class="btn-fb">
							<img src="{{url('public/BackEnd/Images/gg.png')}}" alt="">
								<span>Log in with Google</span>
								</button>
							</a>
                            </div>

                            <a href="#" class="forgot-pw">Forgot password?</a>
                        </div>
                    </div>

                    <div class="app-download">
                        <p>Get the app.</p>
                        <div class="store-link">
                            <a href="#">
                                <img src="{{url('public/BackEnd/Images/slide/app-store.png')}}" alt="app store">
                            </a>
                            <a href="#">
                                <img src="{{url('public/BackEnd/Images/slide/gg-play.png')}}" alt="google play">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="links">
                <a href="#">About</a>
                <a href="#">Blog</a>
                <a href="#">Jobs</a>
                <a href="#">Help</a>
                <a href="#">API</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Top Accounts</a>
                <a href="#">Hashtags</a>
                <a href="#">Locations</a>
                <a href="#" id="darkmode-toggle">Darkmode</a>
            </div>
            <div class="copyright">
                © 2021 SF Travel
            </div>
        </div>
    </div>
    <!-- APP JS -->
    <script src="public/BackEnd/JS/app.js"></script>
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    {!! Toastr::message() !!}
</body> <script src="public/BackEnd/JS/app.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>
