@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Quản Lý Sản Phẩm
     @hasrole(['admin','author'])
     <a href="{{URL::to('/add-Product')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Sản Phẩm</button></a>
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
            <th>Tên Sản Phẩm</th>
            <th>Thư Viện Ảnh</th>
            <th>Tài liệu</th>
            <th>Gia Sản Phẩm</th>
            <th>Gía Gốc</th>
            <th>Khuyến Mãi %</th>
            <th>Số Lượng</th>
            <th>Hình Sản Phẩm</th>
            <th>Danh Mục</th>
            <th>Thương Hiệu</th>
            <th>Slug</th>
            <th>Hiển Thị</th>
            <!-- <th>Ngày Thêm</th> -->
            <th>Quản Lý</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($all_Product as $key => $pro)    
          <tr>
          
          <td>{{$pro -> product_id}}</td>
            <td>{{$pro -> product_name}}</td>

            <td>
            @hasrole(['admin','author'])  
            <a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm thư viện ảnh</a>
          @endhasrole
          </td>
            @if($pro->product_docs)
              @php
              $filename = $pro->product_docs;
              $name = pathinfo($filename, PATHINFO_FILENAME);
              $extension = pathinfo($filename, PATHINFO_EXTENSION);
              @endphp
              @if($extension=='pdf')
              <td><a target="_blank" href="{{asset('public/uploads/document/'.$pro->product_docs)}}">Xem file</a></td>
              @elseif($extension=='docx')
              <td><a target="_blank" href="https://view.officeapps.live.com/op/view.aspx?src={{ url('public/uploads/document/'.$pro->product_docs) }}">Xem file</a></td>
              @endif
            @else 
            <td>Không file</td>
            @endif
            <td>{{number_format($pro -> product_price,0,',','.')}} VNĐ</td>
            <td>{{number_format($pro -> price_cost,0,',','.')}} VNĐ</td>
            <td>{{$pro -> price_promotion}}%</td>
            <td>{{$pro -> product_quantity}}</td>
            <td><img src="public/uploads/product/{{$pro -> product_image}}" height="100" alt=""></td>
            <td>{{$pro -> category_name}}</td>
            <td>{{$pro -> brand_name}}</td>
            <td>{{$pro -> slug_product}}</td>
            @hasrole(['user']) 
               <td></td>
            <td></td>
            @endhasrole
           
           
            @hasrole(['admin','author'])
           <td><span class="text-ellipsis">
            <?php
                if($pro -> product_status == 0)
                { ?>

              <a href="{{URL::To('/unactive-Product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span> 
               <?php }else{ 
                 
                ?>
                  <a href="{{URL::To('/active-Product/'.$pro->product_id)}}"><span class=" fa-thumb-styling fa fa-thumbs-down"></span> 
                <?php }?>
               </span></td>
            <td>
              <a  href="{{URL::To('/edit-Product/'.$pro->product_id)}}"  class="active styling-edit" ui-toggle-class=""><i class=" fa fa-pencil-square-o text-active"></i>
              <a data-product_delete="{{$pro->product_id}}" class="active styling-edit btn_delete_product">
              <i class="fa fa-times text-danger text "></i></a>
            </td>
          </tr>
          @endhasrole
          @endforeach
        </tbody>
      </table>
               </div>
    </div>
    <form action="{{url('import-product')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-wrapper">
				<div class="upload-btn-wrapper">
					<input type="file" class="form-control" accept=".xlsx" name="file_h" onchange="showImage(this)" />
					<button class="btn_upload">Tải File Lên</button>
				</div>
       <input type="submit" value="Import Excel" name="Import Excel" class="btn btn-warning">
        </form>
       <form action="{{url('export-product')}}" method="POST" style="float: left;margin-right: 32px;">
          @csrf
       <input type="submit" value="Export Excel" name="Export Excel" class="btn btn-success">
      </form>

  
  </div>
</div>

@endsection