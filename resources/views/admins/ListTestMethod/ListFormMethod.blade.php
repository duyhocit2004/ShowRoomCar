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
				<div class="card-body" id="detail">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th class="wd-15p">STT</th>
									<th class="wd-15p">Tên</th>
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
    @vite('resources/js/Admins/ListFormMethod.js')
@endpush	