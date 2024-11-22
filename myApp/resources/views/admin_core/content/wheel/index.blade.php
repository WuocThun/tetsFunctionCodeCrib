@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
    <style>
        .wheel_box{
            position: relative;
        }
        img.marker_style{
            position: absolute;
            top: 23.6%;
            left: 14.3%;
            width: 186px;
            opacity: 0.7;
        }
        .wheel_box a:hover{
            opacity: 1;
        }
        img.marker_style:hover{
            opacity: 1;
            transition:  1s all ease;
        }
    </style>



    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($hoursLeft)
            <div class="alert alert-danger">
                Bạn chỉ được quay lại sau {{ $hoursLeft }} giờ nữa!
            </div>
        @endif


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Code Crib</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboardCore')}}">Quản lý</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Vòng quay may mắn</li>
            </ol>
        </nav>
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Vòng quay may mắn</h1>


                @role('admin')
                <a class="btn btn-danger btn-sm d-none d-md-block" href="#">Quản lý vòng quay</a>
              @endrole
            </div>


        <div class="d-none d-md-block card">

            <div class="card-body">
                <div class="wheel_box">
                <img class="wheel_style" src="{{asset('uploads/wheel/wheel.png')}}" height="500px" width="500px">
                    <a style="cursor: pointer;"  id="marker_click" onclick="return Spin_wheel()">
                        <img id="spin-button"  class="marker_style" src="{{asset('uploads/wheel/marker.png')}}" >
                    </a>
                </div>
            </div>
            <!-- end pagination -->
        </div>
        </div>


        <br><br>
    </main>
{{--    <script>--}}
{{--        function Spin_wheel() {--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('admin.spin-wheel') }}",--}}
{{--                type: "POST",--}}
{{--                data: {--}}
{{--                    _token: "{{ csrf_token() }}"--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    swal("Chúc mừng bạn", response.message, "success");--}}
{{--                    // Gọi logic quay thưởng--}}
{{--                },--}}
{{--                error: function (xhr) {--}}
{{--                    if (xhr.status === 403) {--}}
{{--                        swal("Thông báo", xhr.responseJSON.message, "error");--}}
{{--                    } else {--}}
{{--                        swal("Lỗi", "Có lỗi xảy ra, vui lòng thử lại!", "error");--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

    <script type="text/javascript">
        function shuffle(array) {
            var currentIndex = array.length,
                randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {
                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;

                // And swap it with the current element.
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex],
                    array[currentIndex],
                ];
            }

            return array;
        }

        function Spin_wheel() {
            // Play the sound
            document.getElementById('marker_click').setAttribute('onclick','return false')
            // wheel.play();
            var path_wheel = "{{URL::asset('uploads/wheel/wheel.mp3')}}"
            var path_applause = "{{URL::asset('uploads/wheel/applause.mp3')}}"
            var wheel_music = new Audio(path_wheel)
            var applause_music = new Audio(path_applause)
            wheel_music.play();
            // Inisialisasi variabel
            const wheel  = document.querySelector('.wheel_style')
            let SelectedItem = "";

            // Shuffle 450 karena class box1 sudah ditambah 90 derajat diawal. minus 40 per item agar posisi panah pas ditengah.
            // Setiap item memiliki 12.5% kemenangan kecuali item sepeda yang hanya memiliki sekitar 4% peluang untuk menang.
            // Item berupa ipad dan samsung tab tidak akan pernah menang.
            // let Sepeda = shuffle([2210]); //Kemungkinan : 33% atau 1/3
            let cong10ngan = shuffle([1890, 2250, 2610]);
            let cong20ngan = shuffle([1920, 2250, 2610]);
            let cong6ngan = shuffle([1850, 2210, 2570]); //Kemungkinan : 100%
            let cong5ngan = shuffle([1810, 2170, 2530]);
            let cong4ngan = shuffle([1770, 2130, 2490]);
            let cong3ngan = shuffle([1750, 2110, 2470]);
            let cong2ngan = shuffle([1630, 1990, 2350]);
            let cong1ngan = shuffle([1570, 1930, 2290]);

            // Bentuk acak
            let Hasil = shuffle([
                cong1ngan[0],
                cong2ngan[0],
                cong3ngan[0],
                cong4ngan[0],
                cong5ngan[0],
                cong6ngan[0],
                cong20ngan[0],
                cong10ngan[0],

            ]);
            // console.log(Hasil[0]);

            // Ambil value item yang terpilih
            if (cong1ngan.includes(Hasil[0])) SelectedItem = "+1k Vào tài khoản";
            if (cong2ngan.includes(Hasil[0])) SelectedItem = "+2k Vào tài khoản";
            if (cong3ngan.includes(Hasil[0])) SelectedItem = "+3k Vào tài khoản";
            if (cong4ngan.includes(Hasil[0])) SelectedItem = "+4k Vào tài khoản";
            if (cong5ngan.includes(Hasil[0])) SelectedItem = "+5k Vào tài khoản";
            if (cong6ngan.includes(Hasil[0])) SelectedItem = "+6k Vào tài khoản";
            if (cong20ngan.includes(Hasil[0])) SelectedItem = "+20k Vào tài khoản";
            if (cong10ngan.includes(Hasil[0])) SelectedItem = "+10k Vào tài khoản";

            // Proses
            wheel.style.transition = "all 5s ease"
            wheel.style.transform = "rotate(445deg)";

            // setTimeout(function () {
            //     element.classList.add("animate");
            // }, 5000);

            // Munculkan Alert
            // setTimeout(function () {
            //     applause_music.play();
            //     swal(
            //         "Chúc mừng bạn",
            //         "đã trúng " + SelectedItem + ".",
            //         "success"
            //     );
            // }, 5500);
            setTimeout(function () {
                applause_music.play();
                const reward = encodeURIComponent(SelectedItem); // Mã hóa giá trị phần thưởng để an toàn
                window.location.href = `{{ route('admin.spin-wheel.reward') }}?reward=${reward}`;
                swal(
                    "Chúc mừng bạn",
                    "đã trúng " + SelectedItem + ".",
                    "success"
                );
            }, 5500);



            // Delay and set to normal state
            setTimeout(function () {
                document.getElementById('marker_click').setAttribute('onclick','return Spin_wheel()')

                wheel_music.pause();
                sandals.style.setProperty("transition", "initial");
                sandals.style.transform = "rotate(360deg)";
            }, 6000);
        }

        $('#spinButton').on('click', function () {
            $.ajax({
                url: route('admin.spin.wheel'), // URL API kiểm tra
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success') {
                        // Cho phép quay
                        alert(response.message);
                        // Gọi hàm quay spin (ví dụ: startSpin())
                        startSpin();
                    } else {
                        // Thông báo lỗi
                        alert(response.message);
                    }
                },
                error: function (error) {
                    alert('Có lỗi xảy ra: ' + error.responseJSON.message);
                }
            });
        });

        function startSpin() {
            // Hàm quay spin thực tế
            console.log("Quay spin...");
        }

    </script>

@endsection

