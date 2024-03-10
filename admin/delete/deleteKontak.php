<?php 
require '../fungsi.php';

$id = $_GET['id'];

if (deleteKontak($id) > 0 ) {
    # code...
    echo "
        <script>
            alert('Kontak berhasil di hapus');
            document.location.href = '../dashboard-kontak.php';
        </script>
    ";
  
}else {
    echo "
    <script>
        alert('Kontak gagal di hapus');
        document.location.href = '../dashboard-kontak.php';
    </script>
";
}
?>