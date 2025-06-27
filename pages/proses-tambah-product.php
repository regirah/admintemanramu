<?php
require(__DIR__ . '/../middleware.php');
include(__DIR__ . '/../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_brand = $_POST['nama_brand'];
    $nama_produk = $_POST['nama_produk'];
    $harga = (int) $_POST['harga_produk'];
    $manfaat = $_POST['manfaat_produk'];
    $cara_pemakaian = $_POST['cara_pemakaian_produk'];
    $link_produk = $_POST['link_produk'];
    $kandungan_produk = $_POST['kandungan_produk'];

    // Upload
    $gambar = $_FILES['gambar_produk']['name'];
    $tmp = $_FILES['gambar_produk']['tmp_name'];
    $folder_upload = __DIR__ . '/../uploads/';
    $gambar_baru = time() . '-' . basename($gambar);
    $path_simpan = $folder_upload . $gambar_baru;

    // Buat folder jika belum ada
    if (!is_dir($folder_upload)) {
        mkdir($folder_upload, 0777, true);
    }

    if (move_uploaded_file($tmp, $path_simpan)) {
        // Insert DB (tambahkan kandungan_produk)
        $query = "INSERT INTO produk_kecantikan 
        (nama_brand, nama_produk, harga_produk, manfaat_produk, cara_pemakaian_produk, link_produk, kandungan_produk, gambar_produk, terlihat_produk)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";

        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssisssss', $nama_brand, $nama_produk, $harga, $manfaat, $cara_pemakaian, $link_produk, $kandungan_produk, $gambar_baru);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='/admintemanramu/products';</script>";
        } else {
            echo "Gagal tambah produk: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Upload gagal. TMP: $tmp → $path_simpan";
    }
} else {
    echo "<script>alert('Metode tidak diperbolehkan'); history.back();</script>";
}
?>
