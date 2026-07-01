import BASE_URL from './Api.js';

document.addEventListener('DOMContentLoaded', () => {
    RenderSearch();
    ListAndSearch();
    bindEvents();
});

let searchTimeout;
let editorInstance = null;

function debounceSearch() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        ListAndSearch();
    }, 500);
}

function RenderSearch() {
    const title = document.getElementById('page-header');
    title.innerHTML = `
        <div class="page-leftheader">
            <h4 class="page-title">Quản lý Tin tức</h4>
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tin tức</li>
            </ol>
        </div>
        <div class="page-rightheader ml-auto d-flex gap-2">
            <button class="btn btn-success m-1" id="btnAddNews">
                <i class="fa fa-plus"></i> Thêm Tin tức
            </button>
            <input type="text" id="titleSearch" class="form-control m-1" placeholder="Tìm tiêu đề...">
            <select id="statusSearch" class="form-control m-1">
                <option value="">Trạng thái</option>
                <option value="active">Hoạt động</option>
                <option value="inactive">Đã ẩn</option>
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
        if (e.target.closest('#btnAddNews')) {
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
        const btnEdit = e.target.closest('.editNews');
        if (btnEdit) {
            const id = btnEdit.dataset.id;
            try {
                const res = await fetch(`${BASE_URL}/GetDetailNews/${id}`);
                const result = await res.json();
                if (result.success) {
                    renderForm(result.data);
                }
            } catch (error) {
                console.error(error);
            }
        }

        // Delete
        const btnDelete = e.target.closest('.deleteNews');
        if (btnDelete) {
            if (!confirm('Bạn có chắc muốn xóa tin tức này?')) return;
            const id = btnDelete.dataset.id;
            try {
                const res = await fetch(`${BASE_URL}/DeleteNews/${id}`, {
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
        if (e.target.matches('#titleSearch')) {
            debounceSearch();
        }
    });

    document.addEventListener('change', e => {
        if (e.target.matches('#statusSearch')) {
            ListAndSearch();
        }
    });
}

async function ListAndSearch(page = 1) {
    const search = document.getElementById('titleSearch')?.value ?? '';
    const status = document.getElementById('statusSearch')?.value ?? '';

    try {
        const response = await fetch(`${BASE_URL}/GetListNews?page=${page}&search=${search}&status=${status}`);
        const result = await response.json();
        
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
                <td>
                    <div class="d-flex align-items-center">
                        ${item.image ? `<img src="${item.image}" width="60" class="mr-2 rounded">` : ''}
                        <span>${item.title ?? ''}</span>
                    </div>
                </td>
                <td>${item.author ?? 'Admin'}</td>
                <td>
                    ${item.status === 'active' ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Ẩn</span>'}
                </td>
                <td>
                    <button class="btn btn-primary editNews" data-id="${item.id}">
                       <i class="far fa-edit"></i>
                    </button>
                     <button class="btn btn-danger deleteNews" data-id="${item.id}">
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
    const titleText = isEdit ? 'Cập nhật Tin tức' : 'Thêm Tin tức mới';

    let html = `
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>${titleText}</h4>
                        <input type="hidden" id="newsId" value="${data?.id ?? ''}">
                        
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label>Tiêu đề (*)</label>
                                <input class="form-control" id="title" value="${data?.title ?? ''}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Tác giả</label>
                                <input class="form-control" id="author" value="${data?.author ?? ''}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Trạng thái</label>
                                <select id="status" class="form-control">
                                    <option value="active" ${data?.status == 'active' ? 'selected' : ''}>Hoạt động</option>
                                    <option value="inactive" ${data?.status == 'inactive' ? 'selected' : ''}>Ẩn</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Link ảnh đại diện (URL)</label>
                                <input class="form-control" id="image" value="${data?.image ?? ''}" placeholder="https://example.com/image.jpg">
                                ${data?.image ? `<img src="${data.image}" width="150" class="mt-2 rounded">` : ''}
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>Nội dung bài viết (*)</label>
                                <textarea class="form-control" id="content" rows="10" required>${data?.content ?? ''}</textarea>
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

    // Khởi tạo CKEditor
    if (typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }

    // Save
    document.getElementById('btnSave').onclick = async function () {
        const btnSave = this;
        const btnClose = document.getElementById('btnClose');
        const originalText = btnSave.innerText;

        btnSave.disabled = true;
        btnClose.disabled = true;
        btnSave.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...';

        let payload = {
            title: document.getElementById('title').value,
            author: document.getElementById('author').value,
            status: document.getElementById('status').value,
            image: document.getElementById('image').value,
            content: editorInstance ? editorInstance.getData() : document.getElementById('content').value
        };

        if (!payload.title || !payload.content) {
            alert("Vui lòng nhập Tiêu đề và Nội dung bài viết.");
            btnSave.disabled = false;
            btnClose.disabled = false;
            btnSave.innerText = originalText;
            return;
        }

        let url = isEdit ? `${BASE_URL}/UpdateNews/${data.id}` : `${BASE_URL}/insertNews`;
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
