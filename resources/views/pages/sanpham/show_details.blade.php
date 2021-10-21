
@extends('welcome')
@section('content')
@foreach ($deltais_product as $key=>$value )
@php
							$price_promotion =$value->product_price*$value->price_promotion/100;
							$total_price = $value->product_price - $price_promotion;
				@endphp
	<input type="hidden" id="product_viewed_id" value="{{$value->product_id}}">
	<input type="hidden" id="viewed_productname_{{$value->product_id}}" value="{{$value->product_name}}">
	<input type="hidden" id="viewed_producturl_{{$value->product_id}}" value="{{url('/chi-tiet-san-pham/'.$value->slug_product)}}">
	<input type="hidden" id="viewed_productprice_{{$value->product_id}}" value="{{number_format($total_price,0,',','.')}} VNĐ">
	<input type="hidden" id="viewed_productimage_{{$value->product_id}}" value="{{asset('public/uploads/product/'.$value->product_image)}}">
<style>
	li.active{

    color: #73abdd;
}
</style>
<div class="product-details"><!--product-details-->

<nav aria-label="breadcrumb" >
  <ol class="breadcrumb" style="background: none;font-size: 16px;">
    <li class="breadcrumb-item"><a href="{{Url('/trang-chu')}}">Trang Chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$cate_slug)}}">{{$product_cate}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
  </ol>


<style>
	.lSSlideOuter .active{
		border: 2px solid #f2060699;
	}
</style>
						<div class="col-sm-5">
						<ul id="imageGallery" >
						@foreach($gallery as $key => $gal)

						<li  data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
							    <img  width="100%" alt="{{$gal->gallery_name}}"  src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
							  </li>
						@endforeach
						</ul>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->

								<h2>{{$value->product_name}}</h2>
								<span style="text-decoration: line-through;">Giá Gốc: {{ number_format($value->product_price,0,',','.') }} VNĐ</span>

							<span>
							<form action="" method="POST">
								{{ csrf_field() }}
									<span>Giá bán: {{number_format($total_price).' VNĐ'}}</span>
									<label>Số Lượng:</label>
									<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
									<input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                                    <input style="width: 70px;" type="number" value="1" max="{{$value->product_quantity}}" min="1" class="cart_product_qty_{{$value->product_id}}">
									<input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />

									<button type="button" class="btn btn-default add-to-cart" id="cart-details" data-id_product="{{$value->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>  {{__('lang.themgiohang') }}</button>
							<div>


							</div>

							</form>
							<div class="row">


							<div class="col-sm-12" >
								<style>
									b{
										font-weight: 700;font-size: 17px
									}
								</style>
								<p><b>Tình Trạng:</b> Còn {{$value->product_quantity}} Sản Phẩm</p>
								<p><b>Điều Kiện:</b> Hàng New 100%</p>
								<p><b>Thương Hiệu:</b> {{$value->brand_name}}</p>
                                <p><b>Danh Mục:</b> {{$value->category_name}}</p>


								<fieldset>
							<legend>Tags</legend>
							<a href=""><i class="fa fa-tag"></i>

							@php
								$tags = $value->product_tags;
								$tags = explode(",",$tags);

							@endphp

							@foreach ($tags as $tag)
								<a href="{{Url('/tag/'.str_slug($tag))}}" class="tags_style">{{$tag}}</a>
							@endforeach
						</a>
						</fieldset>
							</div><!--/product-information-->
							</div>
						</div>

					</div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô Tả</a></li>

								<li><a href="#reviews" data-toggle="tab">Bình Luận</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="show-content">
                            <p>{!!$value->product_content!!}</p>

								</div>
								<p class="readmore">Đọc Thêm...</p>

							</div>



							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Admin</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>{{date("h:i:s")}}</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>{{date("m.d.y")}}</a></li>
									</ul>
									<style type="text/css">
										.style_comment {
										    border: 1px solid #ddd;
										    border-radius: 10px;
										    background: #eeeeee;
										}
									</style>
									<form>
										 @csrf
										<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
										 <div id="comment_show"></div>

									</form>

									<p><b>Viết đánh giá của bạn</b></p>

									 <!------Rating here---------->
                                                <ul class="list-inline rating"  title="Average Rating">
                                                	@for($count=1; $count<=5; $count++)
                                                		@php
	                                                		if($count<=$rating){
	                                                			$color = 'color:#ffcc00;';
	                                                		}
	                                                		else {
	                                                			$color = 'color:#ccc;';
	                                                		}

                                                		@endphp

                                                    <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}"  data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                                    @endfor

                                                </ul>



									<form action="#">
										<span>
											<input style="width:100%;margin-left: 0" type="text" class="comment_name" placeholder="Tên bình luận"/>

										</span>
										<textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
										<div id="notify_comment"></div>

										<button type="button" class="btn btn-default pull-right send-comment">
											Gửi bình luận
										</button>

									</form>
								</div>
							</div>

						</div>
					</div><!--/category-tab-->
	@endforeach
	<p class="hiden_content" >Ẩn Bớt...</p>

					<div class="col-md-12" id="doitac">
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						<div class="owl-carousel owl-theme ">

						@foreach($realeted as $key => $lienquan)
						@php
						$price_promotion_po =$lienquan->product_price*$lienquan->price_promotion/100;
							$total_price_po = $lienquan->product_price - $price_promotion_po;
										@endphp
							<div class="item" style="padding-left:0 !important; ">

									<div class="col-sm-4" style="width:100%">
										<div class="product-image-wrapper">
											 <div class="single-products">
		                                        <div class="productinfo text-center product-related">
                                                <div >
												<span class="promotion_title">{{number_format($value->product_price,0,',','.')}} VNĐ</span>
												<span class="promotion">-{{$value->price_promotion}}%</span>

											</div>
												<form>
                                                @csrf
                                            <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                                            <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}" id="wishlist_productname{{$lienquan->product_id}}">
                                            <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                                            <input type="hidden" value="{{$total_price_po}}" class="cart_product_price_{{$lienquan->product_id}}">
											<input type="hidden" value="{{$lienquan->product_quantity}}" class="cart_product_quantity_{{$lienquan->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
											<input type="hidden" value="{{number_format($total_price_po,0,',','.')}} VNĐ" class="cart_product_price_list_{{$lienquan->product_id}}" id="wishlist_productprice{{$lienquan->product_id}}">
                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->slug_product)}}" id="wishlist_producturl{{$lienquan->product_id}}">
											<img src="{{URL::To('public/uploads/product/'.$lienquan->product_image)}}" alt="" id="wishlist_productimage{{$lienquan->product_id}}" />
													<h2>{{number_format($total_price_po).' VNĐ'}}</h2>
													<p>{{$lienquan->product_name}}</p>
                                             </a>
														</div>
											 <div class="product-overlay">
											<div class="overlay-content">
												<h2>{{number_format($total_price).' VNĐ'}}</h2>
												{!! $lienquan->product_desc !!}
												<button  type="button" class="btn btn-default cart-add home_cart_{{ $lienquan->product_id }}" id="{{$lienquan->product_id}}" onclick="Addtocart(this.id)"><i class="fa fa-shopping-cart"></i> {{__('lang.themgiohang') }}</button>
												<button style="display:none" class="btn btn-danger del-cart rm_home_cart_{{ $lienquan->product_id }}" id="{{ $lienquan->product_id }}" onclick="Deletecart(this.id);"><i class="fa fa-shopping-cart"></i> {{__('lang.xoagiohang') }}</button>

											</div>
										</div>

                                            </form>
                                			</div>
										</div>
										<a  href="{{url('chi-tiet-san-pham/'.$lienquan->slug_product)}}"> <button style="margin-left: 5%;" type="button" class="btn btn-default watch-sp"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</button> </a>
										<div class="choose">

										<ul class="nav nav-pills nav-justified">
										<li>
										<i class="fa fa-star" aria-hidden="true"></i>
										<button class="button_wishlist" id="{{$lienquan->product_id}}" onclick="add_wistlist(this.id);"><span> {{__('lang.themyeuthich') }}</span>  </button>
									</li>

										<li>
											<i class="fa fa-plus-square"></i>
											<button class="button_wishlist" data-toggle="modal" data-target="#sosanh" style="cursor:pointer;border: none;padding-left: 5px;background: none;" onclick="add_compare({{$lienquan -> product_id}})"><span> {{__('lang.themsosanh') }}</span></button>
										</li>
									</ul>




								</div>
									</div>
							</div>
							@endforeach




						</div>
					</div><!--/recommended_items-->
					<div class="modal" id="sosanh" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">So Sánh Sản Phẩm</h5>

      </div>
      <div class="modal-body">
        <div id="title-compare"></div>
        <style>
          table , td , th{
          text-align: center;
          }
          #title-compare{
              color: red;
              font-size: 18px;
              text-align: right;
              font-weight: 400;
          }

        </style>
      <table class="table" id="row_compare" >
          <thead class="thead-dark">
            <tr>
              <th scope="col">Tên Sản Phẩm</th>
              <th scope="col">Giá Sản Phẩm</th>
              <th scope="col">Hình Ảnh</th>
              <th scope="col" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

@endsection
