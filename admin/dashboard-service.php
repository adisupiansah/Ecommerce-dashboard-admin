<?php 

session_start();

if (!isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require "fungsi.php";

$ourService = quer("SELECT * FROM dashboard_input_service ORDER BY id DESC");

// Logic Input Service
if (isset($_POST['kirimInputService'])) {
    # code...
    if (inputService($_POST) > 0) {
        # code...
        echo "
            <script>
                alert('data Service berhasil di kirim');
                document.location.href = 'dashboard-service.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data service gagal');
                document.location.href = 'dashboard-service.php';
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

                    <a href="#inputService" class="nav__link active">
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

    <h1>Dashboard | Input Service</h1>

    <!-- Form Input Service -->
    <section id="inputService">
        <div class="container">
            <div class="service">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="mb-3 row">
                        <label for="kategoriService" class="col-sm-2 col-form-label labelKategoriService">Kategori Service</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-sm inputKategoriService" id="kategoriService" name="kategori_service">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="keteranganService" class="col-sm-2 col-form-label labelKeteranganService">Keterangan Service</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control form-sm inputKeteranganService" id="keteranganService" name="ket_service"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nomorService" class="col-sm-2 col-form-label labelNomorService">Nomor Service</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-sm inputNomorService" id="nomorService" name="kontak_service">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gambarService" class="col-sm-2 col-form-label labelGambarService">Gambar Service</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control form-sm inputGambarService" id="gambarService" name="gambar">
                        </div>
                    </div>

                    <div class="mb-3 row d-flex justify-content-center align-items-center">
                        <button type="submit" name="kirimInputService" class="btn col-3">Kirim Data</button>
                    </div>

                </form>
            </div>
        </div>

    </section>


    <!-- Table Service -->
    <section id="formTableService">
        <div class="container">
            <div class="table-service">

                <?php $i = 1; ?>
                <?php foreach ($ourService as $row) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Kategori Service</th>
                                <th scope="col">Keterangan service</th>
                                <th scope="col">Nomor service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><a class="btn btn-sm btn-danger" href="delete/deleteService.php?id=<?= $row['id']; ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">delete</a> | <a class="btn btn-sm btn-success" href="editService.php?id=<?= $row['id']; ?>">Edit</a></td>
                                <td><img src="asset/<?= $row['gambar']; ?>" alt="" width="100"></td>
                                <td><?= $row['kategori_service']; ?></td>
                                <td><?= $row['ket_service']; ?></td>
                                <td><?= $row['kontak_service']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php $i++; ?>
                <?php endforeach; ?>

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