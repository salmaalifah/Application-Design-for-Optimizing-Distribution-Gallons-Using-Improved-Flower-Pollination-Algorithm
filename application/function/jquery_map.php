<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
<?php
    $sql = "SELECT * FROM agen ORDER BY id ASC";
    $query = $db->prepare($sql);
    $query->execute();
    
    $id = 0;
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    $id++;
    $lat = $row["latitude"];
    $long = $row["longitude"];
?>
<script type="text/javascript">
    //Map Function (Lat/Long)
    $("#<?php echo $id;?>").click(function(){
        $("#map").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $lat;?>,<?php echo $long;?>&hl=id&z=16&amp;output=embed"></iframe>');
    });
</script>
<?php } ?>