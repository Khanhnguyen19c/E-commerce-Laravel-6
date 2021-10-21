@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Sản Phẩm
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
                             <div class="position-center">
                                <form role="form" name="ADD" action="{{URL::to('/save-Product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text"  minlength="3"  name="product_name" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">SL sản phẩm</label>
                                    <input type="number" min="1" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" name="product_price" class="form-control price_format" id="" placeholder="Nhập Gía Bán">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá gốc</label>
                                    <input type="text"   name="price_cost" class="form-control price_format_cost" id="" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group" style="position:relative">
                                    <label style="float:left;margin-right:10px" for="exampleInputPassword1">Phần Trăm Khuyến Mãi</label>
                                    <input style="width:80px" type="number" data-role="" name="price_promotion" class="form-control">
                                     <span class="promotion_price" style="position: absolute;
                                        top: 12%;
                                        left: 32%;
                                        font-size: 18px;
                                        font-weight: 700;">%</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tags sản phẩm</label>

                                    <input type="text" data-role="tagsinput" name="product_tags" class="form-control">

                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                <div class="form-wrapper">
                                <img src="public/BackEnd/images/Noimages.png" id='hinhtam' style="margin-left:40px" height="auto" width="200" alt="">
                                <div class="upload-btn-wrapper">
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" onchange="showImage(this)">
                                    <button class="btn_upload">Tải Hình Lên</button>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài liệu</label>
                                    <div class="form-wrapper">
                                <div class="upload-btn-wrapper">
                                <input type="file" name="document" class="form-control" id="exampleInputEmail1">
                                    <button class="btn_upload">Tải File Lên</button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none"  rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                    <textarea style="resize:none" class="form-control" name="product_content" id="ckeditor"  placeholder="Nhập Chi Tiết Sản Phẩm" cols="30" rows="5"></textarea>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                      <select name="product_cate" class="form-control ">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_parent==0)
                                                <option style="font-size: 15px" value="{{$cate->category_id}}"> - {{$cate->category_name}}</option>
                                                @foreach($cate_product as $key => $cate_sub)
                                                    @if($cate_sub->category_parent!=0 && $cate_sub->category_parent==$cate->category_id)
                                                    <option style="color: red;font-size: 15px;padding-left:10px" value="{{$cate_sub->category_id}}">  + {{$cate_sub->category_name}}</option>
                                                    @endif
                                                @endforeach

                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương Hiệu Sản Phẩm</label>
                                    <select class="form-control selecter" name="product_brand">
                                    @foreach ($brand as $key => $brand )
                                       <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển Thị</label>
                                    <select class="form-control selecter" name="product_status">
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển Thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_Product" class="btn btn-info">Thêm Sản Phâm</button>
                            </form>
                            </div>
                            <script>
                                function showImage(t) {
                                    document.getElementById('hinhtam').src = window.URL.createObjectURL(t.files[0]);
                                }
                            </script>
    @endsection
