<?php
require("middleware.php");
require("koneksi.php");

// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Query total pengunjung
$query_total_pengunjung = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pengunjung FROM pengunjung");
$total_pengunjung = mysqli_fetch_assoc($query_total_pengunjung);

// Query pengunjung per bulan (tahun berjalan)
$query_grafik_pengunjung = mysqli_query($koneksi, "
    SELECT MONTH(waktu_kunjungan) AS bulan, COUNT(*) AS jumlah
    FROM pengunjung
    WHERE YEAR(waktu_kunjungan) = YEAR(CURDATE())
    GROUP BY MONTH(waktu_kunjungan)
");

$bulan_pengunjung = [];
$jumlah_pengunjung = [];

while ($row = mysqli_fetch_assoc($query_grafik_pengunjung)) {
    $bulan_pengunjung[] = DateTime::createFromFormat('!m', $row['bulan'])->format('M');
    $jumlah_pengunjung[] = $row['jumlah'];
}
$query_grafik_ulasan = mysqli_query($koneksi, "
    SELECT MONTH(tanggal_ulasan) AS bulan, COUNT(*) AS jumlah
    FROM ulasan
    WHERE YEAR(tanggal_ulasan) = YEAR(CURDATE())
    GROUP BY MONTH(tanggal_ulasan)
");

$bulan_ulasan = [];
$jumlah_ulasan = [];

while ($row = mysqli_fetch_assoc($query_grafik_ulasan)) {
    $bulan_ulasan[] = DateTime::createFromFormat('!m', $row['bulan'])->format('M');
    $jumlah_ulasan[] = $row['jumlah'];
}

// Query data lainnya
$query_top_produk = mysqli_query($koneksi, "
    SELECT nama_brand, nama_produk, terlihat_produk 
    FROM produk_kecantikan 
    ORDER BY terlihat_produk DESC 
    LIMIT 5
");

$query_top_tanaman = mysqli_query($koneksi, "
    SELECT nama_tanaman, terlihat_tanaman 
    FROM tanaman_herbal 
    ORDER BY terlihat_tanaman DESC 
    LIMIT 5
");

$query = mysqli_query($koneksi, "
    SELECT 
        u.*, 
        ap.nama_pengguna, 
        ap.email_pengguna, 
        th.nama_tanaman
    FROM ulasan u
    JOIN akun_pengguna ap ON u.id_pengguna = ap.id_pengguna
    JOIN tanaman_herbal th ON u.id_tanaman_herbal = th.id_tanaman_herbal
    WHERE u.is_deleted = 0
    ORDER BY u.tanggal_ulasan DESC
    LIMIT 10
");

$query_tanaman = mysqli_query($koneksi, "SELECT COUNT(*) AS total_tanaman FROM tanaman_herbal");
$query_produk = mysqli_query($koneksi, "SELECT COUNT(*) AS total_produk FROM produk_kecantikan");
$query_ulasan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_ulasan FROM ulasan");
$query_grafik_ulasan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_ulasan FROM ulasan");

$total_tanaman = mysqli_fetch_assoc($query_tanaman);
$total_produk = mysqli_fetch_assoc($query_produk);
$total_ulasan = mysqli_fetch_assoc($query_ulasan);
$total_grafik_ulasan = mysqli_fetch_assoc($query_grafik_ulasan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- ISI PRODUK -->
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>

        <div class="product-container">
            <?php include("layouts/header.php") ?>



            <!-- TOTAL RANGKUMAN -->
            <section>
                <div class="overview-grid">
                    <div class="ov-ulasan">
                        <h4>Total Ulasan Pengguna</h4>
                        <h5><?= $total_ulasan['total_ulasan']  ?></h5>
                    </div>
                    <div class="ov-tanheb">
                        <h4>Total Tanaman Herbal</h4>
                        <h5><?= $total_tanaman['total_tanaman']  ?></h5>
                    </div>
                    <div class="ov-produkherbal">
                        <h4>Total Produk Herbal</h4>
                        <h5><?= $total_produk['total_produk']  ?></h5>
                    </div>
                    <div class="ov-produkherbal">
                        <h4>Total Pengunjung</h4>
                        <h5><?= $total_pengunjung['total_pengunjung'] ?></h5>
                    </div>
                </div>

                <!-- CHART -->
                <div class="statistics">
                    <div class="stat-item">
                        <h3>Ulasan Pengguna (Grafik Per Bulan)</h3>
                        <canvas id="reviewsChart"></canvas>
                    </div>
                    <div class="stat-item">
                        <h3>Total Pengunjung (Grafik Per Bulan)</h3>
                        <canvas id="herbsChart"></canvas>
                    </div>
                </div>

                <!-- TOP TANAMAN -->
                <section class="admin-dashboard">
                    <div class="top-categories">
                        <p>Top 5 Kategori Tanaman Herbal yang Sering Dicari</p>
                        <a href="terlihat-tanheb.php">
                            <button>Lihat Detail</button>
                        </a>
                        <table class="review-table">
                            <thead>
                                <tr><th>No.</th><th>Nama Tanaman</th><th>Jumlah Terlihat</th></tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_assoc($query_top_tanaman)) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_tanaman']) ?></td>
                                        <td><?= intval($row['terlihat_tanaman']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- TOP PRODUK -->
                    <div class="top-categories">
                        <p>Top 5 Produk Kecantikan Tanaman Herbal yang Sering Dicari</p>
                        <a href="terlihat-produk.php">
                            <button>Lihat Detail</button>
                        </a>
                        <table class="review-table">
                            <thead>
                                <tr><th>No.</th><th>Nama Brand</th><th>Nama Produk</th><th>Jumlah Terlihat</th></tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($data = mysqli_fetch_assoc($query_top_produk)) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($data['nama_brand']) ?></td>
                                        <td><?= htmlspecialchars($data['nama_produk']) ?></td>
                                        <td><?= intval($data['terlihat_produk']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ULASAN TERBARU -->
                    <div class="top-categories mt-5">
                        <p>Ulasan Terbaru Pengguna</p>
                        <a href="detail-pengguna.php">
                            <button>Lihat Detail</button>
                        </a>
                        <table class="review-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Tanaman Herbal</th>
                                    <th>Efektifitas</th>
                                    <th>Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($query) > 0): ?>
                                    <?php $no = 1; while ($ulasan = mysqli_fetch_assoc($query)): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($ulasan['nama_pengguna']) ?></td>
                                            <td><?= htmlspecialchars($ulasan['nama_tanaman']) ?></td>
                                            <td>
                                                <?php
                                                switch ($ulasan['efektifitas_tanaman_herbal']) {
                                                    case 3: echo "Sangat Efektif"; break;
                                                    case 2: echo "Agak Efektif"; break;
                                                    case 1: echo "Tidak Efektif"; break;
                                                    default: echo "-";
                                                }
                                                ?>
                                            </td>
                                            <td><?= nl2br(htmlspecialchars($ulasan['isi_ulasan'])) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">Belum ada ulasan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>
        </div>
    </section>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
    <script>
        const bulanPengunjung = <?= json_encode($bulan_pengunjung) ?>;
        const jumlahPengunjung = <?= json_encode($jumlah_pengunjung) ?>;
        const bulanUlasan = <?= json_encode($bulan_ulasan) ?>;
        const jumlahUlasan = <?= json_encode($jumlah_ulasan) ?>;
        document.addEventListener("DOMContentLoaded", function () {
            // Chart Ulasan (Real DB)
            const ctxReviews = document.getElementById("reviewsChart").getContext("2d");
            new Chart(ctxReviews, {
                type: "bar",
                data: {
                    labels: bulanUlasan,
                    datasets: [{
                        label: "Ulasan Pengguna",
                        data: jumlahUlasan,
                        backgroundColor: "#317256",
                        borderColor: "#317256",
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // Chart Pengunjung (Real DB)
            const ctxPengunjung = document.getElementById("herbsChart").getContext("2d");
            new Chart(ctxPengunjung, {
                type: "line",
                data: {
                    labels: bulanPengunjung,
                    datasets: [{
                        label: "Jumlah Pengunjung",
                        data: jumlahPengunjung,
                        borderColor: "#f25252",
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: { responsive: true, scales: { y: { beginAtZero: true } } }
            });
        });
    </script>
</body>
</html>
