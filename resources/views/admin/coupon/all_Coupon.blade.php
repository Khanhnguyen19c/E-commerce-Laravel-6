@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Quản Lý Mã Giảm Giá
     @hasrole(['admin','author'])
     <a href="{{URL::to('/add-coupon')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Mã Giảm Giá</button></a> 
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


            <th>Tên mã giảm giá</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Mã giảm giá</th>
            <th>Số lượng </th>
            <th>Điều kiện </th>
            <th>Số giảm</th>
            <th>Tình trạng</th>
            <th>Hết hạn</th>
            <th>Quản Lý</th>
            <th>Gửi mã</th>

            

          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>

            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_date_start }}</td>
            <td>{{ $cou->coupon_date_end }}</td>

            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_time }}</td>
            <td><span class="text-ellipsis">
              <?php
              if($cou->coupon_condition==1){
                ?>
                Giảm Theo %
                <?php
              }else{
                ?>  
                Giảm Theo Tiền
                <?php
              }
              ?>
            </span>
          </td>
          <td><span class="text-ellipsis">
            <?php
            if($cou->coupon_condition==1){
              ?>
              Giảm {{$cou->coupon_number}} %
              <?php
            }else{
              ?>  
               {{number_format($cou->coupon_number,0,',','.')}} VNĐ
              <?php
            }
            ?>
          </span></td>
          <td><span class="text-ellipsis">
            <?php
            if($cou->coupon_status==1){
              ?>
              <span style="color:green">Đang kích hoạt</span>
              <?php
            }else{
              ?>  
              <span style="color:red;font-weight: 600;">Đã khóa</span>
              <?php
            }
            ?>
          </span>
        </td>
        <td style="width: 95px;">

          @if($cou->coupon_date_end>=$today)
          <span style="color: #095890;
    font-weight: 600;">Còn hạn</span>
          @else 
          <span style="color:red;
    font-weight: 600;">Đã hết hạn</span>
          @endif
          

        </td>
        <td>
        @hasrole(['admin','author'])
          <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
            @endhasrole
          </a>
        </td>
        <td>
        @hasrole(['admin','author'])
          <p><a href="{{url('/send-coupon-vip', [ 

            'coupon_time'=> $cou->coupon_time,
            'coupon_condition'=> $cou->coupon_condition,
            'coupon_number'=> $cou->coupon_number,
            'coupon_code'=> $cou->coupon_code


          ])}}" class="btn btn-warning" style="margin:5px 0;">Gửi giảm giá khách vip</a></p>    
          <p><a href="{{url('/send-coupon',[ 

           
            'coupon_time'=> $cou->coupon_time,
            'coupon_condition'=> $cou->coupon_condition,
            'coupon_number'=> $cou->coupon_number,
            'coupon_code'=> $cou->coupon_code


          ])}}" class="btn btn-info">Gửi giảm giá khách thường</a></p>  
       
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