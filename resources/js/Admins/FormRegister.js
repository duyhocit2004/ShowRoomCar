import BASE_URL from './Api.js'; // Đảm bảo import đúng file Api.js cùng cấp thư mục

document.addEventListener('DOMContentLoaded', () => {
    RenderSearch();
    ListAndSearch();
    DetailList()
});

let searchTimeout;

function debounceSearch() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        ListAndSearch();
    }, 1000)
}

window.makePhoneCall = function (phone) {
    if (!phone) return;
    if (confirm(`Bạn muốn gọi cho số ${phone} không?`)) {
        window.open(`tel:${phone}`, '_self');
    }
}

document.addEventListener('input', (e) => {
    if (e.target.matches('#nameSreach, #emailSreach')) {
        debounceSearch();
    }
});

document.addEventListener('change', (e) => {
    if (e.target.matches('#statusSreach')) {
        debounceSearch();
    }
});

function RenderSearch() {
    var title = document.getElementById('page-header');

    title.innerHTML = `
        <div class="page-leftheader">
			<h4 class="page-title">Danh sách đăng ký tư vấn</h4>
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Danh sách đăng ký tư vấn</li>
			</ol>
		</div>

		<div class="page-leftheader d-flex" id="idSreach">
			<input type="text" id="nameSreach" name="name" class="form-control m-1" placeholder="Tên khách hàng">
			<input type="text" id="emailSreach" name="email" class="form-control m-1" placeholder="email">
			<select name="" id="statusSreach" class="form-control m-1">
				<option value="">Trang thái</option>
				<option value="active">Đã xử lý</option>
				<option value="unactive">Chưa xử lý</option>
			</select>
		</div>
        `;
}

async function ListAndSearch(page = 1) {
    try {



        var name = document.getElementById('nameSreach').value;
        var email = document.getElementById('emailSreach').value;
        var status = document.getElementById('statusSreach').value;

        // Đã sửa lại URL chuẩn gọi qua API
        const response = await fetch(
            `${BASE_URL}/ListRegister?name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&status=${status}&page=${page}`
        );

        const result = await response.json();


        // Kiểm tra cấu trúc data trả về từ Laravel Paginate (thường là result.data.data)
        if (result && result.data && result.data.data) {
            renderTable(result.data.data);
            renderPagination(result.data);



        }
    } catch (error) {
        console.error("Lỗi Fetch Data:", error);
    }
}

// Sửa lại tham số truyền vào thành 'data' và sửa lại (item, key)
function renderTable(data) {
    var tbody = document.getElementById('table-body');
    var cardTitle = document.getElementById('card-title');
    console.log(data)

    if (!tbody) return;

    tbody.innerHTML = ``;
    cardTitle.innerHTML = `Danh sách gửi phiếu`


    if (!Array.isArray(data)) return;

    data.forEach((item, key) => {
        tbody.innerHTML += `
            <tr>
                <td>${key + 1}</td>
                <td>${item.name || ''}</td>
                <td>${item.phone || ''}</td>
                <td>${item.email || ''}</td>
                <td>${item.test_driver_method ? item.test_driver_method.name : ''}</td>
                <td>${item.status === 'active' ? 'Chưa tư vấn' : 'Đã tư vấn'}</td>
                <td>
                <a href="tel:${item.phone}" 
                      onclick="event.stopPropagation(); if(!confirm('Bạn muốn gọi cho số ${item.phone} không?')) { return false; }" 
                      class="btn btn-primary my-1 mx-1">
                        <i class="fas fa-phone-volume"></i>
                   </a>
                    
                    <button data-id="${item.id}"  class="btn btn btn-outline-danger my-1 mx-1 detailProduction"><i class="far fa-eye"></i></button>
                </td>
            </tr>
            
        `
            ;

    });

}

function renderPagination(data) {

    const pagination = document.getElementById('pagination');

    pagination.innerHTML = '';

    data.links.forEach(link => {

        let label = link.label
            .replace('&laquo; Previous', '&laquo;')
            .replace('Next &raquo;', '&raquo;');

        pagination.innerHTML += `
            <li class="page-item ${link.active ? 'active' : ''} ${link.url === null ? 'disabled' : ''}">
                <a href="#" class="page-link" data-page="${link.page ?? ''}">
                    ${label}
                </a>
            </li>
        `;
    });

    document.querySelectorAll('#pagination .page-link').forEach(item => {

        item.addEventListener('click', function (e) {

            e.preventDefault();

            if (this.dataset.page) {
                ListAndSearch(this.dataset.page);
            }

        });

    });

}


function DetailList() {
    document.getElementById('table-body').addEventListener('click', async function (e) {
        const btn = e.target.closest('.detailProduction');
        if (!btn) return;

        e.preventDefault();

        const id = btn.dataset.id;

        const pageDetail = document.getElementById('detail');
        const titleDetail = document.getElementById('page-header');
        const cardTitle = document.getElementById('card-title');

        pageDetail.innerHTML = '';
        cardTitle.innerHTML = `Chi tiết gửi phiếu`;

        titleDetail.innerHTML = `
            <div class="page-leftheader">
                <h4 class="page-title">Thông tin chi tiết</h4>
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Thông tin chi tiết</li>
                </ol>
            </div>
        `;

        const response = await fetch(`${BASE_URL}/DetailAccountRegister/${id}`);
        const result = await response.json();

        if (result.status !== 200) {
            alert("Không tồn tại");
            return;
        }

        const data = result.data;
        const date = data.dateTest ? data.dateTest.split('T')[0] : '';

        pageDetail.innerHTML = `
            <div class="card-body">
                                    
                                    <input type="text" id="id" class="form-control" value="${id}" name="id" hidden>
										<div class="form-group">
											<label class="form-label">Họ tên</label>
											<input type="text" id="name" class="form-control" value="${data.name}" name="name" placeholder="Name">
                                            <p class="text-danger" id="notification-name"></p>
										</div>
										<div class="form-group">
											<label class="form-label">số điện thoại</label>
											<input type="text" id="phone" class="form-control" value="${data.phone}" name="phone" placeholder="Text..">
                                            <p class="text-danger" id="notification-phone"></p>
										</div>
                                        <div class="form-group">
											<label class="form-label">email</label>
											<input type="text" id="email" class="form-control" value="${data.email}" name="email" placeholder="Text..">
                                            <p class="text-danger" id="notification-email"></p>
										</div>
										
										<div class="form-group">
											<label class="form-label">Loại xe</label>
											<input type="text" id="car" class="form-control" name="car" placeholder="lambo" value="${data.car}">
                                            <p class="text-danger" id="notification-car"></p>
										</div>
                                        <div class="form-group">
											<label class="form-label">Trạng thái</label>
											<select class="form-control" id="status" name="status">
                                                <option value="active" ${data.status == 'active' ? 'selected' : ''}>Chưa xử lý</option>
                                                <option value="unactive" ${data.status == 'unactive' ? 'selected' : ''}>Đã xử lý</option>
                                            </select>
                                            <p class="text-danger" id="notification-status"></p>
										</div>
                                        <div class="form-group">
											<label class="form-label">Phương thức</label>
											<select class="form-control" id="testDriveMethod_id" name="testDriveMethod_id ">
                                                <option value="1" ${data.testDriveMethod_id == 1 ? "selected" : ""}>Tư vấn</option>
                                                <option value="2" ${data.testDriveMethod_id == 2 ? "selected" : ""}>Lái thử</option>
                                            </select>
                                            <p class="text-danger" id="notification-testDriveMethod_id"></p>
										</div>
                                        <div class="form-group">
											<label class="form-label">Ngày thử hoặc tư vấn</label>
											<input type="date" id="dateTest" class="form-control" name="dateTest" placeholder="" value="${date}" >
                                            <p class="text-danger" id="notification-dateTest"></p>
										</div>

                                        <div class="form-group">
											<label class="form-label">Ghi chú </label>
											<textarea class="form-control" id="note" value="" name="note" rows="7" placeholder="Ghi chú">${data.note}</textarea>
                                            <p class="text-danger" id="notification-note"></p>
										</div>

                                        <button id="confirm" class="btn btn-primary"> Thay đổi</button>
                                        <button id="close" class="btn btn btn-outline-danger"> Đóng lại</button>
                                    
								</div>
        `;

        UpdateInformation();
    });
}

function UpdateInformation() {
    try {
        var update = document.getElementById('confirm');
        var close = document.getElementById('close');
        close.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = '/admin/table/ListRegister   ';
        });
        update.addEventListener('click', async (e) => {
            e.preventDefault();

            const id = document.getElementById('id').value;
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const car = document.getElementById('car').value;
            const status = document.getElementById('status').value;
            const testDriveMethod_id = document.getElementById('testDriveMethod_id').value;
            const dateTest = document.getElementById('dateTest').value;
            const note = document.getElementById('note').value;

            let hasError = false;

            const setError = (id, msg) => {
                document.getElementById(id).innerHTML = msg;
                hasError = true;
            };

            // reset
            ['notification-name', 'notification-phone', 'notification-email', 'notification-car',
                'notification-status', 'notification-dateTest', 'notification-note']
                .forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.innerHTML = '';
                });

            // validate
            if (name.length < 10 || name.length > 50)
                setError('notification-name', 'Tên từ 10 đến 50 ký tự');

            if (!/^\d{10}$/.test(phone))
                setError('notification-phone', 'SĐT phải đúng 10 số');

            if (email.length < 10 || email.length > 150)
                setError('notification-email', 'Email không hợp lệ');

            if (car.length < 5 || car.length > 100)
                setError('notification-car', 'Car không hợp lệ');

            if (note.length < 3 || note.length > 200)
                setError('notification-note', 'Note không hợp lệ');

            if (status !== "active" && status !== "unactive")
                setError('notification-status', 'Trạng thái không hợp lệ');

            if (hasError) return;

            const data = {
                id,
                name,
                phone,
                email,
                car,
                status,
                testDriveMethod_id,
                dateTest,
                note
            }

            const response = await fetch(`${BASE_URL}/UpdateAccountRegister/${id}`, {
                method: "PUT",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify(data)
            })

            const refult = await response.json();

            if (refult.status === 200) {
                alert('Cập nhật thành công');
                return window.location.href = '/admin/table/ListRegister'
            } else {
                alert('Vui lòng chỉnh sửa lại');
            }



        })
    } catch (error) {
        console.log(new Error(error));
    }
}