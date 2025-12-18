@extends('layouts.frontend.app')
@section('title', 'Groci')

@section('content')

    <!-- body  -->
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url('/') }}">
                        <strong><span class="mdi mdi-home"></span> Home</strong>
                    </a>
                    <span class="mdi mdi-chevron-right"></span>
                    <a href="#">Fruits & Vegetables {{ $item?->category?->name }}</a>
                    {{-- <span class="mdi mdi-chevron-right"></span>
                     <a href="#">Fruits</a> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="shop-single section-padding pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="shop-detail-left">
                        <div class="shop-detail-slider">
                            <div class="favourite-icon">
                                <a class="fav-btn" href="#" title="59% OFF">
                                    <i class="mdi mdi-tag-outline"></i>
                                </a>
                            </div>

                            <div id="sync1" class="owl-carousel">
                                <div class="item">
                                    <img style="height: 100%;width:100%"
                                        src="{{ asset('storage/product/' . $item->image) }}" class="img-fluid img-center"
                                        alt="">
                                </div>
                                @foreach ($item->images as $images)
                                    <div class="item">
                                        <img style="height: 100%;width:100%"
                                            src="{{ asset('storage/products/sub/' . $images->image) }}"
                                            class="img-fluid img-center" alt="">
                                    </div>
                                @endforeach

                            </div>

                            <div id="sync2" class="owl-carousel">

                                <div class="item">
                                    <img src="{{ asset('storage/product/' . $item->image) }}" class="img-fluid img-center"
                                        alt="">
                                </div>
                                @foreach ($item->images as $images)
                                    <div class="item">
                                        <img src="{{ asset('storage/products/sub/' . $images->image) }}"
                                            class="img-fluid img-center" alt="">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="shop-detail-right">
                        <span
                            class="badge badge-success">{{ round((($item->main_price - $item->selling_price) / $item->main_price) * 100) }}%OFF</span>
                        <h2>{{ $item->name }}</h2>
                        {{--    <h6>
                            <strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm
                        </h6> --}}
                        <p class="regular-price">
                            <i class="mdi mdi-tag-outline"></i> MRP : ৳{{ $item->main_price }}
                        </p>
                        <p class="offer-price mb-0">
                            Discounted price : <span class="text-success">৳{{ $item->selling_price }}</span>
                        </p>

                        {{-- Checkout --}}
                        <a href="{{ route('frontend.checkout') }}">
                            <button type="button" class="btn btn-secondary btn-lg">
                                <i class="mdi mdi-cart-outline"></i> Add To Cart
                            </button>
                        </a>

                        <div class="short-description">
                            <h5>
                                Quick Overview
                                <p class="float-right">
                                    Availability:
                                    <span class="badge badge-success">In Stock</span>
                                </p>
                            </h5>
                            <p>
                                <b>{{ $item->description }}
                            </p>

                        </div>

                        <h6 class="mb-3 mt-4">Why shop from Groci?</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feature-box">
                                    <i class="mdi mdi-truck-fast"></i>
                                    <h6 class="text-info">Free Delivery</h6>
                                    <p>Lorem ipsum dolor...</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box">
                                    <i class="mdi mdi-basket"></i>
                                    <h6 class="text-info">100% Guarantee</h6>
                                    <p>Rorem Ipsum Dolor sit...</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- items --}}
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
