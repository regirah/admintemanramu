<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "teman_ramu"; // nama database

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
} else {
    echo "";
}
