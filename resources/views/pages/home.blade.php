@extends('welcome')
@section('slider')
  @include('pages.include.slider')
@endsection
@section('brand_top')
  @include('pages.include.brand_top')
@endsection
@section('content')

<div class="features_items"><!--features_items-->



                    
                    <h2 class="title text-center"style="background: #db3641;
    padding-bottom: 20px;
    color: white;">{{__('lang.sanphammoi')}}</h2>

<div id="all_product"></div>    
    
<div id="cart_session"></div>

				

				   <!-- Modal so sánh-->
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
              <th scope="col" colspan="3">Action</th>
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
                                            <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg"  role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title product_quickview_title" id="">

                                                        <span id="product_quickview_title"></span>
                                                        
                                                    </h5>
                                                   
                                                  </div>
                                                  <div class="modal-body">
                                                    <style type="text/css">
                                                        span#product_quickview_content img {
                                                            width: 100%;
                                                        }

                                                        @media screen and (min-width: 768px) {
                                                            .modal-dialog {
                                                              width: 700px; /* New width for default modal */
                                                            }
                                                            .modal-sm {
                                                              width: 350px; /* New width for small modal */
                                                            }
                                                        }
                                                        
                                                        @media screen and (min-width: 992px) {
                                                            .modal-lg {
                                                              width: 1200px; /* New width for large modal */
                                                            }
                                                        }
                                                    </style>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                           <span id="product_quickview_image"></span>
                                                      <!-- <div class="owl-carousel" id='product_quickview_gallery'>
                                                           
                                                      </div> -->
                                                        </div>
                                                        <form>
                                                            @csrf
                                                            <div id="product_quickview_value"></div>
                                                        <div class="col-md-8">
                                                            <h2><span id="product_quickview_title"></span></h2>
                                                            <span style="display: none;" id="product_quickview_id"></span>
                                                            <p>Giá Gốc: <span style="text-decoration: line-through;"  id="product_quickview_price"></span></p>
                                                            <p style="font-size: 20px; color: brown;font-weight: bold;">Giá sản phẩm : <span id="product_quickview_promotion"></span></p>
                                
                                                                <label>Số lượng: </label>

                                                                <input name="qty" type="number" min="1"  class="cart_product_qty_" value="1" />
																<button type="button" data-id_product=""  class="btn btn-primary add-to-cart-quicky">Mua Ngay</button>
                                                            </span>
															<div id="product_quickview_button"></div>
                                                            <div id="beforesend_quickview"></div>
                                                            <h4 style="font-size: 20px; color: brown;font-weight: bold;">Mô tả sản phẩm</h4>
                                                            <hr>
                                                            <p><span id="product_quickview_desc"></span></p>
                                                            <p class="quickview-content"><span id="product_quickview_content"></span>
                                                            <p class="readmoree">Đọc Thêm...</p>
                                                            <p class="hiden_content">Ẩn Bớt...</p>
                                                          </p>
                                                            
                                                            
                                                        </div>
                                                        </form>

                                                    </div>  
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary redirect-cart">Đi tới giỏ hàng</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div> 
                    @endsection