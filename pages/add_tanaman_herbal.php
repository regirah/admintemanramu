<?php require("middleware.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Herbal</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <!-- ISI PRODUK -->
    <section class="shop-products">
        <?php include("layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("layouts/header.php") ?>

            <!--TANAMAN HERBAL-->
            <section id="tambah-info-tanheb">
                <div class="form-container">
                    <h2>Form Informasi Tanaman Herbal</h2>
                    <form action="proses-add-tanheb" method="post" enctype="multipart/form-data">
                        <!-- Nama Tanaman -->
                        <div class="form-group">
                            <label for="nama_tanaman">Nama Tanaman</label>
                            <input type="text" id="nama_tanaman" name="nama_tanaman" placeholder="Masukkan Nama Tanaman" required>
                        </div>

                        <!-- Nama Latin Tanaman -->
                        <div class="form-group">
                            <label for="nama_latin">Nama Latin Tanaman</label>
                            <input type="text" id="nama_latin" name="nama_latin" placeholder="Masukkan Nama Latin Tanaman" required>
                        </div>

                        <!-- Deskripsi Tanaman -->
                        <div class="form-group">
                            <label for="deskripsi_tanaman">Pemerian</label>
                            <textarea id="deskripsi_tanaman" name="deskripsi_tanaman" placeholder="Masukkan Deskripsi Tanaman" required></textarea>
                        </div>

                        <!-- Taksonomi -->
                        <div class="form-group">
                            <label for="taksonomi">Taksonomi</label>
                            <input type="text" id="taksonomi" name="taksonomi" placeholder="Masukkan Taksonomi Tanaman" required>
                        </div>

                        <!-- Nama Simplisia -->
                        <div class="form-group">
                            <label for="simplisia">Nama Simplisia</label>
                            <input type="text" id="simplisia" name="simplisia" placeholder="Masukkan Nama Simplisia" required>
                        </div>

                        <!-- Bagian yang Digunakan -->
                        <div class="form-group">
                            <label for="bagian_digunakan">Bagian yang Digunakan</label>
                            <input type="text" id="bagian_digunakan" name="bagian_digunakan" placeholder="Masukkan Bagian yang Digunakan" required>
                        </div>

                        <!-- Kontra Indikasi -->
                        <div class="form-group">
                            <label for="kontra_indikasi">Kontra Indikasi</label>
                            <textarea id="kontra_indikasi" name="kontra_indikasi" placeholder="Masukkan Kontra Indikasi" required></textarea>
                        </div>

                        <!-- Kandungan Senyawa / Zat Aktif -->
                        <div class="form-group">
                            <label for="zat_aktif">Kandungan Senyawa / Zat Aktif</label>
                            <input type="text" id="zat_aktif" name="zat_aktif" placeholder="Masukkan Kandungan Senyawa" required>
                        </div>

                        <!-- Kegunaan Tanaman -->
                        <div class="form-group">
                            <label for="kegunaan">Kegunaan Tanaman</label>
                            <textarea id="kegunaan" name="kegunaan" placeholder="Masukkan Kegunaan Tanaman" required></textarea>
                        </div>

                        <!-- Cara Penggunaan -->
                        <div class="form-group">
                            <label for="cara_penggunaan">Cara Penggunaan</label>
                            <textarea id="cara_penggunaan" name="cara_penggunaan" placeholder="Masukkan Cara Penggunaan" required></textarea>
                        </div>

                        <!-- Cara Pengolahan -->
                        <div class="form-group">
                            <label for="cara_pengolahan">Cara Pengolahan</label>
                            <textarea id="cara_pengolahan" name="cara_pengolahan" placeholder="Masukkan Cara Pengolahan" required></textarea>
                        </div>

                        <!-- Takaran Pakai -->
                        <div class="form-group">
                            <label for="takaran_pakai">Takaran Pakai</label>
                            <input type="text" id="takaran_pakai" name="takaran_pakai" placeholder="Masukkan Takaran Pakai" required>
                        </div>

                        <!-- Unggah Gambar -->
                        <div class="form-group">
                            <label for="gambar_tanaman">Unggah Gambar Tanaman</label>
                            <input type="file" id="gambar_tanaman" name="gambar_tanaman" accept="image/*" required>
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit" class="btn-kirim">Unggah Informasi</button>
                    </form>
                </div>
            </section>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>