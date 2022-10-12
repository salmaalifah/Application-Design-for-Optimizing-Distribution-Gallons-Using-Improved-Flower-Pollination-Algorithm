<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Iterasi</th>
      <th scope="col">Bunga Terpilih</th>
      <th scope="col">Urutan</th>
      <th scope="col">Permintaan</th>
      <th scope="col">Jarak</th>
    </tr>
  </thead>
  <tbody>
      
<?php
    $jarak = array();
    $i=0;

    $sql = "SELECT * FROM iterasi WHERE route_id = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $randomid]);
    $results = $query->fetchAll();
    foreach ($results as $row) {
        $i++;
    
    $urutan_echo = json_decode($row["urutan"]);
    
    ?>
        <tr>
            <td><?php echo $row["iterasi"];?></td>
            <td><?php echo $row["bungake"];?></td>
            <td>
                <?php
                    for($u=0;$u<=$banyakp;$u++){
                        if($u<$banyakp-1){
                            $garis = " -> ";
                        } else {
                            $garis = " ";
                        }
                        echo "<span class='text-primary'>$urutan_echo[$u]</span>$garis";
                        
                    }
                    $jarak[$i] = $row["jarak"];
                ?>
            </td>
            <td><?php echo $row["permintaan"];?></td>
            <td><?php echo $row["jarak"];?> Km</td>
        </tr>
    <?php 
        
        
        $terpilih = min($jarak);
        
        if($row["jarak"] === $terpilih || $row["jarak"] === $terpilih[1]){
            
            //Fixed Cost
            $supir = 174000;
            $perawatan = 10000;
            $bensin_per_liter = 7650;
            
            $fixed_cost = $supir+$perawatan+$bensin_per_liter;
            
            //Variable Cost
            $KM_distance = $row["jarak"] / 1000;
            $rasio_bensin = 12.6;
            $variable_cost = $bensin_per_liter / $rasio_bensin;
            
            $total_cost = $fixed_cost+$variable_cost*$KM_distance;
            $total_cost = round($total_cost,0);
            
            $insert_query="UPDATE route SET best_route=:best_route, harga=:harga, jarak=:jarak WHERE randomid=:id";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->bindParam(':best_route', $row["urutan"], PDO::PARAM_STR);
            $stmt->bindParam(':jarak', $terpilih, PDO::PARAM_STR);
            $stmt->bindParam(':harga', $total_cost, PDO::PARAM_STR);
            $stmt->bindParam(':id', $randomid, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        
    }
    
    //Get Route Data From Random Id
    $sql = "SELECT * FROM route WHERE randomid = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $randomid]);
    $results = $query->fetchAll();
    foreach ($results as $row) {
        $best_route = json_decode($row["best_route"]);
        $string_br = implode(" -> ",$best_route);?>
        
        
        
    <?php }
        $route_list = array();
        $route_list = json_decode($row["best_route"]);
        for($list=0;$list<=$banyakp;$list++){
            
            $sql = "SELECT * FROM agen WHERE agen_name = :id";
            $query = $db->prepare($sql);
            $query->execute(['id' => $route_list[$list]]);
            $results = $query->fetchAll();
            foreach ($results as $tampil) {
                $latlong = $tampil["latitude"].','.$tampil["longitude"]; ?>
                
                <script>
                    var tambah = '<input type="text" class="waypoints" value="<?php echo $latlong;?>" hidden>';
                    $("#add2").after(tambah);
                </script>
                
                
            <?php }
            
        }
    ?>
    
    
    
</tbody>
</table>

<script>
    var isi = '<p id="tambah" class="card-text">Result Best Route :<br/><?php $best_route = json_decode($row["best_route"]);$string_br = implode(" -> ",$best_route);echo $string_br;?><br/>Total Distance : <?php echo $row["jarak"];?> KM<br/>Total Cost : Rp. <?php echo $row["harga"];?>,-</p>';
    $("#add").html(isi);
</script>