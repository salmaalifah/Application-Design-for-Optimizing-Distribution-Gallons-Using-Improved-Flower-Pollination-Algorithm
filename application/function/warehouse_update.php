<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("connect.php");
    
    if(ISSET($_POST["update"])){
        
        $name = $_POST["name"];
        $address = $_POST["address"];
        $phone_number = $_POST["phone_number"];
        $long = $_POST["long"];
        $lat = $_POST["lat"];
        
        if(!$name || !$address || !$phone_number || !$long || !$lat) {
        
        echo '<script type="text/javascript">alert("Silahkan isi semua kolom"); </script>';
        
        } else {
            
            $id = "1";
            $insert_query="UPDATE warehouse SET name=:name, address=:address, phone_number=:phone_number, longitude=:longitude, latitude=:latitude WHERE id=:id";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $long, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $lat, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            
            echo '<script type="text/javascript">alert("Data Warehouse berhasil diupdate"); </script>';
            echo '<script type="text/javascript">window.location.href = "../";
            </script>';
            
        }
        
    } else {
    
    $sql = "SELECT * FROM warehouse WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => "1"]);
    
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $name = $row["name"];
        $address = $row["address"];
        $phone_number = $row["phone_number"];
        $lat = $row["latitude"];
        $long = $row["longitude"];
?>
                 <form method="post">
                    <div class="col-10">
                        <div class="mb-3">
                        <label class="form-label">Warehouse Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address;?>">
                    </div>
                    </div>
                    <div class="col-10">
                        <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number;?>">
                    
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="text" name="lat" class="form-control" value="<?php echo $lat;?>">
                    
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" name="long" class="form-control" value="<?php echo $long;?>">
                    </div>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                
                </form>
<?php } } ?>