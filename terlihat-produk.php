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


// Query data lainnya
$query_top_produk = mysqli_query($koneksi, "
    SELECT nama_brand, nama_produk, terlihat_produk 
    FROM produk_kecantikan 
    ORDER BY terlihat_produk DESC 
    LIMIT 10
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

$query_produk = mysqli_query($koneksi, "SELECT COUNT(*) AS total_produk FROM produk_kecantikan");



$total_produk = mysqli_fetch_assoc($query_produk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("layouts/header.php") ?>

            <!-- Profil Admin -->
            <section id="profil-admin" class="content-section">
                <div class="isiprofilPengguna">
                    <div class="profilPengguna">
                        <div class="nama-profil">
                            <h5>Profil Admin</h5>
                            <p>Email Anda</p>
                            <p>Kode Anggota</p>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                    <!-- TOP PRODUK -->
                    <div class="top-categories">
                        <p>Produk Kecantikan yang Sering Dicari</p>
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
                    
                    </div>
                </section>
            </section>
        </div>
    </section>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
