@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Thương Hiệu Sản Phẩm
                <?php
                $message = Session()->get('message');

                if ($message) {
                    echo "<script>";
                    echo "function load(){";
                    echo "swal(" . "'$message'" . ");";
                    echo "}";
                    echo "</script>";
                    Session()->put('message', null);
                }
                ?>
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::To('save-BrandProduct')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Thương Hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug Thương Hiệu</label>
                            <input type="text" name="slug_brand" class="form-control" id="convert_slug" placeholder="Nhập Slug Thương Hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                            <textarea style="resize:none" class="form-control" name="brand_desc" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5"></textarea>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Hiển Thị</label>
                            <select class="form-control" name="brand_status">
                                <option value="1">Ẩn</option>
                                <option selected value="0">Hiển Thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_categoryProduct" class="btn btn-info">Thêm Thương Hiệu</button>
                    </form>
                </div>
                @endsection
