import BASE_URL from './Api.js';

document.addEventListener('DOMContentLoaded', async () => {
    await fetchCategories();
    RenderSearch();
    ListAndSearch();
    bindEvents();
});

let searchTimeout;
let categoriesList = [];

async function fetchCategories() {
    try {
        const response = await fetch(`${BASE_URL}/GetAllCategories`);
        const result = await response.json();
        if (result.status) {
            categoriesList = result.data ?? [];
        }
    } catch (e) {
        console.error("Lỗi khi tải danh mục", e);
    }
}

function debounceSearch() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        ListAndSearch();
    }, 500);
}

function bindEvents() {
    document.addEventListener('click', function (e) {
        const pageLink = e.target.closest('#pagination .page-link');
        if (pageLink) {
            e.preventDefault();
            ListAndSearch(pageLink.dataset.page);
        }

        const btnDetail = e.target.closest('.detailProduction');
        if (btnDetail) {
            e.preventDefault();
            DetailList(btnDetail.dataset.id);
        }

        const btnDelete = e.target.closest('.deleteProduct');
        if (btnDelete) {
            e.preventDefault();
            DeleteProduct(btnDelete.dataset.id);
        }

        if (e.target.closest('#btnAddProduct')) {
            e.preventDefault();
            renderForm(null);
        }
        
        const btnClose = e.target.closest('#btnClose');
        if (btnClose) {
            e.preventDefault();
            const formContainer = document.getElementById('form-container');
            if (formContainer) formContainer.style.display = 'none';
            document.querySelector('.table-responsive').style.display = 'block';
        }
    });

    document.addEventListener('input', e => {
        if (e.target.matches('#nameSearch')) {
            debounceSearch();
        }
    });

    document.addEventListener('change', e => {
        if (e.target.matches('#statusSearch')) {
            ListAndSearch();
        }
    });
}

function RenderSearch() {
    const title = document.getElementById('page-header');
    title.innerHTML = `
        <div class="page-leftheader">
            <h4 class="page-title">Danh sách sản phẩm</h4>
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Danh sách sản phẩm</li>
            </ol>
        </div>
        <div class="page-rightheader ml-auto d-flex gap-2">
            <button class="btn btn-success m-1" id="btnAddProduct">
                <i class="fa fa-plus"></i> Thêm sản phẩm
            </button>
            <input type="text" id="nameSearch" class="form-control m-1" placeholder="Tên sản phẩm">
            <select id="statusSearch" class="form-control m-1">
                <option value="">Trạng thái</option>
                <option value="active">Hoạt động</option>
                <option value="inactive">Ngừng hoạt động</option>
            </select>
        </div>
    `; 
}

async function ListAndSearch(page = 1) {
    const name = document.getElementById('nameSearch')?.value ?? '';
    const status = document.getElementById('statusSearch')?.value ?? '';

    try {
        const response = await fetch(`${BASE_URL}/GetListProduct?page=${page}&name=${name}&status=${status}`);
        const result = await response.json();
        const items = result?.data ?? [];
        renderTable(items, (page - 1) * result.per_page);
        renderPagination(result);
    } catch (error) {
        console.error(error);
    }
}

function renderTable(data, startIndex = 0) {
    const tbody = document.getElementById('table-body');
    if (!tbody) return;

    let html = '';
    data.forEach((item, index) => {
        html += `
            <tr>
                <td>${startIndex + index + 1}</td>
                <td>${item.name ?? ''}</td>
                <td><img src="${item.image}" width="60" height="40"></td>
                <td>${item.category?.name ?? item.category_id ?? ''}</td>
                <td>${item.price ?? 0}</td>
                <td>
                    ${item.status === 'active' ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Ẩn</span>'}
                </td>
                <td>
                    <button class="btn btn-primary detailProduction" data-id="${item.id}">
                       <i class="far fa-eye"></i>
                    </button>
                     <button class="btn btn-danger deleteProduct" data-id="${item.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
}

function renderPagination(pagination) {
    const el = document.getElementById('pagination');
    if (!el) return;

    let html = '';
    for (let i = 1; i <= pagination.last_page; i++) {
        html += `
            <li class="page-item ${pagination.current_page == i ? 'active' : ''}">
                <a href="#" class="page-link" data-page="${i}">${i}</a>
            </li>
        `;
    }
    el.innerHTML = html;
}

async function DetailList(id) {
    try {
        const response = await fetch(`${BASE_URL}/GetListDetailProduct/${id}`);
        const result = await response.json();
        const data = result.data ?? result;
        renderForm(data);
    } catch (error) {
        console.error(error);
    }
}

async function DeleteProduct(id) {
    if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) return;
    try {
        const res = await fetch(`${BASE_URL}/DeleteProduct/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        });
        const result = await res.json();
        if (result.status) {
            alert('Xóa thành công');
            ListAndSearch();
        } else {
            alert(result.message || 'Xóa thất bại');
        }
    } catch (error) {
        console.error(error);
    }
}

function inputSpec(label, key, data, type = 'text') {
    return `
        <div class="col-md-3 mt-2">
            <label>${label}</label>
            <input type="${type}" class="form-control spec-input" data-key="${key}" value="${data?.specification?.[key] ?? ''}">
        </div>
    `;
}

function renderForm(data = null) {
    const tableContainer = document.querySelector('.table-responsive');
    if (tableContainer) tableContainer.style.display = 'none';

    let formContainer = document.getElementById('form-container');
    if (!formContainer) {
        formContainer = document.createElement('div');
        formContainer.id = 'form-container';
        document.getElementById('detail').appendChild(formContainer);
    }

    const isEdit = data !== null;
    const titleText = isEdit ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm mới';

    let html = `
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Thông tin cơ bản</h4>
                        <input type="hidden" id="productId" value="${data?.id ?? ''}">
                        
                        <label>Tên</label>
                        <input class="form-control" id="name" value="${data?.name ?? ''}">
                        
                        <label class="mt-2">Tiêu đề</label>
                        <input class="form-control" id="title" value="${data?.title ?? ''}">
                        
                        <label class="mt-2">Danh mục</label>
                        <select class="form-control" id="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            ${categoriesList.map(c => `<option value="${c.id}" ${data?.category_id == c.id ? 'selected' : ''}>${c.name}</option>`).join('')}
                        </select>
                        
                        <label class="mt-2">Ảnh sản phẩm</label>
                        <input type="file" id="product_image" class="form-control">
                        <img id="product-preview" src="${data?.image ?? ''}" width="200" class="mt-2" style="${data?.image ? '' : 'display:none'}">
                        
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Giá</label>
                                <input class="form-control" id="price" type="number" value="${data?.price ?? ''}">
                            </div>
                            <div class="col-md-6">
                                <label>Trạng thái</label>
                                <select id="status" class="form-control">
                                    <option value="active" ${data?.status == 'active' ? 'selected' : ''}>Hoạt động</option>
                                    <option value="inactive" ${data?.status == 'inactive' ? 'selected' : ''}>Ẩn</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label>Năm sản xuất</label>
                                <input class="form-control" id="Year" type="date" value="${data?.Year ?? ''}">
                            </div>
                            <div class="col-md-6">
                                <label>Số chỗ ngồi</label>
                                <input class="form-control" id="seat" type="text" value="${data?.seat ?? ''}">
                            </div>
                        </div>
                        
                        <label class="mt-2">Mô tả</label>
                        <textarea id="description" class="form-control">${data?.description ?? ''}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Album ảnh</h4>
                        <input type="file" id="album_input" multiple class="form-control">
                        <div id="album" class="d-flex gap-2 mt-3 flex-wrap"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h4>Thông số xe</h4>
                <div class="row">
                    ${inputSpec('Engine', 'engine', data)}
                    ${inputSpec('Horsepower', 'horsepower', data)}
                    ${inputSpec('Torque', 'torque', data)}
                    ${inputSpec('Fuel', 'fuel_consumption', data)}
                    ${inputSpec('Acceleration', 'acceleration', data)}
                    ${inputSpec('Top speed', 'top_speed', data)}
                    ${inputSpec('Transmission', 'transmission', data)}
                    ${inputSpec('Safety', 'safety_rating', data)}
                    ${inputSpec('Warranty', 'warranty_info', data)}
                    ${inputSpec('Length', 'length', data, 'number')}
                    ${inputSpec('Width', 'width', data, 'number')}
                    ${inputSpec('Height', 'height', data, 'number')}
                    ${inputSpec('Wheelbase', 'wheelbase', data, 'number')}
                    ${inputSpec('Weight', 'weight', data, 'number')}
                    ${inputSpec('Fuel Tank', 'fuel_tank_capacity', data, 'number')}
                </div>
            </div>
        </div>

        <div class="text-end mt-3 mb-5">
            <button class="btn btn-primary" id="btnSave">${titleText}</button>
            <button class="btn btn-secondary" id="btnClose">Đóng</button>
        </div>
    `;

    formContainer.innerHTML = html;
    formContainer.style.display = 'block';

    // Render old album
    let albumContainer = document.getElementById('album');
    if (data?.albumimages) {
        data.albumimages.forEach(img => {
            albumContainer.innerHTML += `
                <div class="position-relative">
                    <img src="${img.image}" width="100" height="100" style="object-fit:cover">
                    <button class="btn btn-danger btn-sm delete-image" data-id="${img.id}" style="position:absolute;top:0;right:0">×</button>
                </div>
            `;
        });
    }

    // Bind preview events
    document.getElementById('product_image').addEventListener('change', e => {
        let file = e.target.files[0];
        if (file) {
            let img = document.getElementById('product-preview');
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
        }
    });

    document.getElementById('album_input').addEventListener('change', e => {
        [...e.target.files].forEach(file => {
            albumContainer.innerHTML += `
                <img src="${URL.createObjectURL(file)}" width="100" height="100" style="object-fit:cover">
            `;
        });
    });

    // Delete album image
    albumContainer.addEventListener('click', async e => {
        let btn = e.target.closest('.delete-image');
        if (!btn) return;
        if (!confirm('Xóa ảnh?')) return;
        
        let res = await fetch(`${BASE_URL}/DeleteAlbumImage/${btn.dataset.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        });
        let result = await res.json();
        if (result.status) {
            btn.parentElement.remove();
        }
    });

    // Save
    document.getElementById('btnSave').onclick = async function () {
        const btnSave = this;
        const btnClose = document.getElementById('btnClose');
        const originalText = btnSave.innerText;

        btnSave.disabled = true;
        btnClose.disabled = true;
        btnSave.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...`;

        let form = new FormData();
        form.append('name', document.getElementById('name').value);
        form.append('title', document.getElementById('title').value);
        form.append('price', document.getElementById('price').value);
        form.append('description', document.getElementById('description').value);
        form.append('status', document.getElementById('status').value);
        form.append('category_id', document.getElementById('category_id').value);
        form.append('Year', document.getElementById('Year').value);
        form.append('seat', document.getElementById('seat').value);

        document.querySelectorAll('.spec-input').forEach(input => {
            form.append(input.dataset.key, input.value);
        });

        let image = document.getElementById('product_image').files[0];
        if (image) {
            form.append('image', image);
        }

        let albumFiles = document.getElementById('album_input').files;
        for (let file of albumFiles) {
            form.append('album[]', file);
        }

        let url = isEdit ? `${BASE_URL}/UpdateProduct/${data.id}` : `${BASE_URL}/insertProduct`;
        
        let options = {
            method: 'POST',
            body: form,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        };

        if (isEdit) {
            form.append('_method', 'PUT');
        }

        try {
            let res = await fetch(url, options);
            let result = await res.json();
            if (result.status) {
                alert(isEdit ? 'Cập nhật thành công' : 'Thêm thành công');
                ListAndSearch();
                document.getElementById('form-container').style.display = 'none';
                document.querySelector('.table-responsive').style.display = 'block';
            } else {
                alert('Có lỗi xảy ra: ' + (result.message || ''));
            }
        } catch(e) {
            console.error(e);
            alert('Lỗi kết nối');
        } finally {
            btnSave.disabled = false;
            btnClose.disabled = false;
            btnSave.innerText = originalText;
        }
    };
}
