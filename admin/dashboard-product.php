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
                    <a href="dashboard.php" class="nav__link">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>
                    </a>
                    <a href="#inputBarang" class="nav__link active">
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

    <h1>Dashboard | Input Product</h1>

    <section id="inputBarang">

        <div class="container">
            <div class="inputCart">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="mb-3 row">
                        <label for="namaProduk" class="col-sm-2 col-form-label labelNameProduk">Nama Produk</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-sm inputNameProduk" id="namaProduk" name="name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gambarProduk" class="col-sm-2 col-form-label labelGambarProduk">Gambar Produk</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control form-sm inputGambarProduk" id="gambarProduk" name="img">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="hargaProduk" class="col-sm-2 col-form-label labelHargaProduk">Harga Produk</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-sm inputHargaProduk" id="hargaProduk" name="price">
                        </div>
                    </div>

                    <div class="mb-3 row d-flex justify-content-center align-items-center">
                        <button class="btn col-3" type="submit" name="kirimProduct">Kirim Data</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- Table Product -->
    <section id="tableProduct">
        <div class="container">
            <div class="table-service">

                <?php $i = 1; ?>
                <?php foreach ($ourProduct as $row) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Name Product</th>
                                <th scope="col">Gambar Product</th>
                                <th scope="col">Harga Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><a class="btn btn-sm btn-danger" href="delete/deleteProduct.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin menghapus produk ini?')">delete</a> | <a class="btn btn-sm btn-success" href="editProduct.php?id=<?= $row['id']; ?>">Edit</a></td>

                                <td><?= $row['name']; ?></td>

                                <td><img src="imgProduct/<?= $row['img']; ?>" alt="" width="70"></td>

                                <td><?= $row['price']; ?></td>
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