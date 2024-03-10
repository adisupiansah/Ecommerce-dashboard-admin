<?php

    $conn = mysqli_connect("localhost", "root", "", "ndrshoop");


    function query($query) {
        global $conn;

        $result = mysqli_query($conn, $query); 
        $rows = [];
        while ($row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }




function komentar($data) {

    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $komentar = htmlspecialchars($data['komentar']);
    $kategori = htmlspecialchars($data['kategori']);
    $rating = htmlspecialchars($data['rating']);

    $gambarKomentar = gambarKomentar();

    if (!$gambarKomentar) {
        # code...
        return false;
    }

    $query = "INSERT INTO tbkomentar (nama, komentar, kategori, gambar_komentar, rating) VALUES ('$nama', '$komentar', '$kategori', '$gambarKomentar', '$rating')";

                mysqli_query($conn, $query);
                return mysqli_affected_rows($conn);

}

function gambarKomentar() {

    $namaFile = $_FILES['gambar_komentar']['name'];
    $ukuranFile = $_FILES['gambar_komentar']['size'];
    $error = $_FILES['gambar_komentar']['error'];
    $tmpName = $_FILES['gambar_komentar']['tmp_name'];

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
    if ($ukuranFile > 10000000) {
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
    move_uploaded_file($tmpName, 'gambar-komentar/' . $namaFileBaru);

    return $namaFileBaru;
}