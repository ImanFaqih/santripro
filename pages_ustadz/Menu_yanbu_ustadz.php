<?php
require '../config.php';

// Ambil data search
$keyword  = $_POST['keyword'] ?? '';
$category = $_POST['category'] ?? 1;

// Jika keyword diisi → jalankan search
if ($keyword != "") {

    if ($category == 1) { 
        // Nama
        $query = "SELECT * FROM yanbu WHERE nama LIKE '%$keyword%' ORDER BY id DESC";

    } elseif ($category == 2) { 
        // Kelas
        $query = "SELECT * FROM yanbu WHERE kelas LIKE '%$keyword%' ORDER BY id DESC";

    } elseif ($category == 3) { 
        // Jilid
        $query = "SELECT * FROM yanbu WHERE jilid LIKE '%$keyword%' ORDER BY id DESC";

    } elseif ($category == 4) { 
        // Status
        $query = "SELECT * FROM yanbu WHERE status LIKE '%$keyword%' ORDER BY id DESC";
    }

} else {
    // default tampil semua
    $query = "SELECT * FROM yanbu ORDER BY id DESC";
}

// Eksekusi query search (HANYA INI yang dipakai)
$data = $koneksi->query($query);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Yanbu'a</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f3f7ff;
            font-family: "Segoe UI", sans-serif;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            color: #1e3a8a;
        }

        .top-card {
            background: white;
            border-radius: 14px;
            padding: 16px 22px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-left: 5px solid #3b82f6;
        }

        .btn-add {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            color: white;
            transition: 0.3s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59,130,246,0.5);
        }

        .table-container {
            background: white;
            border-radius: 14px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        table thead {
            background: #1e3a8a;
            color: white;
        }

        table tbody tr:hover {
            background: #eef4ff !important;
            transition: 0.2s;
        }

        .btn-action-edit {
            background: #facc15;
            border: none;
            color: #000;
            padding: 5px 12px;
            border-radius: 6px;
        }

        .btn-action-delete {
            background: #ef4444;
            border: none;
            color: white;
            padding: 5px 12px;
            border-radius: 6px;
        }

        .search-box {
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
             .navbar-custom { background-color: var(--card-bg); box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 0.6rem 1.5rem; }
    </style>
</head>

<body>
<div class="container mt-4">

    <h2 class="page-title mb-2">Data Juz'Amma</h2>

    <div class="top-card mb-3">
        <div class="d-flex justify-content-between align-items-center">

        <a href="?p=tambah_data_ustadz" class="btn-add">
            <i class="fa fa-plus"></i> Tambah Data
        </a>
    </div>
</div>

<form method="post" class="d-flex gap-2 mb-3">
    <input type="text" name="keyword" placeholder="Cari..." class="form-control search-box" style="max-width:300px;" />

    <select name="category" class="form-select" style="max-width:200px;">
        <option value="1">Nama</option>
        <option value="2">Kelas</option>
        <option value="3">Jilid</option>
        <option value="4">Status</option>
    </select>

    <button type="submit" class="btn btn-primary">Search</button>
</form>

    <div class="table-container">
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jilid/Juz</th>
                    <th>Status</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
              <tbody>
<?php
require '../config.php';
$no = 1;
while ($row = $data->fetch_assoc()) {
?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['kelas']; ?></td>
        <td><?= $row['jilid']; ?></td>

        <td>
            <?php if ($row['status'] == 'lulus') echo '<span class="badge bg-warning text-dark">lulus</span>'; ?>
            <?php if ($row['status'] == 'tidak lulus') echo '<span class="badge bg-secondary">tidak lulus</span>'; ?>
        </td>

        <td><?= $row['tanggal']; ?></td>

    </tr>
<?php } ?>
</tbody>
            </tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function filterTable() {
    let filter = document.getElementById('searchInput').value.toLowerCase();
    let rows = document.querySelectorAll('#dataTable tbody tr');
    rows.forEach(r => {
        r.style.display = r.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
}
</script>
</body>
</html>