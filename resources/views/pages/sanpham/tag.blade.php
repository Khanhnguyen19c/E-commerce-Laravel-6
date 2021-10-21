@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->

                        <h2 class="title text-center">Tag tìm kiếm : {{$product_tag}}</h2>

                        @foreach($pro_tag as $key => $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">

                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            @php
                                            $price_promotion =$product->product_price*$product->price_promotion/100;
											$total_price = $product->product_price - $price_promotion;
                                            @endphp
                                            <div >
												<span class="promotion_title">{{number_format($product->product_price,0,',','.')}} VNĐ</span>
												<span class="promotion">-{{$product->price_promotion}}%</span>

											</div>
                                            <form>
                                                @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">

                                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">

                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug_product)}}">
                                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($total_price,0,',','.').' '.'VNĐ'}}</h2>
                                                <p>{{$product->product_name}}</p>


                                             </a>
                                             </div>
                                             <div class="product-overlay">
											<div class="overlay-content">
												<h2>{{number_format($total_price).' VNĐ'}}</h2>
												{!! $product->product_desc !!}
												<button  type="button" class="btn btn-default cart-add home_cart_{{ $product->product_id }}" id="{{$product->product_id}}" onclick="Addtocart(this.id)"><i class="fa fa-shopping-cart"></i> {{__('lang.themgiohang') }}</button>
												<button style="display:none" class="btn btn-danger del-cart rm_home_cart_{{ $product->product_id }}" id="{{ $product->product_id }}" onclick="Deletecart(this.id);"><i class="fa fa-shopping-cart"></i> {{__('lang.xoagiohang') }}</button>
												</div>
										</div>

								</div>
								<a href="{{url('chi-tiet-san-pham/'.$product->slug_product)}}"> <button type="button" class="btn btn-default watch-sp"><i class="fa fa-info-circle"></i> {{__('lang.xemchitiet') }}</button> </a>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li>
										<i class="fa fa-star" aria-hidden="true"></i>
										<button class="button_wishlist" id="{{$product->product_id}}" onclick="add_wistlist(this.id);"><span> {{__('lang.themyeuthich') }}</span>  </button> </li>

										<li><i class="fa fa-plus-square"></i><span><button data-toggle="modal" data-target="#sosanh" style="cursor:pointer;border: none;padding-left: 5px;background: none;" onclick="add_compare({{$product -> product_id}})">{{__('lang.themsosanh') }}</span></button></li>
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
                    {{--   <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$all_product->links()!!}
                      </ul> --}}
        <!--/recommended_items-->
@endsection
