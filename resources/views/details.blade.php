@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-md-1 pb-md-3"></div>
    <section class="product-single container">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-single__media" data-media-type="vertical-thumbnail">
                    <div class="product-single__image">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-single__image-item">
                                <img loading="lazy"
     class="img-fluid mx-auto d-block"
     src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}"
     alt="Product Image"
     style="max-width: 500px; width: 100%; height: auto; object-fit: contain; aspect-ratio: 1 / 1;">

                                    <a data-fancybox="gallery" href="{{asset('uploads/products')}}/{{$product->image}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_zoom" />
                                        </svg>
                                    </a>
                                </div>                                                                    
                                @foreach (explode(",",$product->images) as $gimg)
                                <div class="swiper-slide product-single__image-item">
                                <img loading="lazy"
     class="img-fluid"
     src="{{ asset('uploads/products') }}/{{ trim($gimg) }}"
     alt="Product Thumbnail"
     style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">


                                <a data-fancybox="gallery" href="{{asset('uploads/products')}}/{{trim($gimg)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_zoom" />
                                        </svg>
                                    </a>
                                </div>
                                @endforeach                            
                            </div>
                            <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_sm" />
                                </svg></div>
                            <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_sm" />
                                </svg></div>
                        </div>
                    </div>
                    <div class="product-single__thumbnail">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-single__image-item"><img loading="lazy" class="h-auto" src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}" width="104" height="104" alt="" /></div>
                                @foreach (explode(",",$product->images) as $gimg)
                                    <div class="swiper-slide product-single__image-item">
                                    <img loading="lazy"
     class="img-fluid"
     src="{{ asset('uploads/products') }}/{{ trim($gimg) }}"
     alt="Product Thumbnail"
     style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">

                                    </div>
                                @endforeach                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="{{route('home.index')}}"  class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="{{route('shop.index')}}"  class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                    </div><!-- /.breadcrumb -->
                   
                </div>
                <h1 class="product-single__name">{{$product->name}}</h1>
                
                <div class="product-single__price">
                    <span class="current-price">
                        @if($product->sale_price)                    
                            <s>${{$product->regular_price}}</s> ${{$product->sale_price}} {{round(($product->regular_price - $product->sale_price)*100/$product->regular_price)}} % OFF
                        @else
                            {{$product->regular_price}}
                        @endif
                    </span>
                </div>
                <div class="product-single__short-desc">
                    <p>{{$product->short_description}}</p>
                </div>
                @if(Cart::instance("cart")->content()->Where('id',$product->id)->count()>0)
                    <a href="{{route('cart.index')}}" class="btn btn-warning mb-3">Go to Cart</a>
                @else
                <form name="addtocart-form" method="POST" action="{{route('cart.store')}}">
                    @csrf
                    <div class="product-single__addtocart">
                        <div class="qty-control position-relative">
                            <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                            <div class="qty-control__reduce">-</div>
                            <div class="qty-control__increase">+</div>
                        </div><!-- .qty-control -->
                        <input type="hidden" name="id" value="{{$product->id}}" />
                        <input type="hidden" name="name" value="{{$product->name}}" />
                        <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price:$product->sale_price}}" />                        
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </div>
                </form>
                @endif
                <div class="product-single__addtolinks">
                    <a href="#" class="menu-link menu-link_us-s add-to-wishlist"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                        </svg><span>Add to Wishlist</span></a>
                   
                       
                           
                   
                    <script src="js/details-disclosure.js" defer="defer"></script>
                    <script src="js/share.js" defer="defer"></script>
                </div>
                <div class="product-single__meta-info">
                    <div class="meta-item">
                        <label>SKU:</label>
                        <span>{{$product->SKU}}</span>
                    </div>
                    <div class="meta-item">
                        <label>Category:</label>
                        <span>{{$product->category->name}}</span>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="product-single__details-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a>
                </li>
                
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-description" role="tabpanel" aria-labelledby="tab-description-tab">
                    <div class="product-single__description">
                        {{$product->description}}
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
                    <div class="product-single__addtional-info">
                        <div class="item">
                            <label class="h6">Weight</label>
                            <span>1.25 kg</span>
                        </div>
                        <div class="item">
                            <label class="h6">Dimensions</label>
                            <span>90 x 60 x 90 cm</span>
                        </div>
                      
                        <div class="item">
                            <label class="h6">Color</label>
                            <span>Black, Orange, White</span>
                        </div>
                       
                    </div>
                </div>
             
            </div>
        </div>
    </section>
    
</main>
@endsection

