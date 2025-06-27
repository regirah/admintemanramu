<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("middleware.php");
include('koneksi.php');

// Tangkap input pencarian jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// ====================
// Query ulasan aktif
// ====================
$queryUlasan = "
    SELECT u.*, ap.nama_pengguna, ap.email_pengguna, th.nama_tanaman 
    FROM ulasan u 
    JOIN akun_pengguna ap ON u.id_pengguna = ap.id_pengguna
    JOIN tanaman_herbal th ON u.id_tanaman_herbal = th.id_tanaman_herbal
";

if (!empty($search)) {
    $queryUlasan .= " 
        WHERE ap.nama_pengguna LIKE '%$search%'
           OR ap.email_pengguna LIKE '%$search%'
           OR th.nama_tanaman LIKE '%$search%'
           OR u.isi_ulasan LIKE '%$search%'
           OR u.efektifitas_tanaman_herbal LIKE '%$search%'
           OR u.permasalahan_kecantikan LIKE '%$search%'
    ";
}

$queryUlasan .= " ORDER BY u.tanggal_ulasan DESC";
$resultUlasan = mysqli_query($koneksi, $queryUlasan);

// ====================
// Query riwayat hapus
// ====================
$queryRiwayat = "
    SELECT r.*, ap.nama_pengguna, th.nama_tanaman 
    FROM riwayat_hapus_ulasan r 
    JOIN akun_pengguna ap ON r.id_pengguna = ap.id_pengguna
    JOIN tanaman_herbal th ON r.id_tanaman_herbal = th.id_tanaman_herbal
";

if (!empty($search)) {
    $queryRiwayat .= " 
        WHERE ap.nama_pengguna LIKE '%$search%'
           OR th.nama_tanaman LIKE '%$search%'
           OR r.tanggal_hapus LIKE '%$search%'
           OR r.isi_ulasan LIKE '%$search%'
    ";
}

$queryRiwayat .= " ORDER BY r.tanggal_hapus DESC";
$resultRiwayat = mysqli_query($koneksi, $queryRiwayat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informasi Ulasan Produk Herbal</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("layouts/header.php") ?>

            <section>
                <!-- JUDUL & FORM PENCARIAN -->
                <div class="judul-informasi">
                    <h4>Informasi Ulasan Pengguna</h4>
                </div>

                <div class="header-riwayat-ulasan">
                    <h4>Riwayat Ulasan Pengguna</h4>
                    <form class="product-search-container" method="get">
                        <input type="text" class="product-search-bar" name="search" placeholder="Cari Informasi Ulasan atau Riwayat" value="<?= htmlspecialchars($search) ?>">
                        <?php if (!empty($search)) : ?>
                            <a href="?" class="btn btn-sm btn-secondary ms-2">Reset</a>
                        <?php else : ?>
                            <button class="search-btn">
                                <img src="images/search.png" alt="">
                            </button>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- TABEL ULASAN PENGGUNA -->
                <div class="riwayat-ulasan">
                    <table class="review-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Ulasan</th>
                                <th>Efektifitas</th>
                                <th>Tanaman Herbal</th>
                                <th>Tipe Kulit</th>
                                <th>Permasalahan Kecantikan</th>
                                <th>Umur Pengguna</th>
                                <th>Ulasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($resultUlasan) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($resultUlasan)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
                                        <td><?= htmlspecialchars($row['email_pengguna']) ?></td>
                                        <td><?= htmlspecialchars($row['tanggal_ulasan']) ?></td>
                                        <td><?= htmlspecialchars($row['efektifitas_tanaman_herbal']) ?></td>
                                        <td><?= htmlspecialchars($row['nama_tanaman']) ?></td>
                                        <td><?= htmlspecialchars($row['tipe_kulit']) ?></td>
                                        <td><?= htmlspecialchars($row['permasalahan_kecantikan']) ?></td>
                                        <td><?= htmlspecialchars($row['umur_pengguna']) ?></td>
                                        <td><?= htmlspecialchars($row['isi_ulasan']) ?></td>
                                        <td>
                                            <a href="proses_hapus_ulasan.php?id=<?= $row['id_ulasan'] ?>" onclick="return confirm('Yakin ingin menghapus ulasan ini?')">
                                                <button class="keterangan-ulasan">
                                                    <img src="images/bin.png" alt="Hapus">
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="10" class="text-center">Tidak ada ulasan ditemukan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- TABEL RIWAYAT HAPUS ULASAN -->
                <div class="judul-informasi mt-5">
                    <h4>Riwayat Hapus Ulasan</h4>
                </div>
                <div class="riwayat-ulasan">
                    <table class="review-table">
                        <thead class="table-secondary">
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Nama Tanaman</th>
                                <th>Tanggal Dihapus</th>
                                <th>Isi Ulasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($resultRiwayat) > 0): ?>
                                <?php while ($r = mysqli_fetch_assoc($resultRiwayat)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['nama_pengguna']) ?></td>
                                        <td><?= htmlspecialchars($r['nama_tanaman']) ?></td>
                                        <td><?= htmlspecialchars($r['tanggal_hapus']) ?></td>
                                        <td><?= htmlspecialchars($r['isi_ulasan']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center">Tidak ada riwayat hapus ditemukan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
</body>
</html>
