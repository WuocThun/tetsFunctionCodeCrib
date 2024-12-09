<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CodeCrib</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Phòng
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Đăng tin cho thuê phòng</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tin cho thuê phòng</h6>
                <a class="collapse-item" href="{{route('admin.roomsCore.createCore')}}">Đăng tin cho thuê phòng</a>
                <a class="collapse-item" href="{{route('admin.rooms.myRooms')}}">Phòng của tôi</a>
                @role('admin')
                <a class="collapse-item" href="{{route('admin.rooms.getPendingRooms')}}">Phòng đang đợi duyệt</a>
                <a class="collapse-item" href="{{route('admin.rooms.allRooms')}}">Danh sách các phòng</a>
                <a class="collapse-item" href="{{route('admin.room.report')}}">Thống kê phòng</a>
                @endrole
            </div>
        </div>
    </li>


    @role('admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1"
           aria-expanded="true" aria-controls="collapseTwo1">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý hợp đồng</span>
        </a>
        <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hợp đồng</h6>
                <a class="collapse-item" href="{{route('admin.roomsCore.createCore')}}">Đăng tin cho thuê phòng</a>
                <a class="collapse-item" href="{{route('admin.rooms.myRooms')}}">Phòng của tôi</a>
            </div>
        </div>
    </li>

    @endrole


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-hotel"></i>

            @role('houseRenter')
            <span>Quản lý dãy trọ</span>
            @endrole
            @role('admin')
            <span>Xem các phòng trọ</span>
            @endrole
            @role('viewer')
            <span>Phòng trọ của tôi</span>
            @endrole

        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Danh sách phòng trọ</h6>
                @role('viewer')
                <a class="collapse-item" href="{{route('admin.motel.access.form')}}">Phòng đã đăng ký</a>
                @endrole

                @role('admin|houseRenter')
                <a class="collapse-item" href="{{route('admin.motel.index')}}">Dãy trọ của tôi</a>
                <a class="collapse-item" href="{{route('admin.invoices.getIndexInvoice')}}">Hoá đơn điện nước</a>
                <a class="collapse-item" href="{{route('admin.invoices.motelReport')}}">Báo cáo tài chính</a>
                @endrole
                @role('admin')
                <h6 class="collapse-header">Nâng cao</h6>
                <a class="collapse-item" href="{{route('admin.statistics')}}">Báo cáo các phòng</a>
                @endrole
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Khác
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="far fa-calendar-alt"></i>
            <span>Sự kiện</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sự kiện</h6>
                <a class="collapse-item" href="#">Vòng quay may mắn</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Nạp tiền</h6>
                <a class="collapse-item" href="#">Nạp tiền vào tài khoản</a>
                <a class="collapse-item" href="#">Lịch sử nạp tiền</a>
                @role('admin')
                <a class="collapse-item" href="#">Báo cáo nạp tiền</a>
                @endrole
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
           aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-user-alt"></i>
            <span>Tài khoản</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý tài khoản</h6>
                <a class="collapse-item" href="#">Sửa thông tin cá nhân</a>
                <a class="collapse-item" href="#">Đổi mật khẩu</a>
                <div class="collapse-divider"></div>

            </div>
        </div>
    </li>

    @role('admin')
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Thống kê tài khoản</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Thống kê tin phòng</span></a>
    </li>
@endrole
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    {{--    <div class="text-center d-none d-md-inline">--}}
    {{--        <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
    {{--    </div>--}}


</ul>
