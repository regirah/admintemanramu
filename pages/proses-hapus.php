<?php
require("../middleware.php");
include("../koneksi.php");

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='../informasiTanheb.php';</script>";
    exit;
}

$id = intval($_GET['id']);

// Ambil data untuk mendapatkan nama file gambar
$query_select = "SELECT gambar_tanaman FROM tanaman_herbal WHERE id_tanaman_herbal = $id";
$result_select = mysqli_query($koneksi, $query_select);

if (mysqli_num_rows($result_select) > 0) {
    $data = mysqli_fetch_assoc($result_select);
    $gambar = $data['gambar_tanaman'];

    // Hapus data dari database
    $query_delete = "DELETE FROM tanaman_herbal WHERE id_tanaman_herbal = $id";
    $result_delete = mysqli_query($koneksi, $query_delete);

    if ($result_delete) {
        // Hapus file gambar dari folder uploads
        $file_path = "../uploads/" . $gambar;
        if (file_exists($file_path)) {
            unlink($file_path); // hapus file gambar
        }

        echo "<script>alert('Data berhasil dihapus.'); window.location.href='../informasiTanheb.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data dari database.'); window.location.href='../informasiTanheb.php';</script>";
    }
} else {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href='../informasiTanheb.php';</script>";
}
