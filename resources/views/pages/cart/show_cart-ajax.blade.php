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

		@if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
	<div class="table-responsive cart_info"style="overflow-x: hidden;">

		<form action="{{url('/update-cart')}}" method="POST">
					@csrf
			<table class="table table-condensed" >
				<thead>
					<tr class="cart_menu">
						<td class="image"style="width: 17%;">Hình ảnh</td>
						<td class="description">Tên sản phẩm</td>
						<td class="price">Giá sản phẩm</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Thành tiền</td>
						<td>Action</td>
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
							<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="30%" alt="{{$cart['product_name']}}" />
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
							
									<input style="width: 55px;" class="cart_quantity" type="number" max="{{$cart['product_quantity']}}" min="1" name="cart_qty[{{$cart['session_id']}}]"  value="{{$cart['product_qty']}}">

								
								
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
				<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
				</form>
			</table>

			<a class="btn btn-default check_out" href="{{URL::to('/delete-all-product')}}">Xoá Tất Cả Sản Phẩm</a>
			<?php
					$customer_id = Session()->get('customer_id');
					if ($customer_id != NULL ) {
					?>
						<a style="float: right;" class="btn btn-default check_out" href="{{URL::to('/check-out')}}">Thanh toán</a>
			<?php }else{
				?>
			<a style="float: right;" class="btn btn-default check_out" href="{{URL::to('/dang-nhap')}}">Thanh toán</a>
			<?php }?>
			
		</div>
	
</section>
<!--/#cart_items-->
@else
<th colspan="4" style="text-align: center;">*Vui lòng thêm sản phẩm vào giỏ hàng</td>
	</table>
	</div>
	</section>
	@endif
	@endsection