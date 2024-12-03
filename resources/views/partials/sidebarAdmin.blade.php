<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            {{-- ni beda kode karena ada sedikit permasalahan style badge notification dan jsnya juga ada perbedaan--}}
            <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.notification') }}" >
                        <i class="ti-bell menu-icon position-relative"></i>
                        <span class="menu-title">Notification</span>
                        <span id="notificationBadge" 
                            class="badge badge-danger notification-badge" 
                            style="display: {{ $unreadNotificationsCount > 0 ? 'inline-block' : 'none' }}; background-color: red; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 75%; line-height: 1; vertical-align: baseline; white-space: nowrap;">
                            {{ $unreadNotificationsCount > 0 ? $unreadNotificationsCount : '' }}
                        </span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Order</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ url('orderform') }}">Order Forms</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('orderhistory') }}">Offline History</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('online-history') }}">Online History</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                    <i class="icon-grid-2 menu-icon"></i>
                    <span class="menu-title">Data Collecting</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ url('stok') }}">Data Table</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>