<?php
    include("connect.php");
        
    $random = rand(0,500);
    $agen_id = "#agen" . $random;
    
    $agen_name = $_POST["agen_name"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $city_code = $_POST["city_code"];
    $long = $_POST["longitude"];
    $lat = $_POST["latitude"];
    
    //Distance Calculation
    $id = "1";
    $sql = "SELECT * FROM warehouse WHERE id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $id]);
    $results = $query->fetchAll();
    foreach ($results as $row) {
        $latw = $row["latitude"];
        $longw = $row["longitude"];
        
        $theta = $long - $longw;
        $dist = sin(deg2rad($lat)) * sin(deg2rad($latw)) +  cos(deg2rad($lat)) * cos(deg2rad($latw)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = $miles * 1.609344;
        $distance = round($distance,2);
        
        
    }
    //End Distance Calculation
    
    if(!$agen_id || !$agen_name || !$address || !$phone_number || !$city_code || !$long || !$lat) {
        
        echo '<script type="text/javascript">alert("Silahkan isi semua kolom"); </script>';
        
        if(!$distance){
            echo '<script type="text/javascript">alert("Distance masih kosong"); </script>';
        }
        
    } else {
        $sql = $db->prepare("INSERT INTO agen (agen_id, agen_name, address, phone_number, city_code, longitude, latitude, distance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $simpan = $sql->execute(array($agen_id, $agen_name, $address, $phone_number, $city_code, $long, $lat, $distance));
        if($simpan) {
            echo '<script type="text/javascript">alert("Data Agen berhasil disimpan"); </script>';
            echo '<script type="text/javascript">window.location.href = "../agen-configuration/";
            </script>';
        }
    }
?>