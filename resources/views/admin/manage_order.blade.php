@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Liệt Kê Đơn Hàng
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
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Lý Do Huỷ</th>
            <!-- <th>Ngày Thêm</th> -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=1;
          @endphp
        @foreach ($order as $key => $ord)    
          <tr>
           
            <td>{{$i++}}</td>
            <td>{{$ord -> order_code}}</td>
            <td>{{$ord -> created_at}}</td>
            <td>@if ($ord -> order_status==1)
             <span class="text text-success"> Đơn Hàng Mới</span>
            @elseif ($ord -> order_status==2)
            <span class="text text-primary">Đã Xử Lý</span>
             @else
             <span class="text text-danger"> Đã Bị Huỷ</span>
            @endif
          </td>
             @if($ord -> order_status==3)
             <td>{{$ord -> order_destroy}}</td>
             @else
             <td></td>
            @endif
          
            <td>
            @hasrole(['admin','author'])
              <a  href="{{URL::To('/view-order/'.$ord->order_code)}}"  class="active styling-edit" ui-toggle-class=""><i class=" fa fa-eye"></i>
              <a onclick="return confirm('Are You Sure To Delete?')" href="{{URL::To('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text "></i></a>
              @endhasrole
            </td>
          
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
    </div>
   
  </div>
</div>
@endsection