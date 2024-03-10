<?php 
require '../fungsi.php';

$id = $_GET['id'];

if (deleteLogo($id) > 0 ) {
    # code...
    echo "
        <script>
            alert('Logo berhasil di hapus');
            document.location.href = '../dashboard-logoDanHero.php';
        </script>
    ";
  
}else {
    echo "
    <script>
        alert('Logo gagal di hapus');
        document.location.href = '../dashboard-logoDanHero.php';
    </script>
";
}
?>