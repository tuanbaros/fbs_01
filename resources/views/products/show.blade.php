@extends('layouts.app')

@section('title')
    @lang('product.productDetail')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/productDetail.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/category.css') }}">
    @if ($product)
        <div class="view-product">
            <div class="container">
                <div class="row margin-top-20">
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <div id="carousel-example-generic" class="carousel slide border-shadow-bottom" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($product->images as $key => $image)
                                    @if ($key == 0)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="active"></li>
                                    @else
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}"></li>
                                    @endif
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach ($product->images as $key => $image)
                                    @if ($key == 0)
                                        <div class="item active">
                                            <img src="{{ asset($image->url) }}" class="img-product">
                                            <div class="carousel-caption"></div>
                                        </div>
                                    @else
                                        <div class="item">
                                            <img src="{{ asset($image->url) }}" class="img-product">
                                            <div class="carousel-caption"></div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">@lang('product.previous')</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">@lang('product.next')</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                        <div class="block-info-product col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">{{ number_format($product->price, 0) }} @lang('home.currency')</div>
                            <div class="rate">
                                <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                            </div>
                            <div class="info-sell-product">
                                <span>@lang('product.count'): </span>
                                <span class="operator">-</span>
                                <span class="number">1</span>
                                <span class="operator">+</span>
                                <span class="avarible-product">{{ $product->quantity }} @lang('product.availible')</span>
                            </div>
                            <div class="add-product-in-cart">
                                <input type="button" class="btn-add-cart-product-detail" value="@lang('categories.addCart')">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom security-shop">
                            <i class="fa fa-shield" aria-hidden="true"></i>
                            <span class="title">@lang('product.securityShop')</span>
                            <span class="receipt">@lang('product.moneyReceipt')</span>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom view-shop">
                            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 avatar-shop">
                                <a href="{{ route('shop.show', $product->shop->id) }}">
                                    <img src="{{ asset($product->shop->image) }}" width="50" height="50">
                                </a>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 row block-shop-info">
                                <a href="{{ route('shop.show', $product->shop->id) }}" class="shop-name">
                                    <span>{{ $product->shop->name }}</span>
                                </a>
                                <div class="view-follow-shop-info">
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 row view">
                                        <a href="{{ route('shop.show', $product->shop->id) }}" class="btn-button button4">@lang('product.view')</a>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 follow">
                                        <a href="" class="btn-button button4">@lang('product.follow')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 row info-in-shop">
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->products) }}</div>
                                    <div class="text-align-center name">@lang('product.product')</div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->follows) }}</div>
                                    <div class="text-align-center name">@lang('product.follow')</div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->likes) }}</div>
                                    <div class="text-align-center name">@lang('product.like')</div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->collections) }}</div>
                                    <div class="text-align-center name">@lang('product.collection')</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margin-top-10">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom background-while padding-top-10">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#detail">@lang('product.productDetail')</a></li>
                                <li><a href="#vote">@lang('product.vote')</a></li>
                                <li><a href="#comment">@lang('product.comment')</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="detail" class="tab-pane fade in active">
                                    <h4>@lang('product.introductProduct') {{ $product->name }}</h4>
                                    <p class="margin-top-20"><h4>@lang('product.generalInformation')</h4></p>
                                    <p>@lang('product.productName') {{ $product->name }}</p>
                                    <p>@lang('product.code') {{ $product->code }}</p>
                                    <p>@lang('product.price') {{ number_format($product->price, 0) }} @lang('home.currency')</p>
                                    <p>@lang('product.number') {{ $product->quantity }}</p>
                                    <p>@lang('product.status') {{ $product->status }}</p>
                                    <p class="margin-top-20"><h4>@lang('product.description')</h4></p>
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div id="vote" class="tab-pane fade">
                                </div>
                                <div id="comment" class="tab-pane fade">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 view-category">
                            <h4><span class="title-category">@lang('product.similarProduct')</span></h4>
                            <h5 class="view-all">
                                <a href="">
                                    <span class="padding-right-5">@lang('product.viewAll')</span> 
                                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                </a>
                            </h5>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero margin-top-10">
                            @foreach ($similarProducts as $key => $value)
                                <div class="col-md-2 padding-zero block-product-category block-product-similar">
                                    <div class="height-140p">
                                        <a href="{{ route('product.show', $value->id) }}" class="col-md-12 img-product">
                                            @if (count($value->images) > 0)
                                                <img src="{{ asset($value->images[0]->url) }}" class="image">
                                            @endif  
                                        </a>
                                    </div>
                                    <div class="text-align-center product-name">
                                        <a href="{{ route('product.show', $value->id) }}">{{ $value->name }}</a>
                                    </div>
                                    <div class="product-price">
                                        <span>{{ number_format($value->price, 0) }} @lang('home.currency')</span>
                                    </div>
                                    <div>
                                        <input name="input-start" value="{{ $value->point_rate }}" class="rating input-start" readonly="true">
                                        <input type="button" class="button btn-add-cart" value="@lang('categories.addCart')">
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/tab.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('user/js/product.js') }}"></script>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom not-found-product">
            @lang('product.not-found-product')
        </div>
    @endif
@endsection
