
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
						@php
								$i=0;
								if(isset($slider)){
							@endphp
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							@foreach ($slider as $key=>$slide )
								@php
									$i++;
								@endphp
							<div class="item {{$i==1 ? 'active' : ''}}">
								<div class="col-md-12">
								<img  src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" width="100%" class="img-slider" alt="{{$slide->slider_desc}}">
								</div>
							</div>
							@endforeach
						</div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
						@php
								}
						@endphp
						
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
