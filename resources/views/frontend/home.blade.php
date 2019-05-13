@extends('frontend.master')
@section('title')
    Trang chủ
@endsection
@section('links')
    <link rel="stylesheet" href="{{asset('frontend/css/home.css')}}">
@endsection
@section('contents')
    <div class="products">
							<h3>sản phẩm nổi bật</h3>
							<div class="product-list row">
								@foreach ($latestProducts as $item)
                                    <div class="product-item col-md-3 col-sm-6 col-xs-12">
                                        <a href="#"><img src="{{asset('storage/images/'.$item->image)}}" class="img-thumbnail"></a>
                                        <p><a href="#">{{$item->name}}</a></p>
                                        <p class="price">{{$item->price}}</p>
                                        <div class="marsk">
                                            <a href="{{url('products/'.$item->id)}}">Xem chi tiết</a>
                                        </div>
								</div>
                                @endforeach

							</div>
						</div>

						<div class="products">
							<h3>sản phẩm mới</h3>
							<div class="product-list row">
								@foreach ($mostViewsProducts as $item)
                                    <div class="product-item col-md-3 col-sm-6 col-xs-12">
                                        <a href="#"><img src="{{asset('storage/images/'.$item->image)}}" class="img-thumbnail"></a>
                                        <p><a href="#">{{$item->name}}</a></p>
                                        <p class="price">{{$item->price}}</p>
                                        <div class="marsk">
                                            <a href="{{url('products/'.$item->id)}}">Xem chi tiết</a>
                                        </div>
								</div>
                                @endforeach
							</div>
						</div>
@endsection
