<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">Saran</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.index') }}"><i class="fas fa-file-alt"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="@if(request()->is('dashboard')) active @endif">
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="@if(request()->is('dashboard/saran*')) active @endif">
                <a class="nav-link" href="{{ route('dashboard.saran.index') }}"><i class="fas fa-file-alt"></i>
                    <span>Saran</span></a>
            </li>
            @if (Auth::user()->isAdmin())
            <li class="menu-header">Master</li>
            <li class="@if(request()->is('dashboard/users*')) active @endif">
                <a class="nav-link" href="{{ route('dashboard.users.index') }}"><i class="fas fa-users"></i>
                    <span>Users</span></a>
            </li>
            <li class="@if(request()->is('dashboard/divisi*')) active @endif">
                <a class="nav-link" href="{{ route('dashboard.divisi.index') }}"><i class="fas fa-sitemap"></i>
                    <span>Divisi</span></a>
            </li>
            @endif
        </ul>
    </aside>
</div>
