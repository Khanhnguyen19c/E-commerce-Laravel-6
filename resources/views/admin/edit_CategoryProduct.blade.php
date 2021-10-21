@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cật Nhật Danh Mục Sản Phẩm
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
                            @foreach ($edit_CategoryProduct as $key => $edit_value)


                            <div class="position-center">
                                <form role="form" action="{{URL::To('update-CategoryProduct/'.$edit_value->category_id)}}" method="POST">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" value="{{($edit_value-> category_name)}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" name="slug_category"  value="{{($edit_value-> slug_category)}} "class="form-control" id="convert_slug" placeholder="Nhập Slug Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                    <textarea style="resize:none" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5">{{($edit_value-> category_desc)}}</textarea>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ Khoá Danh Mục</label>
                                    <textarea style="resize:none" class="form-control" name="category_product_keywords" id="exampleInputPassword1" placeholder="Nhập Mô Tả" cols="30" rows="5">{{($edit_value-> category_keywords)}}</textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thuộc Danh Mục</label>
                                    <select class="form-control selecter" name="category_parent">
                                    <option value="0" >-----------Danh mục cha-----------</option>
                                    @foreach($category as $key => $val)

                                    @if($val->category_parent==0)
                                        <option {{$val->category_id==$edit_value->category_parent ? 'selected' : '' }} value="{{$val->category_id}}">{{$val->category_name}}</option>
                                    @endif

                                    @foreach($category as $key => $val2)

                                        @if($val2->category_parent==$val->category_id)

                                            <option {{$val2->category_id==$edit_value->category_parent ? 'selected' : '' }} value="{{$val2->category_id}}">---{{$val2->category_name}}</option>

                                        @endif

                                    @endforeach

                                    @endforeach


                            </select>
                                </div>
                                <button type="submit" name="update_categoryProduct" class="btn btn-info">Cật Nhật Danh Mục</button>
                            </form>
                            @endforeach
                            </div>

    @endsection
