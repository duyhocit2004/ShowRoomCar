			<aside class="app-sidebar">
				<div class="app-sidebar__user">
					<div class="dropdown user-pro-body text-center">
						<div class="user-pic">
							<img src="{{ auth()->user()?->image }}" alt="user-img" class="avatar-xl rounded-circle mb-1">
						</div>
						<div class="user-info">
							<h6 class=" mb-1 text-dark">{{ auth()->user()?->name  ?? 'Không xác định' }}</h6>
							<span class="text-muted app-sidebar__user-name text-sm">{{ auth()->user()?->role === 'admin'  ? 'Quản trị viên' : 'không xác định' }}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="index-2.html#"><i
								class="side-menu__icon fe fe-monitor"></i><span
								class="side-menu__label">Thống kê</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="index.html"><span>Bảng thống kê chi tiết</span></a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="index-2.html#"><i
								class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Danh sách đăng ký</span><i
								class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="cards.html" class="slide-item">Đăng ký Lái thử</a></li>
							<li><a href="{{ route('ListRegister') }}" class="slide-item">Đăng ký tư vấn</a></li>
							<li><a href="chat.html" class="slide-item">Đăn ký sửa xe</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="index-2.html#"><i
								class="side-menu__icon fe fe-pie-chart"></i><span
								class="side-menu__label">Sản phẩm</span><i class="angle fa fa-angle-right"></i>
						</a>
						<ul class="slide-menu">
							<li><a href="{{ route('RenderProduct') }}" class="slide-item">Danh sách sản phẩm</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="index-2.html#"><i
								class="side-menu__icon fe fe-compass"></i><span class="side-menu__label">Danh mục</span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<li><a href="{{ route('ListFormMethodTest') }}" class="slide-item"> Danh sách danh mục</a></li>
							<li><a href="{{ route('ListFormMethodTest') }}" class="slide-item">Danh sách phương thưc tư vấn</a></li>
							<li><a href="{{ route('ListFormMethodTest') }}" class="slide-item"> Progress</a></li>
						</ul>
					</li>
					<li>
						<a class="side-menu__item" href="{{ route('LocationShowroom') }}"><i class="side-menu__icon fe fe-map-pin"></i><span
								class="side-menu__label">bản đồ</span></a>
					</li>
					<li>
						<a class="side-menu__item" href="{{ route('ListNews') }}"><i class="side-menu__icon fe fe-feather"></i><span
								class="side-menu__label">Tin tức</span></a>
					</li>
				</ul>
			</aside>