@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Quản Lý Banner Website
    @hasrole(['admin','author'])
    <a href="{{URL::to('/add-slider')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Banner Mới</button></a> 
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
            <th>#</th>
            <th>Tên Slide</th>
            <th>Hình Ảnh</th>
            <th>Mô Tả</th>
            <th>Tình Trạng</th>
            <th>Quản LÝ</th>
            <!-- <th>Ngày Thêm</th> -->
          
          </tr>
        </thead>
        <tbody>
        @foreach ($all_slide as $key => $slide)    
          <tr>
          <td>{{$slide -> slider_id}}</td>
            <td>{{$slide -> slider_name}}</td>
            <td><img src="public/uploads/slider/{{$slide->slider_image}}" height="100" alt=""></td>
            <td>{{$slide -> slider_desc}}</td>
            @hasrole(['user']) 
              <td></td>
            <td></td>
            @endhasrole
            @hasrole(['admin','author'])
           <td><span class="text-ellipsis">
         
            <?php
                if($slide -> slider_status == 0)
                { ?>

              <a href="{{URL::To('/unactive-slider/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span> 
               <?php }else{ 
                 
                ?>
                  <a href="{{URL::To('/active-slider/'.$slide->slider_id)}}"><span class=" fa-thumb-styling fa fa-thumbs-down"></span> 
                <?php }?>
               </span></td>
            <td>
              <a onclick="return confirm('Are You Sure To Delete?')" href="{{URL::To('/delete-slider/'.$slide->slider_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text "></i></a>
            </td>
            @endhasrole
          </tr>
          @endforeach
        </tbody>
      </table>
               </div>
    </div>
  
  </div>
</div>
@endsection