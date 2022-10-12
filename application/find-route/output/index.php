<?php
    include("../../function/connect.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <title>Find Route | Output</title>
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
                            <li><a class="dropdown-item" href="../">Route</a></li>
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
                <ol class="list-group list-group-numbered">
  

                <?php
                    $sql = "SELECT * FROM route ORDER BY id DESC";
                    $query = $db->prepare($sql);
                    $query->execute();
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $randomid = $row["randomid"];
                    $harga = $row["harga"];
                    $best_route = json_decode($row["best_route"]);
                    $string_br = implode(" -> ",$best_route);
                    $jarak = $row["jarak"];
                    ;?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                              <div class="fw-bold">Route #<?php echo $randomid;?></div>
                              <?php echo $string_br;?>
                            </div>
                            <span class="badge bg-primary rounded-pill"><?php echo $jarak;?> Km</span>
                            <a href="data/?id=<?php echo $randomid;?>" class="stretched-link"></a>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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