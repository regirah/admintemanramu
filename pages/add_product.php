<?php require("middleware.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Kecantikan</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("layouts/header.php") ?>

            <section id="tambah-produk-kecantikan">
                <div class="form-container container">
                    <h2>Form Tambah Produk Kecantikan</h2>

                    <form action="proses-add-product" method="post" enctype="multipart/form-data">

                        <label for="nama_brand">Nama Brand</label>
                        <input type="text" id="nama_brand" name="nama_brand" required>

                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" required>

                        <label for="harga_produk">Harga Produk</label>
                        <input type="number" id="harga_produk" name="harga_produk" required>

                        <label for="manfaat_produk">Manfaat Produk</label>
                        <textarea id="manfaat_produk" name="manfaat_produk" rows="3" required></textarea>

                        <label for="cara_pemakaian_produk">Cara Pemakaian</label>
                        <textarea id="cara_pemakaian_produk" name="cara_pemakaian_produk" rows="3" required></textarea>

                        <label for="link_produk">Link Produk</label>
                        <input type="url" id="link_produk" name="link_produk" required>

                        <label for="gambar_produk">Gambar Produk</label>
                        <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" required>

                        <button type="submit" class="btn-kirim">Unggah Produk</button>
                    </form>
                </div>
            </section>
        </div>
    </section>
</body>

</html>
/