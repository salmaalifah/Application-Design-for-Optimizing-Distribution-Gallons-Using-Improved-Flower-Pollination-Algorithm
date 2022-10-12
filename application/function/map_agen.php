<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<div class="row" style="min-height:100vh;">
    <div class="col-4" style="border-right:1px solid#000;">
        <h3 class="text-center" style="border-bottom:1px solid #000;margin-bottom:10px;padding-bottom:10px;">List Agen</h3>
        <ul class="list-group">
        <?php
            include("connect.php");

            $sql = "SELECT * FROM agen ORDER BY id ASC";
            $query = $db->prepare($sql);
            $query->execute();
            
            $id = 0;
            
            while($row = $query->fetch(PDO::FETCH_ASSOC)) { 
            $id++;
            $agen_id = $row["agen_id"];
            $agen_name = $row["agen_name"];
        ?>
          <a id="<?php echo $id;?>" style="text-decoration:none;"><li class="list-group-item list-group-item-action" aria-current="true"><?php echo $agen_name;?></li></a>
        <?php
            }
        ?>
        </ul>
    </div>
    <div id="map" class="col-8">
        <!--Map-->
    </div>
</div>