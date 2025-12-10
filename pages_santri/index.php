<?php
session_start();

if (!isset($_SESSION['users']) || $_SESSION['level'] != 'santri') {
    header("Location: ../login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Informasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <link rel="stylesheet" href="../assets/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg-color: #f8f9fa;
            --text-color: #333;
            --sidebar-bg: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            --card-bg: #fff;
        }
        [data-bs-theme="dark"] {
            --bg-color: #121212;
            --text-color: #e2e8f0;
            --sidebar-bg: linear-gradient(135deg, #0f1419 0%, #1e3a8a 100%);
            --card-bg: #1e1e1e;
        }
        body { font-family: 'Segoe UI', sans-serif; background-color: var(--bg-color); color: var(--text-color); transition: background-color 0.3s, color 0.3s; }
        .custom-sidebar { background: var(--sidebar-bg); box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
        .sidebar-menu .nav-icon { font-size: 1.4rem; margin-right: 10px; width: 25px; text-align: center; }
        .sidebar-menu .nav-link { color: #e2e8f0; transition: all 0.3s ease; border-radius: 8px; margin: 2px 8px; }
        .sidebar-menu .nav-link:hover { background-color: rgba(255,255,255,0.1); color: #fff; transform: translateX(5px); }
        .sidebar-menu .nav-link.active { background-color: rgba(255,255,255,0.2); color: #fff; }
        .nav-treeview { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .has-treeview.menu-open .nav-treeview { max-height: 500px; }
        .nav-treeview .nav-link { padding-left: 40px; font-size: 0.9rem; opacity: 0; transform: translateY(-10px); transition: all 0.3s ease; }
        .has-treeview.menu-open .nav-treeview .nav-link { opacity: 1; transform: translateY(0); }
        .nav-treeview .nav-link:hover { background-color: rgba(255,255,255,0.05); }
        .has-treeview > .nav-link i:last-child { transition: transform 0.3s ease; }
        .has-treeview.menu-open > .nav-link i:last-child { transform: rotate(90deg); }
        .navbar-custom { background-color: var(--card-bg); box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 0.6rem 1.5rem; }
        .dashboard-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 10px; }
        .card { display: flex; flex-direction: row-reverse; align-items: center; justify-content: space-between;
                background: var(--card-bg); border-radius: 16px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 4px 14px rgba(0,0,0,0.15); }
        .icon { font-size: 28px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%; }
        .icon.green { background-color: #e6f8ec; color: #2ecc71; }
        .icon.blue { background-color: #e6f0ff; color: #084872ff; }
        .icon.purple { background-color: #f2e6ff; color: #9b59b6; }
        .icon.orange { background-color: #fff4e6; color: #e67e22; }
        .profile-img { width: 40px; height: 40px; border-radius: 50%; }
        .theme-toggle { cursor: pointer; font-size: 1.2rem; margin-right: 10px; }
        .app-sidebar {
    transition: margin-left 0.3s ease;
}

body:not(.sidebar-open) .app-sidebar {
    margin-left: -260px; /* sembunyikan sidebar */
}

    </style>
</head>

<body class="sidebar-expand-lg sidebar-open bg-body-tertiary" data-bs-theme="light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-custom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- 🔘 Tombol Toggle Sidebar -->
        <i id="sidebar-toggle" class="bi bi-list fs-3 me-3" style="cursor:pointer;"></i>
            <div class="d-flex align-items-center gap-3">
                <span class="navbar-brand">Pengguna Santri</span>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-moon theme-toggle" id="theme-toggle" title="Toggle Dark Mode"></i>
            </div>
        </div>
    </nav>

<div class="app-wrapper">

    <!-- SIDEBAR -->
    <aside class="app-sidebar custom-sidebar shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="?p=dashboard_ustadz" class="brand-link">
                <img src="../assets/image/santripro.png" alt="Logo" height="45" width="45" class="rounded-circle img-fluid">
                <span class="brand-text fw-bold">SantriPro</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav>
                <ul class="nav sidebar-menu flex-column">
                    <li class="nav-item">
                        <a href="?p=dashboard_santri" class="nav-link">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" aria-expanded="false">
                            <i class="nav-icon bi bi-box-seam"></i>
                            <p>Catatan Prestasi <i class="bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li><a href="?p=data_yanbu_santri" class="nav-link"><i class="nav-icon bi bi-person-lines-fill"></i> Data Yanbu'a</a></li>
                            <li><a href="?p=data_juzama_santri" class="nav-link"><i class="nav-icon bi bi-book-half"></i> Data Juz'ama</a></li>
                            <li><a href="?p=data_alquran_santri" class="nav-link"><i class="nav-icon bi bi-journal-text"></i> Data Al Qur'an</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

<?php include '../route.php';  ?>
</div>

<!-- FOOTER -->
<footer class="app-footer text-center p-2">
    <strong>&copy; 2025 SantriPro.</strong>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/adminlte.js"></script>
<!-- Auto Active Menu and Theme Toggle -->
<script>
    // Active menu highlighting
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
            let parent = link.closest('.has-treeview');
            if (parent) parent.classList.add('menu-open');
        }
    });

    // Submenu toggle with ARIA
    document.querySelectorAll('.has-treeview > .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            let parent = this.parentElement;
            let isOpen = parent.classList.contains('menu-open');
            parent.classList.toggle('menu-open');
            this.setAttribute('aria-expanded', !isOpen);
        });
    });

    // Dark mode toggle
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', () => {
        const body = document.body;
        const currentTheme = body.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        body.setAttribute('data-bs-theme', newTheme);
        themeToggle.className = newTheme === 'dark' ? 'bi bi-sun theme-toggle' : 'bi bi-moon theme-toggle';
    });
        const sidebarToggle = document.getElementById('sidebar-toggle');
    const body = document.body;

    sidebarToggle.addEventListener('click', () => {
        body.classList.toggle('sidebar-open');
    });
</script>
</body>
</html>
