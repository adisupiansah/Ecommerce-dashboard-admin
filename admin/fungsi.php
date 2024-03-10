<?php

$conn = mysqli_connect("localhost", "root", "", "ndrshoop");


function quer($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi untuk Form Input Service
function inputService($service)
{
    global $conn;

    $kategoriService = htmlspecialchars($service['kategori_service']);
    $keteranganService = htmlspecialchars($service['ket_service']);
    $kontakService = htmlspecialchars($service['kontak_service']);

    $gambarService = uploadService();
    if (!$gambarService) {
        # code...
        return false;
    }

    $query = "INSERT INTO dashboard_input_service (kategori_service, ket_service, kontak_service, gambar) VALUES ('$kategoriService', '$keteranganService', '$kontakService', '$gambarService')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadService()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar di upload
    if ($error === 4) {
        # code...
        echo "
                <script>
                    alert('pilih gambar terlebih dahulu');
                </script>
            ";

        return false;
    }

    // cek apakah diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        # code...
        echo "
                <script>
                    alert('yang anda upload bukan gambr');
                </script>";

        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 1000000) {
        # code...
        echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>";

        return false;
    }

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmpName, 'asset/' . $namaFileBaru);

    return $namaFileBaru;
}

// Edit
function editService($data)
{

    global $conn;

    $id = $data["id"];
    $kategoriService = htmlspecialchars($data['kategori_service']);
    $keteranganService = htmlspecialchars($data['ket_service']);
    $kontakService = htmlspecialchars($data['kontak_service']);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atw tidak
    if( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadService();
    }


    $query = "UPDATE dashboard_input_service SET 
                kategori_service = '$kategoriService',
                ket_service = '$keteranganService',
                kontak_service = '$kontakService',
                gambar = '$gambar'
            WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM dashboard_input_service WHERE id = $id");

    return mysqli_affected_rows($conn);
}


// input Product
function inputProduct($product)
{
    global $conn;

    $nameProduct = htmlspecialchars($product['name']);
    $priceProduct = htmlspecialchars($product['price']);

    $gambarProduct = uploadProduct();
    if (!$gambarProduct) {
        # code...
        return false;
    }


    $query = "INSERT INTO products (name, img, price) VALUES ('$nameProduct', '$gambarProduct', '$priceProduct')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadProduct()
{
    $namaFile = $_FILES['img']['name'];
    $ukuranFile = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmpName = $_FILES['img']['tmp_name'];

    // cek apakah tidak ada gambar di upload
    if ($error === 4) {
        # code...
        echo "
                <script>
                    alert('pilih gambar terlebih dahulu');
                </script>
            ";

        return false;
    }

    // cek apakah diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        # code...
        echo "
                <script>
                    alert('yang anda upload bukan gambr');
                </script>";

        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 1000000) {
        # code...
        echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>";

        return false;
    }

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmpName, 'imgProduct/' . $namaFileBaru);

    return $namaFileBaru;
}

// Edit produk
function editProduct($data){

    global $conn;

    $id = $data["id"];
    $namaProduk = htmlspecialchars($data["name"]);
    $hargaProduk = htmlspecialchars($data["price"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atw tidak
    if( $_FILES['img']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadProduct();
    }


    $query = "UPDATE products SET 
                name = '$namaProduk',
                img = '$gambar',
                price = '$hargaProduk'
            WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteProduct($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM products WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Form pengisian logo dan hero
function inputLogo($logoDanHero)
{
    global $conn;

    $logoCompany = uploadLogo();
    if (!$logoCompany) {
        # code...
        return false;
    }

    $namaLogo = htmlspecialchars($logoDanHero['nama_logo']);
    $keteranganCompany = htmlspecialchars($logoDanHero['ket_company']);

    $gambarProfil = uploadProfil();
    if (!$gambarProfil) {
        # code...
        return false;
    }



    $query = "INSERT INTO logo_hero (logo, nama_logo, ket_company, gambar_profil) VALUES ('$logoCompany', '$namaLogo', '$keteranganCompany', '$gambarProfil')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadLogo()
{
    $namaFile = $_FILES['logo']['name'];
    $ukuranFile = $_FILES['logo']['size'];
    $error = $_FILES['logo']['error'];
    $tmpName = $_FILES['logo']['tmp_name'];

    // cek apakah tidak ada gambar di upload
    if ($error === 4) {
        # code...
        echo "
                <script>
                    alert('pilih gambar terlebih dahulu');
                </script>
            ";

        return false;
    }

    // cek apakah diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        # code...
        echo "
                <script>
                    alert('yang anda upload bukan gambr');
                </script>";

        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 100000000) {
        # code...
        echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>";

        return false;
    }

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmpName, 'asset/' . $namaFileBaru);

    return $namaFileBaru;
}

// Edit logo
function editLogo($data){

    global $conn;

    $id = $data["id"];
    
    

    $logoLama = htmlspecialchars($data["logoLama"]);
    $namaLogo = htmlspecialchars($data["nama_logo"]);
    $ketCompany = htmlspecialchars($data['ket_company']);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atw tidak
    if( $_FILES['gambar_profil']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadProfil();
    }

    if ($_FILES['logo']['error'] === 4) {
        # code...
        $logo = $logoLama;
    } else {
        $logo = uploadLogo();
    }


    $query = "UPDATE logo_hero SET 
                logo = '$logo',
                nama_logo = '$namaLogo',
                ket_company = '$ketCompany',
                gambar_profil = '$gambar'
            WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadProfil()
{
    $namaFile = $_FILES['gambar_profil']['name'];
    $ukuranFile = $_FILES['gambar_profil']['size'];
    $error = $_FILES['gambar_profil']['error'];
    $tmpName = $_FILES['gambar_profil']['tmp_name'];

    // cek apakah tidak ada gambar di upload
    if ($error === 4) {
        # code...
        echo "
                <script>
                    alert('pilih gambar terlebih dahulu');
                </script>
            ";

        return false;
    }

    // cek apakah diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        # code...
        echo "
                <script>
                    alert('yang anda upload bukan gambr');
                </script>";

        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 100000000) {
        # code...
        echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>";

        return false;
    }

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmpName, 'asset/' . $namaFileBaru);

    return $namaFileBaru;
}

function deleteLogo($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM logo_hero WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Form Input Kontak Pedagang
function inputKontak($contact)
{
    global $conn;

    $nomorWhatsApp = htmlspecialchars($contact['nomor_wa']);
    $namaKontak = htmlspecialchars($contact['nama_kontak']);

    $query = "INSERT INTO input_kontak (nomor_wa, nama_kontak) VALUES ('$nomorWhatsApp', '$namaKontak')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Edit Kontak
function editKontak($data){

    global $conn;

    $id = $data["id"];
    $namaKontak = htmlspecialchars($data["nama_kontak"]);
    $nomor = htmlspecialchars($data["nomor_wa"]);

    $query = "UPDATE input_kontak SET 
                nomor_wa = '$nomor',
                nama_kontak = '$namaKontak'
            WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteKontak($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM input_kontak WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Form pengisian Alamat pedagang
function inputAlamat($contact)
{
    global $conn;

    $alamat = htmlspecialchars($contact['alamat']);
    $urlAlamat = htmlspecialchars($contact['url_alamat']);

    $gambarAlamat = uploadAlamat();
    if (!$gambarAlamat) {
        # code...
        return false;
    }

    $query = "INSERT INTO input_alamat (alamat, url_alamat, gambar_alamat) VALUES ('$alamat', '$urlAlamat', '$gambarAlamat')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function uploadAlamat()
{
    $namaFile = $_FILES['gambar_alamat']['name'];
    $ukuranFile = $_FILES['gambar_alamat']['size'];
    $error = $_FILES['gambar_alamat']['error'];
    $tmpName = $_FILES['gambar_alamat']['tmp_name'];

    // cek apakah tidak ada gambar di upload
    if ($error === 4) {
        # code...
        echo "
                <script>
                    alert('pilih gambar terlebih dahulu');
                </script>
            ";

        return false;
    }

    // cek apakah diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        # code...
        echo "
                <script>
                    alert('yang anda upload bukan gambr');
                </script>";

        return false;
    }

    // cek ukuran gambar
    if ($ukuranFile > 100000000) {
        # code...
        echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>";

        return false;
    }

    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap di upload
    move_uploaded_file($tmpName, 'asset/' . $namaFileBaru);

    return $namaFileBaru;
}

// Edit alamat
function editAlamat($data){

    global $conn;

    $id = $data["id"];
    $alamat = htmlspecialchars($data["alamat"]);
    $urlAlamat = htmlspecialchars($data["url_alamat"]);
    $gambarLama = htmlspecialchars($data["gambar_lama"]);
    
    // cek apakah user pilih gambar baru atw tidak
    if( $_FILES['gambar_alamat']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadAlamat();
    }


    $query = "UPDATE input_alamat SET 
                alamat = '$alamat',
                url_alamat = '$urlAlamat',
                gambar_alamat = '$gambar'
            WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteAlamat($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM input_alamat WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_escape_string($conn, $data['password']);
    $password2 = mysqli_escape_string($conn, $data['password2']);

    // cek username, apakah sudah terdaftar sebelumnya ?
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result) ) {
        echo "
        <script>
            alert('maaf nama user sudah terdaftar sebelumnya');
        </script>
        ";

        return false;
    }

    // cek konfirmasi password,, apakah sama 

    if ($password !== $password2) {
        # code...
        echo "
        <script>
            alert('password tidak sesuai');
        </script>
        
        ";
        return false;
    }

    // enkripsi password (ubah password menjadi random di database)
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru di database ketika selesai mendaftar
    mysqli_query($conn, "INSERT INTO user (username, password) VALUES('$username', '$password')");

    return mysqli_affected_rows($conn);
}
