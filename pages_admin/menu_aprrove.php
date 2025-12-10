<?php
require '../config.php';

$data = $koneksi->query("SELECT * FROM approve WHERE approved=0 ORDER BY id DESC");
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="fw-bold mb-3 text-primary">
                <i class="fa fa-check-circle"></i> Data Pending Approval
            </h3>
            <p class="text-muted mb-4">Berikut adalah daftar data yang menunggu persetujuan admin.</p>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jilid/Juz</th>
                            <th>Halaman</th> <th>Status</th>
                            <th>Kategori</th>
                            <th>Nama Ustadz</th> <th>Tanggal</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row = $data->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['kelas'] ?></td>
                            <td><?= $row['jilid'] ?></td>
                            <td><?= $row['halaman'] ?></td> <td>
                                <?php if ($row['status'] == 'lulus'): ?>
                                    <span class="badge bg-success">Lulus</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Tidak Lulus</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if ($row['kategori'] == 'juzama'): ?>
                                    <span class="badge bg-primary">Juz Amma</span>
                                <?php elseif ($row['kategori'] == 'alquran'): ?>
                                    <span class="badge bg-info text-dark">Al Qur'an</span>
                                <?php elseif ($row['kategori'] == 'yanbu'): ?>
                                    <span class="badge bg-warning text-dark">Yanbu'a</span>
                                <?php else: ?>
                                    <span class="badge bg-success text-dark">Tidak ada Kategori</span>
                                <?php endif; ?>
                            </td>
                            
                            <td><?= $row['nama_ustadz'] ?></td> <td><?= $row['tanggal'] ?></td>

                            <td>
                                <a href="approve.php?id=<?= $row['id'] ?>" 
                                    class="btn btn-success btn-sm me-1"
                                    onclick="return confirm('Yakin ingin menerima data ini?');"> <i class="fa fa-check"></i> Terima
                                </a>

                                <a href="approve.php?id=<?= $row['id'] ?>&tolak=1" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menolak data ini?');"> <i class="fa fa-times"></i> Tolak
                                </a>
                            </td>

                        </tr>
                        <?php endwhile; ?>

                        <?php if ($data->num_rows == 0): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3"> Tidak ada data menunggu approval.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">