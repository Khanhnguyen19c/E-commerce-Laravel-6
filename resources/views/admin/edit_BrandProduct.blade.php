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


                            <div class="position-center">
                                <form role="form" action="{{URL::To('update-BrandProduct/'.$edit_BrandProduct->brand_id)}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" value="{{($edit_BrandProduct-> brand_name)}}" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug Thương Hiệu</label>
                                    <input type="text" name="slug_brand" value="{{($edit_BrandProduct-> slug_brand)}}" class="form-control" id="convert_slug" placeholder="Nhập Slug Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                    <textarea style="resize:none" class="form-control" name="brand_desc" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5">{{($edit_BrandProduct-> brand_desc)}}</textarea>

                                </div>



                                <button type="submit" name="update_BrandProduct" class="btn btn-info">Cật Nhật Danh Mục</button>
                            </form>

                            </div>

    @endsection
