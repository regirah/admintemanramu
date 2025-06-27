<?php
require(__DIR__ . '/../middleware.php');
include(__DIR__ . '/../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_tanaman        = $_POST['nama_tanaman'];
    $nama_latin          = $_POST['nama_latin'];
    $pemerian            = $_POST['deskripsi_tanaman'];
    $taksonomi           = $_POST['taksonomi'];
    $nama_simplisia      = $_POST['simplisia'];
    $bagian_digunakan    = $_POST['bagian_digunakan'];
    $kontra_indikasi     = $_POST['kontra_indikasi'];
    $zat_aktif           = $_POST['zat_aktif'];
    $kegunaan_tanaman    = $_POST['kegunaan'];
    $cara_penggunaan     = $_POST['cara_penggunaan'];
    $cara_pengolahan     = $_POST['cara_pengolahan'];
    $takaran_pakai       = $_POST['takaran_pakai'];

    // Upload gambar
    $gambar_name = $_FILES['gambar_tanaman']['name'];
    $gambar_tmp  = $_FILES['gambar_tanaman']['tmp_name'];
    $upload_dir  = "uploads/";

    // Buat folder uploads jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $gambar_path = $upload_dir . basename($gambar_name);

    // Pindahkan gambar ke folder uploads
    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        $query = "INSERT INTO tanaman_herbal (
                    id_produk_kecantikan,
                    nama_tanaman,
                    nama_latin_tanaman,
                    pemerian,
                    taksonomi,
                    nama_simplisia,
                    bagian_digunakan,
                    kontra_indikasi,
                    zat_aktif,
                    kegunaan_tanaman,
                    cara_penggunaan,
                    cara_pengolahan,
                    takaran_pakai,
                    gambar_tanaman
                ) VALUES (
                    0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";

        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'sssssssssssss',
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
            $gambar_name
        );

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href='../informasiTanheb.php';</script>";
        } else {
            echo "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Gagal mengupload gambar.";
    }
} else {
    // Akses langsung tanpa POST
    header("Location: add_tanaman_herbal.php");
    exit;
}
