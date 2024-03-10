<?php
require "function.php";
require "admin/fungsi.php";

$komen = query("SELECT * FROM tbkomentar ORDER BY id DESC");

$OurService = quer("SELECT * FROM dashboard_input_service");

$logoDanHero = quer("SELECT * FROM logo_hero LIMIT 1 OFFSET 0");
$kontak = quer('SELECT * FROM input_kontak');

$addres = quer("SELECT * FROM input_alamat ORDER BY id DESC");




if (isset($_POST['kirimKomentar'])) {
    // cek apkah komentar berhasil ditambahkan atw tidak ?
    if (komentar($_POST) > 0) {
        echo "
                <script>
                    alert('komentar berhasil ');
                    document.location.href = 'index.php';
                </script>
            ";
    } else {
        echo "
            <script>
                alert('komentar Gagal !');
                document.location.href = 'index.php';
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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <!-- logo title -->
    <?php foreach ($logoDanHero as $row) : ?>
        <link rel="shortcut icon" href="admin/asset/<?= $row['logo']; ?>">
    <?php endforeach ?>


    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->

    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- fonts google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">



    <!-- Fonts Google Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <!-- alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-eDfsQTa-YuStaNqi"></script>



    <?php foreach ($logoDanHero as $row) : ?>
        <title><?= $row['nama_logo']; ?></title>
    <?php endforeach; ?>
</head>

<body>

    <?php

    $conn = mysqli_connect("localhost", "root", "", "ndrshoop");

    // Ambil data produk dari MySQL
    $products = mysqli_query($conn, "SELECT * FROM products");

    // Ubah format data produk menjadi array asosiatif
    $items = [];
    while ($row = mysqli_fetch_assoc($products)) {
        $items[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'img' => $row['img'],
        ];
    }

    ?>
    <!-- navbar -->
    <nav class="navbar shadow-sm mb-3 sticky-top" x-data>
        <div class="container">
            <?php foreach ($logoDanHero as $row) : ?>
                <a class="navbar-brand text-dark"><img src="admin/asset/<?= $row['logo']; ?>" alt="" width="45" class="mx-1"><?= $row['nama_logo']; ?></a>
            <?php endforeach; ?>
            <!-- menu -->
            <div class="justify-content-center align-items-center text-center menu">
                <ul class="nav justify-content-center ">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="kontak.php"><i class="icon bi bi-people"></i><br>Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="lokasi.php"><i class="icon bi bi-geo-alt"></i><br>Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#toko"><i class="icon bi bi-cart2"></i><br>Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#komentar"><i class="icon bi bi-chat-dots"></i><br>Comment</a>
                    </li>
                </ul>
            </div>

            <a class="navbar-toggler text-decoration-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <i class="bi bi-cart2">
                    <span class="quantity-badge text-white" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
                </i>
            </a>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">NDR SHOOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" id="keranjangNavbar">
                    <!-- Keranjang belanja akan ditambahkan di sini -->

                    <template x-for="(item, index) in $store.cart.items" x-key="index">
                        <div class="shoping-cart">
                            <div class="row col-auto">
                                <div class="col-md-4">
                                    <img class="radius-img" :src="`admin/imgProduct/${item.img}`" :alt="item.name" width="50">
                                </div>

                                <div class="col-md-8 cart-belanja">
                                    <h4 class="card-title fs-5" x-text="item.name"></h4>

                                    <div class="card-text">
                                        <span x-text="rupiah(item.price)"></span> &times;

                                        <button class="btn btn-danger btn-sm size" @click="$store.cart.remove(item.id)">&minus;</button>

                                        <span x-text="item.quantity">1</span>

                                        <button class="btn btn-success btn-sm size" @click="$store.cart.add(item)">&plus;</button> &equals;
                                        <span x-text="rupiah(item.total)"></span>
                                    </div>

                                </div>

                            </div>
                            <small>
                                <hr>
                            </small>
                        </div>

                    </template>

                    <h5 x-show="!$store.cart.items.length" class="text-center text-secondary" style="font-style: italic;">Your cart is empty</h5>

                    <h4 x-show="$store.cart.items.length" class="text-center fs-5">Total : <span x-text="rupiah($store.cart.total)"></span></h4>

                    <div class="form-container container mt-4" x-show="$store.cart.items.length">
                        <form action="" id="checkoutForm">
                            <input type="hidden" name="items" x-model="JSON.stringify($store.cart.items)">
                            <input type="hidden" name="total" x-model="$store.cart.total">
                            <h5 class="text-center mb-2"> Customer Detail</h5>

                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-9 mx-1">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-9 mx-1">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-9 mx-1 mb-4">
                                    <input type="number" class="form-control" id="phone" name="phone">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-2"></div>
                                <button class="btn btn-sm btn-primary col-9 checkout-button" type="submit" id="checkout-button">Checkout</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <!-- hero section -->
    <?php foreach ($logoDanHero as $row) : ?>
        <section class="hero" style="background-image: url('admin/asset/<?= $row['gambar_profil']; ?>');">
            <div class="container">
                <main class="content">
                    <h1>SHOPE <span><?= $row['nama_logo']; ?></span></h1>
                    <p><?= $row['ket_company']; ?></p>
                    <a href="#toko" class="btn btn-sm">Shopping now <i class="bi bi-cart2"></i></a>
                </main>

            </div>
        </section>
    <?php endforeach; ?>

    <!-- tentang kami  -->
    <div class="container our-services">
        <div class="service">
            <h2>Our Services</h2>
        </div>
        <div class="row justify-content-center">

            <?php $s = 1; ?>
            <?php foreach ($OurService as $row) : ?>
                <div class="col-md-4">
                    <div class="card card-service">
                        <div class="card-body">
                            <img src="admin/asset/<?= $row['gambar']; ?>" alt="">
                            <h4 class="fw-bold mt-2 text-center"><?= $row['kategori_service']; ?></h4>
                            <p class="fw-normal"><?= $row['ket_service']; ?></p>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                            <p class="contact">Our Contact</p>
                            <i class="bi bi-whatsapp"><span class="mx-1"><?= $row['kontak_service']; ?></span></i>
                        </div>
                    </div>
                </div>

                <?php $s++; ?>
            <?php endforeach; ?>

            <!-- <div class="col-md-4">
                <div class="card card-service">
                    <div class="card-body">
                        <img src="img/card-service2.jpg" alt="">
                        <h4 class="fw-bold mt-2 text-center">Payment gateway</h4>
                        <p class="fw-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet debitis voluptatem culpa! At, maxime libero.</p>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        <p class="contact">Our Contact</p>
                        <i class="bi bi-whatsapp"><span class="mx-1">0812-7566-9055</span></i>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-4">
                <div class="card card-service">
                    <div class="card-body">
                        <img src="img/card-service3.jpg" alt="">
                        <h4 class="fw-bold mt-2 text-center">Fast service</h4>
                        <p class="fw-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet debitis voluptatem culpa! At, maxime libero.</p>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        <p class="contact">Our Contact</p>
                        <i class="bi bi-whatsapp"><span class="mx-1">0812-7566-9055</span></i>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- card-produk -->
    <div class="container" x-data="products">
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3" id="toko">
            <template x-for="(item, index) in items" x-key="index">
                <div class="col-6 col-sm-4">
                    <div class="card h-100 shadow mb-3 rounded product">
                        <img :src="`admin/imgProduct/${item.img}`" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" x-text="item.name"></h5>
                            <p class="card-text fw-normal">IDR : <span class="fw-normal" x-text="rupiah(item.price)"></span></p>
                            <a href="#" @click.prevent="$store.cart.add(item)" class="btn btn-sm rounded-3 tambah-ke-keranjang">add to cart</a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- komentar pelanggan-->
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="testimony" id="komentar">
                <h2 class="text-center">Comments <span class="cst">Customer</span></h2>

                <div class="inputGroup">
                    <input type="text" name="nama" required autocomplete="off">
                    <label for="name">Name</label>
                </div>

                <div class="inputGroup">
                    <input type="text" name="kategori" required autocomplete="off">
                    <label for="name">Kategori</label>
                </div>

                <div class="inputGroup">
                    <input type="file" name="gambar_komentar" required autocomplete="off">
                    <!-- <label for="name"></label> -->
                </div>

                <div class="inputRating">
                    <select aria-label="Small select example" name="rating" required>
                        <option selected disabled hidden>Silakan beri rating pada produk</option>
                        <option value="★" class="text-warning">★</option>
                        <option value="★★" class="text-warning">★★</option>
                        <option value="★★★" class="text-warning">★★★</option>
                        <option value="★★★★" class="text-warning">★★★★</option>
                        <option value="★★★★★" class="text-warning">★★★★★</option>
                    </select>
                </div>

                <div class="inputKomentar">
                    <textarea type="text" name="komentar" required autocomplete="off"></textarea>
                    <label for="name">Your comments</label>
                </div>

                <div class="tombolKirim">
                    <button type="submit" name="kirimKomentar" class="btn btn-lg">Send Comments</button>
                </div>

            </div>
        </form>
    </div>


    <!-- hasil komentar -->
    <div class="container mt-3">
        <div class="row commentResults">
            <div class="col">
                <?php $i = 1; ?>
                <?php foreach ($komen as $row) : ?>

                    <div class="card mt-3" style="border-radius: 20px; overflow: hidden; border: 1px #40A2E3 solid;">
                        <div class="card-header" style="background: #40A2E3;">
                            <span class="fw-bold text-dark"><i class="bi bi-person-fill-check mx-1 text-dark"></i><?= $row['nama']; ?></span>

                        </div>
                        <div class="card-body" style="background-color: #F5F7F8;">

                            <img src="gambar-komentar/<?= $row['gambar_komentar']; ?>" alt="" width="25%">
                            <p style="margin-bottom: -1px;">Kategori: <?= $row['kategori']; ?></p>
                            <p>Rating: <span class="text-warning"><?= $row['rating']; ?></span></p>
                            <p class="cart-text fw-normal mt-2"><?= $row['komentar']; ?></p>
                        </div>
                    </div>

                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="text-dark text-center mt-5" style="height: 40%; background-color:#F5F7F8;">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <h5>Alamat</h5>
                    <?php foreach ($addres as $row) : ?>
                        <p class="fw-normal"><?= $row['alamat']; ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6">
                    <h5>Kontak Kami</h5>
                    <?php foreach ($kontak as $row) : ?>
                        <a class="text-dark fw-normal" href="#" style="text-decoration: none;"><img src="img/logo-wa.png" alt="" width="30">WhatsApp : <?= $row['nomor_wa']; ?></a><br>
                    <?php endforeach; ?>

                </div>
                <section>
                    <div class="container">
                        <div class="col-12">
                            <p class="mt-5"><span class="developer text-dark fw-normal" onclick="redirIg()">Copy right @ 2024 | Developer by Teh botol</span></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </footer>

    <!-- <script src="js/app.js"></> -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("products", () => ({
                items: <?= json_encode($items) ?>,
            }));

            Alpine.store('cart', {
                items: [],
                total: 0,
                quantity: 0,
                add(newItem) {
                    const cartItem = this.items.find((item) => item.id === newItem.id);

                    if (!cartItem) {
                        this.items.push({
                            ...newItem,
                            quantity: 1,
                            total: newItem.price
                        });
                        this.quantity++;
                        this.total += newItem.price;
                    } else {
                        this.items = this.items.map((item) => {
                            if (item.id !== newItem.id) {
                                return item;
                            } else {
                                item.quantity++;
                                item.total = item.price * item.quantity;
                                this.quantity++;
                                this.total = this.items.reduce((acc, item) => acc + item.total, 0);
                                return item;
                            }
                        });

                    }
                },

                remove(id) {
                    const cartItem = this.items.find((item) => item.id === id);

                    if (cartItem.quantity > 1) {
                        this.items = this.items.map((item) => {
                            if (item.id !== id) {
                                return item;
                            } else {
                                item.quantity--;
                                item.total = item.price * item.quantity;
                                this.quantity--;
                                this.total -= item.price; // Mengurangi harga item dari total
                                return item;
                            }
                        });
                    } else if (cartItem.quantity === 1) {
                        this.items = this.items.filter((item) => item.id !== id);
                        this.quantity--;
                        this.total -= cartItem.price; // Mengurangi harga item dari total
                    }
                },
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const checkoutButton = document.querySelector('.checkout-button');
            const form = document.querySelector('form');

            checkoutButton.addEventListener('click', async function(e) {
                e.preventDefault();
                const formData = new FormData(form);
                const data = new URLSearchParams(formData);
                const objData = Object.fromEntries(data);
                const message = formatMessage(objData);

                <?php foreach ($kontak as $row) : ?>
                    window.open('http://wa.me/<?= $row["nomor_wa"]; ?>?text=' + encodeURIComponent(message));
                <?php endforeach; ?>

            });

        });

        const formatMessage = (obj) => {
            return `Data Customer: 
        Nama : ${obj.name}
        Email : ${obj.email}
        No HP : ${obj.phone}
        Data pesanan:
        ${JSON.parse(obj.items).map((item) => `${item.name} (${item.quantity} x ${rupiah(item.total)}) \n`)}
        TOTAL: ${rupiah(obj.total)}
        Terima Kasih.`;
        };

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(number);
        };
    </script>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>