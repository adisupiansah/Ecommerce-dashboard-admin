<?php 
require '../fungsi.php';

$id = $_GET['id'];

if (deleteAlamat($id) > 0 ) {
    # code...
    echo "
        <script>
            alert('Data berhasil di hapus');
            document.location.href = '../dashboard-alamat.php';
        </script>
    ";
  
}else {
    echo "
    <script>
        alert('Data gagal di hapus');
        document.location.href = '../dashboard-alamat.php';
    </script>
";
}
?>