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
                                <form role="form" name="ADD" action="{{URL::to('/update-post/'.$edit_Post->post_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Bài Viết</label>
                                    <input type="text"  minlength="3" value="{{$edit_Post->post_title}}" name="post_title" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="post_slug"  value="{{$edit_Post->post_slug}}" class="form-control" id="convert_slug" placeholder="Điền số lượng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm Tắt Bài Viết</label>
                                    <textarea style="resize: none"   rows="8" class="form-control" name="post_desc" id="ckeditor1" placeholder="Mô tả sản phẩm">{{$edit_Post->post_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Bài Viết</label>
                                    <textarea style="resize:none" class="form-control" name="post_content" id="ckeditor"  placeholder="Nhập Chi Tiết Sản Phẩm" cols="30" rows="5">{{$edit_Post->post_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ Khoá Bài Viết</label>
                                    <input type="text"  minlength="3"  value="{{$edit_Post->post_meta_keywords}}"  name="post_meta_keywords" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Bài Viết</label>
                                    <input type="text"  minlength="3" value="{{$edit_Post->post_meta_desc}}" name="post_meta_desc" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Bài Viết</label>
                                <div class="form-wrapper">
                                <img src="{{URL::To('public/uploads/post/'.$edit_Post->post_image)}}" id='hinhtam' style="margin-left:40px" height="150" width="150" alt="">
                                <div class="upload-btn-wrapper">
                                <input type="file" name="post_image"  value="{{$edit_Post->post_image}}" class="form-control" id="exampleInputEmail1" onchange="showImage(this)">
                                    <button class="btn_upload">Tải File Lên</button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh Mục Bài Viết</label>
                                    <select class="form-control selecter" name="category_post_id">
                                       @foreach ($category_post as $key => $cate )
                                       @if ($edit_Post->category_post_id == $cate->category_post_id)
                                       <option selected value="{{$cate->category_post_id}}">{{$cate->category_post_name}}</option>
                                       @else
                                       <option value="{{$cate->category_post_id}}">{{$cate->category_post_name}}</option>
                                       @endif
                                       @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển Thị</label>
                                    <select class="form-control selecter" name="post_status">
                                        @if($cate->category_post_status==0)
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển Thị</option>
                                        @else
                                        <option selected value="1">Ẩn</option>
                                        <option value="0">Hiển Thị</option>
                                    @endif
                                    </select>
                                </div>

                                <button type="submit" name="add_Product" class="btn btn-info">Update Bài Viết</button>
                            </form>
                            </div>
                            <script>
                                function showImage(t) {
                                    document.getElementById('hinhtam').src = window.URL.createObjectURL(t.files[0]);
                                }
                            </script>
    @endsection
