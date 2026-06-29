@extends('admins.index')
@section('main')
	<!--Page header-->
	<div class="page-header" id="page-header">


	</div>
	<!--End Page header-->
	<!--Row-->
	<div class="row">
		<div class="col-md-12 col-lg-12" id="edit">
			<div class="card">
				<div class="card-header">
					<div class="card-title" id="card-title"></div>
					<div class="card-options ">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
								class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="card-body" id="detail">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th class="wd-15p">STT</th>
									{{-- <th class="wd-15p">image</th> --}}
									<th class="wd-15p">Họ tên</th>
									<th class="wd-20p">số điện thoại</th>
									<th class="wd-15p">email</th>
									<th class="wd-15p">Hình thức</th>
									<th class="wd-10p">Trạng thái</th>
									<th class="wd-25p">Thao tác</th>
								</tr>
							</thead>
							<tbody id="table-body">


							</tbody>
						</table>
						<nav class="mt-3">
							<ul class="pagination justify-content-end" id="pagination">
							</ul>
						</nav>
					</div>
				</div>
				<!-- table-wrapper -->
			</div>
		</div>
	</div>
	<!--End row-->
@endsection
@push('scripts')
    @vite('resources/js/Admins/FormRegister.js')
@endpush	