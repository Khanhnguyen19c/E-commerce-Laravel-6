@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Quản Lý Danh Mục Bài Viết
     @hasrole(['admin','author'])
     <a href="{{URL::to('/add-CategoryPost')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Danh Mục</button></a>
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
            <th>Slug</th>
            <th>Mô Tả Bài Viết</th>
            <th>Hiển Thị</th>
            <th>Quản Lý</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($all_CategoryPost as $key => $cate_post)    
          <tr>
          <td>{{$cate_post -> category_post_id}}</td>
            <td>{{$cate_post -> category_post_name}}</td>
            <td>{{$cate_post -> category_post_slug}}</td>
            <td>{{$cate_post -> category_post_desc}}</td>
            @hasrole(['user']) 
              <td></td>
            <td></td>
            @endhasrole
            @hasrole(['admin','author'])
           <td><span class="text-ellipsis">
         
            <?php
                if($cate_post -> category_post_status == 0)
                { ?>

              <a href="{{URL::To('/unactive-CategoryPost/'.$cate_post->category_post_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span> 
               <?php }else{ 
                 
                ?>
                  <a href="{{URL::To('/active-CategoryPost/'.$cate_post->category_post_id)}}"><span class=" fa-thumb-styling fa fa-thumbs-down"></span> 
                <?php }?>
               </span></td>
            <td>
              <a  href="{{URL::To('/edit-CategoryPost/'.$cate_post->category_post_id)}}"  class="active styling-edit" ui-toggle-class=""><i class=" fa fa-pencil-square-o text-active"></i>
              <a onclick="return confirm('Are You Sure To Delete?')" href="{{URL::To('/delete-CategoryPost/'.$cate_post->category_post_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text "></i></a>
            </td>
            @endhasrole
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <form action="{{url('import-brand')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-wrapper">
				<div class="upload-btn-wrapper">
					<input type="file" class="form-control" accept=".xlsx" name="file_h" onchange="showImage(this)" />
					<button class="btn_upload">Tải File Lên</button>
				</div>
       <input type="submit" value="Import Excel" name="Import Excel" class="btn btn-warning">
        </form>
       <form action="{{url('export-brand')}}" method="POST" style="float: left;margin-right: 32px;">
          @csrf
       <input type="submit" value="Export Excel" name="Export Excel" class="btn btn-success">
      </form>
   
  </div>
</div>
@endsection