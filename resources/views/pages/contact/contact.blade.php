@extends('welcome')
@section('slider')
  @include('pages.include.slider')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Trang Liên Hệ</h2>
                        <div class="row">
                            <div class="col-md-6 text-center" style="font-size: 20px;font-weight: bold;">
                                @foreach ($contact as $key =>$cont)
                             {!!$cont->info_contact!!}
                            </div>
                            <div class="col-md-6 text-center">
                            {!!$cont->info_fanpage!!}
                               
                            </div>
                           
                            <div class="col-md-12">
                                <h4>Bản Đồ</h4>
                                {!!$cont->info_map!!}
                            </div>
                        </div>
                        @endforeach
                            
					

					</div><!--features_items-->
				
                    @endsection
    