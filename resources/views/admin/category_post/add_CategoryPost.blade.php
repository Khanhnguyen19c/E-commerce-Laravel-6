@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Danh Mục Bài Viết
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
                                <form role="form" action="{{URL::To('save-CategoryPost')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Bài Viết</label>
                                    <input type="text" name="post_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Thương Hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug Bài Viết</label>
                                    <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Nhập Slug Thương Hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Bài Viết</label>
                                    <textarea style="resize:none" class="form-control" name="post_desc" id="ckeditor" placeholder="Nhập Mô Tả" cols="30" rows="5"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển Thị</label>
                                    <select class="form-control" name="post_status">
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển Thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_categoryProduct" class="btn btn-info">Thêm Danh Mục Bài Viết</button>
                            </form>
                            </div>
    @endsection
