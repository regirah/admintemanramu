<?php
require("middleware.php");
include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produk Herbal</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Sidebar -->
    <section class="shop-products">
        <?php include("layouts/sidebar.php"); ?>

        <div class="product-container">
            <!-- Header -->
            <?php include("layouts/header.php"); ?>

            <!-- Section: Informasi Tanaman Herbal -->
            <section>
                <div class="judul-informasi">
                    <h4>Informasi Tanaman Herbal</h4>

                    <!-- Search Bar -->
                    <form class="product-search-container" method="get">
                        <input type="text" class="product-search-bar" name="search" placeholder="Cari Nama Tanaman atau Nama Latin..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                        <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                            <a href="?" class="btn btn-sm btn-secondary ms-2">Reset</a>
                        <?php else: ?>
                            <button class="search-btn">
                                <img src="images/search.png" alt="Search Icon" />
                            </button>
                        <?php endif; ?>
                    </form>

                    <!-- Button Tambah -->
                    <button class="tambah-info-btn">
                        <a href="tanaman-herbal/add">+ Tambah Tanaman</a>
                    </button>
                </div>

                <!-- Daftar Tanaman Herbal -->
                <div class="info-tanheb d-flex flex-wrap">
                    <?php
                    $query = "SELECT id_tanaman_herbal, nama_tanaman, nama_latin_tanaman, gambar_tanaman, terlihat_tanaman FROM tanaman_herbal";

                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = '%' . mysqli_real_escape_string($koneksi, $_GET['search']) . '%';
                        $query = "
                            SELECT id_tanaman_herbal, nama_tanaman, nama_latin_tanaman, gambar_tanaman, terlihat_tanaman 
                            FROM tanaman_herbal 
                            WHERE nama_tanaman LIKE '$search' OR nama_latin_tanaman LIKE '$search'
                        ";
                    }

                    $result = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="isi-tanheb m-2 text-center">
                                <a href="/admintemanramu/tanaman-herbal/detail?id=<?= $row['id_tanaman_herbal'] ?>">
                                    <img src="uploads/<?= htmlspecialchars($row['gambar_tanaman'] ?: 'default.jpg') ?>" alt="<?= htmlspecialchars($row['nama_tanaman']) ?>" style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;" />
                                </a>
                                <p><?= htmlspecialchars($row['nama_tanaman']) ?></p>
                                <p><em><?= htmlspecialchars($row['nama_latin_tanaman']) ?></em></p>
                                <p class="terlihat"><?= intval($row['terlihat_tanaman']) ?> Melihat</p>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p class='ms-3'>Tidak ada data tanaman herbal yang cocok.</p>";
                    }
                    ?>
                </div>
            </section>
        </div>
    </section>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
</body>

</html>
