@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Danh Mục Sản Phẩm
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
                                <form role="form" action="{{URL::To('save-CategoryProduct')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" name="slug_category" class="form-control" id="convert_slug" placeholder="Nhập Slug Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                    <textarea style="resize:none" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ Khoá Danh Mục</label>
                                    <textarea style="resize:none" class="form-control" name="category_product_keywords" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thuộc Danh Mục</label>
                                    <select class="form-control selecter" name="category_parent">
                                    <option value="0">--Danh Mục Cha--</option>
                                        @foreach ($category as $key =>$value )
                                        <option value="{{$value->category_id}}">{{$value->category_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển Thị</label>
                                    <select class="form-control" name="category_product_status">
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển Thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_categoryProduct" class="btn btn-info">Thêm Danh Mục</button>
                            </form>
                            </div>
    @endsection
