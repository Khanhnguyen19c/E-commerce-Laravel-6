@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm thư viện ảnh
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
                        
                        <div class="row">
                        @hasrole(['admin','author'])
                        <form style="text-align: center;" action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                <div class="form-wrapper">
                                <div class="upload-btn-wrapper1">
                              
                                <input type="file" class="form-control file_up" id="file" name="file[]" accept="image/*" multiple>
                                <span id="error_gallery"></span>
                                    <button class="btn_upload1">Tải File Lên</button>
                                </div>
                                
                                <input type="submit" name="upload" name="taianh" value="Thêm ảnh" class="btn btn-success ">
                            </div>
                           
                               
                           
                            
                        </div>
                        </form>

                       
                            <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                            <form>
                                @csrf
                                <div id="gallery_load">
                                   
                                </div>
                            </form>

                       @endhasrole
                    </section>

            </div>
            <script>
                                function showImage(t) {
                                    document.getElementById('hinhtam').src = window.URL.createObjectURL(t.files[0]);
                                }
                            </script>
@endsection