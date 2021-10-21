@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
			<style type="text/css">
				p.title_thongke {
				    text-align: center;
				    font-size: 20px;
				    font-weight: bold;
				}
			</style>
<div class="row">
		<p class="title_thongke">Thống kê đơn hàng doanh số</p>

		<form autocomplete="off">
			@csrf

			<div class="col-md-2">
				<p>Từ ngày: <input type="date" id="datepicker" class="form-control" min="2021-01-01" value="2021-01-01"></p>

				<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>
				
			</div>

			<div class="col-md-2">
				<p>Đến ngày: <input type="date" id="datepicker2" class="form-control" placeholder="Đến Ngày Nào"></p>
				
			</div>

			
			<div class="col-md-2">
				<p>
					Lọc theo: 
					<select class="dashboard-filter form-control" >
						<option>--Chọn--</option>
						<option value="7ngay">7 ngày qua</option>
						<option value="thangtruoc">tháng trước</option>
						<option value="thangnay">tháng này</option>
						<option value="365ngayqua">365 ngày qua</option>
					</select>
				</p>
			</div>

		</form>

		<div class="col-md-12">
			<div id="chart" style="height: 250px;"></div>
		</div>

</div>

<div class="row" style="margin-top:95px">
	<style type="text/css">
		table.table.table-bordered.table-dark {
		    background: #32383e;
		}
		table.table.table-bordered.table-dark tr th {
		    color: #fff;
		}
	</style>

<p class="title_thongke">Thống kê truy cập</p>

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Đang online</th>
      <th scope="col">Tổng tháng trước</th>
      <th scope="col">Tổng tháng này</th>
      <th scope="col">Tổng một năm</th>
      <th scope="col">Tổng truy cập</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <td>{{$visitor_count}}</td>
      <td>{{$visitor_last_month_count}}</td>
      <td>{{$visitor_this_month_count}}</td>
      <td>{{$visitor_year_count}}</td>
      <td>{{$visitors_total}}</td>
    </tr>
   
  </tbody>
</table>

</div>

<div class="row">

	<div class="col-md-4 col-xs-12">
		<p class="title_thongke">Thống kê tổng sản phẩm bài viết đơn hàng</p>
		<div id="donut"></div>	
	</div>

	<!--------------------------->

	<div class="col-md-4 col-xs-12">
		<h3>Bài viết xem nhiều</h3>

		<ol class="list_views">
		@foreach($post_views as $key => $post)
			<li>
				<a target="_blank" href="{{url('/tin-tuc/'.$post->post_slug)}}">{{$post->post_title}} | Views <span style="color:red;font-weight:bold">{{$post->post_views}}</span></a>
			</li>
			@endforeach
		</ol>
		
	</div>

	<div class="col-md-4 col-xs-12">
		<style type="text/css">
			ol.list_views {
			    margin: 10px -5px;
				padding-bottom: 10px;
				height: 400px;
				overflow: scroll;
				background-color: #8a909030;
			}
			ol.list_views li{
				padding-top: 10px;
				padding-bottom: 10px;
			}
			ol.list_views a {
				color: #161616;
   				 font-weight: 500;
				
			}
			::-webkit-scrollbar{
    width: .50rem;
    background-color: #d5d6d62b;
    border-radius: .5rem;
}
::-webkit-scrollbar-thumb{
    background-color: #45cae87d;
    border-radius: .5rem;
}
::-webkit-scrollbar-thumb:hover{
    background-color: #077c9ab8;
}
		</style>
		<h3>Sản phẩm xem nhiều</h3>

		<ol class="list_views">
		@foreach($product_views as $key => $pro)
			<li>
				<a target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->slug_product)}}">{{$pro->product_name}} | Views <span style="color:red;font-weight:bold">{{$pro->product_views}}</span></a>
			</li>
			@endforeach
		</ol>

	</div>
</div>


</div>

@endsection