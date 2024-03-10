<?php
session_start();

if (!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require "fungsi.php";


$ourProduct = quer("SELECT * FROM products ORDER BY id DESC");

// logic input product
if (isset($_POST['kirimProduct'])) {
    # code...
    if (inputProduct($_POST) > 0) {
        # code...
        echo "
            <script>
                alert('Data product terkirim');
                document.location.href = 'dashboard-product.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data product gagal di kirim');
            document.location.href = 'dashboard-product.php';
        </script>
    ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles.css">




    <title>Dashboard | Input Product</title>
</head>

<body id="body-pd">

    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="#" class="nav__logo">Bedimcode</a>
                </div>
                <div class="nav__list">
                    <a href="dashboard.php" class="nav__link active">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>
                    </a>
                    <a href="dashboard-product.php" class="nav__link">
                        <ion-icon name="cart-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Input product</span>
                    </a>

                    <a href="dashboard-service.php" class="nav__link">
                        <ion-icon name="time-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Input service</span>
                    </a>

                    <a href="dashboard-logoDanHero.php" class="nav__link">
                        <ion-icon name="create-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Input logo</span>
                    </a>

                    <a href="dashboard-kontak.php" class="nav__link">
                        <ion-icon name="person-add-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Input kontak</span>
                    </a>

                    <a href="dashboard-alamat.php" class="nav__link">
                        <ion-icon name="location-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Input alamat</span>
                    </a>
                </div>
            </div>

            <a href="logout.php" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <h1>Dashboard</h1>


    <section>
     
        <h3 class="mt-5">Selamat Datang <?= $_SESSION['username']; ?></h3>
     
        <p>Jadi admin, bakalan ngasi cara dan aturan mengelola dagangan</p>

        <div class="row mt-5">
            <div class="col">

                <div class="card mb-3" id="chatAdmin" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="imgProduct/admin.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">admin</h5>
                                <p class="card-text">jika ada kendala dalam mengelola dagangan / produk, silahkn chat admin</p>
                                <button class="btn btn-sm btn-primary">chat admin</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-5 quick">
        <h3>Quick started</h3>

        <div class="row">
            <p class="jdl">1. Input Product</p>

            <div class="col-md-6">
                <img src="imgProduct/input-product.png" alt=".." width="90%">
                <div class="col-md-11">
                    <p class="mt-3">pada menu input product, silahkan menginput produk <?= $_SESSION['username']; ?>, terdapat tombol delete dan Update untuk setiap produk</p>
                </div>
            </div>

        </div>
        <div class="row mt-3">
            <p class="jdl">2. Input Service</p>

            <div class="col-md-6">
                <img src="imgProduct/input-service.png" alt=".." width="90%">
                <div class="col-md-11">
                    <p class="mt-3">silahkan masukan, layanan dari usahan <?= $_SESSION['username']; ?>, Contohnya seperti gratis ongkir, COD (cash on delivery), garansi product, dll.</p>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <p class="jdl">3. Input Logo Usaha</p>

            <div class="col-md-6">
                <img src="imgProduct/input-logo.png" alt=".." width="90%">
                <img src="imgProduct/hasil-logo.png" class="mt-3" alt=".." width="90%">
                <div class="col-md-11">
                    <p class="mt-3 ket-logo">silahkan beri logo, keterangan, dan gambar usaha product / lokasi usaha, jadi di sini <?= $_SESSION['username']; ?> hanya bisa menggunakan 1 logo saja, walaupun <?= $_SESSION['username']; ?> menginput logo baru, logo tidak akan di tampilkan di shope, karna yang akan di tampilkan di shope hanya tabel no 1 saja,silahkan delete / update tabel no 1 jika ingin menampilkan logo baru.</p>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <p class="jdl">4. Input Kontak Owner</p>

            <div class="col-md-6">
                <img src="imgProduct/input-kontak.png" alt=".." width="90%">
                <div class="col-md-11">
                    <p class="mt-3">Silahkan masukan Nomor wa <?= $_SESSION['username']; ?>, agar customer bisa menghubungi <?= $_SESSION['username']; ?> dengan mudah</p>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <p class="jdl">5. Input Alamat Usaha</p>

            <div class="col-md-6">
                <img src="imgProduct/input-alamat.png" alt=".." width="90%">
                <div class="col-md-11">
                    <p class="mt-3">Silahkan mengisi alamat Usaha <?= $_SESSION['username']; ?>, link Google Maps dan gambar lokasi usaha, agar Customer bisa langsung menuju toko </p>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <p class="jdl">6. Url</p>

            <div class="col-md-6">
        
                <div class="col-md-11">
                    <p>Jika sudah selesai menginput kebutuhan usaha <?= $_SESSION['username']; ?>, silahkan kunjungi shope <?= $_SESSION['username']; ?> untuk melihat hasilnya <span><a href="#">https://shopendr.com</a></span> dan jangan lupa share linknya agar customer mudah melihat / belanja di E-commerce <?= $_SESSION['username']; ?></p>
                    <p>Jika terjadi kendala dalam menggunakan dashbord, silahkan hubungi admin..Terima kasih😄 <span><a href="#chatAdmin">Chat admin</a></span></p>
                </div>
            </div>

        </div>
    </section>















    <style>
        .card {
            background-color: #F5F7F8;
            border-radius: 20px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }

        .card .card-title {
            font-weight: 600;
        }

        /* quick started */
        .quick {
            margin-bottom: 110px;
        }

        .quick img {
            border-radius: 10px;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }
        .quick h3{
            font-weight: 600;
        }

        .quick p{
            text-align: justify;
        }
        .quick .jdl{
            font-weight: bold;
        }
    </style>




    <!-- Jss Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="assets/js/main.js"></script>
</body>

</html>