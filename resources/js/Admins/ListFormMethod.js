import BASE_URL from './Api.js'

document.addEventListener('DOMContentLoaded', () => {
    RenderSearch();

    ListAndSearch()

    DetailList()

    DeleteMethod()
})
let searchTimeout;

function debounceSearch() {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        ListAndSearch();
    }, 500);
}

document.addEventListener('input', (e) => {

    if (e.target.matches('#nameSearch')) {
        debounceSearch();
    }

});

document.addEventListener('change', (e) => {

    if (e.target.matches('#statusSearch')) {
        ListAndSearch();
    }

});

function RenderSearch() {

    const title = document.getElementById('page-header');

    title.innerHTML = `

        <div class="page-leftheader">

            <h4 class="page-title">Danh sách phương thức</h4>

            <ol class="breadcrumb pl-0">

                <li class="breadcrumb-item">

                    <a href="#">Home</a>

                </li>

                <li class="breadcrumb-item active">

                    Danh sách phương thức

                </li>

            </ol>

        </div>

        <div class="page-leftheader d-flex">

            <input
                type="text"
                id="nameSearch"
                class="form-control m-1"
                placeholder="Tên phương thức">

            <select
                id="statusSearch"
                class="form-control m-1">

                <option value="">Trạng thái</option>

                <option value="active">
                    Hoạt động
                </option>

                <option value="unactive">
                    Ngừng hoạt động
                </option>

            </select>

        </div>

    `;

}

async function ListAndSearch (page = 1) {
    try {
       const name = document.getElementById('nameSearch')?.value.trim() ?? '';

        const status = document.getElementById('statusSearch')?.value ?? '';

        const response = await fetch(
            `${BASE_URL}/GetListMethodTest?page=${page}&search=${encodeURIComponent(name)}&status=${status}`
        );

        const result = await response.json();

        if (result.success) {

            // Nếu Service trả về paginate
        renderTable(result.data);

        renderPagination(result.pagination);

        }
    } catch (error) {
        console.log(error)
    }
}

function renderTable (data) {
    const tbody = document.getElementById('table-body')

    if (!tbody) return

    tbody.innerHTML = ''

    data.forEach((item, key) => {
        tbody.innerHTML += `

            <tr>

                <td>${key + 1}</td>

                <td>${item.name}</td>

                <td>

                    ${
                        item.status == 'active'
                            ? '<span class="badge bg-success">Hoạt động</span>'
                            : '<span class="badge bg-danger">Ngừng hoạt động</span>'
                    }

                </td>

  <td>

    <button
        class="btn btn-primary my-1 mx-1 detailProduction"
        data-id="${item.id}">
        <i class="far fa-eye"></i>
    </button>

    <button
        class="btn btn-danger my-1 mx-1 deleteProduction"
        data-id="${item.id}">
        <i class="fa fa-trash"></i>
    </button>

</td>

            </tr>

        `
    })
}

function renderPagination(pagination) {

    const paginationElement = document.getElementById('pagination');

    paginationElement.innerHTML = '';

    for (let i = 1; i <= pagination.last_page; i++) {

        paginationElement.innerHTML += `

            <li class="page-item ${pagination.current_page == i ? 'active' : ''}">

                <a
                    href="#"
                    class="page-link"
                    data-page="${i}">

                    ${i}

                </a>

            </li>

        `;

    }

    document.querySelectorAll('#pagination .page-link')
        .forEach(item => {

            item.addEventListener('click', function (e) {

                e.preventDefault();

                ListAndSearch(this.dataset.page);

            });

        });

}
function DetailList () {
    document
        .getElementById('table-body')
        .addEventListener('click', async function (e) {
            const btn = e.target.closest('.detailProduction')

            if (!btn) return

            e.preventDefault()

            const id = btn.dataset.id

            const pageDetail = document.getElementById('detail')

            const titleDetail = document.getElementById('page-header')

            pageDetail.innerHTML = ''

            titleDetail.innerHTML = `
            <div class="page-leftheader">
                <h4 class="page-title">Chi tiết phương thức</h4>
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Chi tiết phương thức
                    </li>
                </ol>
            </div>
        `

            try {
                const response = await fetch(
                    `${BASE_URL}/GetListDetailMethodTest/${id}`
                )

                const result = await response.json()

                if (!result.success) {
                    alert('Không tìm thấy dữ liệu')

                    return
                }

                const data = result.data

                pageDetail.innerHTML = `

                <div class="card-body">

                    <input
                        type="hidden"
                        id="id"
                        value="${data.id}"
                    >

                    <div class="form-group">

                        <label class="form-label">

                            Tên phương thức

                        </label>

                        <input

                            type="text"

                            class="form-control"

                            id="name"

                            value="${data.name}"

                        >

                        <p class="text-danger" id="notification-name"></p>

                    </div>

                    <div class="form-group">

                        <label class="form-label">

                            Trạng thái

                        </label>

                        <select
                            class="form-control"
                            id="status"
                        >

                            <option

                                value="active"

                                ${data.status == 'active' ? 'selected' : ''}

                            >

                                Hoạt động

                            </option>

                            <option

                                value="unactive"

                                ${data.status == 'unactive' ? 'selected' : ''}

                            >

                                Ngừng hoạt động

                            </option>

                        </select>

                        <p class="text-danger" id="notification-status"></p>

                    </div>

                    <button
                        class="btn btn-primary"
                        id="confirm">

                        Cập nhật

                    </button>

                    <button
                        class="btn btn-outline-danger"
                        id="close">

                        Đóng

                    </button>

                </div>

            `

                UpdateInformation()
            } catch (error) {
                console.log(error)
            }
        })
}
function UpdateInformation () {
    try {
        const update = document.getElementById('confirm')

        const close = document.getElementById('close')

        close.addEventListener('click', e => {
            e.preventDefault()

            window.location.href = '/admin/classify/ListFormMethodTest'
        })

        update.addEventListener('click', async e => {
            e.preventDefault()

            const id = document.getElementById('id').value

            const name = document.getElementById('name').value.trim()

            const status = document.getElementById('status').value

            let hasError = false

            const setError = (id, message) => {
                document.getElementById(id).innerHTML = message

                hasError = true
            }

            document.getElementById('notification-name').innerHTML = ''

            document.getElementById('notification-status').innerHTML = ''

            if (name.length < 3 || name.length > 255) {
                setError('notification-name', 'Tên phải từ 3 đến 255 ký tự')
            }

            if (status != 'active' && status != 'unactive') {
                setError('notification-status', 'Trạng thái không hợp lệ')
            }

            if (hasError) {
                return
            }

            const data = {
                name,

                status
            }

            const response = await fetch(
                `${BASE_URL}/UpdateListMethodTest/${id}`,

                {
                    method: 'PUT',

                    headers: {
                        'Content-Type': 'application/json'
                    },

                    body: JSON.stringify(data)
                }
            )

            const result = await response.json()

            if (result.success) {
                alert('Cập nhật thành công')

                window.location.href = '/admin/classify/ListFormMethodTest'
            } else {
                alert(result.message ?? 'Cập nhật thất bại')
            }
        })
    } catch (error) {
        console.log(error)
    }
}

function DeleteMethod () {
    document
        .getElementById('table-body')
        .addEventListener('click', async function (e) {
            const btn = e.target.closest('.deleteProduction')

            if (!btn) return

            e.preventDefault()

            const id = btn.dataset.id

            if (!confirm('Bạn có chắc muốn xóa không?')) {
                return
            }

            try {
                const response = await fetch(
                    `${BASE_URL}/DeleteMethodTest/${id}`,

                    {
                        method: 'DELETE'
                    }
                )

                const result = await response.json()

                if (result.success) {
                    alert('Xóa thành công')

                    ListAndSearch()
                } else {
                    alert(result.message)
                }
            } catch (error) {
                console.log(error)
            }
        })
}
