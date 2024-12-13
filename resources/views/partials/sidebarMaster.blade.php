<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('masterdata/home') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('masterdata/manage') }}">
                    <i class="fas fa-boxes menu-icon"></i>
                    <span class="menu-title">Manage Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Master data</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ url('') }}">Data User</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="{{ url('masterdata/admin') }}">Data Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('masterdata/penjualan') }}">Data Penjualan</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
{{-- </div> --}}
