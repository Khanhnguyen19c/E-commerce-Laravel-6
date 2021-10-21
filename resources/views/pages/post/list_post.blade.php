@extends('welcome')
@section('slider')
  @include('pages.include.slider')
@endsection
@section('content')
<div class="features_items">
       
                        <h2 class="title text-center">{{$meta_title}} </h2>

                      
						<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
						<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>


                        <div class="zalo-share-button" data-href="{{$url_canonical}}" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
                
                            @foreach($post as $key => $p)
                             
                                        <div class="row" style="border-bottom:1px solid #80808036">
											<div class="col-md-4" style="margin-top: 10px;">
											<a href="{{url('tin-tuc/'.$p->post_slug)}}"><img class="img-thumbnail" src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" /></a>
											</div>
											<div class="col-md-8 align-middle">
											<a href="{{url('tin-tuc/'.$p->post_slug)}}"><h4>{{$p->post_title}}</h4></a>
											<div class="article-info">
												<div class="article-date" style="float: left; margin-right:20px">
												<i class="fa fa-calendar" aria-hidden="true"></i> {{$p->created_at}}
												</div>
												<div class="article-author" style="float: left;margin-right:20px">
												<i class="uil uil-user-circle"></i> Admin
												</div>
												<div class="article-comment">
												<i class="uil uil-eye"></i> <span class="fb-comments-count fb_comments_count_zero_fluid_desktop" data-href="{{$url_canonical}}"><span class="fb_comments_count">{{$p->post_views}}</span></span>
												</div>
											</div>
                                                <p >{!!$p->post_desc!!}</p>
											</div>
											<div class="text-right">
                                    		<a  href="{{url('/tin-tuc/'.$p->post_slug)}}" class="btn btn-primary btn-sm watch-post">Xem bài viết</a>
                                    	</div>
                                        </div>
                                       
										
                                <div class="clearfix"></div>
                             @endforeach
                           
							 {{ $post->links() }}
                   
        <!--/recommended_items-->
		</div>
@endsection