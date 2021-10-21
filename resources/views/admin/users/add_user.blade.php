@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Admin Mới
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
                        </header>
                       
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::To('save-admin')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Admin</label>
                                    <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Thương Hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email Admin</label>
                                    <input type="email" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Nhập Slug Thương Hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Phone</label>
                                    <input type="number" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Nhập Slug Thương Hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Password</label>
                                    <input type="password" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Nhập Slug Thương Hiệu">
                                </div>
                                
                                <button type="submit" name="add_categoryProduct" class="btn btn-info">Thêm Admin</button>
                            </form>
                            </div>
    @endsection