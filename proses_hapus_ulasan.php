<?php
require("middleware.php");
include('koneksi.php');

if (isset($_GET['id'])) {
    $id_ulasan = intval($_GET['id']);

    // Ambil data sebelum hapus
    $query = "SELECT * FROM ulasan WHERE id_ulasan = $id_ulasan";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Simpan ke riwayat dengan tanggal hari ini
        $insertRiwayat = "INSERT INTO riwayat_hapus_ulasan (
            id_ulasan, 
            id_pengguna, 
            id_tanaman_herbal, 
            isi_ulasan, 
            tanggal_hapus
        ) VALUES (
            {$row['id_ulasan']},
            {$row['id_pengguna']},
            {$row['id_tanaman_herbal']},
            '" . mysqli_real_escape_string($koneksi, $row['isi_ulasan']) . "',
            CURDATE()
        )";

        mysqli_query($koneksi, $insertRiwayat);
    }

    // Hapus ulasan
    $delete = "DELETE FROM ulasan WHERE id_ulasan = $id_ulasan";
    mysqli_query($koneksi, $delete);
}

header('Location: /admintemanramu/reviews');
exit;
