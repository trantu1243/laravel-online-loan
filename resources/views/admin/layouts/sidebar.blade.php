<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Page</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->



            <li class="nav-item">
                <a href="/admin" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/contract-template" class="nav-link {{ Route::currentRouteName() == 'contract-template' ? 'active' : '' }}">
                    <i class="nav-icon fa fa-file-pdf-o"></i>
                    <p>Hợp đồng điện tử</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/setting/loan" class="nav-link {{ Route::currentRouteName() == 'loan-setting' ? 'active' : '' }}">
                    <i class="fa fa-money nav-icon"></i>
                    <p>Các gói vay</p>
                </a>
            </li>

            @if(auth()->user()->role === 'ADMIN')
                <li class="nav-item {{ Route::currentRouteName() == 'settings' || Route::currentRouteName() == 'customer-setting' || Route::currentRouteName() == 'show-code' || Route::currentRouteName() == 'show-others' || Route::currentRouteName() == 'form-setting' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>Giao diện và cài đặt
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/setting" class="nav-link {{ Route::currentRouteName() == 'settings' ? 'active' : '' }}">
                                <i class="fa fa-genderless nav-icon"></i>
                                <p>Chung</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/admin/setting/form" class="nav-link {{ Route::currentRouteName() == 'form-setting' ? 'active' : '' }}">
                                <i class="fa fa-genderless nav-icon"></i>
                                <p>Form</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="/admin/setting/customer" class="nav-link {{ Route::currentRouteName() == 'customer-setting' ? 'active' : '' }}">
                                <i class="fa fa-genderless nav-icon"></i>
                                <p>Đánh giá</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/admin/setting/code" class="nav-link {{ Route::currentRouteName() == 'show-code' ? 'active' : '' }}">
                                <i class="fa fa-genderless nav-icon"></i>
                                <p>Thêm code</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/admin/setting/others" class="nav-link {{ Route::currentRouteName() == 'show-others' ? 'active' : '' }}">
                                <i class="fa fa-genderless nav-icon"></i>
                                <p>Khác</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'show-user' || Route::currentRouteName() == 'add-user' ? 'menu-open' : '' }}">
                    <a href="" class="nav-link {{ Route::currentRouteName() == 'show-user' || Route::currentRouteName() == 'add-user' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/user" class="nav-link {{ Route::currentRouteName() == 'show-user' ? 'active' : '' }}">
                            <i class="fa fa-genderless nav-icon"></i>
                            <p>Danh sách user</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/add-user" class="nav-link {{ Route::currentRouteName() == 'add-user' ? 'active' : '' }}">
                            <i class="fa fa-genderless nav-icon"></i>
                            <p>Thêm user</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif


            @if(auth()->user()->role === 'ADMIN' || auth()->user()->role === 'SALE')
                <li class="nav-header">SALE</li>
                <li class="nav-item">
                    <a href="/admin/sale" class="nav-link {{ Route::currentRouteName() == 'show-sale' ? 'active' : '' }}">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Danh sách khách hàng</p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->role === 'ADMIN' || auth()->user()->role === 'CENSOR')
                <li class="nav-header">Kiểm duyệt viên</li>
                <li class="nav-item">
                    <a href="/admin/censor" class="nav-link {{ Route::currentRouteName() == 'show-censor' ? 'active' : '' }}">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Danh sách khách hàng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/censor/reminder" class="nav-link {{ Route::currentRouteName() == 'show-reminder' ? 'active' : '' }}">
                        <i class="fa fa-calendar nav-icon"></i>
                        <p>Bộ nhắc nhở</p>
                    </a>
                </li>
            @endif

            <li class="nav-header">ACTIONS</li>
            <li class="nav-item">
                <a href="/admin/logout" class="nav-link">
                    <i class="nav-icon fa fa-sign-out"></i>
                    <p>Đăng xuất</p>
                </a>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
