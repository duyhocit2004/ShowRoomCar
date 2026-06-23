const ALL_CARS = [
  {id:'camry',name:'Toyota Camry',brand:'TOYOTA',type:'Sedan Cao Cấp',cat:'sedan',priceNum:1235,price:'1.235',tag:'Bestseller',tagColor:'#CC0000',power:'203 HP',fuel:'7.5L/100km',seats:'5 chỗ',trans:'Tự Động',year:'2024',img:'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=600&q=80',features:['Hybrid Option','Safety Sense','Wireless Charge'],desc:'Sedan hạng D nổi tiếng với sự êm ái, tiết kiệm nhiên liệu và trang bị an toàn đỉnh cao.'},
  {id:'vios',name:'Toyota Vios',brand:'TOYOTA',type:'Sedan Đô Thị',cat:'sedan',priceNum:479,price:'479',tag:'Giá Tốt',tagColor:'#1a7a4a',power:'107 HP',fuel:'5.2L/100km',seats:'5 chỗ',trans:'CVT',year:'2024',img:'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=600&q=80',features:['CVT Thông Minh','Apple CarPlay','Cảm biến lùi'],desc:'Sedan hạng B lý tưởng cho đô thị – vận hành êm ái, tiết kiệm nhiên liệu và bền bỉ theo thời gian.'},
  {id:'fortuner',name:'Toyota Fortuner',brand:'TOYOTA',type:'SUV 7 Chỗ',cat:'suv',priceNum:1088,price:'1.088',tag:'Phổ Biến',tagColor:'#CC0000',power:'170 HP',fuel:'8.0L/100km',seats:'7 chỗ',trans:'Tự Động',year:'2024',img:'https://images.unsplash.com/photo-1581540222194-0def2dda95b8?w=600&q=80',features:['7 Chỗ Ngồi','4WD Option','Camera 360°'],desc:'SUV 7 chỗ đẳng cấp, khung gầm body-on-frame bền bỉ, chinh phục mọi địa hình.'},
  {id:'corolla-cross',name:'Toyota Corolla Cross',brand:'TOYOTA',type:'SUV Compact Hybrid',cat:'hybrid',priceNum:820,price:'820',tag:'Hybrid',tagColor:'#1a5276',power:'122 HP',fuel:'4.8L/100km',seats:'5 chỗ',trans:'e-CVT',year:'2024',img:'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?w=600&q=80',features:['Hybrid Tiết Kiệm','TSS 2.0','360° Camera'],desc:'SUV hybrid thế hệ mới, vận hành êm ái và tiết kiệm nhiên liệu vượt trội.'},
  {id:'veloz',name:'Toyota Veloz Cross',brand:'TOYOTA',type:'MPV 7 Chỗ',cat:'suv',priceNum:648,price:'648',tag:'Gia Đình',tagColor:'#117a65',power:'140 HP',fuel:'6.5L/100km',seats:'7 chỗ',trans:'CVT',year:'2024',img:'https://images.unsplash.com/photo-1504215680853-026ed2a45def?w=600&q=80',features:['7 Chỗ Rộng','Cửa Trượt Điện','Cảm biến đỗ xe'],desc:'MPV đa dụng 7 chỗ, thiết kế hiện đại, không gian nội thất rộng rãi cho cả gia đình.'},
  {id:'hilux',name:'Toyota Hilux',brand:'TOYOTA',type:'Bán Tải 4×4',cat:'pickup',priceNum:898,price:'898',tag:'Off-Road',tagColor:'#7a4a10',power:'204 HP',fuel:'7.8L/100km',seats:'5 chỗ',trans:'Tự Động',year:'2024',img:'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=600&q=80',features:['4WD Terrain','Payload 1T','Bán Tải Điện'],desc:'Bán tải mạnh mẽ nhất phân khúc, động cơ diesel mạnh, tải trọng cao và khả năng off-road vượt trội.'},
  {id:'land-cruiser',name:'Toyota Land Cruiser',brand:'TOYOTA',type:'SUV Off-Road Đỉnh Cao',cat:'suv',priceNum:4500,price:'4.500',tag:'Biểu Tượng',tagColor:'#9a7a32',power:'415 HP',fuel:'12.5L/100km',seats:'7 chỗ',trans:'Tự Động',year:'2024',img:'https://images.unsplash.com/photo-1591293836027-e05b48473b67?w=600&q=80',features:['V6 Twin-Turbo','TSS 3.0','10 Chế Độ Địa Hình'],desc:'Biểu tượng SUV off-road huyền thoại 70 năm lịch sử. Động cơ V6 3.5L Twin-Turbo 415 mã lực.'},
  {id:'innova',name:'Toyota Innova Cross',brand:'TOYOTA',type:'MPV Cao Cấp',cat:'suv',priceNum:920,price:'920',tag:'Mới 2024',tagColor:'#CC0000',power:'174 HP',fuel:'6.0L/100km',seats:'7 chỗ',trans:'e-CVT',year:'2024',img:'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&q=80',features:['Hybrid Mạnh','ADAS Level 2','Cửa Trượt Điện'],desc:'MPV thế hệ mới hoàn toàn – nền tảng TNGA-C, hybrid hiệu suất cao, thiết kế mạnh mẽ đương đại.'},
  {id:'yaris-cross',name:'Toyota Yaris Cross',brand:'TOYOTA',type:'SUV Hạng B',cat:'hybrid',priceNum:650,price:'650',tag:'Hybrid',tagColor:'#1a5276',power:'116 HP',fuel:'4.5L/100km',seats:'5 chỗ',trans:'e-CVT',year:'2024',img:'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=600&q=80',features:['Hybrid Tiết Kiệm','Gương Gập Điện','GR Sport Option'],desc:'SUV nhỏ gọn hybrid, phong cách trẻ trung, tiết kiệm nhiên liệu ấn tượng chỉ 4.5L/100km.'},
];

let currentView = 'grid';
let compareList = JSON.parse(sessionStorage.getItem('compareList') || '[]');
let currentPage = 1;
const perPage = 6;

function applyFilters() {
  const search = document.getElementById('searchInput').value.toLowerCase();
  const cat = document.getElementById('catFilter').value;
  const price = document.getElementById('priceFilter').value;
  const sort = document.getElementById('sortFilter').value;
  let result = ALL_CARS.filter(c => {
    const matchSearch = !search || c.name.toLowerCase().includes(search) || c.type.toLowerCase().includes(search);
    const matchCat = !cat || c.cat === cat;
    let matchPrice = true;
    if (price) { const [min, max] = price.split('-').map(Number); matchPrice = c.priceNum >= min && c.priceNum <= max; }
    return matchSearch && matchCat && matchPrice;
  });
  if (sort === 'price-asc') result.sort((a, b) => a.priceNum - b.priceNum);
  else if (sort === 'price-desc') result.sort((a, b) => b.priceNum - a.priceNum);
  else if (sort === 'name-asc') result.sort((a, b) => a.name.localeCompare(b.name));
  document.getElementById('resultCount').textContent = result.length;
  document.getElementById('emptyState').style.display = result.length === 0 ? 'block' : 'none';
  currentPage = 1;
  renderPage(result);
}

function renderPage(data) {
  const start = (currentPage - 1) * perPage;
  const pageData = data.slice(start, start + perPage);
  if (currentView === 'grid') {
    document.getElementById('carsGrid').style.display = 'flex';
    document.getElementById('carsList').style.display = 'none';
    document.getElementById('carsGrid').innerHTML = pageData.map(car => `
      <div class="col-md-6 col-lg-4">
        <div class="car-card">
          <div class="car-card-img">
            <img src="${car.img}" alt="${car.name}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=400&q=60'"/>
            <div class="car-tag" style="background:${car.tagColor}">${car.tag}</div>
            <div class="compare-toggle ${compareList.includes(car.id) ? 'added' : ''}" onclick="toggleCompare('${car.id}')" title="So sánh">
              <i class="fas fa-exchange-alt"></i>
            </div>
          </div>
          <div class="car-card-body">
            <div class="car-brand">${car.brand} · ${car.year}</div>
            <div class="car-name">${car.name}</div>
            <div class="car-type">${car.type}</div>
            <div class="car-specs">
              <div class="car-spec"><span class="car-spec-val">${car.power}</span><span class="car-spec-label">Công Suất</span></div>
              <div class="car-spec"><span class="car-spec-val">${car.fuel}</span><span class="car-spec-label">Tiêu Thụ</span></div>
              <div class="car-spec"><span class="car-spec-val">${car.seats}</span><span class="car-spec-label">Chỗ Ngồi</span></div>
            </div>
            <div class="car-footer">
              <div>
                <div class="car-price-label">Giá Từ</div>
                <div class="car-price">${car.price} <small>Triệu VNĐ</small></div>
              </div>
              <a href="detail.html?id=${car.id}" class="btn-detail">Chi Tiết</a>
            </div>
          </div>
        </div>
      </div>`).join('');
  } else {
    document.getElementById('carsGrid').style.display = 'none';
    document.getElementById('carsList').style.display = 'block';
    document.getElementById('carsList').innerHTML = pageData.map(car => `
      <div class="car-list-card">
        <div class="car-list-img" style="height:220px;">
          <img src="${car.img}" alt="${car.name}" loading="lazy"/>
          <div class="car-tag" style="background:${car.tagColor};position:absolute;top:14px;left:14px;">${car.tag}</div>
        </div>
        <div class="car-list-body">
          <div class="car-list-top">
            <div>
              <div class="car-brand">${car.brand} · ${car.year}</div>
              <div class="car-name" style="font-size:24px;">${car.name}</div>
              <div class="car-type">${car.type}</div>
            </div>
            <div style="text-align:right;">
              <div class="car-price-label">Giá Từ</div>
              <div class="car-price" style="font-size:26px;">${car.price} <small>Triệu</small></div>
            </div>
          </div>
          <div class="car-list-specs">
            <div class="car-spec"><span class="car-spec-val">${car.power}</span><span class="car-spec-label">Công Suất</span></div>
            <div class="car-spec"><span class="car-spec-val">${car.fuel}</span><span class="car-spec-label">Tiêu Thụ</span></div>
            <div class="car-spec"><span class="car-spec-val">${car.seats}</span><span class="car-spec-label">Chỗ Ngồi</span></div>
            <div class="car-spec"><span class="car-spec-val">${car.trans}</span><span class="car-spec-label">Hộp Số</span></div>
          </div>
          <div class="car-list-bottom">
            <div class="features-tags">${car.features.map(f => `<span class="feat-tag">${f}</span>`).join('')}</div>
            <div class="d-flex gap-2">
              <button class="btn-detail ${compareList.includes(car.id) ? 'active' : ''}" style="${compareList.includes(car.id) ? 'background:rgba(204,0,0,0.1);border-color:var(--red);color:var(--red);' : ''}" onclick="toggleCompare('${car.id}')">
                <i class="fas fa-exchange-alt"></i> ${compareList.includes(car.id) ? 'Đang So Sánh' : 'So Sánh'}
              </button>
              <a href="detail.html?id=${car.id}" class="btn-detail" style="background:var(--red);color:var(--white);border-color:var(--red);">Chi Tiết <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>`).join('');
  }
  // Pagination
  const totalPages = Math.ceil(data.length / perPage);
  const pag = document.getElementById('paginationWrap');
  if (totalPages <= 1) { pag.innerHTML = ''; return; }
  let html = '';
  if (currentPage > 1) html += `<a class="page-btn" onclick="goPage(${currentPage-1}, data)"><i class="fas fa-chevron-left"></i></a>`;
  for (let i = 1; i <= totalPages; i++) html += `<a class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goPage(${i})">${i}</a>`;
  if (currentPage < totalPages) html += `<a class="page-btn" onclick="goPage(${currentPage+1})"><i class="fas fa-chevron-right"></i></a>`;
  pag.innerHTML = html;
}

function goPage(p) { currentPage = p; applyFilters(); window.scrollTo({top: document.getElementById('filterBar').offsetTop - 100, behavior: 'smooth'}); }

function setView(v) {
  currentView = v;
  document.getElementById('gridBtn').classList.toggle('active', v === 'grid');
  document.getElementById('listBtn').classList.toggle('active', v === 'list');
  applyFilters();
}

function toggleCompare(id) {
  if (compareList.includes(id)) {
    compareList = compareList.filter(x => x !== id);
    showToast('Đã xóa khỏi danh sách so sánh', 'info');
  } else {
    if (compareList.length >= 3) { showToast('Chỉ so sánh tối đa 3 xe!', 'warn'); return; }
    compareList.push(id);
    showToast('Đã thêm vào so sánh!', 'success');
  }
  sessionStorage.setItem('compareList', JSON.stringify(compareList));
  updateCompareBar();
  applyFilters();
}

function clearCompare() {
  compareList = [];
  sessionStorage.setItem('compareList', JSON.stringify(compareList));
  updateCompareBar();
  applyFilters();
}

function updateCompareBar() {
  const bar = document.getElementById('compareBar');
  const slots = document.getElementById('compareSlots');
  const goBtn = document.getElementById('compareGoBtn');
  if (compareList.length === 0) { bar.classList.remove('visible'); return; }
  bar.classList.add('visible');
  goBtn.style.display = compareList.length >= 2 ? 'inline-block' : 'none';
  const items = compareList.map(id => ALL_CARS.find(c => c.id === id)).filter(Boolean);
  const empties = 3 - items.length;
  slots.innerHTML = items.map(c => `<div class="compare-slot filled"><span>${c.name}</span><span class="slot-remove" onclick="toggleCompare('${c.id}')"><i class="fas fa-times"></i></span></div>`).join('') +
    Array(empties).fill('<div class="compare-slot"><i class="fas fa-plus" style="margin-right:6px;"></i> Thêm xe</div>').join('');
}

function showToast(msg, type = 'success') {
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  const icons = {success:'fa-check-circle',info:'fa-info-circle',warn:'fa-exclamation-triangle'};
  const colors = {success:'#1a7a4a',info:'#1a5276',warn:'#CC0000'};
  t.className = 'toast-msg';
  t.style.borderLeftColor = colors[type];
  t.innerHTML = `<i class="fas ${icons[type]}" style="color:${colors[type]}"></i> ${msg}`;
  wrap.appendChild(t);
  setTimeout(() => t.classList.add('show'), 10);
  setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3000);
}

function resetFilters() {
  document.getElementById('searchInput').value = '';
  document.getElementById('catFilter').value = '';
  document.getElementById('priceFilter').value = '';
  document.getElementById('sortFilter').value = 'default';
  applyFilters();
}

function toggleMobile() { document.getElementById('mobileMenu').classList.toggle('open'); }
function closeMobile() { document.getElementById('mobileMenu').classList.remove('open'); }

// Init from URL params
window.addEventListener('DOMContentLoaded', () => {
  const p = new URLSearchParams(location.search);
  if (p.get('cat')) document.getElementById('catFilter').value = p.get('cat');
  updateCompareBar();
  applyFilters();
});

window.addEventListener('scroll', () => {
  document.getElementById('scrollTop').classList.toggle('show', window.scrollY > 400);
});