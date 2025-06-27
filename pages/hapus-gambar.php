<?php
include("../koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $gambar = $_POST['gambar_lama'];
    $tipe = $_POST['tipe']; // 'tanaman' atau 'produk'

    $gambarPath = "../uploads/" . $gambar;

    if (file_exists($gambarPath)) {
        unlink($gambarPath); // Hapus file gambar
    }

    // Query & Redirect berdasarkan tipe
    if ($tipe === 'tanaman') {
        $query = "UPDATE tanaman_herbal SET gambar_tanaman = NULL WHERE id_tanaman_herbal = ?";
        $redirect = "edit.php?id=" . $id;
    } elseif ($tipe === 'produk') {
        $query = "UPDATE produk_kecantikan SET gambar_produk = NULL WHERE id_produk_kecantikan = ?";
        $redirect = "edit-product.php?id=" . $id;
    } else {
        echo "Tipe tidak dikenali.";
        exit;
    }

    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: " . $redirect);
    exit;
} else {
    echo "Akses tidak valid.";
}
