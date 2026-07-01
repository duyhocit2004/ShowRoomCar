import BASE_URL from './Api.js';

document.addEventListener('DOMContentLoaded', () => {
    RenderSearch();
    ListAndSearch();
    bindEvents();
});

let searchTimeout;

function debounceSearch() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        ListAndSearch();
    }, 500);
}

function escapeHtml(text) {
    if (!text) return '';
    return text.toString()
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function RenderSearch() {
    const title = document.getElementById('page-header');
    title.innerHTML = `
        <div class="page-leftheader">
            <h4 class="page-title">Danh sách Showroom</h4>
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Showroom</li>
            </ol>
        </div>
        <div class="page-rightheader ml-auto d-flex gap-2">
            <button class="btn btn-success m-1" id="btnAddShowroom">
                <i class="fa fa-plus"></i> Thêm Showroom
            </button>
            <input type="text" id="nameSearch" class="form-control m-1" placeholder="Tên showroom">
            <select id="statusSearch" class="form-control m-1">
                <option value="">Trạng thái</option>
                <option value="active">Hoạt động</option>
                <option value="inactive">Ngừng hoạt động</option>
            </select>
        </div>
    `;
}

function bindEvents() {
    document.addEventListener('click', async e => {
        // Pagination
        if (e.target.matches('.page-link')) {
            e.preventDefault();
            const page = e.target.dataset.page;
            if (page) ListAndSearch(page);
        }

        // Add
        if (e.target.closest('#btnAddShowroom')) {
            renderForm();
        }

        // Close
        const btnClose = e.target.closest('#btnClose');
        if (btnClose) {
            e.preventDefault();
            const formContainer = document.getElementById('form-container');
            if (formContainer) formContainer.style.display = 'none';
            document.querySelector('.table-responsive').style.display = 'block';
        }

        // Edit
        const btnEdit = e.target.closest('.editShowroom');
        if (btnEdit) {
            const id = btnEdit.dataset.id;
            try {
                const res = await fetch(`${BASE_URL}/GetDetailShowroom/${id}`);
                const result = await res.json();
                if (result.success) {
                    renderForm(result.data);
                }
            } catch (error) {
                console.error(error);
            }
        }

        // Delete
        const btnDelete = e.target.closest('.deleteShowroom');
        if (btnDelete) {
            if (!confirm('Bạn có chắc muốn xóa showroom này?')) return;
            const id = btnDelete.dataset.id;
            try {
                const res = await fetch(`${BASE_URL}/DeleteShowroom/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });
                const result = await res.json();
                if (result.success) {
                    alert('Xóa thành công');
                    ListAndSearch();
                } else {
                    alert('Xóa thất bại');
                }
            } catch (error) {
                console.error(error);
            }
        }
    });

    document.addEventListener('input', e => {
        if (e.target.matches('#nameSearch')) {
            debounceSearch();
        }

        if (e.target.matches('#locationOnGoogle')) {
            const preview = document.getElementById('mapPreview');
            if (preview) {
                const val = e.target.value.trim();
                preview.innerHTML = val;
                preview.style.display = val ? 'block' : 'none';
            }
        }
    });

    document.addEventListener('change', e => {
        if (e.target.matches('#statusSearch')) {
            ListAndSearch();
        }
    });
}

async function ListAndSearch(page = 1) {
    const search = document.getElementById('nameSearch')?.value ?? '';
    const status = document.getElementById('statusSearch')?.value ?? '';

    try {
        const response = await fetch(`${BASE_URL}/GetListShowroom?page=${page}&search=${search}&status=${status}`);
        const result = await response.json();
        
        // Handling both success wrapper or direct pagination object
        let items = [];
        let paginationData = null;
        
        if (result.success && result.pagination) {
            items = result.data ?? [];
            paginationData = result.pagination;
        } else if (result.data) {
            items = result.data;
            paginationData = result;
        }
        
        let startIndex = 0;
        if (paginationData && paginationData.current_page && paginationData.per_page) {
            startIndex = (paginationData.current_page - 1) * paginationData.per_page;
        }

        renderTable(items, startIndex);
        if (paginationData) renderPagination(paginationData);
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
                <td>
                    ${item.status === 'active' ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Ẩn</span>'}
                </td>
                <td>
                    <button class="btn btn-primary editShowroom" data-id="${item.id}">
                       <i class="far fa-edit"></i>
                    </button>
                     <button class="btn btn-danger deleteShowroom" data-id="${item.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
}

function renderPagination(data) {
    const pagination = document.getElementById('pagination');
    if (!pagination) return;

    let html = '';
    if (data.current_page > 1) {
        html += `<li class="page-item"><a class="page-link" href="#" data-page="${data.current_page - 1}">Trước</a></li>`;
    }

    for (let i = 1; i <= data.last_page; i++) {
        html += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                 </li>`;
    }

    if (data.current_page < data.last_page) {
        html += `<li class="page-item"><a class="page-link" href="#" data-page="${data.current_page + 1}">Sau</a></li>`;
    }

    pagination.innerHTML = html;
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
    const titleText = isEdit ? 'Cập nhật Showroom' : 'Thêm Showroom mới';

    let html = `
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>${titleText}</h4>
                        <input type="hidden" id="showroomId" value="${data?.id ?? ''}">
                        
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label>Tên Showroom (*)</label>
                                <input class="form-control" id="name" value="${data?.name ?? ''}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Thành phố (*)</label>
                                <input class="form-control" id="City" value="${data?.City ?? ''}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Số điện thoại</label>
                                <input class="form-control" id="phone" value="${data?.phone ?? ''}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Giờ mở cửa</label>
                                <input class="form-control" id="Opening_hours" value="${data?.['Opening hours'] ?? ''}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Diện tích Showroom</label>
                                <input class="form-control" id="ShowroomArea" value="${data?.ShowroomArea ?? ''}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Bảng/Khu vực (Table)</label>
                                <input class="form-control" id="table" value="${data?.table ?? ''}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Vị trí Google Map (URL/Iframe)</label>
                                <input class="form-control" id="locationOnGoogle" value="${escapeHtml(data?.locationOnGoogle ?? '')}">
                                <div id="mapPreview" class="mt-3 w-100" style="display: ${data?.locationOnGoogle ? 'block' : 'none'}; overflow: hidden; border-radius: 8px; border: 1px solid #ddd;">
                                    ${data?.locationOnGoogle ?? ''}
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Địa chỉ cụ thể</label>
                                <textarea class="form-control" id="location" rows="3">${data?.location ?? ''}</textarea>
                            </div>
                        </div>

                        <h5 class="mt-4">Các dịch vụ cung cấp</h5>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_test_drive" ${data?.has_test_drive ? 'checked' : ''}>
                                    <label class="form-check-label" for="has_test_drive">Lái thử</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_service" ${data?.has_service ? 'checked' : ''}>
                                    <label class="form-check-label" for="has_service">Dịch vụ bảo dưỡng</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_parking" ${data?.has_parking ? 'checked' : ''}>
                                    <label class="form-check-label" for="has_parking">Bãi đỗ xe</label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_accessories" ${data?.has_accessories ? 'checked' : ''}>
                                    <label class="form-check-label" for="has_accessories">Phụ kiện</label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_insurance" ${data?.has_insurance ? 'checked' : ''}>
                                    <label class="form-check-label" for="has_insurance">Bảo hiểm</label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_body_paint" ${data?.has_body_paint ? 'checked' : ''}>
                                    <label class="form-check-label" for="has_body_paint">Đồng sơn</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label>Trạng thái</label>
                                <select id="status" class="form-control">
                                    <option value="active" ${data?.status == 'active' ? 'selected' : ''}>Hoạt động</option>
                                    <option value="inactive" ${data?.status == 'inactive' ? 'selected' : ''}>Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
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

    // Save
    document.getElementById('btnSave').onclick = async function () {
        const btnSave = this;
        const btnClose = document.getElementById('btnClose');
        const originalText = btnSave.innerText;

        btnSave.disabled = true;
        btnClose.disabled = true;
        btnSave.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...`;

        let payload = {
            name: document.getElementById('name').value,
            City: document.getElementById('City').value,
            phone: document.getElementById('phone').value,
            Opening_hours: document.getElementById('Opening_hours').value,
            ShowroomArea: document.getElementById('ShowroomArea').value,
            table: document.getElementById('table').value,
            locationOnGoogle: document.getElementById('locationOnGoogle').value,
            location: document.getElementById('location').value,
            has_test_drive: document.getElementById('has_test_drive').checked,
            has_service: document.getElementById('has_service').checked,
            has_parking: document.getElementById('has_parking').checked,
            has_accessories: document.getElementById('has_accessories').checked,
            has_insurance: document.getElementById('has_insurance').checked,
            has_body_paint: document.getElementById('has_body_paint').checked,
            status: document.getElementById('status').value
        };

        let url = isEdit ? `${BASE_URL}/UpdateShowroom/${data.id}` : `${BASE_URL}/insertShowroom`;
        let method = isEdit ? 'PUT' : 'POST';
        
        let options = {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(payload)
        };

        try {
            let res = await fetch(url, options);
            let result = await res.json();
            if (result.success) {
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
