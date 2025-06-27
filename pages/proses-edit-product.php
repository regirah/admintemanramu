<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../middleware.php");
include("../koneksi.php");

// Redirect if not a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: informasiTanheb.php");
    exit;
}

// Get data from form
$id                      = $_POST['id'] ?? null;
$nama_brand              = $_POST['nama_brand'] ?? '';
$nama_produk             = $_POST['nama_produk'] ?? '';
$harga_produk            = $_POST['harga_produk'] ?? '';
$manfaat_produk          = $_POST['manfaat_produk'] ?? '';
$kandungan_produk        = $_POST['kandungan_produk'] ?? '';  // ✅ tambahkan ini
$cara_pemakaian_produk   = $_POST['cara_pemakaian_produk'] ?? '';
$link_produk             = $_POST['link_produk'] ?? '';

if (!$id) {
    die("ID produk tidak ditemukan.");
}

// Handle file upload if provided
$upload_dir = "../uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$gambar_name = $_FILES['gambar_produk']['name'] ?? '';
$gambar_tmp  = $_FILES['gambar_produk']['tmp_name'] ?? '';
$safe_name   = '';
$include_gambar = false;

if (!empty($gambar_name) && is_uploaded_file($gambar_tmp)) {
    $safe_name = time() . "_" . basename($gambar_name); // Unique file name
    $gambar_path = $upload_dir . $safe_name;

    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        $include_gambar = true;
    } else {
        echo "Gagal mengupload gambar.";
        exit;
    }
}

// Build SQL query
if ($include_gambar) {
    // ✅ versi kalau ada gambar baru
    $query = "UPDATE produk_kecantikan SET 
                nama_brand = ?, 
                nama_produk = ?, 
                harga_produk = ?, 
                manfaat_produk = ?, 
                kandungan_produk = ?, 
                cara_pemakaian_produk = ?, 
                link_produk = ?, 
                gambar_produk = ?
              WHERE id_produk_kecantikan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }

    // 8 string + 1 integer
    mysqli_stmt_bind_param(
        $stmt,
        'ssssssssi',
        $nama_brand,
        $nama_produk,
        $harga_produk,
        $manfaat_produk,
        $kandungan_produk,
        $cara_pemakaian_produk,
        $link_produk,
        $safe_name,
        $id
    );

} else {
    // ✅ versi tanpa gambar
    $query = "UPDATE produk_kecantikan SET 
                nama_brand = ?, 
                nama_produk = ?, 
                harga_produk = ?, 
                manfaat_produk = ?, 
                kandungan_produk = ?, 
                cara_pemakaian_produk = ?, 
                link_produk = ?
              WHERE id_produk_kecantikan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($koneksi));
    }

    // 7 string + 1 integer
    mysqli_stmt_bind_param(
        $stmt,
        'sssssssi',
        $nama_brand,
        $nama_produk,
        $harga_produk,
        $manfaat_produk,
        $kandungan_produk,
        $cara_pemakaian_produk,
        $link_produk,
        $id
    );
}

// Execute query
if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data berhasil diperbarui'); window.location.href='/admintemanramu/products';</script>";
} else {
    echo "Gagal memperbarui data: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
?>
