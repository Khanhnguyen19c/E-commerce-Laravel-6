@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Quản Lý Admin
     <a href="{{URL::to('/add-user')}}"><button class="btn btn-success" style="float: right;margin-top: 12px;">Thêm Admin</button></a>
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
    <style>
      th,td{
        text-align: center;
      }
    </style>
      <div class="panel-body">
      <table class="table table-striped b-t b-light"id="dataTables-example">
        <thead>
          <tr >
           
            <th>Tên User</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Author</th>
            <th>Admin</th>
            <th>User</th>
            <th>Hành Động</th>
            <!-- <th>Ngày Thêm</th> -->
           
          </tr>
        </thead>
        <tbody>
        @foreach ($admin as $key => $user)   
       
          <tr>
          <form action="{{url('/assign-roles')}}" method="POST">
               @csrf
            <td>{{$user -> admin_name}}</td>
            <td>{{$user -> admin_email}}</td>
            <input type="hidden" name="admin_email" value="{{$user -> admin_email}}">
            <input type="hidden" name="admin_id" value="{{$user -> admin_id}}">
            <td>{{$user -> admin_phone}}</td>
            <td>{{$user -> admin_password}}</td>
            <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}} ></td>
            <td><input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}} ></td>
            <td><input type="checkbox" name="user_role" {{$user->hasRole('user') ? 'checked' : ''}} ></td>
            <td>
              <a href="{{url('/delete-user-roles/'.$user->admin_id)}}" class="btn btn-sm btn-danger" style="margin-bottom: 10px;">Xoá user</a>
              <a href="{{url('/impersonate/'.$user->admin_id)}}" class="btn btn-sm btn-success" style="margin-bottom: 10px;">Chuyển user</a>
            <input type="submit" value="Phân Quyền" id="" class="btn btn-sm btn-primary" style="margin-bottom: 10px;">
            </td>
            </form> 
          </tr>
       
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
   
    
  </div>
</div>
@endsection