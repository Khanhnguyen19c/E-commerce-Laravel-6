@extends('welcome')
@section('slider')
  @include('pages.include.slider')
@endsection

@section('content')
<div class="features_items"><!--features_items-->
       
                        <h2 class="title text-center">Video Shop</h2>
                        <div class="row">
                        @foreach($all_video as $key => $video)
                        <div class="col-sm-4" >
                            <div class="product-image-wrapper">
                            <form>
                                @csrf
                                <div class="single-products single-products-video">
                                        <div class="productinfo text-center">
                                                <img style="min-height:auto;" class="img-video" src="{{asset('public/uploads/videos/'.$video->video_image)}}" alt="{{$video->video_title}}" />
                                                <h2>{{$video->video_name}}</h2>
                                              <p style="height:auto">{{$video->video_desc}}</p>
                                                <button type="button" class="btn btn-primary watch-video" data-toggle="modal" data-target="#modal_video" id="{{$video->video_id}}">
                                                  Xem video
                                                </button>
                                        </div>
                                      
                                </div>
                            </form>
                           
                             
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div><!--features_items-->
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$all_video->links()!!}
                      </ul>
        

          
            <div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="video_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             
                    </button>
                  </div>
                
                  <div class="modal-body">
                    <div id="video_link"></div>
                    <div id="video_desc"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="close_video" class="btn btn-secondary" data-dismiss="modal">Đóng video</button>
                    
                  </div>
                </div>
              </div>
            </div>
           
@endsection