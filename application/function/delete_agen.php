<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("connect.php");
    $id = $_GET["id"];
    
    $sql = "DELETE FROM agen WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    
    echo '<script type="text/javascript">alert("Data Agen sudah dihapus"); </script>';
    echo '<script>history.go(-1);</script>';
?>