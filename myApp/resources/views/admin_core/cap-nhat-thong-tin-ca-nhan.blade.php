<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboardádas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../style.css">
</head>

<body class="desktop dashboard quan-ly dang-tin dang-tin-moi">
    <div id="webpage">
        <div class="container-fluid">
            <div class="row">
                <nav class="d-none d-lg-block bg-light sidebar">
                    <div class="user_info">
                        <a href="#" class="clearfix">
                            <div class="user_avatar"><img src="/images/default-user.png"></div>
                            <div class="user_meta">
                                <div class="inner">
                                    <div class="user_name">van trung</div>
                                    <div class="user_verify" style="color: #555; font-size: 0.9rem;">0582686301</div>
                                </div>
                            </div>
                        </a>
                        <ul>
                            <li><span>Mã thành viên:</span> <span style="font-weight: 700;"> 145617</span></li>
                            <li><span>TK Chính:</span> <span style="font-weight: 700;"> 0</span></li>

                        </ul>
                        <a class="btn btn-warning" href="./nap-tien.html">Nạp
                            tiền</a>
                        <a class="btn btn-danger" href="./dang-tin-moi.html">Đăng
                            tin</a>
                    </div>

                    <ul class="nav-sidebar">
                        <li class="nav-item">
                            <a class="nav-link " href="./tin-dang.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Quản lý tin đăng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./cap-nhat-thong-tin-ca-nhan.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Sửa thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./nap-tien.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                Nạp tiền vào tài khoản
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./lich-su-nap-tien.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                Lịch sử nạp tiền
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./lich-su-thanh-toan.html">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Lịch sử thanh toán
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="" target="_blank">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clipboard">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                Bảng giá dịch vụ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-message-circle">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg>
                                Liên hệ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-user-logout" href="./thoat">
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Thoát
                            </a>
                        </li>
                    </ul>
                </nav>
                <main role="main" class="ml-sm-auto col">

                    <div class="user_quick_info js-mobile-user-quick-info">
                        <p style="margin-top: 0; margin-bottom: 5px;">Xin chào <strong>van trung</strong>. Mã tài khoản:
                            <strong>145617</strong></p>
                        <p style="margin-bottom: 0;">Số dư TK của bạn là: <strong>0</strong></p>
                    </div>



                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Code Crib</a></li>
                            <li class="breadcrumb-item"><a href="index.html">QQuảnuản lý</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Đăng tin mới</li>
                        </ol>
                    </nav>
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">Cập nhật thông tin cá nhân</h1>
                    </div>

                    <form class="js-form-submit-data" action="#"
                        data-action-url="https://phongtro123.com/api/user/update/profile" method="POST"
                        novalidate="novalidate">
                        <div class="form-group row mt-5">
                            <label for="user_id" class="col-md-2 offset-md-2 col-form-label">Mã thành viên</label>
                            <div class="col-md-6">
                                <input type="text" readonly="" class="form-control disable" id="user_id"
                                    value="#145617">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_phone" class="col-md-2 offset-md-2 col-form-label">Số điện thoại</label>
                            <div class="col-md-6">
                                <input type="phone" readonly="" class="form-control disable" id="user_phone"
                                    value="0582686301">
                                <div class="form-text text-muted"><a style="display: inline-block; margin-top: 5px;"
                                        href="./doi-so-dien-thoai.html">Đổi số điện thoại</a></div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="user_name" class="col-md-2 offset-md-2 col-form-label">Tên hiển thị</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="user_name" name="name" value="van trung"
                                    placeholder="Ex: Nguyễn Văn A">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_email" class="col-md-2 offset-md-2 col-form-label">Email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="user_email" name="email" value=""
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_zalo" class="col-md-2 offset-md-2 col-form-label">Số Zalo</label>
                            <div class="col-md-6">
                                <input type="phone" class="form-control" id="user_zalo" name="user_zalo"
                                    value="0582686301">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_facebook" class="col-md-2 offset-md-2 col-form-label">Facebook</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="user_facebook" name="user_facebook" value=""
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="user_password" class="col-md-2 offset-md-2 col-form-label"
                                style="padding-top: 0;">Mật khẩu</label>
                            <div class="col-md-6">
                                <a class="" href="./doi-mat-khau.html">Đổi mật khẩu</a>
                            </div>
                        </div>


                        <div class="form-group row mt-5">
                            <label for="user_avatar" class="col-md-2 offset-md-2 col-form-label"
                                style="padding-top: 0;">Ảnh đại diện</label>
                            <div class="col-md-6">
                                <div class="user-avatar-upload-wrapper js-one-image-wrapper ">
                                    <div class="user-avatar-inner js-one-image-inner">
                                        <div class="user-avatar-preview js-one-image-preview"
                                            style="background: url(https://phongtro123.com/images/default-user.png) center no-repeat; background-size: cover;">
                                        </div>
                                    </div>
                                    <div class="user-avatar-upload clearfix">
                                        <a class="remove-image js-remove-one-image">Xóa hình này</a>
                                        <input type="file" class="btn-add-avatar js-change-image-file" multiple="">
                                        <input type="hidden" name="user_avatar" class="js-input-value" value="">
                                    </div>
                                </div> <!-- end one_featured_image_wrapper -->
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="user_email" class="col-md-2 col-form-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-lg mb-2 btn-block">Lưu &amp; Cập
                                    nhật</button>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="145617">
                    </form>


                    <br><br>

                </main>



            </div>
        </div>




    </div><!-- end webpage -->

</body>

</html>