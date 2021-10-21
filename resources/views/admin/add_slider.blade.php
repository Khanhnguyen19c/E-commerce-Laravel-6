@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Banner Mới
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
                                <form role="form" action="{{URL::to('save-slider')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Thương Hiệu">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Banner</label>
                                <div class="form-wrapper">
                                
                                <div class="upload-btn-wrapper">
                                <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" onchange="showImage(this)">
                                    <button class="btn_upload">Tải File Lên</button>
                                    <img src="public/BackEnd/images/Noimages.png" id='hinhtam' style="max-width: 650px;height: auto;margin-left:40px" width="650" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Slider</label>
                                    <textarea style="resize:none" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển Thị</label>
                                    <select class="form-control" name="slider_status">
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển Thị</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm Banner</button>
                            </form>
                            </div>
                            <script>
                                function showImage(t) {
                                    document.getElementById('hinhtam').src = window.URL.createObjectURL(t.files[0]);
                                }
                            </script>
    @endsection