@extends('frontend.layout.master')
@section('title','List Item')
@section('main')
 <div class="featured-products-section carousel-section">
                <div class="container">
                    <h2 class="h3 title mb-4 text-center">{{$ca->name}}</h2>
                    <div class="featured-products owl-carousel owl-theme">
                        @foreach($ca->products as $prod)
                        <div class="product">
                            <figure class="product-image-container">
                                <a href="{{route('product.list',['slug' => $prod->slug ,'id' => $prod->id])}}" class="product-image">
                                    <img src="{{$prod->image}}" alt="product" style="height: 400px" >
                                </a>
                                <a href="ajax/product-quick-view.html" class="btn-quickview">Quickview</a>
                            </figure>
                            <div class="product-details">
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                                </div><!-- !-- End .product-container -->
                                <h2 class="product-title" style="height: 50px">
                                    <a href="{{route('product.list',['slug' => $prod->slug ,'id' => $prod->id])}}">{{$prod->name}}</a>
                                </h2>
                                <div class="price-box">
                                    <span class="product-price">{{number_format($prod->price)}} VNĐ</span> 
                                    
                                </div><!-- End .price-box -->

                                <div class="product-action">
                                    <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                        <span>Add to Wishlist</span>
                                    </a>

                                    <a href="{{route('cart.add',['id'=>$prod->id,'slug' => $prod->slug])}}" class="paction add-cart" title="Add to Cart">
                                        <span>Add to Cart</span>
                                    </a>

                                    <a href="#" class="paction add-compare" title="Add to Compare">
                                        <span>Add to Compare</span>
                                    </a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .featured-proucts --> 
                    
                </div><!-- End .container -->
            </div>
@stop