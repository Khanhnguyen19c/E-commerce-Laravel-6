@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cật Nhật Thương Hiệu Sản Phẩm
                           <?php
		$message = Session()->get('message');

		if($message){
		echo "<script>";
		echo "function load(){";
		echo "swal("."'$message'".");";
		echo "}";
		echo "</script>";
		Session()->put('message', null);
		}
		?>
                        </header>

                        <div class="panel-body">
                            @foreach ($edit_Product as $key => $edit_value)
                            <div class="position-center">
                            <form role="form" action="{{URL::To('update-Product/'.$edit_value->product_id)}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input value="{{$edit_value->product_name }}" type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" value="{{$edit_value->slug_product }}" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SL sản phẩm</label>
                                    <input value="{{$edit_value->product_quantity }}" type="number" min="1" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                <div class="form-wrapper">
                                <img src="{{URL::To('public/uploads/product/'.$edit_value->product_image)}}" id='hinhtam' style="margin-left:40px" height="150" width="150" alt="">
                                <div class="upload-btn-wrapper">
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" onchange="showImage(this)">
                                    <button class="btn_upload">Tải File Lên</button>
                                </div>

                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tags sản phẩm</label>

                                    <input type="text"  value="{{$edit_value->product_tags }}" data-role="tagsinput" name="product_tags" class="form-control">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gía Sản Phẩm</label>
                                    <input value="{{$edit_value->product_price }}" type="text" name="product_price" class="form-control price_format" id="exampleInputEmail1" placeholder="Nhập Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá gốc</label>
                                    <input type="text" value="{{$edit_value->price_cost}}" min="1"  name="price_cost" class="form-control price_format_cost" id="" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group" style="position:relative">
                                    <label style="float:left;margin-right:10px" for="exampleInputPassword1">Phần Trăm Khuyến Mãi</label>
                                    <input style="width:80px" type="number" data-role="" name="price_promotion" class="form-control" value="{{$edit_value->price_promotion}}">
                                     <span class="promotion_price" style="position: absolute;
                                        top: 12%;
                                        left: 32%;
                                        font-size: 18px;
                                        font-weight: 700;">%</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                    <textarea style="resize:none" class="form-control" name="product_desc"  id="ckeditor1" placeholder="Nhập Mô Tả Sản Phẩm" cols="30" rows="5">{{$edit_value->product_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chi Tiết Sản Phẩm</label>
                                    <textarea style="resize:none" class="form-control" name="product_content"  id="ckeditor" placeholder="Nhập Chi Tiết Sản Phẩm" cols="30" rows="5">{{$edit_value->product_content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài liệu</label>
                                    <input type="file" name="document" class="form-control" id="exampleInputEmail1">
                                    @if($edit_value->product_docs)
                                    <p class="cofile">

                                        <a target="_blank" href="{{asset('public/uploads/document/'.$edit_value->product_docs)}}">
                                            {{$edit_value->product_docs}}
                                        </a>
                                        <button type="button" data-document_id="{{$edit_value->product_id}}" class="btn btn-sm btn-danger btn-delete-document"><i class="fa fa-times"></i></button>
                                    </p>
                                    @else
                                    <p class="cofile">Không file</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Danh Mục Sản Phẩm</label>
                                    <select class="form-control selecter" name="product_cate">
                                    @foreach ($cate_product as $key => $cate )
                                       @if($cate->category_id==$edit_value->category_id)

                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>

                                      @else
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                       @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương Hiệu Sản Phẩm</label>
                                    <select class="form-control selecter" name="product_brand">
                                    @foreach ($brand_product as $key => $brand )
                                       @if($brand->brand_id==$edit_value->brand_id)

                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>

                                      @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                      @endif
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển Thị</label>
                                    <select class="form-control selecter" name="product_status">
                                    @if($brand->brand_status==0)
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển Thị</option>
                                        @else
                                        <option selected value="1">Ẩn</option>
                                        <option value="0">Hiển Thị</option>
                                    @endif
                                    </select>
                                </div>
                                <button type="submit" name="update_Product" class="btn btn-info">Cật Nhật Danh Mục</button>
                            </form>
                            @endforeach
                            </div>
                            <script>
                                function showImage(t) {
                                    document.getElementById('hinhtam').src = window.URL.createObjectURL(t.files[0]);
                                }
                            </script>
    @endsection
