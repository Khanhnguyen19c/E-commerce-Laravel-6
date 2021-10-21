@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản Lý Videos
    </div>
    <div class="row w3-res-tb">
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
      @hasrole(['admin','author'])
      <div class="col-sm-12">
        <div class="position-center">
       
                                <form>
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên video</label>
                                    <input type="text" name="video_title" class="form-control video_title" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug video</label>
                                    <input type="text" name="video_slug" class="form-control video_slug" id="convert_slug" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link video</label>
                                    <input type="text" name="link_video" class="form-control video_link" id="convert_slug" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả video</label>
                                    <textarea style="resize: none" rows="8" class="form-control video_desc" name="video_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                 <div class="form-group">
                                 <label for="exampleInputPassword1">Hình ảnh video</label>
                                 <div class="form-wrapper">
                                 <img src="public/BackEnd/images/Noimages.png" id='hinhtam' style="margin-left:40px" height="auto" width="250" alt="">
                                <div class="upload-btn-wrapper">
                                <input type="file" class="form-control" id="file_img_video" name="file" accept="image/*"  onchange="showImage(this)" >
                                <span id="error_gallery"></span>
                                    <button class="btn_upload">Tải File Lên</button>
                                </div>
                                  
                                <button style="margin:0 auto" type="button" name="add_video" id="btn-add-video" class="btn btn-info">Thêm video</button>
                                </form>
                                <div id="notify"></div>
                            </div>
      </div>
    </div>
    @endhasrole
    <div class="table-responsive" >
    
         <div id="video_load"></div>



    </div>
  
  </div>
  <script>
                                function showImage(t) {
                                    document.getElementById('hinhtam').src = window.URL.createObjectURL(t.files[0]);
                                }
                            </script>
  
@endsection