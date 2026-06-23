<!DOCTYPE html>
<html lang="vi">

<head>
  @include('clients.layout.head')
</head>

<body>

    <div class="page-loader" id="pageLoader">
        <div class="loader-inner">
            <div class="loader-logo">TOYOTA<span>VN</span></div>
            <div class="loader-bar-wrap">
                <div class="loader-bar" id="loaderBar"></div>
            </div>
        </div>
    </div>

    <!-- <div class="mobile-menu" id="mobileMenu">
  <a href="index.html" onclick="closeMobile()">Trang Chủ</a>
  <a href="cars.html" onclick="closeMobile()">Dòng Xe</a>
  <a href="index.html#featured" onclick="closeMobile()">Nổi Bật</a>
  <a href="showroom.html" onclick="closeMobile()">Showroom</a>
  <a href="services.html" onclick="closeMobile()">Dịch Vụ</a>
  <a href="contact.html" onclick="closeMobile()">Liên Hệ</a>
</div> -->

    @include('clients.layout.nav')

    {{-- banner --}}
    <section id="home" style="padding-top: 80px; padding-bottom: 0; background: var(--white);">
        <img src="https://toyota-quangbinh.com/wp-content/uploads/2022/06/banner-toyora-corolla-cross-new-nhuanads.com_.jpg"
            alt="Toyota Banner" style="width: 100%; height: auto; display: block;" />
    </section>

    <div class="marquee-bar">
        <div class="marquee-track">
            <span class="marquee-item">Toyota Camry <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Fortuner 2024 <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Land Cruiser <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Vios <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Corolla Cross <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Veloz Cross <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Hilux <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">RAV4 <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Toyota Camry <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Fortuner 2024 <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Land Cruiser <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Vios <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Corolla Cross <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Veloz Cross <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">Hilux <span class="marquee-sep">✦</span></span>
            <span class="marquee-item">RAV4 <span class="marquee-sep">✦</span></span>
        </div>
    </div>

    {{-- end_banner --}}

    <section id="models">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <p class="section-eyebrow">Dòng Sản Phẩm</p>
                    <h2 class="section-title">Bộ Sưu Tập <span>2024 – 2025</span></h2>
                </div>
                <div class="col-lg-6 d-flex align-items-end">
                    <p class="section-desc">Từ sedan sang trọng đến SUV mạnh mẽ – mỗi mẫu xe là một tuyên ngôn về phong
                        cách và hiệu suất.</p>
                </div>
            </div>
            <div class="models-filter">
                <button class="filter-btn active" onclick="filterCars('all', this)">Tất Cả</button>
                <button class="filter-btn" onclick="filterCars('sedan', this)">Sedan</button>
                <button class="filter-btn" onclick="filterCars('suv', this)">SUV</button>
                <button class="filter-btn" onclick="filterCars('MPV', this)">MPV</button>
                <button class="filter-btn" onclick="filterCars('pickup', this)">Bán Tải</button>
            </div>
            <div class="row g-4" id="carsGrid"></div>
            <div class="text-center mt-5">
                <a href="cars.html" class="btn-outline-custom">Xem Tất Cả Dòng Xe <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section id="featured">
        <div class="featured-bg"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <p class="section-eyebrow">Xe Nổi Bật</p>
                    <h2 class="section-title">Toyota Land Cruiser<br><span>GR Sport 2024</span></h2>
                    <p class="section-desc">Biểu tượng của sức mạnh và đẳng cấp. Land Cruiser GR Sport 2024 mang đến
                        trải nghiệm off-road đỉnh cao với công nghệ hybrid tiên tiến nhất.</p>
                    <ul class="feature-list">
                        <li>
                            <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                            <div>
                                <div class="feature-title">Động Cơ V6 3.5L Twin-Turbo</div>
                                <div class="feature-desc">415 mã lực – tăng tốc 0–100 km/h trong 6.7 giây</div>
                            </div>
                        </li>
                        <li>
                            <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
                            <div>
                                <div class="feature-title">An Toàn Toyota Safety Sense 3.0</div>
                                <div class="feature-desc">Hệ thống hỗ trợ lái chủ động, phanh khẩn cấp tự động</div>
                            </div>
                        </li>
                        <li>
                            <div class="feature-icon"><i class="fas fa-mountain-sun"></i></div>
                            <div>
                                <div class="feature-title">Multi-Terrain Select 10 Chế Độ</div>
                                <div class="feature-desc">Tự động tối ưu địa hình: bùn, cát, đá, tuyết</div>
                            </div>
                        </li>
                    </ul>
                    <div class="price-highlight">
                        <span class="from">Từ</span>
                        <span class="amount">4.5</span>
                        <span class="unit">Tỷ VNĐ</span>
                    </div>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="detail.html?id=land-cruiser" class="btn-primary-custom">Xem Chi Tiết <i
                                class="fas fa-arrow-right"></i></a>
                        <a href="contact.html" class="btn-outline-custom"><i class="fas fa-calendar-check"></i> Đặt Lịch
                            Lái Thử</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1591293836027-e05b48473b67?w=800&q=85&auto=format&fit=crop"
                        alt="Toyota Land Cruiser"
                        style="width:100%;border-radius:4px;filter:drop-shadow(0 0 60px rgba(204,0,0,0.2));" />
                </div>
            </div>
        </div>
    </section>

    <section id="why">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow">Tại Sao Chọn Chúng Tôi</p>
                <h2 class="section-title">Cam Kết <span>Chất Lượng</span></h2>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon"><i class="fas fa-award"></i></div>
                        <div class="why-title">Đại Lý Chính Hãng</div>
                        <p class="why-desc">Được Toyota Việt Nam ủy quyền – đảm bảo xe chính hãng 100% với đầy đủ giấy
                            tờ hợp lệ.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon"><i class="fas fa-tools"></i></div>
                        <div class="why-title">Bảo Dưỡng Suốt Đời</div>
                        <p class="why-desc">Gói bảo hành 5 năm hoặc 150,000 km. Đội kỹ thuật viên được đào tạo tại Nhật
                            Bản.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon"><i class="fas fa-percent"></i></div>
                        <div class="why-title">Tài Chính Linh Hoạt</div>
                        <p class="why-desc">Hỗ trợ vay 0% lãi suất 12 tháng đầu. Thủ tục nhanh gọn, giải ngân trong 24
                            giờ.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon"><i class="fas fa-headset"></i></div>
                        <div class="why-title">Hỗ Trợ 24/7</div>
                        <p class="why-desc">Đường dây nóng hoạt động 24/7. Cứu hộ xe tận nơi trong vòng 60 phút tại Hà
                            Nội.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow">Khách Hàng Nói Gì</p>
                <h2 class="section-title">Hơn <span>10,000+</span> Khách Hàng Tin Tưởng</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">Trải nghiệm mua xe hoàn toàn khác biệt. Đội ngũ tư vấn nhiệt tình,
                            không có cảm giác bị ép buộc. Chiếc Fortuner của tôi chạy đã được 2 năm mà vẫn như mới.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">TM</div>
                            <div>
                                <div class="author-name">Trần Minh Quân</div>
                                <div class="author-car">Toyota Fortuner Legender</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">Chiếc Camry là quyết định đúng đắn nhất của tôi. Nội thất sang
                            trọng, vận hành êm ái và tiết kiệm nhiên liệu hơn tôi nghĩ. Dịch vụ hậu mãi cũng rất chuyên
                            nghiệp.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar" style="background:#1a5276;">NL</div>
                            <div>
                                <div class="author-name">Nguyễn Lan Anh</div>
                                <div class="author-car">Toyota Camry 2.5Q</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <p class="testimonial-text">Land Cruiser GR Sport là đỉnh cao. Đã chạy qua Tây Bắc, đường rừng
                            núi hiểm trở – xe xử lý quá ổn định. Đây là chiếc xe tôi sẽ gắn bó suốt đời.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar" style="background:#117a65;">PH</div>
                            <div>
                                <div class="author-name">Phạm Hoàng Đức</div>
                                <div class="author-car">Toyota Land Cruiser GR</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="showroom">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-lg-6">
                    <p class="section-eyebrow">Showroom & Trải Nghiệm</p>
                    <h2 class="section-title">Không Gian <span>Đẳng Cấp</span></h2>
                </div>
                <div class="col-lg-6">
                    <p class="section-desc">Showroom Toyota chuẩn quốc tế với không gian trưng bày hiện đại, khu vực lái
                        thử và trải nghiệm xe thực tế.</p>
                </div>
            </div>
            <div class="showroom-grid">
                <div class="showroom-img main"><img
                        src="https://images.unsplash.com/photo-1567818735868-e71b99932e29?w=800&q=80" alt="Showroom" />
                    <div class="showroom-overlay"></div>
                </div>
                <div class="showroom-img"><img
                        src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500&q=80" alt="Interior" />
                    <div class="showroom-overlay"></div>
                </div>
                <div class="showroom-img"><img
                        src="https://images.unsplash.com/photo-1486496572940-2bb2341fdbdf?w=500&q=80" alt="Exterior" />
                    <div class="showroom-overlay"></div>
                </div>
                <div class="showroom-img"><img
                        src="https://images.unsplash.com/photo-1577495508048-b635879837f1?w=500&q=80" alt="Service" />
                    <div class="showroom-overlay"></div>
                </div>
                <div class="showroom-img"><img
                        src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=500&q=80"
                        alt="Technology" />
                    <div class="showroom-overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="contact-bg-accent"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row g-5">
                <div class="col-lg-5">
                    <p class="section-eyebrow">Liên Hệ</p>
                    <h2 class="section-title">Đặt Lịch <span>Tư Vấn</span></h2>
                    <p class="section-desc mb-5">Đội ngũ chuyên gia sẵn sàng hỗ trợ 7 ngày/tuần. Lái thử miễn phí –
                        không ràng buộc.</p>
                    <div>
                        <div class="contact-info-item">
                            <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                            <div>
                                <div class="contact-label">Địa Chỉ</div>
                                <div class="contact-val">468 Minh Khai, Hai Bà Trưng, Hà Nội</div>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <div class="contact-label">Hotline</div>
                                <div class="contact-val">1800 6589 (Miễn phí)</div>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <div class="contact-label">Email</div>
                                <div class="contact-val">sales@toyotavietnam.com.vn</div>
                            </div>
                        </div>
                        <div class="contact-info-item" style="border:none;">
                            <div class="contact-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <div class="contact-label">Giờ Làm Việc</div>
                                <div class="contact-val">T2 – CN: 7:30 – 20:00</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-form-wrap">
                        <h3 style="font-size:22px;font-weight:700;margin-bottom:28px;">Đăng Ký Lái Thử</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Họ và Tên</label>
                                <input type="text" class="form-control-custom" placeholder="Nguyễn Văn A" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Số Điện Thoại</label>
                                <input type="tel" class="form-control-custom" placeholder="0912 345 678" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Email</label>
                                <input type="email" class="form-control-custom" placeholder="email@example.com" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Mẫu Xe Quan Tâm</label>
                                <select class="form-control-custom">
                                    <option value="">Chọn mẫu xe...</option>
                                    <option>Toyota Camry 2024</option>
                                    <option>Toyota Fortuner</option>
                                    <option>Toyota Land Cruiser</option>
                                    <option>Toyota Vios</option>
                                    <option>Toyota Corolla Cross</option>
                                    <option>Toyota Veloz Cross</option>
                                    <option>Toyota Hilux</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Ngày Lái Thử</label>
                                <input type="date" class="form-control-custom" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Hình Thức</label>
                                <select class="form-control-custom">
                                    <option>Lái thử tại showroom</option>
                                    <option>Tư vấn tại nhà</option>
                                    <option>Tư vấn qua điện thoại</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label-custom">Ghi Chú</label>
                                <textarea class="form-control-custom" rows="4"
                                    placeholder="Yêu cầu đặc biệt..."></textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn-primary-custom w-100 justify-content-center"
                                    onclick="submitForm(this)">
                                    <i class="fas fa-paper-plane"></i> Gửi Đăng Ký Ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 

    <button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const carsData = [
            { id: 'camry', name: "Toyota Camry", type: "Sedan Cao Cấp", cat: "sedan", price: "1.235", tag: "Bestseller", power: "203 HP", fuel: "7.5L/100km", seats: "5 chỗ", img: "https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=600&q=80" },
            { id: 'vios', name: "Toyota Vios", type: "Sedan Đô Thị", cat: "sedan", price: "479", tag: "Giá Tốt", power: "107 HP", fuel: "5.2L/100km", seats: "5 chỗ", img: "https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=600&q=80" },
            { id: 'fortuner', name: "Toyota Fortuner", type: "SUV 7 Chỗ", cat: "suv", price: "1.088", tag: "Phổ Biến", power: "170 HP", fuel: "8.0L/100km", seats: "7 chỗ", img: "https://images.unsplash.com/photo-1581540222194-0def2dda95b8?w=600&q=80" },
            { id: 'corolla-cross', name: "Toyota Corolla Cross", type: "SUV Compact Hybrid", cat: "suv", price: "820", tag: "Hybrid", power: "122 HP", fuel: "4.8L/100km", seats: "5 chỗ", img: "https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?w=600&q=80" },
            { id: 'veloz', name: "Toyota Veloz Cross", type: "MPV 7 Chỗ", cat: "suv", price: "648", tag: "Gia Đình", power: "140 HP", fuel: "6.5L/100km", seats: "7 chỗ", img: "https://images.unsplash.com/photo-1504215680853-026ed2a45def?w=600&q=80" },
            { id: 'hilux', name: "Toyota Hilux", type: "Bán Tải 4×4", cat: "pickup", price: "898", tag: "Off-Road", power: "204 HP", fuel: "7.8L/100km", seats: "5 chỗ", img: "https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=600&q=80" }
        ];
        function renderCars(filter) {
            const grid = document.getElementById('carsGrid');
            const filtered = filter === 'all' ? carsData : carsData.filter(c => c.cat === filter);
            grid.innerHTML = filtered.map(car => `
    <div class="col-md-6 col-lg-4">
      <div class="car-card">
        <div class="car-card-img">
          <img src="${car.img}" alt="${car.name}" loading="lazy"/>
          <div class="car-tag">${car.tag}</div>
        </div>
        <div class="car-card-body">
          <div class="car-name">${car.name}</div>
          <div class="car-type">${car.type}</div>
          <div class="car-specs">
            <div class="car-spec"><span class="car-spec-val">${car.power}</span><span class="car-spec-label">Công Suất</span></div>
            <div class="car-spec"><span class="car-spec-val">${car.fuel}</span><span class="car-spec-label">Tiêu Thụ</span></div>
            <div class="car-spec"><span class="car-spec-val">${car.seats}</span><span class="car-spec-label">Chỗ Ngồi</span></div>
          </div>
          <div class="car-price-row">
            <div>
              <div class="car-price-label">Giá Từ</div>
              <div class="car-price">${car.price} <span>Triệu VNĐ</span></div>
            </div>
            <a href="detail.html?id=${car.id}" class="btn-card">Chi Tiết</a>
          </div>
        </div>
      </div>
    </div>`).join('');
        }
        function filterCars(cat, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            renderCars(cat);
        }
        renderCars('all');
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 60);
            document.getElementById('scrollTop').classList.toggle('show', window.scrollY > 400);
        });
        function toggleMobile() { document.getElementById('mobileMenu').classList.toggle('open'); }
        function closeMobile() { document.getElementById('mobileMenu').classList.remove('open'); }
        function submitForm(btn) {
            btn.innerHTML = '<i class="fas fa-check"></i> Đã Gửi Thành Công!';
            btn.style.background = '#1a7a4a';
            btn.disabled = true;
            setTimeout(() => { btn.innerHTML = '<i class="fas fa-paper-plane"></i> Gửi Đăng Ký Ngay'; btn.style.background = ''; btn.disabled = false; }, 4000);
        }
        const bar = document.getElementById('loaderBar');
        let w = 0;
        const iv = setInterval(() => {
            w += Math.random() * 18;
            if (w >= 100) { w = 100; clearInterval(iv); }
            bar.style.width = w + '%';
            if (w >= 100) {
                setTimeout(() => {
                    const loader = document.getElementById('pageLoader');
                    loader.style.opacity = '0';
                    setTimeout(() => loader.remove(), 600);
                }, 250);
            }
        }, 80);
    </script>
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function () {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function (msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        }
        else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>

</html>