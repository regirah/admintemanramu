<?php
require("../middleware.php");
include("../koneksi.php"); // koneksi database

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: informasiTanheb.php");
    exit;
}

$id = $_POST['id'] ?? null;
$nama_tanaman      = $_POST['nama_tanaman'] ?? '';
$nama_latin        = $_POST['nama_latin'] ?? '';
$pemerian          = $_POST['deskripsi_tanaman'] ?? '';
$taksonomi         = $_POST['taksonomi'] ?? '';
$nama_simplisia    = $_POST['simplisia'] ?? '';
$bagian_digunakan  = $_POST['bagian_digunakan'] ?? '';
$kontra_indikasi   = $_POST['kontra_indikasi'] ?? '';
$zat_aktif         = $_POST['zat_aktif'] ?? '';
$kegunaan_tanaman  = $_POST['kegunaan'] ?? '';
$cara_penggunaan   = $_POST['cara_penggunaan'] ?? '';
$cara_pengolahan   = $_POST['cara_pengolahan'] ?? '';
$takaran_pakai     = $_POST['takaran_pakai'] ?? '';

if (!$id) {
    die("ID tanaman tidak ditemukan.");
}

// Upload gambar jika ada
$upload_dir = "../uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$gambar_name = $_FILES['gambar_tanaman']['name'] ?? '';
$gambar_tmp  = $_FILES['gambar_tanaman']['tmp_name'] ?? '';
$gambar_path = '';

$include_gambar = false;

if (!empty($gambar_name) && is_uploaded_file($gambar_tmp)) {
    $safe_name = time() . "_" . basename($gambar_name); // prevent overwrite
    $gambar_path = $upload_dir . $safe_name;

    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        $include_gambar = true;
    } else {
        echo "Gagal mengupload gambar.";
        exit;
    }
}

// SQL Query
if ($include_gambar) {
    $query = "UPDATE tanaman_herbal SET 
                nama_tanaman = ?, 
                nama_latin_tanaman = ?, 
                pemerian = ?, 
                taksonomi = ?, 
                nama_simplisia = ?, 
                bagian_digunakan = ?, 
                kontra_indikasi = ?, 
                zat_aktif = ?, 
                kegunaan_tanaman = ?, 
                cara_penggunaan = ?, 
                cara_pengolahan = ?, 
                takaran_pakai = ?, 
                gambar_tanaman = ?
              WHERE id_tanaman_herbal = ?";
} else {
    $query = "UPDATE tanaman_herbal SET 
                nama_tanaman = ?, 
                nama_latin_tanaman = ?, 
                pemerian = ?, 
                taksonomi = ?, 
                nama_simplisia = ?, 
                bagian_digunakan = ?, 
                kontra_indikasi = ?, 
                zat_aktif = ?, 
                kegunaan_tanaman = ?, 
                cara_penggunaan = ?, 
                cara_pengolahan = ?, 
                takaran_pakai = ?
              WHERE id_tanaman_herbal = ?";
}

$stmt = mysqli_prepare($koneksi, $query);
if (!$stmt) {
    die("Prepare failed: " . mysqli_error($koneksi));
}

// Bind parameters
if ($include_gambar) {
    mysqli_stmt_bind_param(
        $stmt,
        'sssssssssssssi',
        $nama_tanaman,
        $nama_latin,
        $pemerian,
        $taksonomi,
        $nama_simplisia,
        $bagian_digunakan,
        $kontra_indikasi,
        $zat_aktif,
        $kegunaan_tanaman,
        $cara_penggunaan,
        $cara_pengolahan,
        $takaran_pakai,
        $safe_name,
        $id
    );
} else {
    mysqli_stmt_bind_param(
        $stmt,
        'ssssssssssssi',
        $nama_tanaman,
        $nama_latin,
        $pemerian,
        $taksonomi,
        $nama_simplisia,
        $bagian_digunakan,
        $kontra_indikasi,
        $zat_aktif,
        $kegunaan_tanaman,
        $cara_penggunaan,
        $cara_pengolahan,
        $takaran_pakai,
        $id
    );
}

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data berhasil diperbarui'); window.location.href='../informasiTanheb.php';</script>";
} else {
    echo "Gagal memperbarui data: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
