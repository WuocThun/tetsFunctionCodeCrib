<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thanh toán thất bại</title>
    <link rel="stylesheet" href="{{asset('style/css/checkout.css')}}" />
</head>
<body>
<div class="main-box">
    <h4 class="payment-titlte">Đã bị huỷ</h4>
    <p>
        Nếu có bất kỳ câu hỏi nào, hãy gửi email tới
        <a href="mailto:support@payos.vn">support@payos.vn</a>
    </p>
    <a href="{{route('admin.user.paymentIndex')}}" id="return-page-btn"
    >Trở về trang Tạo Link thanh toán</a
    >
</div>
</body>
</html>
