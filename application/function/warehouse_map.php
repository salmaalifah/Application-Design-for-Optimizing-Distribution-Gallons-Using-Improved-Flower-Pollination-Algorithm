<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $sql = "SELECT * FROM warehouse ORDER BY id ASC";
    $query = $db->prepare($sql);
    $query->execute();
    
    $id = 0;
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    $id++;
    $lat = $row["latitude"];
    $long = $row["longitude"];
?>
    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $lat;?>,<?php echo $long;?>&hl=id&z=20&amp;output=embed"></iframe>
<?php } ?>