<h4>Menghitung Total Jarak</h4>

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
    
<?php
    //Step 4 : Menghitung Total Jarak
    $latw = array(-7.3601311);
    $longw = array(112.7788957);
    $jarak = array();
    $jaraktemp = array();
    $x_best = array();
        for($i=1;$i<=$jmlbunga;$i++){
            echo '
                <tr>
                    <td>'. $i .'</td>
                    <td>
            ';
            $k=0;
            $permintaan = 0;
            $totaljarak = 0;
            for($j=0;$j<$banyakp;$j++){
                $k++;
                
                $agen[$j] = array_search($bungabaru[$i][$j],$newarr[$i]);
                
                //Inisialisasi Jarak
                $sql = "SELECT * FROM agen WHERE agen_name = :agen_name";
                $query = $db->prepare($sql);
                $query->execute(['agen_name' => $agen[$j]]);
                $results = $query->fetchAll();
                foreach ($results as $tampil) {
                    
                    $lat[$j] = $tampil["latitude"];
                    $long[$j] = $tampil["longitude"];
                    $latlong[$j] = $lat[$j].",".$long[$j];
                
                    $latw[$j+1] = $lat[$j];
                    $longw[$j+1] = $long[$j];
                    
                    //Menghitung Jarak
                    $theta[$j] = $long[$j] - $longw[$j];
                    $dist[$j] = sin(deg2rad($lat[$j])) * sin(deg2rad($latw[$j])) +  cos(deg2rad($lat[$j])) * cos(deg2rad($latw[$j])) * cos(deg2rad($theta[$j]));
                    $dist[$j] = acos($dist[$j]);
                    $dist[$j] = rad2deg($dist[$j]);
                    $miles[$j] = $dist[$j] * 60 * 1.1515;
                    $distance[$j] = $miles[$j] * 1.609344;
                    $distance[$j] = round($distance[$j],2);
                    
                    $jarak[$i][$j] = $distance[$j];
                    
                    
                    if($k<=$banyakp){
                        $permintaan = $permintaan+$row["q$k"];
                        $totaljarak = $totaljarak+$jarak[$i][$j];
                        $jarak_temp[$i] = $totaljarak;
                        
                    }
                    
                    $jarakterendah = min($jarak_temp);
                    $tampilbunga = array_search($jarakterendah, $jarak_temp);
                
                }
                
                sort($bungabaru[$i]);
                
                if($j<$banyakp-1){
                    $garis = " -> ";
                } else {
                    $garis = "";
                }
                
                echo '
                    <span class="text-primary">' . array_search($bungabaru[$i][$j],$newarr[$i]) . '</span> ('. $jarak[$i][$j] . ')' . $garis . '
                ';
            }
            
            echo '
                </td>
                <td>'.$permintaan.'</td>
                <td>'.$totaljarak.' Km</td>
                </tr>
            ';
        }
        
        $bungasementara = array($tampilbunga => $jarakterendah);
        $x_best = $bungabaru[$tampilbunga]; 
?>

  </tbody>
</table>