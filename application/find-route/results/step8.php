<h4>Hasil Penyerbukan</h4>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
          <th scope="col">Elemen</th>
    </tr>
  </thead>
  <tbody>
      
    <?php
    $agen = array();
    $newarr = NULL;
    $newarr = array();
        for($i=1;$i<=$jmlbunga;$i++){
            echo "<tr><td>$i</td>";
            for($j=0;$j<$banyakp;$j++){
                
                $agen = $bungabaru;
            
                $newkey = $namaagen[$j+1];
                
                $newarr[$i][$newkey] = $agen[$i][$j];
                unset($agen);
                
                echo '
                <td>'. $newarr[$i][$namaagen[$j+1]] .'<br/><span class="text-primary">' . array_search($bungabaru[$i][$j],$newarr[$i]) .'</span></td>
            ';
            }
            echo "</tr>";
        }
        
        $encode = json_encode($bungabaru);
        
        //$decode = json_decode($bungabaru); Decode DB to Array PHP
        
        $insert_query="UPDATE iterasi SET hasil=:hasil, jumlahbunga=:jumlahbunga, switch=:switch WHERE route_id=:id AND iterasi=:iterasi";
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $stmt = $con->prepare($insert_query);
            $stmt->bindParam(':hasil', $encode, PDO::PARAM_STR);
            $stmt->bindParam(':iterasi', $iterasi, PDO::PARAM_STR);
            $stmt->bindParam(':jumlahbunga', $jmlbunga, PDO::PARAM_STR);
            $stmt->bindParam(':switch', $p, PDO::PARAM_STR);
            $stmt->bindParam(':id', $randomid, PDO::PARAM_STR);
            $stmt->execute();
        
    ?>
      
  </tbody>
</table>
