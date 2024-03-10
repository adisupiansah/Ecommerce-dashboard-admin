<?php 
require '../fungsi.php';

$id = $_GET['id'];

if (delete($id) > 0 ) {
    # code...
    echo "
        <script>
            alert('Service berhasil di hapus');
            document.location.href = '../dashboard-service.php';
        </script>
    ";
  
}else {
    echo "
    <script>
        alert('Service gagal di hapus');
        document.location.href = '../dashboard-service.php';
    </script>
";
}
?>