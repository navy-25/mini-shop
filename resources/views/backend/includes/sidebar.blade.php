<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            @foreach (config('menu') as $key => $value)
                <li class="nav-item">
                    <a class="nav-link d-flex py-2 {{ activeMenu($value['route']) }}" aria-current="page" href="{{ route($value['route']) }}">
                        <i data-feather="{{ $value['icon'] }}" class="align-text-bottom my-auto me-2 text-light"></i>
                        <span style="padding-top:3px !important" class="p-0 my-auto text-light">{{ $value['name'] }}</span>
                    </a>
                </li>
            @endforeach
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a class="nav-link py-2 d-flex" aria-current="page"href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-out" class="align-text-bottom my-auto me-2 text-light"></i>
                    <span style="padding-top:3px !important" class="p-0 my-auto text-light">Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
