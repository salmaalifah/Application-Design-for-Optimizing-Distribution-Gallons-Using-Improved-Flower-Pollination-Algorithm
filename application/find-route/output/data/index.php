<?php
    include("../../../function/connect.php");
    $route_id = $_GET["id"];
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
            
            <div class="container" style="margin-top:20px;">
                
                <div class="col-12">
                    <a href="../" class="btn btn-outline-danger" style="margin-bottom:20px;"><i class="bi bi-arrow-left-short"></i> Back to Output Page</a>
                </div>
                
                <ol class="list-group list-group-numbered">
  

                <?php
                    $sql = "SELECT * FROM iterasi WHERE route_id = $route_id ORDER BY iterasi ASC";
                    $query = $db->prepare($sql);
                    $query->execute();
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $iterasi = $row["iterasi"];
                        $best_route = json_decode($row["urutan"]);
                        $string_br = implode(" -> ",$best_route);
                        $jarak = $row["jarak"];
                        $bungake = $row["bungake"];
                        $switch = $row["switch"];
                        $jumlah = $row["jumlahbunga"];
                    ;?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                              <div class="fw-bold">Iterations : <?php echo $iterasi;?></div>
                              Number of flowers : <?php echo $jumlah;?><br/>
                              Switch Probability : <?php echo $switch;?><br/>
                              Flower : <?php echo $bungake;?><br/>
                              Route : <?php echo $string_br;?><br/>
                              Route Value : <?php echo $jarak;?> Km
                            </div>
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