<?php 
require '../fungsi.php';

$id = $_GET['id'];

if (deleteProduct($id) > 0 ) {
    # code...
    echo "
        <script>
            alert('Product berhasil di hapus');
            document.location.href = '../dashboard-product.php';
        </script>
    ";
  
}else {
    echo "
    <script>
        alert('Product gagal di hapus');
        document.location.href = '../dashboard-product.php';
    </script>
";
}
?>