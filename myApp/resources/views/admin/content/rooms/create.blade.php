@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

        .nameform {
            width: 30%;
        }
        #map {
            width: 500px;
            height: 400px;
            margin-top: 20px;
            border: 1px solid #ccc;
        }
    </style>
<h1>Chọn địa điểm để xem bản đồ</h1>
<!-- Ô chọn tỉnh -->
<label for="province">Tỉnh:</label>
<select id="province" name="province">
    <option value="">Chọn tỉnh</option>
    @foreach ($provinces['results'] as $province)
        <option value="{{ $province['province_id'] }}">{{ $province['province_name'] }}</option>
    @endforeach
</select>

<!-- Ô chọn quận -->
<label for="district">Quận:</label>
<select id="district" name="district" disabled>
    <option value="">Chọn quận</option>
</select>

<!-- Ô chọn phường -->
<label for="ward">Phường:</label>
<select id="ward" name="ward" disabled>
    <option value="">Chọn phường</option>
</select>

<!-- Ô nhập tên đường -->
<label for="street">Tên đường:</label>
<input type="text" id="street" placeholder="Nhập tên đường..." /> <br>

<!-- Ô input để hiển thị dữ liệu đã chọn -->
<label for="selectedInfo">Địa chỉ chính xác:</label>
<input  class="nameform" name="full_address" type="text" id="selectedInfo" readonly />

<!-- Khung hiển thị bản đồ -->
<iframe id="map" frameborder="0" scrolling="no"></iframe>

<script>
    $(document).ready(function() {
        // Khi thay đổi tỉnh
        $('#province').change(function() {
            var provinceId = $(this).val();
            $('#district').prop('disabled', true);
            $('#ward').prop('disabled', true);
            $('#district').empty().append('<option value="">Chọn quận</option>');
            $('#ward').empty().append('<option value="">Chọn phường</option>');

            if (provinceId) {
                $.get('https://vapi.vnappmob.com/api/province/district/' + provinceId, function(data) {
                    $.each(data.results, function(index, district) {
                        $('#district').append('<option value="' + district.district_id + '">' + district.district_name + '</option>');
                    });
                    $('#district').prop('disabled', false);
                });
            }
            updateMap();
        });

        // Khi thay đổi quận
        $('#district').change(function() {
            var districtId = $(this).val();
            $('#ward').prop('disabled', true);
            $('#ward').empty().append('<option value="">Chọn phường</option>');

            if (districtId) {
                $.get('https://vapi.vnappmob.com/api/province/ward/' + districtId, function(data) {
                    $.each(data.results, function(index, ward) {
                        $('#ward').append('<option value="' + ward.ward_id + '">' + ward.ward_name + '</option>');
                    });
                    $('#ward').prop('disabled', false);
                });
            }
            updateMap();
        });

        // Khi thay đổi phường hoặc nhập tên đường
        $('#ward, #street').change(updateMap);

        // Hàm cập nhật thông tin đã chọn và hiển thị bản đồ
        function updateMap() {
            var provinceName = $('#province option:selected').val() ? $('#province option:selected').text() : '';
            var districtName = $('#district option:selected').val() ? $('#district option:selected').text() : '';
            var wardName = $('#ward option:selected').val() ? $('#ward option:selected').text() : '';
            var streetName = $('#street').val();
            // Combine all parts into a single address and display in selectedInfo
            var fullAddress = `${streetName}${wardName ? ',' + wardName : ''}${districtName ? ', ' + districtName : ''}${provinceName ? ', ' + provinceName : ''}`;
            $('#selectedInfo').val(fullAddress);
            // Encode the full address and update the map iframe
            if (fullAddress) {
                const encodedAddress = encodeURIComponent(fullAddress);
                const mapSrc = `https://maps.google.com/maps?width=600&height=400&hl=en&q=${encodedAddress}&t=&z=12&ie=UTF8&iwloc=B&output=embed`;
                $('#map').attr('src', mapSrc);
            }
        }

    });
</script>

@endsection
