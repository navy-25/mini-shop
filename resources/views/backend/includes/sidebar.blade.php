<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-flex active" aria-current="page" href="#">
                    <i data-feather="home" class="align-text-bottom my-auto me-2"></i>
                    <span style="padding-top:3px !important" class="p-0 my-auto">Dashboard</span>
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Saved reports</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link d-flex" href="#">
                    <i data-feather="file-text" class="align-text-bottom my-auto me-2"></i>
                    <span style="padding-top:3px !important" class="p-0 my-auto">Current month</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a class="nav-link d-flex" aria-current="page"href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-out" class="align-text-bottom my-auto me-2"></i>
                    <span style="padding-top:3px !important" class="p-0 my-auto">Keluar</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
