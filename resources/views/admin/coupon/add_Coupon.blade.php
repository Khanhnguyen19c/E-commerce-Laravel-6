@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm mã giảm giá
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
                                <form role="form" action="{{URL::To('save-Coupon')}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số Lượng Mã</label>
                                    <input type="number" name="coupon_time" class="form-control" id="exampleInputEmail1" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày bắt đầu</label>
                                    <input type="text"  name="coupon_date_start" class="form-control" id="start_coupon" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày kết thúc</label>
                                    <input type="text" name="coupon_date_end" class="form-control" id="end_coupon" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Tính năng mã giảm</label>
                                    <select class="form-control selecter" name="coupon_condition">
                                        <option value="0">--Chọn Tính Năng--</option>
                                        <option value="1">Giảm theo phần trăm</option>
                                        <option value="2">Giảm theo Số Tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số % hoặc số tiền giảm</label>
                                    <input type="number" name="coupon_number" class="form-control" id="exampleInputEmail1" placeholder="">
                                </div>
                                <button type="submit" name="add_categoryProduct" class="btn btn-info">Thêm Danh Mục</button>
                            </form>
                            </div>
    @endsection