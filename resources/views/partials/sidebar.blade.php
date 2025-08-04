<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-users"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Manajemen Employee</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Manage Employee -->
    <li class="nav-item {{ request()->is('employees') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage Employee</span>
        </a>
    </li>

    <!-- Assign Employee -->
    <li class="nav-item {{ request()->is('assignments') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('assignments.index') }}">
            <i class="bi bi-calendar-check"></i>
            <span>Assign Employee</span>
        </a>
    </li>

    <!-- History Assign -->
    <li class="nav-item {{ request()->is('employee/logs') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.logs') }}">
            <i class="bi bi-clock-history"></i>
            <span>History Assign</span>
        </a>
    </li>
</ul>

<!-- Overlay untuk mobile -->
<div id="sidebarOverlay" class="sidebar-overlay"></div>
