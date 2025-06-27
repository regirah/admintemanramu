<?php
require("middleware.php");
include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produk Herbal</title>
    <link rel="stylesheet" href="/admintemanramu/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Sidebar -->
    <section class="shop-products">
        <?php include("layouts/sidebar.php"); ?>

        <div class="product-container">
            <!-- Header -->
            <?php include("layouts/header.php"); ?>



    <!--Profil Admin-->
<section id="profil" class="content-section">
    <div class="isiprofilPengguna">
        <div class="profilPengguna">
            <div class="nama-profil">
                <h5>Profil Admin</h5>
                <p>Email: <?= htmlspecialchars($_SESSION['email_admin'] ?? 'Email tidak tersedia') ?></p>
                <p>Kode Anggota: <?= htmlspecialchars($_SESSION['kode_anggota'] ?? 'Kode anggota tidak tersedia') ?></p>
            </div>
        </div>
    </div>
</section>

    <div class="logout-btn">
      <form action="logout.php" method="post">
        <button type="submit">LOGOUT</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>