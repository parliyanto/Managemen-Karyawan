<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Tombol Hamburger Sidebar (Mobile) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Nav kanan -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item text-black">
            <span class="nav-link ">Halo, Saasten!</span>
        </li>
    </ul>
</nav>

<script>
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggleTop');

    // Default sidebar tertutup ketika halaman load
    document.addEventListener('DOMContentLoaded', () => {
        if (sidebar) sidebar.classList.add('toggled');
        if (overlay) overlay.classList.remove('active');
    });

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('toggled');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('toggled');
        overlay.classList.remove('active');
    });
</script>
