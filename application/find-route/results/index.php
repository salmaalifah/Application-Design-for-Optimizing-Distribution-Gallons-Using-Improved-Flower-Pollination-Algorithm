<?php
    error_reporting(E_ALL);
    include("../../function/connect.php");
    $randomid = $_GET["id"];
    
    $latw = array(-7.3601311);
    $longw = array(112.7788957);
    $jumlah_agen = 0;
    
    //Get Route Data From Random Id
    $sql = "SELECT * FROM route WHERE randomid = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $randomid]);
    $results = $query->fetchAll();
    foreach ($results as $row) {
        
        $total_harga = 0;
        $total_distance = 0;
        
        for($x=1;$x<=12;$x++){
            
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
                    
                    //
                    $latw[$x] = $lat[$x];
                    $longw[$x] = $long[$x];
                    
                    $jumlah_agen = $jumlah_agen+1;
                    
                }
                
            } else {
                $lat[$x] = "";
                $long[$x] = "";
                $latlong[$x] = "";
            }
            
        }
        
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
    <script type="module" src="google.js"></script>
    <!-- END MAPS API -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">

    <title>Results Page</title>
  </head>
  <body>
    <div class="container-fluid" style="padding:0;">
        <div class="container-fluid" style="padding-top:20px;padding-bottom:20px;background-color:#20C997;">
            <div class="row">
                
                <div class="col-3">
                    
                </div>
                <div class="col-5">
                    <h1 class="text-center text-white">CV Candra Investindo Pratama</h1>
                </div>
                <div class="col-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="https://candrainvestindo.xyz/.logout.php"><button class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-left"></i></button></a>
                     </div>
                </div>
            </div>
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
                            <li><a class="dropdown-item" href="">Output</a></li>
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
                        
                        
                        <!-- Harus Dirombak Sesuaikan dengan Decode Json Best_route -->
                        <input type="text" id="start" value="-7.3601311,112.7788957" hidden>
                        
                        <?php
                        
                            $inisasi = 0;
                            include("step1.php");
                            $inisasi = 1;
                            
                        ?>
                        
                        <div id="add2"></div>
                        
                        <input type="text" id="end" value="-7.360166, 112.778755" hidden>
                        <!-- END Harus Dirombak Sesuaikan dengan Decode Json Best_route -->
                        
                        <div class="card" style="margin-bottom:10px;">
                            <div class="card-header">
                                <h2 class="fs-6">Improved Flower Pollination Algorithm</h2>
                            </div>
                            <div class="card-body">
                                <div id="add">
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div id="directions-panel" hidden></div>
                        
                        
                        
                    </div>
                    <div class="col-8" style="min-height:90vh;">
                        <button id="ifpa" class="btn btn-success btn-sm">MAP IFPA</button>
                        <a href="manual_map.php?id=<?php echo $randomid;?>"><button id="manual" class="btn btn-outline-dark btn-sm">Manual MAP</button></a>
                        <div id="map" style="margin-top:10px;height:90vh;overflow-y:scroll;"></div>
                    </div>
                    <div class="col-12">
                        <div class="card" style="margin-bottom:10px;">
                            <div class="card-header">
                                <h2 class="fs-6">Step by Step</h2>
                            </div>
                            <div class="card-body">
                                <?php
                                
                                include("step1.php");
                                for($iterasi=0;$iterasi<=$max_iterasi;$iterasi++){
                                    echo "<h4>Iterasi ke-$iterasi</h4><br/>";
                                    if($iterasi > 0){
                                        $bunga = $bungabaru;
                                        //$bunga_sebelum_sort = $bunga;
                                        
                                    } else {
                                        include("step2.php");
                                    }
                                    
                                    include("step3.php");
                                    include("step4.php");
                                    include("step5.php");
                                    
                                    if($iterasi!=$max_iterasi){
                                        include("step6.php");
                                        include("step7.php");
                                        include("step8.php");
                                    } else { }
                                }
                                    
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-12">
                        <div class="card card-body bg-light">
                            <h4>Mencari X_Best terbaik</h4>
                            <?php include("x_best.php");?>
                            <!--Tes Disini-->
                            
                        </div>
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
    
    <script>
        $(document).ready(function(){
            $("#hideaja").remove();
            $("#remove").remove();
        })
    </script>
    <?php } ?>
  </body>
</html>