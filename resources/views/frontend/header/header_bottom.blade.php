<div class="header-bottom sticky-header">
    <div class="container">
        <nav class="main-nav">
            <ul class="menu sf-arrows">
                <li class="active"><a href="{{route('frontend.layout')}}">Trang chủ</a></li>
                <li>
                    <a href="#" class="sf-with-ul">Categories</a>
                    <div class="megamenu megamenu-fixed-width">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="menu-title">
                                            @foreach($categories as $cat)
                                            <a href="{{route('product.list',['id'=> $cat->id , 'slug' => $cat->slug])}}">{{$cat->name}}</a>
                                            @endforeach
                                        </div>
                                    </div><!-- End .col-lg-6 -->
                                    
                                </div><!-- End .row -->
                            </div><!-- End .col-lg-8 -->

                        </div>
                    </div><!-- End .megamenu -->
                </li>
            </ul>
        </nav>
    </div><!-- End .header-bottom -->
</div><!-- End .header-bottom -->