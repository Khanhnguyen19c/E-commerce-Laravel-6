@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center"> Kết Quả Tìm Kiếm </h2>
						@foreach ( $search_product as $key=>$pro )


						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										@php
											$price_promotion =$pro->product_price*$pro->price_promotion/100;
											$total_price = $pro->product_price - $price_promotion;
										@endphp
										<div >
												<span class="promotion_title" >{{number_format($pro->product_price,0,',','.')}} VNĐ</span>
												<span class="promotion">-{{$pro->price_promotion}}%</span>

											</div>
										<form>
                                                @csrf
                                            <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                            <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                                            <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                                            <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">

                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->slug_product)}}">
                                                <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" />
                                                <h2>{{number_format($total_price,0,',','.')}} VNĐ</h2>
                                                <p>{{$pro->product_name}}</p>

                                             </a>
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
								<a href="{{url('chi-tiet-san-pham/'.$pro->slug_product)}}"> <button type="button" class="btn btn-default watch-sp"><i class="fa fa-info-circle"></i>{{__('lang.xemchitiet') }}</button> </a>
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

					</div><!--features_items-->




                    @endsection
