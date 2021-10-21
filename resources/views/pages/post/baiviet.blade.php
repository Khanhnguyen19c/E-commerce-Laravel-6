@extends('welcome')
@section('slider')
  @include('pages.include.slider')
@endsection
@section('content')
<style type="text/css">
  .baiviet ul li {
    padding: 2px;
    font-size: 16px;
}
.title{
    padding-top: 30px;
}
.padding-right{
    background-color: #fff;
}
.baiviet ul li a {
    color: #000;
}
.baiviet ul li a:hover {
    color: #FE980F;
}
.baiviet ul li {
    list-style-type: decimal-leading-zero;
}
.mucluc h1 {
    font-size: 20px;
    color: brown;
}
</style>
                      <div class="features_items">

                     
                        <h2 style="margin:0;position: inherit;font-size: 22px" class="title text-center">{{$meta_title}}</h2>
                        
                       
                      	 	<div class="product-image-wrapper" style="border: none;">
                            @foreach($post_by_id as $key => $p)
                                <div class="single-products" style="margin:10px 0;padding: 2px">
                                <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
						<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>


                        <div class="zalo-share-button" data-href="{{$url_canonical}}" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
                                <div class="article-info" style="font-size: 18px;">
                                
												<div class="article-date" style="float: left; margin-right:20px">
												<i class="fa fa-calendar" aria-hidden="true"></i> {{$p->created_at}}
												</div>
												<div class="article-author" style="float: left;margin-right:20px">
												<i class="fa fa-user" aria-hidden="true"></i> {{$p->post_author}}
												</div>
												<div class="article-comment">
												<i class="fa fa-commenting" aria-hidden="true"></i> <span class="fb-comments-count fb_comments_count_zero_fluid_desktop" data-href="https://authentic-shoes.com/blogs/news/cau-chuyen-on-ao-dang-sau-air-jordan-1-pollen" fb-xfbml-state="parsed" fb-iframe-plugin-query="app_id=&amp;container_width=0&amp;count=true&amp;height=100&amp;href=https%3A%2F%2Fauthentic-shoes.com%2Fblogs%2Fnews%2Fcau-chuyen-on-ao-dang-sau-air-jordan-1-pollen&amp;locale=vi_VN&amp;sdk=joey&amp;version=v7.0&amp;width=550"><i class="fa fa-eye" aria-hidden="true"></i> {{$p->post_views}}</span></span>
												</div>
                                                
						
											</div>
                            
                               
                                   <p style="font-size: 18px;">{!!$p->post_content!!}</p>  
                                     
                                </div>
                                <div class="clearfix"></div>
                           @endforeach
                            </div>
                        
                    	</div><!--features_items-->
                      <h2 style="margin:0;font-size: 22px" class="title text-center">Bài viết liên quan</h2>
                      <style type="text/css">
                        ul.post_relate li {
                          list-style-type: disc;
                          font-size: 16px;
                          padding: 6px;
                        }
                        ul.post_relate li a {
                            color: #000;
                        }
                        ul.post_relate li a:hover {
                            color: #FE980F;
                        }
                      </style>
                      <ul class="post_relate">
                       
                        @foreach($related as $key => $post_relate)
                          <li><a href="{{url('/tin-tuc/'.$post_relate->post_slug)}}">{{$post_relate->post_title}}</a></li>
                        @endforeach

                      </ul>
                      <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>
        <!--/recommended_items-->
@endsection