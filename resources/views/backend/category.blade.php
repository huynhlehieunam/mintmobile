@extends('backend.master')
@section('content')
        <div class="modal" id="category-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="category-form">
                            <div class="form-group">
								<label>Tên danh mục:</label>
								<input type="text" name="name" class="form-control" >
                            </div>
                            <div class="form-group">
								<label>Link mô tả:</label>
								<input type="text" name="descript_link" class="form-control" >
                            </div>
                            <div class="form-group">
								<label>Hình ảnh:</label>
								<input type="file" accept="image/*" name="logo" class="form-control" onclick="changePreview()">
                            </div>
                            <div id="preview">
                                <img src="" style="width:300px;height:300px" alt="">
                            </div>
                            <button type="submit" class="btn btn-success">Gửi</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục sản phẩm</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-5 col-lg-5">
					<div class="panel panel-primary">
						<div class="panel-heading">
							Thêm danh mục
						</div>
						<div class="panel-body">
							<button id="show-create-form" class="btn btn-danger">Tạo danh mục</button>
						</div>
					</div>
			</div>
			<div class="col-xs-12 col-md-7 col-lg-7">
				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách danh mục</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<table class="table table-bordered" id="list-cate">
				              	<thead>
					                <tr class="bg-primary">
					                  <th>Tên danh mục</th>
					                  <th style="width:30%">Tùy chọn</th>
					                </tr>
				              	</thead>
				              	<tbody>

								@foreach($allCate as $cate)
									<tr class="category-item" id="{{$cate->id}}">
										<td class="name">{{$cate->name}}</td>
										<td class="progress">
											<a class="btn btn-warning update-btn"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
											<a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger delete-btn"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
										</td>
                            		</tr>
								@endforeach

				                </tbody>
				            </table>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
@endsection
@section('scripts')
	<script>
			$(document).ready(function(e){
                $("#show-create-form").click(function(e){
                    $("#category-modal").find(".modal-title").text("Tạo danh mục");
                    $("#category-modal form").attr("action","{{url('admin/categories')}}");
                    $("#category-modal").modal();
				});
				$(".update-btn").click(function(e){
					var id = $(this).parents(".category-item").attr('id');
					$.ajax({
                        url: "{{url('admin/categories')}}"+"/"+id,
                        method: 'GET',
						dataType: 'JSON',
                    }).done(function(msg){
						$("#category-modal").find(".modal-title").text("Update danh mục");
                        $("#category-modal form").attr("action","{{url('admin/categories')}}"+"/"+msg.id);
                        $("#category-modal form").find("input[name=name]").val(msg.name);
                        $("#category-modal form").find("input[name=descript_link]").val(msg.descript_link);
                        $("#preview img").attr("src", "data:image/png;base64,"+msg.logo);
						$("#category-modal").modal();
                    });
                });
                $(".delete-btn").click(function(e){
                    e.preventDefault();
                    var id = $(this).parents(".category-item").attr('id');
                    var node = $(this).parents(".category-item");
                    $.ajax({
                        url: "{{url('admin/categories')}}"+"/"+id,
                        method: 'DELETE',

                    }).done(function(msg){
                        node.remove();
                    });

				});
                $("#category-form").submit(function(e){
                    e.preventDefault();
                    var name = $(this).find("input[name=name]").val();
                    var descript_link = $(this).find("input[name=descript_link]").val();
                    var logo = document.querySelector("input[name=logo]").files[0];


                    var data = new FormData();
                    data.append('name',name);
                    data.append('descript_link',descript_link);
                    data.append('logo',logo);

                    $.ajax({
                        url: $(this).attr("action"),
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        data: data,
                    }).done(function(msg){
                        $("#list-cate tbody").append("<tr class='category-item' id='"+msg.id+"'><td class='name'>"+name+"</td><td class='progress'><a class='btn btn-warning update-btn'><span class='glyphicon glyphicon-edit'></span> Sửa</a><a onclick='return confirm('Bạn có chắc chắn muốn xóa?')' class='btn btn-danger delete-btn'><span class='glyphicon glyphicon-trash'></span> Xóa</a></td></tr>");
                    });

                });
            });
            function changePreview(){
                var preview = document.querySelector("#preview img");
                var file = document.querySelector("#category-form input[name=logo]").files[0];
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

