<?php
require("middleware.php");
require("koneksi.php");

// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$query_top_tanaman = mysqli_query($koneksi, "
    SELECT nama_tanaman, terlihat_tanaman 
    FROM tanaman_herbal 
    ORDER BY terlihat_tanaman DESC 
    
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
    
");


$query_ulasan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_ulasan FROM ulasan");


$total_ulasan = mysqli_fetch_assoc($query_ulasan);

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

            <!-- TOTAL RANGKUMAN -->
            <section>
                    <!-- ULASAN TERBARU -->
                    <div class="top-categories mt-5">
                        <p>Ulasan Terbaru Pengguna</p>
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
