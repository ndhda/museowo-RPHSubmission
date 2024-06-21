<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row text-center">
            <div class="nav-logo">
                <div class="nav-item theme-text">
                    <a href="{{ route('home') }}" class="nav-link"> {{ config('app.name', 'Laravel') }} </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories mt-4" id="accordionExample">
            <li class="menu {{ Route::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span>APPLICATIONS</span></div>
            </li>

            <li class="menu">
                <a href="" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="align-justify"></i>
                        <span>Module</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span>DEFAULT FUNCTION</span></div>
            </li>

            <li class="menu {{ Route::is('basic-crud.*') ? 'active' : '' }}">
                <a href="{{ route('basic-crud.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="corner-down-right"></i>
                        <span>Basic CRUD</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ Route::is('livewire-crud.*') ? 'active' : '' }}">
                <a href="{{ route('livewire-crud.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="corner-down-right"></i>
                        <span>Livewire CRUD</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>
