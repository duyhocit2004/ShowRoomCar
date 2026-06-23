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
							<div class="col-xl-7 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Overview Leads This month</h3>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
													class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i
													class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-4  text-left mb-4">
												<p class=" mb-0 ">Today Leads</p>
												<h3 class="mb-0">67<span class="fs-12 text-muted"><span
															class="text-danger mr-1"><i
																class="fe fe-arrow-down ml-1"></i>0.9%</span>last
														month</span></h3>
											</div>
											<div class="col-md-4  text-left mb-4">
												<p class=" mb-0 ">This month Leads</p>
												<h3 class="mb-0">1,367<span class="fs-12 text-muted"><span
															class="text-danger mr-1"><i
																class="fe fe-arrow-down ml-1"></i>0.9%</span>last
														month</span></h3>
											</div>
											<div class="col-md-4  text-left mb-4">
												<p class=" mb-0 ">Web Users(this month)</p>
												<h3 class="mb-0">14,789<span class="fs-12 text-muted"><span
															class="text-danger mr-1"><i
																class="fe fe-arrow-down ml-1"></i>0.9%</span>last
														month</span></h3>
											</div>
										</div>
										<div>
											<canvas id="leads" class="chartsh"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-5 col-md-12 col-lg-12">
								<div class="card">
									<div class="p-3">
										<h3 class="card-title mb-3">Key Conversion Metrics</h3>
										<div class="row widget-text">
											<div class="col-4">
												<h3 class="mb-0">8.56%</h3>
												<span class=" mb-0 fs-12 text-muted">Web User to Lead</span>
											</div>
											<div class="col-4 ">
												<h3 class="mb-0">36.12%</h3>
												<span class=" mb-0 fs-12 text-muted">Lead to Trial</span>
											</div>
											<div class="col-4 ">
												<h3 class="mb-0">9.74%</h3>
												<span class=" mb-0 fs-12 text-muted">Web User to Trial</span>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Lead Breakdown This Month</h3>
										<div class="card-options ">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
													class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i
													class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body p-0">
										<div class="row mr-0 ml-0">
											<div class="col-md-12 border-bottom pr-0 pl-0">
												<div class="p-4">
													<div class="d-flex mb-2">
														<h3 class="mb-0">2,789</h3>
														<span class="fs-18 text-muted ml-auto">Trials</span>
													</div>
													<div class="row">
														<div class="col">
															<p class=" mb-0 ">Trials</p>
															<h4 class="mb-0">58%<span class="fs-12 text-muted"><span
																		class="text-success mr-1"><i
																			class="fe fe-arrow-up ml-1"></i>0.9%</span>last
																	month</span></h4>
														</div>
														<div class="col text-right">
															<div class="">
																<span class="sparkline_bar21"></span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 pr-0 pl-0">
												<div class="p-4">
													<div class="d-flex mb-2">
														<h3 class="mb-0">5,982</h3>
														<span class="fs-18 text-muted ml-auto">Leads</span>
													</div>
													<div class="row">
														<div class="col">
															<p class=" mb-0 ">Non-Trials</p>
															<h4 class="mb-0">63%<span class="fs-12 text-muted"><span
																		class="text-success mr-1"><i
																			class="fe fe-arrow-up ml-1"></i>0.9%</span>last
																	month</span></h4>
														</div>
														<div class="col text-right">
															<div class="">
																<span class="sparkline_bar22"></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--End row-->
@endsection