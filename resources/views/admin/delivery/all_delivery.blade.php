@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Mã Vận Chuyển
                        </header>
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
                        @hasrole(['admin','author'])
                            <div class="position-center">
                                <form>
                                    @csrf 
                             
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn Thành Phố</label>
                                      <select name="city" id="city" class="form-control selecter choose city">
                                    
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_tp}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn Quận Huyện</label>
                                      <select name="province" id="province" class="form-control selecter province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn Xã Phường</label>
                                      <select name="wards" id="wards" class="form-control selecter wards">
                                            <option value="">--Chọn xã phường--</option>   
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                               
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                                </form>
                                @endhasrole
                            </div>
                            <br>
                            <header class="panel-heading">
                           Quản Lý Mã Vận Chuyển
                        </header>
                            <div id="load_delivery">
                                
                            </div>
                            
                        </div>
                    </section>

            </div>
@endsection