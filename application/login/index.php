<?php
include("../function/connect.php");
if(ISSET($_SESSION["username"])){
    echo '<script type="text/javascript">window.location.href = "../agen-configuration/";</script>';
}
if(ISSET($_POST["masuk"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $query = $db->prepare("SELECT * FROM admin WHERE username = ?");
    $query->execute(array($username));
    $hasil = $query->fetch();
    if($query->rowCount() == 0) {
        echo '<script type="text/javascript">alert("Username tidak terdaftar"); </script>';
    } else {
        if($password <> $hasil['password']) {
            echo '<script type="text/javascript">alert("Password salah!"); </script>';
        } else {
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['nama'] = $hasil['nama'];
            echo '<script type="text/javascript">window.location.href = "../agen-configuration/";
                </script>';
        }
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

    <title>Login</title>
  </head>
  <body>
    <div class="container-fluid" style="padding:0;">
        <div class="container-fluid" style="padding-top:20px;padding-bottom:20px;background-color:#20C997;">
            <h1 class="text-center text-white">CV Candra Investindo Pratama</h1>
        </div>
        <div class="card border-0" style="padding-top:100px;padding-left:400px;padding-right:400px;">
        
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" name="masuk" class="btn btn-primary">Login</button>
            </form>
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