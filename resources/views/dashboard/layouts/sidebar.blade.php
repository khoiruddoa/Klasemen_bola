<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard/categories">
                    
                    Klub
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/pertandingan*') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard/pertandingan">
                    
                    Pertandingan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/multiple*') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard/multiple">
                    Multiple Pertandingan
                </a>
            </li>
        </ul>
    </div>
</nav>
