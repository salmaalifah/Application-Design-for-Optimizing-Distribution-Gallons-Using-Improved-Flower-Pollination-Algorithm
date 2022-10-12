<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include("connect.php");
    if(ISSET($_POST["submit"])){
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
        
        $insert_query="INSERT INTO route (agen1, agen2, agen3, agen4, agen5, agen6, agen7, agen8, agen9, agen10, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10) VALUES ('$pilih_agen1','$pilih_agen2','$pilih_agen3','$pilih_agen4','$pilih_agen5','$pilih_agen6','$pilih_agen7','$pilih_agen8','$pilih_agen9','$pilih_agen10','$quantity1','$quantity2','$quantity3','$quantity4','$quantity5','$quantity6','$quantity7','$quantity8','$quantity9','$quantity10')";
        $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $stmt = $con->prepare($insert_query);
        $stmt->execute();
        
        echo '<script type="text/javascript">window.location.href = "../output";</script>';
        
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
                <option value="">Choose...</option>
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
            <?php for($q=0;$q<=10;$q++){ ?>
                <option value="<?php echo $q;?>"><?php echo $q;?></option>
            <?php } ?>
            </select>
        </div>
            
        <?php } ?>
    <button id="submit" type="submit" name="submit" class="btn btn-success btn-sm btn-block" style="margin-top:20px;">Find Route</button>
    </div>
</form>
