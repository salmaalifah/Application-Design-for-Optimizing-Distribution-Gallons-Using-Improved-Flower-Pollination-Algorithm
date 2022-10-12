<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("connect.php");
    $sql = "SELECT * FROM warehouse ORDER BY id ASC";
    $query = $db->prepare($sql);
    $query->execute();
    
    $id = 0;
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    $id++;
    $name = $row["name"];
    $address = $row["address"];
    $phone = $row["phone_number"];
    $lat = $row["latitude"];
    $long = $row["longitude"];
?>
    <p>Warehouse Name : <?php echo $name;?></p>
    <p>Warehouse Address : <?php echo $address;?></p>
    <p>Phone Number : <?php echo $phone;?></p>
    <p>Latitude : <?php echo $lat;?></p>
    <p>Longitude : <?php echo $long;?></p>
<?php } ?>