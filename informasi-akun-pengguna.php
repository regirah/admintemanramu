<?php
require("middleware.php");
include("koneksi.php");

// Ambil input pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Query dengan filter pencarian jika ada input
if (!empty($search)) {
    $query = "
        SELECT 
            ap.id_pengguna,
            ap.nama_pengguna,
            ap.email_pengguna,
            (
                SELECT COUNT(*) 
                FROM ulasan u 
                WHERE u.id_pengguna = ap.id_pengguna
            ) AS jumlah_ulasan
        FROM akun_pengguna ap
        WHERE ap.nama_pengguna LIKE '%$search%'
           OR ap.email_pengguna LIKE '%$search%'
           OR ap.id_pengguna IN (
                SELECT u.id_pengguna 
                FROM ulasan u 
                WHERE u.isi_ulasan LIKE '%$search%'
            )
        ORDER BY ap.id_pengguna ASC
    ";
} else {
    $query = "
        SELECT 
            ap.id_pengguna,
            ap.nama_pengguna,
            ap.email_pengguna,
            (
                SELECT COUNT(*) 
                FROM ulasan u 
                WHERE u.id_pengguna = ap.id_pengguna
            ) AS jumlah_ulasan
        FROM akun_pengguna ap
        ORDER BY ap.id_pengguna ASC
    ";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Pengguna</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="shop-products">
        <?php include("layouts/sidebar.php"); ?>

        <div class="product-container">
            <?php include("layouts/header.php"); ?>

            <section>
                <div class="judul-informasi">
                    <h4>Informasi Akun Pengguna</h4>
                </div>
                <form class="product-search-container" method="get">
                    <input type="text" class="product-search-bar" name="search" placeholder="Cari Nama Pengguna atau Ulasan" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                    <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                        <a href="?" class="btn btn-sm btn-secondary ms-2">Reset</a>
                    <?php else: ?>
                        <button class="search-btn">
                            <img src="images/search.png" alt="Search Icon" />
                        </button>
                    <?php endif; ?>
                </form>

                <table class="review-table">
                    <thead>
                        <tr>
                            <th>ID Pengguna</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Jumlah Ulasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id_pengguna']) ?></td>
                                <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
                                <td><?= htmlspecialchars($row['email_pengguna']) ?></td>
                                <td><?= $row['jumlah_ulasan'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
</body>

</html>
