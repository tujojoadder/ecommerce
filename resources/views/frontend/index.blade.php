@extends('layouts.frontend.app')

@section('title', 'Home - Groci')

@section('content')

    <section class="carousel-slider-main text-center border-top border-bottom bg-white">
        <div class="owl-carousel owl-carousel-slider">

            @foreach ($sliders as $slider)
                <div class="item">
                    <a href="#"><img class="img-fluid" src="{{ asset('storage/slider/' . $slider->image) }}"
                            alt="slide"></a>
                </div>
            @endforeach
        </div>
    </section>
    <section class="top-category section-padding">
        <div class="container">
            <div class="owl-carousel owl-carousel-category">

                @foreach ($categories as $category)
                    <div class="item">
                        <div class="category-item">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset('storage/category/' . $category->icon) }}"
                                    alt="">
                                <h6>{{ $category->name }}</h6>
                                <p>{{ $category?->products->count() }} Items</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">Top Savers Today <span class="badge badge-primary">20% OFF</span>
                    <a class="float-right text-secondary" href="#">View All</a>
                </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">


                @foreach ($products as $product)
                    <div class="item">
                        <div class="product">
                            <a href="{{ route('frontend.product.item', $product->id) }}">
                                <div class="product-header">
                                    <span class="badge badge-success">50% OFF</span>
                                    <img class="img-fluid" src="{{ asset('storage/product/' . $product->image) }}"
                                        alt="">
                                    <span class="veg text-success mdi mdi-circle"></span>
                                </div>
                                <div class="product-body">
                                    <h5>{{ $product->name }} </h5>
                                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                                </div>
                                <div class="product-footer">
                                    <button type="button" class="btn btn-secondary btn-sm float-right"><i
                                            class="mdi mdi-cart-outline"></i>
                                        Add To Cart</button>
                                    <p class="offer-price mb-0">৳{{ $product->selling_price * 0.5 }}<i
                                            class="mdi mdi-tag-outline"></i><br><span
                                            class="regular-price">৳{{ $product->selling_price }}</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="offer-product">
        <div class="container">
            <div class="row no-gutters">
                @foreach ($banners as $banner)
                    <div class="col-md-6">
                        <a href="#"><img class="img-fluid" src="{{ asset('storage/banner/' . $banner->image) }}"
                                alt=""></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="product-items-slider section-padding">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">Best Offers View <span class="badge badge-info">20% OFF</span>
                    <a class="float-right text-secondary" href="#">View All</a>
                </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
                @foreach ($products as $product)
                    <div class="item">
                        <div class="product">
                            <a href="{{ route('frontend.product.item', $product->id) }}">
                                <div class="product-header">
                                    <span class="badge badge-success">20% OFF</span>
                                    <img class="img-fluid" src="{{ asset('storage/product/' . $product->image) }}"
                                        alt="">
                                    <span class="veg text-success mdi mdi-circle"></span>
                                </div>
                                <div class="product-body">
                                    <h5>{{ $product->name }} </h5>
                                    <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                                </div>
                                <div class="product-footer">
                                    <button type="button" class="btn btn-secondary btn-sm float-right"><i
                                            class="mdi mdi-cart-outline"></i>
                                        Add To Cart</button>
                                    <p class="offer-price mb-0">৳{{ $product->selling_price * 0.8 }}<i
                                            class="mdi mdi-tag-outline"></i><br><span
                                            class="regular-price">৳{{ $product->selling_price }}</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
