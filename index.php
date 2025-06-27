<?php

$basePath = '/admintemanramu';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace($basePath, '', $uri);

switch ($path) {
    case '/':
        include 'loginAdmin.php';
        break;

    case '/profil':
        include 'profil-admin.php';
        break;

        case '/overview':
        include 'overview.php';
        break;

    case '/tanaman-herbal':
        include 'informasiTanheb.php';
        break;

    case '/tanaman-herbal/add':
        include 'pages/add_tanaman_herbal.php';
        break;

    case '/tanaman-herbal/proses-add-tanheb':
        include 'pages/proses-tambah.php';
        break;

    case '/tanaman-herbal/detail':
        include 'pages/detail_tanaman_herbal.php';
        break;

    case '/tanaman-herbal/edit':
        include 'pages/edit_tanaman_herbal.php';
        break;

    case '/users':
        include 'informasi-akun-pengguna.php';
        break;

    case '/reviews':
        include 'ulasanPengguna.php';
        break;

    case '/products':
        include 'produkHerbal.php';
        break;

    case '/products/add':
        include 'pages/add_product.php';
        break;

    case '/products/proses-add-product':
        include 'pages/proses-tambah-product.php';
        break;
    case '/products/detail':
        include 'pages/detail_product.php';
        break;

    case '/products/edit':
        include 'pages/add_product.php';
        break;

    case '/profile':
        include 'profilAdmin.php';
        break;

    default:
        echo "404 - Page not found.";
        break;
}
