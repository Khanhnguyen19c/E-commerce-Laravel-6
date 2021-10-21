@extends('welcome')
@section('content')

<section id="cart_items">
		
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			
			<div class="review-payment">
			<?php 
			echo Session()->get('customer_id');
			?>
				<h2>Xem lại giỏ hàng</h2>
			</div>
			<div class="table-responsive cart_info">

			<table class="table table-condensed">
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
							<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<form action="{{URL::To('update-cart')}}" method="POST">
									@csrf
									<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">

									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
								</form>
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">
								{{number_format($subtotal,0,',','.')}}đ

							</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{URL::to('/cart-quantity-delete/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					@endforeach

				</tbody>

			</table>
			<a class="btn btn-default check_out" href="{{URL::to('/delete-all-product')}}">Xoá Tất Cả Sản Phẩm</a>
		</div>
			<h4 style="margin:40px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
			<?php 
			$curtomer_id =Session()->get('customer_id');
				if($curtomer_id){
			?>
			<form method="POST" action="{{URL::to('/order-place')}}">
			<?php }else{
			?>
			<form method="GET" action="{{URL::to('/dang-nhap')}}">
			<?php }?>
				{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
					</span>
					<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
			</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

	@else
<th colspan="4" style="text-align: center;">*Vui lòng thêm sản phẩm vào giỏ hàng</td>
	</table>
	</div>
	</section>
	@endif
	@endsection