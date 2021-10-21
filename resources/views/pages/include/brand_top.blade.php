<div class="container">
<div class="col-md-12" id="doitac">
                    <h3 class="doitac"> @lang('lang.thuonghieunoibat')</h3>
                    <div class="owl-carousel owl-theme">
                        @foreach($icons_doitac as $key => $doitac)
                        <div class="item" style="padding-left:0 !important; ">
                            <a target="_blank" href="{{$doitac->link}}"><p><img class="img-doitac" src="{{asset('public/FrontEnd/Images/icon/'.$doitac->icon_image)}}"></p>
                            <h4 class="doitac_name">{{$doitac->name}}</h4></a>
                        </div>
                        @endforeach
                    </div>         
                </div></div>