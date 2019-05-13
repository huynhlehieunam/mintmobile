@extends('backend.master')
@section('content')
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
                @if(Session::has('msg'))
                    <div class="alert alert-success">
                        {{Session::get('msg')}}
                    </div>
                @endif
                @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        {{$errors->first()}}
                    </div>
                @endif
				<div class="panel panel-primary">
					<div class="panel-heading">Tạo sản phẩm</div>
					<div class="panel-body">
						<form method="post" enctype="multipart/form-data" action="{{route('products.store')}}">
							<div class="row" style="margin-bottom:40px">
								<div class="col-xs-8">
                                    @csrf
									<div class="form-group" >
										<label>Tên sản phẩm</label>
										<input required type="text" name="name" class="form-control" >
									</div>
									<div class="form-group" >
										<label>Giá sản phẩm</label>
										<input required type="number" name="price" class="form-control" >
									</div>
									<div class="form-group" >
										<label>Ảnh sản phẩm</label>
										<input id="image" type="file" name="image" class="form-control" onchange="changeImg()">
					                    <img id="avatar" class="thumbnail" height="200px" >
									</div>
									<div class="form-group" >
										<label>Phụ kiện</label>
										<input required type="text" name="accessories" class="form-control">
									</div>
									<div class="form-group" >
										<label>Bảo hành</label>
										<input required type="text" name="warranty" class="form-control">
									</div>
									<div class="form-group" >
										<label>Khuyến mãi</label>
										<input required type="text" name="promotion" class="form-control">
									</div>
									<div class="form-group" >
										<label>Tình trạng</label>
										<input required type="text" name="condition" class="form-control">
									</div>
									<div class="form-group" >
										<label>Trạng thái</label>
										<select required name="status" class="form-control">
											<option value="1">Còn hàng</option>
											<option value="0">Hết hàng</option>
					                    </select>
									</div>
									<div class="form-group" >
										<label>Miêu tả</label>
										<textarea name="description" class="ckeditor" id="description"></textarea>
                                        <script src="{!! asset('soft/ckeditor/ckeditor.js') !!}"></script>
                                        <script>
                                            CKEditor.replace('description');
                                        </script>
									</div>
									<div class="form-group" >
										<label>Danh mục</label>
										<select required name="category_id" class="form-control">
											@foreach ($categories as $category)
												<option value="{{$category->id}}">{{$category->name}}</option>
											@endforeach
					                    </select>
									</div>

									<input type="submit" name="submit" value="Thêm" class="btn btn-primary">
									<a href="#" class="btn btn-danger">Hủy bỏ</a>
								</div>
							</div>
						</form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
@endsection
@section('scripts')
    <script>
        function changeImg(){
            var file = document.getElementById("image").files[0];
            var preview = document.getElementById("avatar");
            var reader = new FileReader();

            reader.addEventListener("load",function(){
                preview.src = reader.result;
            });
            if(file){
                reader.readAsDataURL(file);
            };
        }

    </script>
@endsection

