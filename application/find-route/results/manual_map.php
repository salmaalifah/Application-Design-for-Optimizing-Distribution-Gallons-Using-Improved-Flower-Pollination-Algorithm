<?php

    error_reporting(E_ALL);
    include("../../function/connect.php");
    $randomid = $_GET["id"];
    
    $latw = "-7.3601311";
    $longw = "112.7788957";
    
    $latlongarray = array();
    $namaagenarray = array();
    $finalarray = array();
    
    //Get Route Data From Random Id
    $sql = "SELECT * FROM route WHERE randomid = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $randomid]);
    $results = $query->fetchAll();
    foreach ($results as $row) {
        
        $total_harga = 0;
        $total_distance = 0;
        $best_route = "";
        
        //Check Total Input
        $total_input = 0;
        for($hitung=1;$hitung<=12;$hitung++){
            if($row["agen$hitung"]!=0){
                $total_input = $hitung;
            }
        }
        
        for($x=1;$x<=$total_input;$x++){
            
            $agen[$x] = $row["agen$x"];
            
            if($agen[$x]!=0){
                
                $sql = "SELECT * FROM agen WHERE id = :id";
                $query = $db->prepare($sql);
                $query->execute(['id' => $agen[$x]]);
                $results = $query->fetchAll();
                foreach ($results as $tampil) {
                    $lat[$x] = $tampil["latitude"];
                    $long[$x] = $tampil["longitude"];
                    $latlong[$x] = $lat[$x].",".$long[$x];
                    $namaagen[$x] = $tampil["agen_name"];
                    
                    //Rumus Kalkulasi Harga
                    $theta[$x] = $long[$x] - $longw;
                    $dist[$x] = sin(deg2rad($lat[$x])) * sin(deg2rad($latw)) +  cos(deg2rad($lat[$x])) * cos(deg2rad($latw)) * cos(deg2rad($theta[$x]));
                    $dist[$x] = acos($dist[$x]);
                    $dist[$x] = rad2deg($dist[$x]);
                    $miles[$x] = $dist[$x] * 60 * 1.1515;
                    $distance[$x] = $miles[$x] * 1.609344;
                    $distance[$x] = round($distance[$x],2);
                    $distance[$x] = $distance[$x] * 1000; //Merubah Km ke Meter
                    $harga[$x] = $distance[$x] * 10; //1 Meter = Rp.10,-
                    
                    $total_harga = $total_harga+$harga[$x];
                    $total_distance = $total_distance+$distance[$x];
                    
                    array_push($latlongarray,$latlong[$x]);
                    array_push($namaagenarray,$namaagen[$x]);
                    
                    $finalarray = array_combine($namaagenarray,$latlongarray);
                    shuffle($finalarray);
                    
                    
                }
                
            } else {
                $lat[$x] = "";
                $long[$x] = "";
                $latlong[$x] = "";
                $distance[$x] = "";
                $harga[$x] = "";
            }
            
        }
        for($update=0;$update<=$total_input-1;$update++){
            
            //Explode Array dulu
            list($exlat, $exlong) = explode(',', $finalarray[$update]);
            $sql = "SELECT * FROM agen WHERE latitude = :lat AND longitude = :long";
                $query2 = $db->prepare($sql);
                $query2->execute(['lat' => $exlat, 'long' => $exlong]);
                $results2 = $query2->fetchAll();
                foreach ($results2 as $tampil2) {
                    $nama[$update] = $tampil2["agen_name"];
                }
                
                if($update<$total_input-1){
                    $best_route = $best_route . $nama["$update"] . "-> ";
                } else {
                    $best_route = $best_route . $nama["$update"];
                }
                
            
        ?>
            <input type="text" class="waypoints" value="<?php echo $finalarray[$update];?>" placeholder="<?php echo $nama[$update];?>" hidden>
            
            
        <?php }
        
        //Fixed Cost
        $uang_hadir = 7500;
        $loper = 85872;
        $sewa_kendaraan = 6250;
        $bensin_per_liter = 9500; //Contoh
        $fixed_cost = $uang_hadir+$loper+$sewa_kendaraan+$bensin_per_liter;
        
        //Variable Cost
        $KM_distance = $total_distance / 1000;
        $rasio_bensin = 42.8;
        $variable_cost = $bensin_per_liter / $rasio_bensin;
        
        $total_cost = $fixed_cost+$variable_cost*$KM_distance;
        
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- MAPS API -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script type="module" src="google2.js"></script>
    <!-- END MAPS API -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

    <title>Manual | Results Page</title>
  </head>
  <body>
    <div class="container-fluid" style="padding:0;">
        <div class="container-fluid" style="padding-top:20px;padding-bottom:20px;background-color:#20C997;">
            <h1 class="text-center text-white">CV Candra Investindo Pratama</h1>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:10px;margin-right:10px;">
            <div class="col-12">
                <div class="d-flex flex-fill">
                    <div class="btn-group d-flex flex-fill" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group flex-md-fill" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn  text-info dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false" style="padding:10px;">Agen Configuration
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <li><a class="dropdown-item" href="../../agen-configuration">List agen</a></li>
                                <li><a class="dropdown-item" href="../../agen-configuration/add-agen">Add agen</a></li>
                                <li><a class="dropdown-item" href="../../agen-configuration/map-agen">Map agen</a></li>
                            </ul>
                        </div>
                        
                            <div class="btn-group flex-md-fill" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-info text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding:10px;">Find Route</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                            <li><a class="dropdown-item" href="#">Route</a></li>
                            <li><a class="dropdown-item" href="#">Output</a></li>
                            </ul>
                            </div>
                        <div class="btn-group flex-md-fill" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn text-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding:10px;">Warehouse</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" href="../../warehouse">Informasi</a></li>
                            <li><a class="dropdown-item" href="../../warehouse/update-warehouse">Update</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn text-info" style="padding:10px;"><a href="../../metode" class="text-info" style="text-decoration:none;">Method</a></button>
                        <button type="button" class="btn text-info" style="padding:10px;"><a href="../../about-us" class="text-info" style="text-decoration:none;">About us</a></button>
                    </div>
                </div>
            
            <div class="container" style="margin-top:20px;">
                <div class="row">
                    <div class="col-12">
                        <a href="../" class="btn btn-outline-danger" style="margin-bottom:20px;"><i class="bi bi-arrow-left-short"></i> Back to Find Route</a>
                    </div>
                    <div class="col-4" style="border-right:1px solid#000;height:90vh;overflow-y:scroll;">
                        
                        <input type="text" id="start" value="-7.3601311,112.7788957" hidden>
                        <input type="text" id="end" value="-7.360166, 112.778755" hidden>
                        
                        <div class="card" style="margin-bottom:10px;">
                            <div class="card-header">
                                <h2 class="fs-6">Manual Route</h2>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Result Best Route :
                                    <br/>
                                    <?php echo $best_route;?>
                                    <br/>
                                    Total Distance : <?php echo $KM_distance;?> KM
                                    <br/>
                                    Total Cost : Rp. <?php echo round($total_cost,2);?>,-
                                </p>
                            </div>
                        </div>
                        <div id="directions-panel" hidden></div>
                    </div>
                    <div class="col-8" style="min-height:90vh;">
                        <a href="index.php?id=<?php echo $randomid;?>"><button id="ifpa" class="btn btn-outline-dark btn-sm">MAP IFPA</button></a>
                        <button id="manual" class="btn btn-success btn-sm">Manual MAP</button>
                        <div id="map" style="margin-top:10px;height:90vh;overflow-y:scroll;"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- MAPS API -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1Z4tGtjX1AZd2dULNW-R1U4vAY_T3CRQ&callback=initMap&v=weekly"
      defer
    ></script>
    <!-- END MAPS API -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    
  </body>
</html>
<?php } ?>