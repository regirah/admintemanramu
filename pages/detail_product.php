<?php
require("middleware.php");
include("koneksi.php"); // koneksi ke database

// Cek parameter ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='../products';</script>";
    exit;
}

$id = intval($_GET['id']);
$query = "SELECT * FROM produk_kecantikan WHERE id_produk_kecantikan = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Cek data ada atau tidak
if (!($data = mysqli_fetch_assoc($result))) {
    echo "<script>alert('Produk tidak ditemukan'); window.location.href='../produkHerbal';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['nama_produk']) ?> - Detail Produk Kecantikan</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("layouts/header.php") ?>

            <section>
                <div class="isidetailtanheb">
                    <div class="contenttanheb">
                        <img src="../uploads/<?= htmlspecialchars($data['gambar_produk']) ?>" alt="<?= htmlspecialchars($data['nama_produk']) ?>" width="300">
                        <div class="contentpenting">
                            <h5><?= htmlspecialchars($data['nama_brand']) ?></h5>
                            <h6><?= htmlspecialchars($data['nama_produk']) ?></h6>
                            <h6><strong>Harga:</strong> Rp<?= number_format($data['harga_produk'], 0, ',', '.') ?></h6>
                            <h6><strong>Link Produk:</strong> <a href="<?= htmlspecialchars($data['link_produk']) ?>" target="_blank"><?= htmlspecialchars($data['link_produk']) ?></a></h6>
                        </div>
                    </div>

                    <div class="dd-contentpenting">
                        <div class="dd-detail">
                            <button class="dd-button">
                                Manfaat Produk
                                <img src="/admintemanramu/images/down.png" alt="icon" class="dd-icon">
                            </button>
                            <div class="dd-content">
                                <p><?= nl2br(htmlspecialchars($data['manfaat_produk'])) ?></p>
                            </div>
                        </div>

                        <div class="dd-contentpenting">
                        <div class="dd-detail">
                            <button class="dd-button">
                                Kandungan Produk 
                                <img src="/admintemanramu/images/down.png" alt="icon" class="dd-icon">
                            </button>
                            <div class="dd-content">
                                <p><?= nl2br(htmlspecialchars($data['kandungan_produk'])) ?></p>
                            </div>
                        </div>

                        <div class="dd-detail">
                            <button class="dd-button">
                                Cara Pemakaian
                                <img src="/admintemanramu/images/down.png" alt="icon" class="dd-icon">
                            </button>
                            <div class="dd-content">
                                <p><?= nl2br(htmlspecialchars($data['cara_pemakaian_produk'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="edit-hapus">
                    <button class="edit-btn">
                        <a href="/admintemanramu/pages/edit-product.php?id=<?= $data['id_produk_kecantikan'] ?>">Edit Informasi</a>
                    </button>

                    <button class="hapus-btn">
                        <a href="/admintemanramu/pages/proses-hapus-product.php?id=<?= $data['id_produk_kecantikan'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus Informasi</a>
                    </button>
                </div>
            </section>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
</body>

</html>