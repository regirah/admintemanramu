<?php
require("../middleware.php");
include("../koneksi.php");

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data tanaman berdasarkan ID
$query = "SELECT * FROM tanaman_herbal WHERE id_tanaman_herbal = ?";
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
    <title>Edit Tanaman Herbal</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="shop-products">
        <?php include("../layouts/sidebar.php") ?>
        <div class="product-container">
            <?php include("../layouts/header.php") ?>

            <!-- EDIT TANAMAN HERBAL -->
            <section id="edit-info-tanheb">
                <div class="form-container">
                    <h2>Edit Informasi Tanaman Herbal</h2>
                    <form action="proses-edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="form-group">
                            <label for="nama_tanaman">Nama Tanaman</label>
                            <input type="text" name="nama_tanaman" value="<?= $data['nama_tanaman'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_latin">Nama Latin</label>
                            <input type="text" name="nama_latin" value="<?= $data['nama_latin_tanaman'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_tanaman">Pemerian</label>
                            <textarea name="deskripsi_tanaman" required><?= $data['pemerian'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="taksonomi">Taksonomi</label>
                            <input type="text" name="taksonomi" value="<?= $data['taksonomi'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="simplisia">Nama Simplisia</label>
                            <input type="text" name="simplisia" value="<?= $data['nama_simplisia'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="bagian_digunakan">Bagian Digunakan</label>
                            <input type="text" name="bagian_digunakan" value="<?= $data['bagian_digunakan'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="kontra_indikasi">Kontra Indikasi</label>
                            <textarea name="kontra_indikasi" required><?= $data['kontra_indikasi'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="zat_aktif">Zat Aktif</label>
                            <input type="text" name="zat_aktif" value="<?= $data['zat_aktif'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="kegunaan">Kegunaan</label>
                            <textarea name="kegunaan" required><?= $data['kegunaan_tanaman'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cara_penggunaan">Cara Penggunaan</label>
                            <textarea name="cara_penggunaan" required><?= $data['cara_penggunaan'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cara_pengolahan">Cara Pengolahan</label>
                            <textarea name="cara_pengolahan" required><?= $data['cara_pengolahan'] ?></textarea>
                        </div>

                       <div class="form-group">
    [                        <label for="takaran_pakai">Takaran Pakai</label>
                            <textarea name="takaran_pakai" required><?= $data['takaran_pakai'] ?></textarea>
                        </div>]

                        <div class="form-group">
                            <label for="gambar_tanaman">Gambar Tanaman (kosongkan jika tidak diubah)</label>
                            <input type="file" name="gambar_tanaman" accept="image/*">
                            <br>
                            <img src="../uploads/<?= $data['gambar_tanaman'] ?>" alt="gambar tanaman" width="120">
                        </div>

                        <button type="submit" class="btn-kirim">Update Informasi</button>
                    </form>
                    <form action="/admintemanramu/pages/hapus-gambar.php" method="post" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                        <input type="hidden" name="id" value="<?= $data['id_tanaman_herbal'] ?>">
                        <input type="hidden" name="gambar_lama" value="<?= $data['gambar_tanaman'] ?>">
                        <input type="hidden" name="tipe" value="tanaman">
                        <button type="submit" class="btn-kirim mt-2" style="background-color: red; color: white;">Hapus Gambar</button>
                    </form>

                </div>
            </section>
        </div>
    </section>
</body>

</html>