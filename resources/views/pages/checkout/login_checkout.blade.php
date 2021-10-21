@extends('welcome')
@section('content')

<section id="form"><!--form-->
		<div class="container1">
			<div class="row">
			<div class="col-sm-12 clearfix">
				@if(session()->has('message'))
				<div class="alert alert-success">
					{!! session()->get('message') !!}
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-danger">
					{!! session()->get('error') !!}
				</div>
				@endif
				<div class="col-sm-5 col-sm-offset-1">
					<div class="login-form"><!--login form-->
					
						<h2>Đăng Nhập Tài Khoản</h2>
						<form action="{{URL::To('/login-customer')}}" method="POST">
						{{ csrf_field() }}
							<input name="customer_email" type="email" placeholder="Email" />
							<input name="customer_password" type="password" placeholder="Password" />
							
							<span>
							
								<input type="checkbox" class="checkbox"> 
								Ghi Nhớ
								<a href="{{url::to('quen-mat-khau')}}">Quên Mật Khẩu?</a>
								<ul class="list-login">

<li>
	<a href="{{url('login-customer-google')}}">
		<img width="10%" alt="Đăng nhập bằng tài khoản google"  src="{{asset('public/frontend/images/icon/gg.png')}}">
	</a>
</li>

<li>
	<a href="{{url('login-facebook-customer')}}">
		<img width="10%" alt="Đăng nhập bằng tài khoản facebook"  src="{{asset('public/frontend/images/icon/fb.png')}}">
	</a>
</li>
</ul>
							</span>
						
							<button type="submit" class="btn btn-default">Đăng Nhập</button>
							
						</form>
						

						
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Tạo Tài Khoản Mới!</h2>
						<form action="{{URL::To('/add-customer')}}" method="POST">
						{{ csrf_field() }}
							<input name="customer_name" type="text" placeholder="Name"/>
							<input name="customer_email" type="email" placeholder="Email Address"/>
							<input name="customer_password" type="password" placeholder="Password"/>
							<input name="customer_phone" type="text" placeholder="phone"/>
							<button type="submit" class="btn btn-default">Đăng Ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection