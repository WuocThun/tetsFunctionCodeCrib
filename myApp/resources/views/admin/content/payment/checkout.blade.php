<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tạo Link thanh toán</title>
    <link rel="stylesheet" href="{{asset('style/css/checkout.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>
<div class="main-box">
    <div class="checkout">
        <div class="product">
            <p><strong>Tên sản phẩm:</strong> Mì tôm Hảo Hảo ly</p>
            <p><strong>Giá tiền:</strong> 2000 VNĐ</p>
            <p><strong>Số lượng:</strong> 1</p>
        </div>
        <form action="{{route('admin.payment.mbbank.createPaymentLink')}}" method="post">
            @csrf
            <button type="submit" class="btn" id="create-payment-link-btn">
                Tạo Link thanh toán
            </button>
        </form>
    </div>
</div>
{{--<div class="main-box">--}}
{{--    <div class="checkout">--}}
{{--        <form action="{{route('admin.payment.mbbank.create')}}" method="post">--}}
{{--            @csrf--}}
{{--        <div class="product">--}}
{{--            <p><strong>Tên sản phẩm:</strong> </p>--}}
{{--            <input type="text" name="productName" id="">--}}
{{--            <p><strong>Giá tiền:</strong></p>--}}
{{--            <input type="number" name="amount" id="">--}}
{{--            <p><strong>Số lượng:</strong> 1</p>--}}
{{--        </div>--}}

{{--            <button type="submit" class="btn" id="create-payment-link-btn">--}}
{{--                Tạo Link thanh toán--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
</body>
</html>
