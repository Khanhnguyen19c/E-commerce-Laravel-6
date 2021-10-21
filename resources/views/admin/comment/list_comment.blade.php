@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản Lý Bình Luận
    </div>
    <div id="notify_comment"></div>
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
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
           
            <th>Duyệt</th>
            <th>Tên người gửi</th>
            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $key => $comm)
          <tr>
        
            <td>
            @hasrole(['admin','author'])
              @if($comm->comment_status==1)
                <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt" >
              @else 
                <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt" >
              @endif
            @endhasrole
            </td>
            <td>{{ $comm->comment_name }}</td>

            <td>{{ $comm->comment }}
              <style type="text/css">
                ul.list_rep li {
                  list-style-type: decimal;
                  color: blue;
                  margin: 5px 40px;
              }
              </style>
              <ul class="list_rep">
                Trả lời : 
                @foreach($comment_rep as $key => $comm_reply)
                  @if($comm_reply->comment_parent_comment==$comm->comment_id)
                  @hasrole(['admin','author'])
                   <li><a onclick="return confirm('Bạn có chắc là muốn xóa bình luận này ko?')" href="{{url('/delete-rep/'.$comm_reply->comment_id)}}"><i class= "fa fa-times text-danger text"></i></a> {{$comm_reply->comment}}</li>
                 @endhasrole
                   @endif
                
                @endforeach

              </ul>
              @if($comm->comment_status==0)
             
              <br/><textarea class="form-control reply_comment_{{$comm->comment_id}}" rows="5"></textarea>
              @hasrole(['admin','author'])
              <br/><button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$comm->comment_product_id}}"  data-comment_id="{{$comm->comment_id}}">Trả lời bình luận</button>
              @endhasrole
              @endif
             

            </td>
            <td>{{ $comm->created_at }}</td>
            <td><a href="{{url('/chi-tiet/'.$comm->product->slug_product)}}" target="_blank">{{ $comm->product->product_name }}</a></td>
            <td>
            @hasrole(['admin','author'])
              <a onclick="return confirm('Bạn có chắc là muốn xóa bình luận này ko?')" href="{{Url('/delete-comment/'.$comm->comment_id)}}"  class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
                @endhasrole
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  
  </div>
</div>
@endsection