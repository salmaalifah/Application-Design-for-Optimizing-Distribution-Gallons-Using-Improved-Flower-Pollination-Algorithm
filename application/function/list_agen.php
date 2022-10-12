<table class="table table-bordered">
     <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Agen ID</th>
            <th scope="col">Agen Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone Number</th>
            <th scope="col">City Code</th>
            <th scope="col">Distance</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
                    
                
<?php
    include("connect.php");
    
    $sql = "SELECT * FROM agen ORDER BY id ASC";
    $query = $db->prepare($sql);
    $query->execute();
    
    $id = 0;
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    $id++;
    $agen_id = $row["agen_id"];
    $agen_name = $row["agen_name"];
    $address = $row["address"];
    $phone_number = $row["phone_number"];
    $city_code = $row["city_code"];
    $distance = $row["distance"];
    $lat = $row["latitude"];
    $long = $row["longitude"];
?>
        <tr>
            <th scope="row"><?php echo $id;?></th>
            <td><?php echo $agen_id;?></td>
            <td><?php echo $agen_name;?></td>
            <td><?php echo $address;?></td>
            <td><?php echo $phone_number;?></td>
            <td><?php echo $city_code;?></td>
            <td><?php echo $distance . " Km";?></td>
            <td><?php echo $lat;?></td>
            <td><?php echo $long;?></td>
            <td class="d-grid gap-2">
                <a href="update-agen/?id=<?php echo $row["id"];?>" style="text-decoration:none;" class="btn btn-success btn-sm btn-block" >Update</a>
                <a href="../function/delete_agen.php/?id=<?php echo $row["id"];?>" style="text-decoration:none;" class="btn btn-danger btn-sm btn-block">Delete</a>
            </td>
        </tr>
                    
<?php } ?>
                    
    </tbody>
</table>