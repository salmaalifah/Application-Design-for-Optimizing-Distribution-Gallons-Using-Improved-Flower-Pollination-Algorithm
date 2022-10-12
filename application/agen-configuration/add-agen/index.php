<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <title>Add agen</title>
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
                            <button id="btnGroupDrop1" type="button" class="btn btn-info text-white dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false" style="padding:10px;">Agen Configuration
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <li><a class="dropdown-item" href="../">List agen</a></li>
                                <li><a class="dropdown-item" href="../add-agen">Add agen</a></li>
                                <li><a class="dropdown-item" href="../map-agen">Map agen</a></li>
                            </ul>
                        </div>
                        <div class="btn-group flex-md-fill" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn text-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding:10px;">Find Route</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                            <li><a class="dropdown-item" href="../../find-route">Route</a></li>
                            <li><a class="dropdown-item" href="../../find-route/output">Output</a></li>
                            </ul>
                        </div>
                        <div class="btn-group flex-md-fill" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn text-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding:10px;">Warehouse</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                            <li><a class="dropdown-item" href="../../warehouse">Informasi</a></li>
                            <li><a class="dropdown-item" href="../../warehouse/update-warehouse">Update</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn text-info" style="padding:10px;"><a href="../../metode" style="text-decoration:none;" class="text-info">Method</a></button>
                        <button type="button" class="btn text-info" style="padding:10px;"><a href="../../about-us" style="text-decoration:none;" class="text-info">About us</a></button>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row" style="margin-top:20px;margin-bottom:20px;margin-left:10px;margin-right:10px;">
            <div class="container">
                <div class="card border-0" style="padding-top:0px;padding-left:400px;padding-right:400px;">
                <form method="POST" action="../../function/add_agen.php">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                            <label class="form-label">Agen Name</label>
                            <input type="text" name="agen_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control">
                        
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label class="form-label">City Code</label>
                            <input type="text" name="city_code" class="form-control">
                        
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" class="form-control">
                        
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" class="form-control">
                            </div>
                        </div>
                        <button type="submit" name="add" class="btn btn-primary">Add Agen</button>
                    </div>
                </form>
            
                </div>
            </div>
        </div>
    </div>
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