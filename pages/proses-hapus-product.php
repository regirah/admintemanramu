<?php
require("../middleware.php");
include("../koneksi.php");

if (isset($_GET['id'])) {
    $id_produk_kecantikan = $_GET['id'];

    // Ambil nama file gambar untuk dihapus dari server
    $query_select = "SELECT gambar_produk FROM produk_kecantikan WHERE id_produk_kecantikan = ?";
    $stmt_select = mysqli_prepare($koneksi, $query_select);
    mysqli_stmt_bind_param($stmt_select, "i", $id_produk_kecantikan);
    mysqli_stmt_execute($stmt_select);
    mysqli_stmt_bind_result($stmt_select, $gambar_produk);
    mysqli_stmt_fetch($stmt_select);
    mysqli_stmt_close($stmt_select);

    if ($gambar_produk) {
        $gambar_path = "../uploads/" . $gambar_produk;

        // Hapus file gambar dari server jika ada
        if (file_exists($gambar_path)) {
            unlink($gambar_path);
        }
    }

    // Hapus data produk dari database
    $query_delete = "DELETE FROM produk_kecantikan WHERE id_produk_kecantikan = ?";
    $stmt_delete = mysqli_prepare($koneksi, $query_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $id_produk_kecantikan);

    if (mysqli_stmt_execute($stmt_delete)) {
        echo "<script>alert('Produk berhasil dihapus'); window.location.href='/admintemanramu/products';</script>";
    } else {
        echo "Gagal menghapus produk: " . mysqli_stmt_error($stmt_delete);
    }

    mysqli_stmt_close($stmt_delete);
} else {
    echo "ID produk tidak ditemukan.";
}
