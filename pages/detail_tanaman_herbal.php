<?php
require("middleware.php");
include('koneksi.php');

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='../tanaman-herbal';</script>";
    exit;
}

$id = intval($_GET['id']); // amankan ID
$query = "SELECT * FROM tanaman_herbal WHERE id_tanaman_herbal = $id";
$result = mysqli_query($koneksi, $query);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href='../tanaman-herbal';</script>";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['nama_tanaman']) ?> - Detail Produk Herbal</title>
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
                        <img src="../uploads/<?= htmlspecialchars($data['gambar_tanaman']) ?>" alt="<?= htmlspecialchars($data['nama_tanaman']) ?>" width="300">
                        <div class="contentpenting">
                            <h5><?= htmlspecialchars($data['nama_tanaman']) ?></h5>
                            <h6><?= htmlspecialchars($data['nama_latin_tanaman']) ?></h6>
                            <h6><strong>Pemerian:</strong> <?= htmlspecialchars($data['pemerian']) ?></h6>
                            <h6><strong>Taksonomi:</strong> <?= htmlspecialchars($data['taksonomi']) ?></h6>
                            <h6><strong>Nama Simplisia:</strong> <?= htmlspecialchars($data['nama_simplisia']) ?></h6>
                            <h6><strong>Bagian yang Digunakan:</strong> <?= htmlspecialchars($data['bagian_digunakan']) ?></h6>
                        </div>
                    </div>

                    <div class="dd-contentpenting">

                        <?php
                        $sections = [
                            "kontra_indikasi" => "Kontra Indikasi",
                            "zat_aktif" => "Kandungan Senyawa / Zat Aktif",
                            "kegunaan_tanaman" => "Kegunaan Tanaman",
                            "cara_penggunaan" => "Cara Penggunaan",
                            "cara_pengolahan" => "Cara Pengolahan",
                            "takaran_pakai" => "Takaran Pakai"
                        ];

                        foreach ($sections as $key => $label) {
                            echo '
                            <div class="dd-detail">
                                <button class="dd-button">
                                    ' . $label . '
                                    <img src="/admintemanramu/images/down.png" alt="icon" class="dd-icon">
                                </button>
                                <div class="dd-content">
                                    <p>' . nl2br(htmlspecialchars($data[$key])) . '</p>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="edit-hapus">
                    <button class="edit-btn">
                        <a href="/admintemanramu/pages/edit-tanaman-herbal.php?id=<?= $data['id_tanaman_herbal'] ?>">Edit Informasi</a>
                    </button>

                    <button class="hapus-btn">
                        <a href="/admintemanramu/pages/proses-hapus.php?id=<?= $data['id_tanaman_herbal'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus Informasi</a>
                    </button>
                </div>
            </section>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/admintemanramu/assets/js/script.js"></script>
</body>

</html>