@extends('admins.index')
@section('main')
	<!--Page header-->
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title">Dashboard</h4>
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Dashboard 02</li>
			</ol>
		</div>

	</div>
	<!--End Page header-->
	<!--Row-->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Danh sách gửi phiếu</div>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th class="wd-15p">STT</th>
									<th class="wd-15p">image</th>
									<th class="wd-15p">Họ tên</th>
									<th class="wd-20p">số điện thoại</th>
									<th class="wd-15p">Vấn đề</th>
									<th class="wd-10p">Salary</th>
									<th class="wd-25p">Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Bella</td>
									<td>Chloe</td>
									<td>System Developer</td>
									<td>2018/03/12</td>
									<td>$654,765</td>
									<td><a href="https://laravel.spruko.com/cdn-cgi/l/email-protection" class="__cf_email__"
											data-cfemail="0d6f234e656162684d696c796c796c6f61687e23636879">[email&#160;protected]</a>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
				<!-- table-wrapper -->
			</div>
		</div>
	</div>
	<!--End row-->
@endsection