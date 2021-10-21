@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Quản Lý Danh Mục Sản Phẩm
    @hasrole(['admin','author'])
    <a href="{{URL::to('/add-CategoryProduct')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Danh Mục</button></a>
    @endhasrole  
  </div>
    
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
            <th>Tên Danh Mục</th>
            <th>Thuộc Danh Mục</th>
            <th>Slug</th>
            <th>Mô Tả</th>
            <th>Hiển Thị</th>
            <th >Quản Lý</th>
          </tr>
        </thead>
        <style>
          #category_order .ui-state-highlight{
            padding: 24px;
            background-color: #ffffcc;
            border: 1px dotted #ccc;
            cursor: pointer;
            margin-top: 12px;
          }
        </style>
        <tbody id="category_order">
        @foreach ($all_CategoryProduct as $key => $cate_pro)    
          <tr id="{{$cate_pro -> category_id}}">
          <td>{{$cate_pro -> category_order}}</td>
            <td>{{$cate_pro -> category_name}}</td>
            <td>
              @if ($cate_pro-> category_parent==0)
              <span style="color: red;">
                Danh Mục Cha
                </span> 
              @else

              @foreach ($cate_product as $key =>$cate_sub_pro)

                @if ( $cate_sub_pro->category_id ==$cate_pro->category_parent)
                  <span style="color: green;">
                      {{$cate_sub_pro->category_name}}
                  </span> 
                @endif
              
              @endforeach
              
              @endif
            </td>
            <td>{{$cate_pro -> slug_category}}</td>
            <td>{{$cate_pro -> category_desc}}</td>
            @hasrole(['user']) 
              <td></td>
            <td></td>
            @endhasrole
            @hasrole(['admin','author'])
           <td><span class="text-ellipsis">
            <!-- <td>{{ $cate_pro -> category_status}}</td> -->
            <?php
                if($cate_pro -> category_status == 0)
                { ?>

              <a href="{{URL::To('/unactive-CategoryProduct/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span> 
               <?php }else{ 
                 
                ?>
                  <a href="{{URL::To('/active-CategoryProduct/'.$cate_pro->category_id)}}"><span class=" fa-thumb-styling fa fa-thumbs-down"></span> 
                <?php }?>
               </span></td>
            <td>
              <a  href="{{URL::To('/edit-CategoryProduct/'.$cate_pro->category_id)}}"  class="active styling-edit" ui-toggle-class=""><i class=" fa fa-pencil-square-o text-active"></i>
              <a data-category_delete="{{$cate_pro->category_id}}" class="active styling-edit btn_delete_category">
              <i class="fa fa-times text-danger text "></i></a>
            </td>
            @endhasrole
          </tr>
          @endforeach
        </tbody>
      </table>
     </div>
    </div>
    <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-wrapper">
				<div class="upload-btn-wrapper">
					<input type="file" class="form-control" accept=".xlsx" name="file_h" onchange="showImage(this)" />
					<button class="btn_upload">Tải File Lên</button>
				</div>
       <input type="submit" value="Import Excel" name="import_csv" class="btn btn-warning">
        </form>
       <form action="{{url('export-csv')}}" method="POST" style="float: left;margin-right: 32px;">
          @csrf
       <input type="submit" value="Export Excel" name="export_csv" class="btn btn-success">
      </form>
    
  </div>
</div>
@endsection