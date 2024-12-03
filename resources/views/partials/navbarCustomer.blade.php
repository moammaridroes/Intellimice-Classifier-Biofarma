<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ url('/customer/home') }}">
            <img src="{{ asset('images/Logo_Bio_Farma.png') }}" style="width: 65%; height: 65%;" class="mr-2" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/customer/home') }}">
            <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="logo" />
        </a>
    </div>

    
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
        <!-- Tombol untuk tampilan mobile -->
        <span class="mobile-menu-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </span>

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <div class="d-flex align-items-center ml-auto">
            <div class="nav-item dropdown mr-4">
                <a class="nav-link p-0" href="#" data-toggle="dropdown" id="languageDropdown">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="black" d="m12 22l-1-3H4q-.825 0-1.412-.587T2 17V4q0-.825.588-1.412T4 2h6l.875 3H20q.875 0 1.438.563T22 7v13q0 .825-.562 1.413T20 22zm-4.85-7.4q1.725 0 2.838-1.112T11.1 10.6q0-.2-.012-.362t-.063-.338h-3.95v1.55H9.3q-.2.7-.763 1.088t-1.362.387q-.975 0-1.675-.7T4.8 10.5t.7-1.725t1.675-.7q.45 0 .85.163t.725.487L9.975 7.55Q9.45 7 8.712 6.7T7.15 6.4q-1.675 0-2.863 1.188T3.1 10.5t1.188 2.913T7.15 14.6m6.7.5l.55-.525q-.35-.425-.637-.825t-.563-.85zm1.25-1.275q.7-.825 1.063-1.575t.487-1.175h-3.975l.3 1.05h1q.2.375.475.813t.65.887M13 21h7q.45 0 .725-.288T21 20V7q0-.45-.275-.725T20 6h-8.825l1.175 4.05h1.975V9h1.025v1.05H19v1.025h-1.275q-.25.95-.75 1.85T15.8 14.6l2.725 2.675L17.8 18l-2.7-2.7l-.9.925L15 19z"/></svg>
                        {{-- <span style="color: black;">@lang('messages.languages')</span> --}}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="languageDropdown">
                    <a class="dropdown-item" href="{{ url('locale/en') }}">English</a>
                    <a class="dropdown-item" href="{{ url('locale/id') }}">Bahasa Indonesia</a>
                </div>
            </div>

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
    </div>
</nav>