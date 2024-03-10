<?php 
require "fungsi.php";

$id = $_GET['id'];
$logoDanHero = quer("SELECT * FROM logo_hero WHERE id = $id")[0];

// Logic Input Service
if (isset($_POST['editLogo'])) {
    # code...
    if (editLogo($_POST) > 0) {
        # code...
        echo "
            <script>
                alert('data Logo berhasil di edit');
                document.location.href = 'dashboard-logoDanHero.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data Logo gagal di edit');
                document.location.href = 'dashboard-logoDanHero.php';
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




    <title>Dashboard | Edit Logo</title>
</head>

<body id="body-pd">

<!-- Navigasi sidebar -->
    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="#" class="nav__logo">Bedimcode</a>
                </div>
                <div class="nav__list">
                    <a href="dashboard.php" class="nav__link">
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
                   
                    <a href="#inputService" class="nav__link active">
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

            <a href="#" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <h1>Dashboard | Edit logo & hero</h1>

    <!-- Form Input logo dan hero -->
    <section id="inputService">
        <div class="container">
            <div class="service">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $logoDanHero["id"]; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $logoDanHero["gambar_profil"]; ?>">
                    <input type="hidden" name="logoLama" value="<?= $logoDanHero["logo"]; ?>">

                    <div class="mb-3 row">
                        <label for="logo" class="col-sm-2 col-form-label labelKategoriService">Logo</label>
                        <img src="asset/<?= $logoDanHero['logo']; ?>" alt="" width="20%">
                        <div class="col-sm-8">
                            <input type="file" class="form-control form-sm inputKategoriService" id="logo" name="logo">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="namaLogo" class="col-sm-2 col-form-label labelKeteranganService">Nama Logo</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control form-sm inputKeteranganService" id="namaLogo" name="nama_logo"><?= $logoDanHero['nama_logo']; ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ketUsaha" class="col-sm-2 col-form-label labelNomorService">Keterangan usaha</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-sm inputNomorService" id="ketUsaha" name="ket_company" value="<?= $logoDanHero['ket_company']; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gambarProfil" class="col-sm-2 col-form-label labelGambarService">Gambar Profil/perusahaan</label>
                        <img src="asset/<?= $logoDanHero['gambar_profil']; ?>" alt="">
                        <div class="col-sm-8">
                            <input type="file" class="form-control form-sm inputGambarService" id="gambarProfil" name="gambar_profil">
                        </div>
                    </div>

                    <div class="mb-3 row d-flex justify-content-center align-items-center">
                        <button type="submit" name="editLogo" class="btn col-3">Kirim Data</button>
                    </div>

                </form>
            </div>
        </div>

    </section>



     <!-- Jss Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="assets/js/main.js"></script>
</body>

</html>