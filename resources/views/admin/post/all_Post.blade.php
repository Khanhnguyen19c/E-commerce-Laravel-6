@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Quản Lý Bài Viết
     @hasrole(['admin','author'])
     <a href="{{URL::to('/add-Post')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Bài Viết</button></a>
    @endhasrole
    </div>
  
    <div class="table-responsive">
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
      <div class="panel-body">
      <table class="table table-striped b-t b-light" id="dataTables-example">
        <thead>
          <tr>
            <th style="width:20px;">
              #
            </th>
            <th>Tên Bài Viết</th>
            <th>Hình Ảnh</th>
            <th>Slug</th>
            <th>Mô Tả Bài Viết</th>
            <th>Từ Khoá</th>
            <th>Danh Mục Bài Viết</th>
            <th>Hiển Thị</th>
            <!-- <th>Ngày Thêm</th> -->
            <th>Quản Lý</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($all_post as $key => $post)    
          <tr>
          <td>{{$post -> post_id}}</td>
            <td>{{$post -> post_title}}</td>
            <td><img src="public/uploads/post/{{$post -> post_image}}" height="100" alt=""></td>
            <td>{{$post -> post_slug}}</td>
            <td>{!!$post -> post_desc!!}</td>
            <td>{{$post -> post_meta_keywords}}</td>
            <td>{{ $post->cate_post->category_post_name }}</td>
            @hasrole(['user']) 
              <td></td>
            <td></td>
            @endhasrole
            @hasrole(['admin','author'])
            <td><span class="text-ellipsis">
            <?php
                if($post -> post_status == 0)
                { ?>

              <a href="{{URL::To('/unactive-post/'.$post->post_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span> 
               <?php }else{ 
                 
                ?>
                  <a href="{{URL::To('/active-post/'.$post->post_id)}}"><span class=" fa-thumb-styling fa fa-thumbs-down"></span> 
                <?php }?>
               </span></td>
            <td>
              <a  href="{{URL::To('/edit-post/'.$post->post_id)}}"  class="active styling-edit" ui-toggle-class=""><i class=" fa fa-pencil-square-o text-active"></i>
              <a  onclick="return confirm('Are You Sure To Delete?')" href="{{URL::To('/delete-post/'.$post->post_id)}}" class="active styling-edit Delete_btn" ui-toggle-class="">
              <i class="fa fa-times text-danger text "></i></a>
              </td>
            @endhasrole
           
          </tr>
          
          @endforeach
        </tbody>
      </table>
               </div>
    </div>
    <form action="{{url('import-postduct')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-wrapper">
				<div class="upload-btn-wrapper">
					<input type="file" class="form-control" accept=".xlsx" name="file_h" onchange="showImage(this)" />
					<button class="btn_upload">Tải File Lên</button>
				</div>
       <input type="submit" value="Import Excel" name="Import Excel" class="btn btn-warning">
        </form>
       <form action="{{url('export-postduct')}}" method="POST" style="float: left;margin-right: 32px;">
          @csrf
       <input type="submit" value="Export Excel" name="Export Excel" class="btn btn-success">
      </form>

   
  </div>
</div>

@endsection