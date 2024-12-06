@extends('admin_core.layouts.test')

@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{route('admin.motel.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Thêm phòng trọ</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="text-dark" for= "">Tên phòng</label> <label>*</label>
                            <input class="nameform form-control"    value="{{ old('name') }}"
                                   name="name" type="text" />
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >Tiền phòng (Tr/Tháng)</label> <label>*</label>
                            <input class="nameform form-control currency-input" id="money"  value="{{ old('money') }}"
                                   name="money" type="text"  />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Số điện hiện tại (kW)</label> <label>*</label>
                                    <input class="nameform form-control" value="{{ old('default_electric') }}" name="default_electric" type="number" min="1" step="1"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Số nước hiện tại (m/<sup>3</sup>)</label> <label>*</label>
                                    <input class="nameform form-control" value="{{ old('default_water') }}" name="default_water" type="number" min="1" step="1"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Số tiền điện trên 1kW</label> <label>*</label>
                                    <input class="nameform form-control currency-input" value="{{ old('money_electric') }}" name="money_electric" type="text" min="1" step="1"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Số tiền nước trên 1m/<sup>3</sup></label> <label>*</label>
                                    <input class="nameform form-control currency-input" value="{{ old('money_water') }}" name="money_water" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Tiền Wifi</label>
                                    <input class="nameform form-control currency-input" value="{{ old('money_wifi') }}" name="money_wifi" type="text" />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Tiền rác + phụ thu</label>
                                    <input class="nameform form-control currency-input"  value="{{ old('money_another') }}" name="money_another" type="text" />
                                </div>
                            </div><div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-dark" for= "">Phòng bao nhiêu người</label>
                                    <input class="nameform form-control currency-input"  value="{{ old('total_member') }}" name="total_member" type="number" min="1" max="10" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark" for= "">Ngày tính tiền hàng tháng</label>
                                <input id="money_date" class="nameform form-control"  name="money_date" type="date" min="1" step="1"  />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark" for= "">Loại phòng</label>
                                <select name="kind_motel" class="form-control">
                                    <option value="0">Chọn loại phòng:</option>
                                    <option value="1">DEMO</option>
                                    <option value="2">ABC</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark" for= "">Trạng thái phòng</label>
                                <select name="status" class="form-control">
                                    <option value="1">Đã có người thuê</option>
                                    <option value="0">Còn trống</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>

                </div>
                </div>
            </div>
        </div>
        </form>
    </main>
    <script>
        // Lấy phần tử input theo id
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy phần tử input theo id
            const dateInput = document.getElementById('money_date');

            // Lấy ngày hiện tại
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0]; // Định dạng yyyy-mm-dd

            // Đặt giá trị mặc định là ngày hiện tại và thiết lập giá trị tối thiểu
            dateInput.value = formattedDate;
            dateInput.setAttribute('min', formattedDate);

            // Lắng nghe sự kiện thay đổi giá trị
            dateInput.addEventListener('change', function () {
                // Nếu ngày được chọn nhỏ hơn ngày hiện tại, tự động đặt lại thành ngày hiện tại
                if (new Date(this.value) < today) {
                    alert('Bạn không thể chọn ngày cũ. Ngày đã được tự động chỉnh sửa!');
                    this.value = formattedDate;
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chọn tất cả các input cần định dạng
            const currencyInputs = document.querySelectorAll('.currency-input');

            currencyInputs.forEach(input => {
                // Ngăn nhập ký tự không phải số
                input.addEventListener('keydown', function (e) {
                    const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab'];

                    // Cho phép các phím số, phím điều hướng và phím chức năng
                    if ((e.key >= '0' && e.key <= '9') || allowedKeys.includes(e.key)) {
                        return; // Hợp lệ
                    }

                    e.preventDefault(); // Ngăn chặn ký tự không hợp lệ
                });

                // Định dạng lại số khi nhập
                input.addEventListener('input', function () {
                    let value = this.value.replace(/,/g, ''); // Loại bỏ dấu `,`
                    if (isNaN(value)) {
                        this.value = '';
                        return;
                    }
                    this.value = Number(value).toLocaleString('en-US'); // Thêm dấu `,`
                });

                // Chuyển giá trị về định dạng không dấu `,` khi rời khỏi ô nhập liệu
                input.addEventListener('blur', function () {
                    this.value = this.value.replace(/,/g, '');
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const moneyInput = document.getElementById('money');
            // const moneyInput = document.getElementById('money');

            // Ngăn chặn nhập ký tự không hợp lệ
            moneyInput.addEventListener('keydown', function (e) {
                // Danh sách các phím hợp lệ (số, phím điều hướng, xóa, dấu chấm/dấu phẩy)
                const allowedKeys = [
                    'Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab'
                ];

                // Cho phép nhập các số (phím số và phím numpad)
                if ((e.key >= '0' && e.key <= '9') || allowedKeys.includes(e.key)) {
                    return; // Hợp lệ, không làm gì
                }

                // Nếu không hợp lệ, ngăn sự kiện nhập
                e.preventDefault();
            });

            // Định dạng lại giá trị nhập vào khi có sự thay đổi
            moneyInput.addEventListener('input', function () {
                // Lấy giá trị hiện tại và loại bỏ các dấu ',' nếu có
                let value = this.value.replace(/,/g, '');

                // Nếu giá trị không phải là số thì đặt về chuỗi rỗng
                if (isNaN(value)) {
                    this.value = '';
                    return;
                }

                // Định dạng lại số với dấu phân cách hàng nghìn
                this.value = Number(value).toLocaleString('en-US');
            });

            // Trước khi gửi form, chuyển giá trị về định dạng không dấu ','
            moneyInput.addEventListener('blur', function () {
                this.value = this.value.replace(/,/g, '');
            });
        });
    </script>

@endsection

