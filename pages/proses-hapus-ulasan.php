<?php
require("middleware.php");
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_ulasan'])) {
    $id_ulasan = intval($_POST['id_ulasan']);

    // Jalankan query delete
    $query = "DELETE FROM ulasan WHERE id_ulasan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_ulasan);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect kembali ke halaman ulasan
        header("Location: ulasanPengguna.php");
        exit();
    } else {
        echo "Gagal menghapus ulasan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
