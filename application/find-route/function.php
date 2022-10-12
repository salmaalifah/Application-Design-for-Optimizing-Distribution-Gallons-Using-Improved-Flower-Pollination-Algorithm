<?php
    error_reporting(E_ALL);
    include("../function/connect.php");
    if(ISSET($_POST["submit"])){
        
        //Inisialisasi Input
        $randomid = rand(0,9999);
        $pilih_agen1 = $_POST["pilih_agen_1"];
        $pilih_agen2 = $_POST["pilih_agen_2"];
        $pilih_agen3 = $_POST["pilih_agen_3"];
        $pilih_agen4 = $_POST["pilih_agen_4"];
        $pilih_agen5 = $_POST["pilih_agen_5"];
        $pilih_agen6 = $_POST["pilih_agen_6"];
        $pilih_agen7 = $_POST["pilih_agen_7"];
        $pilih_agen8 = $_POST["pilih_agen_8"];
        $pilih_agen9 = $_POST["pilih_agen_9"];
        $pilih_agen10 = $_POST["pilih_agen_10"];
        $pilih_agen11 = $_POST["pilih_agen_11"];
        $pilih_agen12 = $_POST["pilih_agen_12"];
        $quantity1 = $_POST["quantity_agen_1"];
        $quantity2 = $_POST["quantity_agen_2"];
        $quantity3 = $_POST["quantity_agen_3"];
        $quantity4 = $_POST["quantity_agen_4"];
        $quantity5 = $_POST["quantity_agen_5"];
        $quantity6 = $_POST["quantity_agen_6"];
        $quantity7 = $_POST["quantity_agen_7"];
        $quantity8 = $_POST["quantity_agen_8"];
        $quantity9 = $_POST["quantity_agen_9"];
        $quantity10 = $_POST["quantity_agen_10"];
        $quantity11 = $_POST["quantity_agen_11"];
        $quantity12 = $_POST["quantity_agen_12"];
        
        //Validasi Total Quantity tidak Melebihi ketentuan
        $totalq = $quantity1+$quantity2+$quantity3+$quantity4+$quantity5+$quantity6+$quantity7+$quantity8+$quantity9+$quantity10+$quantity11+$quantity12;
        
        if($totalq >= 101){
            echo '<script type="text/javascript">window.alert("Quantity Melebihi Batas");</script>';
        } else if($totalq <=24) {
            echo '<script type="text/javascript">window.alert("Total Quantity Minimal adalah 25");</script>';
        } else {
        
        //Fungsi AddtoDatabase
            $insert_query="INSERT INTO route (randomid, agen1, agen2, agen3, agen4, agen5, agen6, agen7, agen8, agen9, agen10, agen11, agen12, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12) VALUES ('$randomid','$pilih_agen1','$pilih_agen2','$pilih_agen3','$pilih_agen4','$pilih_agen5','$pilih_agen6','$pilih_agen7','$pilih_agen8','$pilih_agen9','$pilih_agen10','$pilih_agen11','$pilih_agen12','$quantity1','$quantity2','$quantity3','$quantity4','$quantity5','$quantity6','$quantity7','$quantity8','$quantity9','$quantity10','$quantity11','$quantity12')";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->execute();
            
            $insert_query="INSERT INTO ifpa_temp (route_randomid) VALUES ('$randomid')";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->execute();
            
            echo '<script type="text/javascript">window.location.href = "results?id='.$randomid.'";</script>';
        }
    }
?>
<form method="POST" action="#">
    <input type="text" id="start" value="0.881867,104.451129" hidden>
    <input type="text" id="end" value="0.881867,104.451129" hidden>
    <div class="row">
        
        <?php for($a=1;$a<=12;$a++){ ?>
            
        <div class="col-8" style="margin-bottom:10px;">
            <label class="text-center" style="border-bottom:1px;margin-bottom:10px;padding-bottom:10px;">Agen <?php echo $a;?></label>
            <select id="pilih_agen<?php echo $a;?>" class="form-select waypoints" name="pilih_agen_<?php echo $a;?>">
                <option selected>Choose...</option>
            <?php
            $sql = "SELECT * FROM agen ORDER BY id ASC";
            $query = $db->prepare($sql);
            $query->execute();
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $agen_id = $row["agen_id"];
            $agen_name = $row["agen_name"];?>
                <option value="<?php echo $row["id"];?>"><?php echo $agen_name;?></option>
            <?php } ?>
            </select>
        </div>
        
        <div class="col-4" style="margin-bottom:10px;">
            <label class="text-center" style="border-bottom:1px;margin-bottom:10px;padding-bottom:10px;">Quantity</label>
            <select class="form-select" name="quantity_agen_<?php echo $a;?>">
                <option value="0">Pilih...</option>
            <?php for($q=1;$q<=50;$q++){ ?>
                <option value="<?php echo $q;?>"><?php echo $q;?></option>
            <?php } ?>
            </select>
        </div>
            
        <?php } ?>
        
        <div class="row">
            <div class="col-6 d-grid">
                <button id="submit" type="submit" name="submit" class="btn btn-success" style="margin-top:20px;">Find Route</button>
            </div>
            <div class="col-6 d-grid">
                <button id="reset" type="reset" name="reset" class="btn btn-danger" style="margin-top:20px;">Reset</button>
            </div>
        </div>
    
    </div>
</form>