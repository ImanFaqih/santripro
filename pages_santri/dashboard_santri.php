<?php
require '../config.php';


$total_quran = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM alquran"));
$lulus_quran = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM alquran WHERE status='lulus'"));
$tdk_quran   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM alquran WHERE status='tidak lulus'"));


$total_yanbu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM yanbu"));
$lulus_yanbu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM yanbu WHERE status='lulus'"));
$tdk_yanbu   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM yanbu WHERE status='tidak lulus'"));


$total_juz   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM juzama"));
$lulus_juz   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM juzama WHERE status='lulus'"));
$tdk_juz     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM juzama WHERE status='tidak lulus'"));


$total_lulus_semua = $lulus_quran + $lulus_yanbu + $lulus_juz;
$total_tdk_semua   = $tdk_quran + $tdk_yanbu + $tdk_juz;
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>sistem Informasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#dbe5f0ff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#837f7fff" media="(prefers-color-scheme: dark)" />
    <link rel="preload" href="assets/css/adminlte.css" as="style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
          crossorigin="anonymous" media="print" onload="this.media='all'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
          crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
          crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/adminlte.css" />
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

<body>

 <!-- ========== MAIN CONTENT ========== -->
<main class="app-main">
  <div class="app-content">
    <div class="container-fluid">

    </div>
    <!-- Bagian Kotak Kecil di atas -->
    <div class="dashboard-cards">
      <div class="card">
        <div class="icon green"><i class="fas fa-solid fa-book-quran"></i></div>
        <div class="text">
            <h5>Al-Qur'an</h5>
            <p>Total: <b><?= $total_quran ?></b></p>
            <p>Lulus: <b><?= $lulus_quran ?></b></p>
            <p>Tidak Lulus: <b><?= $tdk_quran ?></b></p>
        </div>
      </div>

   <div class="card p-3 shadow-sm">
        <div class="icon blue"><i class="fas fa-solid fa-book-open"></i></div>
        <div class="text">
            <h5>Yanbu'</h5>
            <p>Total: <b><?= $total_yanbu ?></b></p>
            <p>Lulus: <b><?= $lulus_yanbu ?></b></p>
            <p>Tidak Lulus: <b><?= $tdk_yanbu ?></b></p>
        </div>
      </div>

<div class="card p-3 shadow-sm">
        <div class="icon purple"><i class="fas fa-solid fa-book"></i></div>
        <div class="text">
            <h5>Juz Amma</h5>
            <p>Total: <b><?= $total_juz ?></b></p>
            <p>Lulus: <b><?= $lulus_juz ?></b></p>
            <p>Tidak Lulus: <b><?= $tdk_juz ?></b></p>
        </div>
      </div>

        <div class="card p-3 shadow-sm bg-primary text-white">
            <h5>Total Lulus</h5>
            <h3><?= $total_lulus_semua ?></h3>
        </div>

        <div class="card p-3 shadow-sm bg-danger text-white">
            <h5>Total Tidak Lulus</h5>
            <h3><?= $total_tdk_semua ?></h3>
        </div>
    </div>
  </div>

</div>
</main>


    <!-- ========== FOOTER ========== -->

<!-- ========== SCRIPTS ========== -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
<script src="assets/js/adminlte.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Grafik Pengungjung (Rp)',
            data: [7500000, 8200000, 9500000, 8800000, 10200000, 12000000],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(230, 127, 25, 0.5)'
            ],
            borderWidth: 3,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        }
    }
});
</script>


</body>
</html>

