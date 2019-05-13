@extends('backend.master')
@section('content')
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách sản phẩm</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="{{url('admin/products/create')}}" class="btn btn-primary">Thêm sản phẩm</a>
								<table class="table table-bordered" style="margin-top:20px;">
									<thead>
										<tr class="bg-primary">
											<th>ID</th>
											<th width="30%">Tên Sản phẩm</th>
											<th>Giá sản phẩm</th>
											<th width="20%">Ảnh sản phẩm</th>
											<th>Danh mục</th>
											<th>Tùy chọn</th>
										</tr>
									</thead>
									<tbody id="list-products">
										@foreach ($products as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->price}} VND</td>
                                                <td>
                                                    <img width="50px" src="{{asset('storage/images'.'/'.$item->image)}}" class="thumbnail">
                                                </td>
                                                <td>{{$item->category_name}}</td>
                                                <td>
                                                    <a href="{{url("admin/products/$item->id/edit")}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                                                    {!! Form::open(["url"=>route('products.destroy',$item->id),"method"=>"DELETE","style"=>"display:inline"]) !!}

                                                         <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                                                    {!! Form::close() !!}

                                                </td>
                                            </tr>
                                        @endforeach

									</tbody>
								</table>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
@endsection
@section('scripts')


@endsection

