<?php
require("../middleware.php");
include("../koneksi.php");

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data tanaman berdasarkan ID
$query = "SELECT * FROM produk_kecantikan WHERE id_produk_kecantikan = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) < 1) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk Kecantikan</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="shop-products">
        <?php include("../layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("../layouts/header.php") ?>

            <section id="tambah-produk-kecantikan">
                <div class="form-container container">
                    <h2>Form Edit Produk Kecantikan</h2>

                    <form action="proses-edit-product.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <label for="nama_brand">Nama Brand</label>
                        <input type="text" id="nama_brand" name="nama_brand" value="<?= $data['nama_brand']  ?>" required>

                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" value="<?= $data['nama_produk']  ?>" required>

                        <label for="harga_produk">Harga Produk</label>
                        <input type="number" id="harga_produk" name="harga_produk" value="<?= $data['harga_produk']  ?>" required>

                        <label for="manfaat_produk">Manfaat Produk</label>
                        <textarea id="manfaat_produk" name="manfaat_produk" rows="3" required><?= $data['manfaat_produk'] ?></textarea>

                        <label for="kandungan_produk">Kandungan Produk</label>
                        <textarea id="kandungan_produk" name="kandungan_produk" rows="3" required><?= $data['kandungan_produk'] ?></textarea>

                        <label for="cara_pemakaian_produk">Cara Pemakaian</label>
                        <textarea id="cara_pemakaian_produk" name="cara_pemakaian_produk" rows="3" required><?= $data['cara_pemakaian_produk'] ?></textarea>

                        <label for="link_produk">Link Produk</label>
                        <input type="url" id="link_produk" name="link_produk" value="<?= $data['link_produk']  ?>" required>

                        <label for="gambar_produk">Gambar Produk</label>
                        <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*">

                        <img src="../uploads/<?= $data['gambar_produk'] ?>" alt="gambar tanaman" width="120">

                        <button type="submit" class="btn-kirim mt-4 ">Update Produk</button>
                    </form>
                    <form action="/admintemanramu/pages/hapus-gambar.php" method="post" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                        <input type="hidden" name="id" value="<?= $data['id_produk_kecantikan'] ?>">
                        <input type="hidden" name="gambar_lama" value="<?= $data['gambar_produk'] ?>">
                        <input type="hidden" name="tipe" value="produk">
                        <button type="submit" class="btn-kirim mt-2" style="background-color: red; color: white;">Hapus Gambar</button>
                    </form>

                </div>
            </section>
        </div>
    </section>
</body>

</html>
/