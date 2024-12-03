<!-- Navbar -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row shadow-sm">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}">
            <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        
        <div class="nav-item dropdown" style="border: 0.5px solid #5c5252; border-radius: 5px; padding: 5px;">
            <a href="#" id="profileDropdown" data-toggle="dropdown" aria-expanded="false" style="cursor: pointer; color: transparent;">
                <img src="{{ asset('images/profile.png') }}" alt="Profile Icon" style="width: 25px; height: 25px; ">
                <span class="text-black font-weight">
                    {{ Auth::user()->name }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>