<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xác nhận đơn hàng</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
	<div class="container" style="background: #9bf8ff;border-radius: 12px;padding:15px;">
		<div class="col-md-12" >

			<p style="text-align: center;color: #e40909;font-size: 18px;font-weight: 700;">Đây là email tự động. Quý khách vui lòng không trả lời email này.</p>
			<div class="row" style="background:#eef4f4de;padding: 15px">

				
				<div class="col-md-6" style="text-align: center;color: #1a1a1a;font-weight: bold;font-size: 30px">
					<h4 style="margin:0">Shop Bán Hàng K-Shopper</h4>
					<h6 style="margin:0">DỊCH VỤ BÁN HÀNG - VẬN CHUYỂN - TƯ VẤN CHUYÊN NGHIỆP</h5>
				</div>

				<div class="col-md-6 logo"  style="color: #000">
					<p>Chào bạn: <strong style="color: #ff2525;font-size: 18px;">{{mb_strtoupper($shipping_array['customer_name'])}}</strong></p>
				</div>
				
				<div class="col-md-12">
					<p style="color:#902020;font-size: 17px;">Bạn hoặc một ai đó đã đăng ký dịch vụ tại shop với thông tin như sau:</p>
					<h4 style="color: #000;text-transform: uppercase;">Thông tin đơn hàng</h4>
					<p>Mã đơn hàng : <strong style="text-transform: uppercase;color:#a22828">{{$code['order_code']}}</strong></p>
					<p>Mã khuyến mãi áp dụng : <strong style="text-transform: uppercase;color:#a22828">{{$code['coupon_code']}}</strong></p>
					<p>Phí ship hàng : <strong style="text-transform: uppercase;color:#a22828">{{number_format($shipping_array['fee'],0,',','.')}} VNĐ</strong></p>
					<p>Dịch vụ : <strong style="text-transform: uppercase;color:#a22828">Đặt hàng trực tuyến</strong></p>
					
					<h4 style="color: #000;text-transform: uppercase;">Thông tin người nhận</h4>

					<p>Email : 
						@if($shipping_array['shipping_email']=='')
							<span style="color:#a22828">không có</span>
						@else
							<span style="color:#a22828">{{$shipping_array['shipping_email']}}</span>
						@endif
					</p>

					<p>Họ và tên người gửi : 
						@if($shipping_array['shipping_name']=='')
							<span style="color:#a22828">Không Có</span>
						@else
							<span style="color:#a22828">{{$shipping_array['shipping_name']}}</span>
						@endif
					</p>
					<p>Địa chỉ nhận hàng : 
						@if($shipping_array['shipping_address']=='')
							<span style="color:#a22828">không có</span>
						@else
							<span style="color:#a22828">{{$shipping_array['shipping_address']}}</span>
						@endif
					</p>	
					<p>Số điện thoại : 
						@if($shipping_array['shipping_phone']=='')
							<span style="color:#a22828">không có</span>
						@else
							<span style="color:#a22828">{{$shipping_array['shipping_phone']}}</span>
						@endif
					</p>	
					<p>Ghi chú đơn hàng : 
						@if($shipping_array['shipping_notes']=='')
							<span style="color:#a22828">không có</span>
						@else
							<span style="color:#a22828">{{$shipping_array['shipping_notes']}}</span>
						@endif
					</p>	
					<p>Hình thức thanh toán : <strong style="text-transform: uppercase;color:#a22828">
						@if($shipping_array['shipping_method']==0)
							Chuyển khoản ATM
						@else
							Tiền mặt
						@endif
					
					</strong></p>
					<p style="color: #ff2828;font-size: 18px;">Nếu thông tin người nhận hàng không có chúng tôi sẽ liên hệ với người đặt hàng để trao đổi thông tin về đơn hàng đã đặt.</p>



					<h4 style="color: #000;text-transform: uppercase;">Sản phẩm đã đặt</h4>
<style>
	table, th, td {
  border: 1px solid gray;
}
table{
	width: 600px;
	height: auto;
	border-collapse: collapse;
	text-align: center;
}
th{
	font-size: 18px;
}
td{
	font-size: 15px;
	padding: 5px 5px;
}
</style>
					<table>
						<thead>
							<tr>
								<th>Sản phẩm</th>
								<th>Giá tiền</th>
								<th>Số Lượng</th>
								<th>Thành tiền</th>

							</tr>
						</thead>

						<tbody>
							@php 
							$sub_total = 0;
							$total = 0;
							@endphp	

							@foreach($cart_array as $cart)

							@php 
							$sub_total = ($cart['product_qty']*$cart['product_price']) - $cart['coupon_number'];
							$total+=$sub_total;
							$subNo=  $cart['product_qty']*$cart['product_price']
							@endphp	

							<tr style="text-align: center;">
								<td>{{$cart['product_name']}}</td>
								<td>{{number_format($cart['product_price'],0,',','.')}} VNĐ</td>
								<td>{{$cart['product_qty']}}</td>
								<td>{{number_format($subNo,0,',','.')}} VNĐ</td>
							</tr>
							@endforeach

							<tr style="text-align: center;">
								<td  style="color:#a22828;font-size: 17px;font-weight: 700">Giảm Giá: <td>{{number_format($cart['coupon_number'],0,',','.')}} VNĐ</td></td>
								<td  style="COLOR: darkred;font-size: 17px;font-weight: 700;text-decoration: underline;"colspan="4" align="right">Tổng tiền thanh toán : {{number_format($total+$shipping_array['fee'],0,',','.')}} VNĐ</td>
							</tr>

						</tbody>
					</table>
				</div>

				<p  align="right" style="color:#101010">Mọi chi tiết xin liên hệ website tại : <a target="_blank" href="https://khanhnguyen19c.gov.com/shop6x"> K-Shopper</a>, hoặc liên hệ qua số hotline : 77 2879 116 .Xin cảm ơn quý khách đã đặt hàng shop chúng tôi.</p>

			</div>
		</div>
	</div>
</body>
</html>

