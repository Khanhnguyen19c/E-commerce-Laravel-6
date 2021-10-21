@extends('welcome')
@section('content')
<section id="cart_items">
	<div class="container1">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Trang Chủ</a></li>
				<li class="active">Giỏ Hàng Của Bạn</li>
			</ol>
		</div>

		<div class="shopper-informations">
			<div class="row">
				<style type="text/css">
					.col-md-6.form-style input[type=text] {
						margin: 5px 0;
					}
				</style>
				<div class="col-md-12 clearfix">
					<div class="bill-to">
						<p>Điền thông tin gửi hàng</p>

						<div class="col-md-6 form-style">

							<form method="POST" action="#">
								@csrf
								<input type="text" name="shipping_email" class="shipping_email form-control" placeholder="Điền email">
								<input type="text" name="shipping_name" class="shipping_name form-control" placeholder="Họ và tên người gửi">
								<input type="text" name="shipping_phone" class="shipping_phone form-control" placeholder="Số điện thoại">
								<input disabled type="text" name="shipping_address" class="shipping_address form-control" id="shipping_address" placeholder="Địa Chỉ Giao Hàng">
								<textarea name="shipping_notes" class="shipping_notes form-control" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>

								@if(Session::get('fee'))
								<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
								@else
								<input type="hidden" name="order_fee" class="order_fee" value="25000">
								@endif

								@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
								<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
								@endforeach
								@else
								<input type="hidden" name="order_coupon" class="order_coupon" value="no">
								@endif
								<input id="make_text1" type="hidden" class="cityy" name="city" value="{{old('city')}}" />
								<input id="make_text2" type="hidden" class="provincee" name="province" value="{{old('province')}}" />
								<input id="make_text3" type="hidden" class="wardss" name="wardss" value="{{old('wardss')}}" />
								<div id="tam" style="display:none">

								</div>

								<div class="">
									<div class="form-group">
										<label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
										<select name="payment_select" class="form-control  payment_select">
											<option value="0">Qua chuyển khoản</option>
											<option value="1">Tiền mặt</option>
										</select>
									</div>
								</div>

								<script>
									function setTextField1(ddl) {
										document.getElementById('make_text1').value = ddl.options[ddl.selectedIndex].text;
									}

									function setTextField2(ddl) {
										document.getElementById('make_text2').value = ddl.options[ddl.selectedIndex].text;
									}

									function setTextField3(ddl) {
										document.getElementById('make_text3').value = ddl.options[ddl.selectedIndex].text;
									}
								</script>
								<input style="margin-bottom:20px" type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
							</form>

						</div>
						<div class="col-md-6">
							<form>
								@csrf

								<div class="form-group">
									<label for="exampleInputPassword1">Chọn thành phố</label>
									<select name="city" id="city" class="form-control selecter choose city" onchange="setTextField1(this)">

										<option value="">--Chọn tỉnh thành phố--</option>
										@foreach($city as $key => $ci)
										<option value="{{$ci->matp}}">{{$ci->name_tp}}</option>
										@endforeach

									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn quận huyện</label>
									<select name="province" id="province" class="form-control selecter province choose" onchange="setTextField2(this)">
										<option value="">--Chọn quận huyện--</option>

									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Chọn xã phường</label>
									<select name="wards" id="wards" class="form-control selecter wards" onchange="setTextField3(this)">
										<option value="">--Chọn xã phường--</option>
									</select>
								</div>


								<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm check_delivery">


							</form>
						</div>



					</div>
				</div>
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
					<div class="table-responsive cart_info" style="overflow-x:hidden;">
						<table class="table table-condensed">
							<form action="{{url('/update-cart')}}" method="POST">
								@csrf
								<thead>
									<tr class="cart_menu">
										<td class="image">Hình ảnh</td>
										<td class="description">Tên sản phẩm</td>
										<td class="price">Giá sản phẩm</td>
										<td class="quantity">Số lượng</td>
										<td class="total">Thành tiền</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@if(Session()->get('cart')==true)
									@php
									$total = 0;
									$subtotal =0;

									@endphp
									@foreach(Session::get('cart') as $key => $cart)
									@php
									$subtotal = $cart['product_price']*$cart['product_qty'];
									$total+=$subtotal;
									@endphp
									<tr>
										<td class="cart_product">
											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
										</td>
										<td class="cart_description">
											<h4><a href=""></a></h4>
											<p>{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">

												<input class="cart_quantity" type="number" max="{{$cart['product_quantity']}}" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">



											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
												{{number_format($subtotal,0,',','.')}} VNĐ

											</p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="{{URL::to('/cart-quantity-delete/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									@endforeach

								</tbody>

						</table>
						<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
						<a class="btn btn-default check_out" href="{{URL::to('/delete-all-product')}}">Xoá Tất Cả Sản Phẩm</a>
					</div>
					</form>
				</div>
</section>
<!--/#cart_items-->
<section id="do_action">
	<div class="container1">

		<div class="row">
			<div class="col-sm-6">

			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>

						<li>Tổng <span> {{number_format($total,0,',','.')}} VNĐ</span></li>
						@if(Session::get('coupon'))
						@foreach(Session::get('coupon') as $key => $cou)
						@if($cou['coupon_condition']==1)
						<li><a class="btn btn check_coupon" href="{{URL::to('/unset-coupon')}}"><i class="fa fa-times"></i></a> Mã giảm : <span>{{$cou['coupon_number']}} % </span></li>
						<p>
							@php
							$total_coupon = ($total*$cou['coupon_number'])/100;
							@endphp
						</p>
						<p>
							@php
							$total_after_coupon = $total - $total_coupon
							@endphp
						</p>
						@elseif($cou['coupon_condition']==2)
						<li><a class="btn btn check_coupon" href="{{URL::to('/unset-coupon')}}"><i class="fa fa-times"></i></a> Mã giảm : <span>{{number_format($cou['coupon_number'],0,',','.')}} VNĐ </span></li>
						@php
						$total_coupon = $total - $cou['coupon_number'];
						$total_after_coupon = $total_coupon;
						@endphp
						@endif
						@endforeach
						@endif

						<li><a class="btn btn check_coupon" href="{{URL::to('/unset-delivery')}}"><i class="fa fa-times"></i></a> Phí vận chuyển: <span>
								@if (Session()->get('fee')) {{number_format(Session()->get('fee'),0,',','.')}} VNĐ
								<?php $total_after_fee = $total + Session()->get('fee'); ?></span></li>
								@else
								 25.000 VNĐ
						@endif
						<li>Thành Tiền: <span>
								@php
								if(Session::get('fee') && !Session::get('coupon')){
								$total_after = $total_after_fee ;
								echo number_format($total_after,0,',','.').'VNĐ';
								}elseif(!Session::get('fee') && Session::get('coupon')){
								$total_after = $total_after_coupon + 25000;
								echo number_format($total_after,0,',','.').'VNĐ';
								}elseif(Session::get('fee') && Session::get('coupon')){
								$total_after = $total_after_coupon;
								$total_after = $total_after + Session::get('fee');
								echo number_format($total_after,0,',','.').'VNĐ';
								}elseif(!Session::get('fee') && !Session::get('coupon')){
								$total_after = $total+ 25000;
								echo number_format($total_after,0,',','.').'VNĐ';
								}
								@endphp
							</span></li>

						</span>

					</ul>
					<div class="row">
						<div class="col-md-6">
							<form style="width: 250px;padding-left: 42px;" action="{{URL::To('check-coupon')}}" method="POST">
								@csrf

								<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
								<input style="margin-top:10px;" type="submit" class="btn btn-default check_coupon" value="check" name="check_coupon">
							</form>
						</div>
						<div class="col-md-6">
							@php

							$vnd_to_usd = $total_after/23083;
							@endphp
							<div id="paypal-button" style="margin-left: 37px;"></div>
							<input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}">
						</div>

					</div>
				</div>




			</div>
		</div>
	</div>
</section>
<!--/#do_action-->
@else
<th colspan="4" style="text-align: center;">*Vui lòng thêm sản phẩm vào giỏ hàng</td>
	</table>
	</div>
	</section>
	@endif
	@endsection