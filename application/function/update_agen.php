<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("connect.php");
    
    $id = $_GET["id"];
    
    if(ISSET($_POST["update"])){
        
        $agen_name = $_POST["agen_name"];
        $address = $_POST["address"];
        $phone_number = $_POST["phone_number"];
        $city_code = $_POST["city_code"];
        $long = $_POST["longitude"];
        $lat = $_POST["latitude"];
        
        if(!$agen_name || !$address || !$phone_number || !$city_code || !$long || !$lat) {
        
        echo '<script type="text/javascript">alert("Silahkan isi semua kolom"); </script>';
        
        } else {
            $insert_query="UPDATE agen SET agen_name=:agen_name, address=:address, phone_number=:phone_number, city_code=:city_code, longitude=:longitude, latitude=:latitude WHERE id=:id";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->bindParam(':agen_name', $agen_name, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
            $stmt->bindParam(':city_code', $city_code, PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $long, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $lat, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            
            echo '<script type="text/javascript">alert("Data Agen berhasil diupdate"); </script>';
            echo '<script type="text/javascript">window.location.href = "../";
            </script>';
            
        }
        
    } else {
    
    $sql = "SELECT * FROM agen WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $id]);
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $agen_id = $row["agen_id"];
        $agen_name = $row["agen_name"];
        $address = $row["address"];
        $phone_number = $row["phone_number"];
        $city_code = $row["city_code"];
        //$distance = $row["distance"];
        $lat = $row["latitude"];
        $long = $row["longitude"];
?>
<form method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
            <label class="form-label">Agen Name</label>
            <input type="text" name="agen_name" class="form-control" value="<?php echo $agen_name;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address;?>">
        </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number;?>">
        
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
            <label class="form-label">City Code</label>
            <input type="text" name="city_code" class="form-control" value="<?php echo $city_code;?>">
        
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
            <label class="form-label">Longitude</label>
            <input type="text" name="longitude" class="form-control" value="<?php echo $long;?>">
        
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
            <label class="form-label">Latitude</label>
            <input type="text" name="latitude" class="form-control" value="<?php echo $lat;?>">
            </div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Agen</button>
    </div>
</form>
<?php } } ?>