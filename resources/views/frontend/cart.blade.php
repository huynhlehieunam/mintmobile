@extends('frontend.master')
@section('title')
    Giỏ hàng
@endsection
@section('links')
    <link rel="stylesheet" href="{{asset('frontend/css/category.css')}}">
@endsection
@section('contents')
    <div id="list-cart">
							<h3>Giỏ hàng</h3>
							<form>
								<table class="table table-bordered .table-responsive text-center">
									<tr class="active">
										<td width="11.111%">Ảnh mô tả</td>
										<td width="22.222%">Tên sản phẩm</td>
										<td width="22.222%">Số lượng</td>
										<td width="16.6665%">Đơn giá</td>
										<td width="16.6665%">Thành tiền</td>
										<td width="11.112%">Xóa</td>
									</tr>
									@if (Session::has('cart'))
                                        @foreach (Session::get('cart')->list as $item)
                                            <tr>
                                                <td ><img class="img-responsive"  height="50px" src="{{asset('storage/images/'.$item->product['image'])}}"></td>
                                                <td>{{$item->product['name']}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control" type="number" value="{{$item->quantity}}">
                                                    </div>
                                                </td>
                                                <td><span class="price">{{$item->product['price']}}</span></td>
                                                <td><span class="price">{{$item->quantity*$item->product['price']}}</span></td>
                                                <td><a href="#">Xóa</a></td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif

								</table>
								<div class="row" id="total-price">
									<div class="col-md-6 col-sm-12 col-xs-12">
											Tổng thanh toán: <span class="total-price">50.000.000 đ</span>

									</div>
									<div class="col-md-6 col-sm-12 col-xs-12">
										<a href="#" class="my-btn btn">Mua tiếp</a>
										<a href="#" class="my-btn btn">Cập nhật</a>
										<a href="#" class="my-btn btn">Xóa giỏ hàng</a>
									</div>
								</div>
							</form>
						</div>

						<div id="xac-nhan">
							<h3>Xác nhận mua hàng</h3>
                            <form id="confirm" action="{{url('order')}}" method="POST">
                                @csrf
								<div class="form-group">
									<label for="email">Email address:</label>
									<input required type="email" class="form-control" id="email" name="email" value="<?php echo (Auth::check()? Auth::user()->email : '') ?>">
								</div>
								<div class="form-group">
									<label for="name">Họ và tên:</label>
									<input required type="text" class="form-control" id="name" name="name" value="<?php echo (Auth::check()? Auth::user()->name : '') ?>">
								</div>
								<div class="form-group">
									<label for="phone">Số điện thoại:</label>
									<input required type="number" class="form-control" id="phone" name="phone" value="<?php echo (Auth::check()? Auth::user()->tel : '') ?>">
								</div>
								<div class="form-group">
									<label for="add">Địa chỉ:</label>
									<input required type="text" class="form-control" id="add" name="address" value="<?php echo (Auth::check()? Auth::user()->address : '') ?>">
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-default">Thực hiện đơn hàng</button>
								</div>
							</form>
						</div>

@endsection
@section('scripts')
@endsection
