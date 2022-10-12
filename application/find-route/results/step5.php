<h4>Menampilkan Bunga Terbaik Sementara</h4>

<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
      <th scope="col">Urutan</th>
      <th scope="col">Permintaan</th>
      <th scope="col">Jarak</th>
    </tr>
  </thead>
  <tbody>
      <tr>
          <td><?php echo $tampilbunga ;?></td>
          <td><?php
                $urutan = array();
                    for($j=0;$j<$banyakp;$j++){
                        
                        if($j<$banyakp-1){
                            $garis = " -> ";
                        } else {
                            $garis = "";
                        }
                        
                        echo '<span class="text-primary">'.array_search($bunga[$tampilbunga][$j],$newarr[$tampilbunga]).' </span>'.$garis;
                        
                        $urutan[$iterasi][$j] = array_search($bunga[$tampilbunga][$j],$newarr[$tampilbunga]);
                        
                    }
          ;?></td>
          <td><?php echo $permintaan;?></td>
          <td><?php echo $jarakterendah;?> Km</td>
      </tr>
  </tbody>
</table>

<?php
    $bunga_ke = $tampilbunga;
    $encode = json_encode($urutan[$iterasi]);
        
        $insert_query="INSERT INTO iterasi (route_id, bungake, permintaan, urutan, iterasi,jarak) VALUES ('$randomid','$bunga_ke','$permintaan','$encode','$iterasi','$jarakterendah')";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->execute();
?>
