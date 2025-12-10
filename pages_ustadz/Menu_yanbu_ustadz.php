<?php
require '../config.php';

// Ambil data search
$keyword  = $_POST['keyword'] ?? '';
$category = $_POST['category'] ?? 1;

// Inisialisasi variabel query
$query = "SELECT * FROM yanbu ORDER BY id DESC";

// Jika keyword diisi → jalankan search
if ($keyword != "") {

    // Sanitize input untuk keamanan dasar
    $safe_keyword = $koneksi->real_escape_string($keyword);

    // Tentukan kolom berdasarkan kategori
    $column = '';
    if ($category == 1) { 
        $column = 'nama';
    } elseif ($category == 2) { 
        $column = 'kelas';
    } elseif ($category == 3) { 
        $column = 'jilid';
    } elseif ($category == 4) { 
        $column = 'status';
    }

    // Buat query pencarian
    if ($column) {
        $query = "SELECT * FROM yanbu WHERE $column LIKE '%$safe_keyword%' ORDER BY id DESC";
    }
}

// Eksekusi query
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

        .btn-add {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            color: white;
            transition: 0.3s;
            text-decoration: none;
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
            text-decoration: none;
        }

        .btn-action-delete {
            background: #ef4444;
            border: none;
            color: white;
            padding: 5px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .search-box {
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>
<div class="container mt-4">

    <h2 class="page-title mb-2">Data Yanbu'a</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="tambah_data_yanbu_ustadz.php" class="btn-add"> 
            <i class="fa fa-plus-circle me-1"></i> Tambah Data
        </a>
    </div>

    <form method="post" class="d-flex gap-2 mb-3">
        <input type="text" name="keyword" placeholder="Cari..." class="form-control search-box" style="max-width:300px;" value="<?= htmlspecialchars($keyword); ?>" />

        <select name="category" class="form-select" style="max-width:200px;">
            <option value="1" <?= $category == 1 ? 'selected' : '' ?>>Nama</option>
            <option value="2" <?= $category == 2 ? 'selected' : '' ?>>Kelas</option>
            <option value="3" <?= $category == 3 ? 'selected' : '' ?>>Jilid</option>
            <option value="4" <?= $category == 4 ? 'selected' : '' ?>>Status</option>
        </select>

        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?p=data_yanbu_ustadz" class="btn btn-secondary">Reset</a>
    </form>

    <div class="table-container">
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jilid/Juz</th>
                    <th>Halaman</th> <th>Status</th>
                    <th>Nama Ustadz</th> <th>Tanggal Input</th>
                    <th width="150">Aksi</th> </tr>
            </thead>
            <tbody>
<?php
$no = 1;
// Menggunakan variabel $data yang sudah dieksekusi di awal script
while ($row = $data->fetch_assoc()) {
?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['kelas']; ?></td>
        <td><?= $row['jilid']; ?></td>
        <td><?= $row['halaman']; ?></td> <td>
            <?php if ($row['status'] == 'lulus') echo '<span class="badge bg-warning text-dark">lulus</span>'; ?>
            <?php if ($row['status'] == 'tidak lulus') echo '<span class="badge bg-secondary">tidak lulus</span>'; ?>
        </td>

        <td><?= $row['nama_ustadz']; ?></td> <td><?= $row['tanggal']; ?></td>

        <td>
            <a href="edit_data_yanbu_ustadz.php?id=<?= $row['id']; ?>" class="btn-action-edit btn-sm me-1" title="Edit Data">
                <i class="fa fa-edit"></i>
            </a>
            <a href="hapus_data_yanbu_ustadz.php?id=<?= $row['id']; ?>" class="btn-action-delete btn-sm" title="Hapus Data" onclick="return confirm('Yakin ingin menghapus data ini?');">
                <i class="fa fa-trash"></i>
            </a>
        </td>

    </tr>
<?php } ?>
<?php if ($data->num_rows == 0): ?>
    <tr>
        <td colspan="9" class="text-center text-muted py-3">Tidak ada data ditemukan.</td>
    </tr>
<?php endif; ?>
</tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>