@extends('frontend.master')
@section('title')
    Trang chủ
@endsection
@section('links')
    <link rel="stylesheet" href="{{asset('frontend/css/details.css')}}">
@endsection
@section('contents')
    <div id="product-info">
						<div class="clearfix"></div>
						<h3>Điện thoại {{$product->name}}</h3>
						<div class="row">
							<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
								<img src="{{asset('storage/images/'.$product->image)}}" class="img-fluid">
							</div>
						    <div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
									<p>Giá: <span class="price"><span style="color:blue;font-weight:bold ">{{$product->price}}</span></span></p>
									<p>Bảo hành: <span style="color:blue;font-weight:bold ">{{$product->warranty}} tháng</span> </p>
									<p>Phụ kiện: <span style="color:blue;font-weight:bold ">{{$product->accessories}}</span></p>
									<p>Tình trạng: <span style="color:blue;font-weight:bold "><?php if($product->condition==0) {echo "Mới 100%";} else {echo "Cũ";} ?></span></p>
									<p>Khuyến mại: <span style="color:blue;font-weight:bold ">{{$product->promotion}}</span></p>
									<p class="add-cart text-center"><a href="{{url('cart/add/'.$product->id)}}">Đặt hàng online</a></p>
								</div>
							</div>
						</div>
						<div id="product-detail">
							<h3>Chi tiết sản phẩm</h3>
                            <?php
                                //dd(gettype($product->descript));
                                echo $product->descript
                            ?>
						</div>
						<div id="comment">
							<h3>Bình luận</h3>
							<div class="col-md-9 comment">
								<form id="add-comment">
									<div class="form-group">
										<label for="email">Email:</label>
										<input required type="email" class="form-control" id="email" name="email">
									</div>

									<div class="form-group">
										<label for="cm">Bình luận:</label>
										<textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
									</div>
									<div class="form-group text-right">
										<button type="submit" class="btn btn-default">Gửi</button>
									</div>
								</form>
							</div>
						</div>
						<div id="comment-list">
							@foreach ($comments as $comment)
                                <ul>
                                    <li class="com-title">
                                        {{$comment->email}}
                                        <br>
                                        <span>{{$comment->created_at}}</span>
                                    </li>
                                    <li class="com-details">
                                        {{$comment->content}}
                                    </li>
							    </ul>
                            @endforeach
						</div>
@endsection
@section('scripts')
    <script>
        $("#add-comment").submit(function(e){
                    e.preventDefault();
                    var email = $(this).find("input[name=email]").val();
                    var content = $(this).find("textarea[name=content]").val();
                    var product_id = {{$product->id}};


                    $.ajax({
                        url: "{{url('comments/create')}}",
                        method: 'POST',
                        dataType:'JSON',
                        data: {"email":email,"content":content,"product_id":product_id},
                    }).done(function(msg){
                        $("#comment-list").append("<ul><li class='com-title'>"+email+"<br><span>"+msg.created_date+"</span></li><li class='com-details'>"+content+"</li></ul>")
                    }).fail(function(response){
                        alert(response.message);
                    });

                });

    </script>
@endsection
