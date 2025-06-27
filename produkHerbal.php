<?php
require("middleware.php");
include("koneksi.php"); // sambungkan ke database

// Ambil semua data produk kecantikan dari tabel
$query = "SELECT id_produk_kecantikan, nama_brand, nama_produk, gambar_produk FROM produk_kecantikan";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = '%' . mysqli_real_escape_string($koneksi, $_GET['search']) . '%';
    $query = "SELECT id_produk_kecantikan, nama_brand, nama_produk, gambar_produk FROM produk_kecantikan WHERE nama_produk LIKE '$search'";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Herbal</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- ISI PRODUK -->
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>

        <div class="product-container">
            <?php include("layouts/header.php") ?>

            <!--TANAMAN HERBAL-->
            <section>
                <div class="judul-informasi">
                    <h4>Informasi Produk Kecantikan</h4>
                    <form class="product-search-container" method="get">
                        <input type="text" class="product-search-bar"
                            name="search"
                            placeholder="Cari Nama Produk..." />
                        <?php

                        if (isset($_GET['search'])) {
                            if (!empty($_GET['search'])) {
                        ?>
                                <button class="search-btn">
                                    Reset
                                </button>
                            <?php
                            } else {
                            ?>
                                <button class="search-btn">
                                    <img src="images/search.png" alt="Search Icon" />
                                </button>
                            <?php
                            }
                        } else {
                            ?>
                            <button class="search-btn">
                                <img src="images/search.png" alt="Search Icon" />
                            </button>
                        <?php
                        }

                        ?>
                    </form>
                    <button class="tambah-info-btn">
                        <a href="products/add">+ Tambah Produk</a>
                    </button>
                </div>

                <div class="grid-produkherbal">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="isi-produk">
                            <a href="products/detail?id=<?= $row['id_produk_kecantikan']; ?>">
                                <button>
                                    <img src="uploads/<?= htmlspecialchars($row['gambar_produk']); ?>" alt="">
                                    <h6><?= htmlspecialchars($row['nama_brand']); ?></h6>
                                    <p><?= htmlspecialchars($row['nama_produk']); ?></p>
                                </button>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
</body>

</html>