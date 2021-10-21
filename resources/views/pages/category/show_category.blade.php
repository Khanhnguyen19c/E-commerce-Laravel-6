@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->


						@foreach ($category_name as $key =>$name )
						<h2 class="title text-center">Danh Mục {{$name->category_name}}</h2>
						@endforeach
							<div class="row">
								<div class="col-md-4">
									<label for="amount">Sắp Xếp Theo</label>
									<form>
										@csrf
										<select name="sort" id="sort" class="form-control">
										@if(isset($_GET['sort_by']))
											<?php $sort_by = $_GET['sort_by']; ?>
											@if($sort_by=='kytu_az')
											<option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
											<option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
											<option value="{{Request::url()}}?sort_by=kytu_az" selected>--A Đến Z--</option>
											<option value="{{Request::url()}}?sort_by=kytu_za">--Z Đến A--</option>
											@elseif($sort_by=='kytu_za')
											<option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
											<option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
											<option value="{{Request::url()}}?sort_by=kytu_az" >--A Đến Z--</option>
											<option value="{{Request::url()}}?sort_by=kytu_za" selected>--Z Đến A--</option>
											@elseif($sort_by=='giam_dan')
											<option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
											<option value="{{Request::url()}}?sort_by=giam_dan" selected>--Giá giảm dần--</option>
											<option value="{{Request::url()}}?sort_by=kytu_az" >--A Đến Z--</option>
											<option value="{{Request::url()}}?sort_by=kytu_za" >--Z Đến A--</option>
											@elseif($sort_by=='tang_dan')
											<option value="{{Request::url()}}?sort_by=tang_dan" selected>--Giá tăng dần--</option>
											<option value="{{Request::url()}}?sort_by=giam_dan" >--Giá giảm dần--</option>
											<option value="{{Request::url()}}?sort_by=kytu_az" >--A Đến Z--</option>
											<option value="{{Request::url()}}?sort_by=kytu_za" >--Z Đến A--</option>
											@endif
											@else
											<option value="{{Request::url()}}?sort_by=none">--Chọn--</option>
											<option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
											<option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
											<option value="{{Request::url()}}?sort_by=kytu_az">--A Đến Z--</option>
											<option value="{{Request::url()}}?sort_by=kytu_za">--Z Đến A--</option>
											@endif
										</select>
									</form>
								</div>
								<div class="col-md-1">

								</div>
								<div class="col-md-5">
								<form>

                                        <div id="slider-range"></div>
                                        <style type="text/css">
                                            .style-range p {
                                                float: left;
                                                width: 36%;
                                            }
                                        </style>

                                        <div class="style-range">

                                            <p><input type="text" id="amount_start" readonly style="border:0; color:#d7202c; font-size:17px; font-weight:bold;margin-top:10px;"></p>
                                            <p><input type="text" id="amount_end" readonly style="border:0; color:#d7202c; font-size:17px; font-weight:bold;margin-top:10px;"></p>
                                        </div>

                                        <input type="hidden" name="start_price" id="start_price">
                                        <input type="hidden" name="end_price" id="end_price">
										<input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-primary" style="float: right;background: #000000c4;color: whitesmoke;">
                                         <br>
                                         <div class="clearfix"></div>

                                    </form>

                            </div>



                        </div>

						@foreach ($category_by_id as $key=>$pro )
										@php
											$price_promotion =$pro->product_price*$pro->price_promotion/100;
											$total_price = $pro->product_price - $price_promotion;
										@endphp
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										<div >
												<span class="promotion_title">{{number_format($pro->product_price,0,',','.')}} VNĐ</span>
												<span class="promotion">-{{$pro->price_promotion}}%</span>

											</div>
										<a id="wishlist_producturl{{$pro->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$pro->slug_product)}}"><img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" id="wishlist_productimage{{$pro->product_id}}"> </a>
											<h2>Giá bán: {{number_format($total_price).' VNĐ'}}</h2>
											<p>{{$pro->product_name}}</p>

                                            <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                            <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}" id="wishlist_productname{{$pro->product_id}}">
                                            <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
											<input type="hidden" value="{{$pro->product_quantity}}" class="cart_product_quantity_{{$pro->product_id}}">
											<input type="hidden" value="{{$total_price}}" class="cart_product_price_{{$pro->product_id}}">
											<input type="hidden" value="{{number_format($total_price,0,',','.')}} VNĐ" class="cart_product_price_list_{{$pro->product_id}}" id="wishlist_productprice{{$pro->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
											</div>
											<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{number_format($total_price).' VNĐ'}}</h2>
                                                {!! $pro->product_desc !!}
												<button  type="button" class="btn btn-default cart-add home_cart_{{ $pro->product_id }}" id="{{$pro->product_id}}" onclick="Addtocart(this.id)"><i class="fa fa-shopping-cart"></i> {{__('lang.themgiohang') }}</button>
												<button style="display:none" class="btn btn-danger del-cart rm_home_cart_{{ $pro->product_id }}" id="{{ $pro->product_id }}" onclick="Deletecart(this.id);"><i class="fa fa-shopping-cart"></i> {{__('lang.xoagiohang') }}</button>
												</div>
										</div>

								</div>
								<a href="{{url('chi-tiet-san-pham/'.$pro->slug_product)}}"> <button type="button" class="btn btn-default watch-sp"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</button> </a>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li>
										<i class="fa fa-star" aria-hidden="true"></i>
										<button class="button_wishlist" id="{{$pro->product_id}}" onclick="add_wistlist(this.id);"><span> {{__('lang.themyeuthich') }}</span>  </button> </li>

										<li><i class="fa fa-plus-square"></i><span><button data-toggle="modal" data-target="#sosanh" style="cursor:pointer;border: none;padding-left: 5px;background: none;" onclick="add_compare({{$pro -> product_id}})">{{__('lang.themsosanh') }}</span></button></li>
									</ul>

								</div>

							</div>

						</div>

						@endforeach
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
					</div><!--features_items-->
					{{$category_by_id->links()}}
					<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>

                    @endsection
