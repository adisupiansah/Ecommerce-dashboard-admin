<?php
require "admin/fungsi.php";

$addresCompany = quer("SELECT * FROM input_alamat");
$logoDanHero = quer("SELECT * FROM logo_hero LIMIT 1 OFFSET 0");

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- css Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Css custom -->
    <link rel="stylesheet" type="text/css" href="css/location.css">

    <!-- logo title -->
    <?php foreach($logoDanHero as $row) : ?>
    <link rel="shortcut icon" href="admin/asset/<?= $row['logo']; ?>">
    <?php endforeach ?>

    <!-- Fonts Google Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <!-- Fonts Google Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php foreach($logoDanHero as $row) : ?>
    <title><?= $row['nama_logo']; ?> | Location</title>
    <?php endforeach; ?>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar shadow-sm mb-3 sticky-top" x-data>
        <div class="container">
            <?php foreach ($logoDanHero as $row) : ?>
                <a class="navbar-brand text-dark">
                    <img src="admin/asset/<?= $row['logo']; ?>" alt="" width="45" class="mx-1"><?= $row['nama_logo']; ?>
                </a>
            <?php endforeach; ?>

            <!-- menu -->
            <div class="justify-content-center align-items-center text-center menu">
                <ul class="nav justify-content-center ">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="./"><i class="icon bi bi-house"></i><br>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="kontak.php"><i class="icon bi bi-people"></i><br>Contact</a>
                    </li>

                </ul>
            </div>


            <a class="navbar-toggler text-decoration-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <i class="bi bi-cart2">
                    <span class="quantity-badge text-white" x-show="$store.cart.quantity" x-text="$store.cart.quantity"><span>
                </i>
            </a>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">NDR SHOOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" id="keranjangNavbar">
                    <!-- Keranjang belanja akan ditambahkan di sini -->

                </div>
            </div>
        </div>
    </nav>

    <!-- lokasi -->
    <div class="container">
        <div class="Location">

            <div class="row">
                <?php foreach ($addresCompany as $row) : ?>
                    <div class="col-md-6">
                        <img src="admin/asset/<?= $row['gambar_alamat']; ?>" alt="...">
                    </div>
                    <div class="col-md-6">

                        <h2>Location <span>Company</span></h2>
                        <p class="keterangan"><?= $row['alamat']; ?></p>
                    <?php endforeach; ?>
                    </div>
            </div>

            <div class="row">
                <div class="map">
                    <div class="col-md-12 text-center">
                        <?php foreach ($addresCompany as $row) : ?>
                            <a href="<?= $row['url_alamat']; ?>" target="_blank" class="btn btn-sm">View Maps <i class="bi bi-geo-alt"></i></a>
                        <?php endforeach; ?>

                        <!-- <p class="peta text-center">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3989.1385043847117!2d103.35793187496527!3d1.057700998932136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwMDMnMjcuNyJOIDEwM8KwMjEnMzcuOCJF!5e0!3m2!1sid!2sid!4v1708439043468!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </p> -->




                    </div>
                </div>
            </div>

        </div>

    </div>




    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>