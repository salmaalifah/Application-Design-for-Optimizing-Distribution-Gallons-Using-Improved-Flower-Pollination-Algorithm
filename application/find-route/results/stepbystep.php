<?php
    error_reporting(E_ALL);
    include("../../function/connect.php");
    
    //Step 1 : Inisiasi
    $jmlbunga = 5;
    $max_iterasi = 10;
    $y = 0.2;
    $p = 0.80000;
    $lambda = 1.5;
    $banyakp = $jumlah_agen;
    $i=1;
    $j=1;
    $varians = 0.6965745;
    $gf = 0.2992067103;
?>

<h4>Step 1 : Inisasi</h4>
<div class="d-grid gap-2" style="margin-bottom:20px;">
    <span>Jumlah Bunga = <?php echo $jmlbunga;?></span>
    <span>Max Iterasi = <?php echo $max_iterasi;?></span>
    <span>y = <?php echo $y;?></span>
    <span>p = <?php echo $p;?></span>
    <span>lambda = <?php echo $lambda;?></span>
    <span>banyakp = <?php echo $banyakp;?></span>
</div>

<h4>Step 2 : Generate Angka</h4>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
      <th scope="col">Elemen</th>
    </tr>
  </thead>
  <tbody>

<?php
    //Step 2 : Generate Angka
    $agen = array();
    $newarr = array();
    for($i=1;$i<=$jmlbunga;$i++){
        echo '
            <tr>
                <td>'. $i .'</td>
        ';
        for($j=1;$j<=$banyakp;$j++){
            $decimals = 5;
            $div = pow(10, $decimals);
            $rand = mt_rand(0.00001 * $div, 1.00000 * $div) / $div;
            $bunga[$i][$j] = number_format($rand,5);
            
            $agen = $bunga;
            
            $newkey = $namaagen[$j];
            
            $newarr[$i][$newkey] = $agen[$i][$j];
            unset($agen);
            echo '
                <td>'. $newarr[$i][$namaagen[$j]] .'<br/><span class="text-primary">' . array_search($bunga[$i][$j],$newarr[$i]) .'</span></td>
            ';
        }
        echo '
            </tr>
        ';
        
    }
?>

  </tbody>
</table>

<h4>Step 3 : Mengurutkan Nilai dari yang Terkecil</h4>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
      <th scope="col">Urutan</th>
    </tr>
  </thead>
  <tbody>

<?php
    //Step 3 : Mengurutkan Nilai
  
        for($i=1;$i<=$jmlbunga;$i++){
            echo '
                <tr>
                    <td>'. $i .'</td>
                    <td>
            ';
            
            $k=1;
            for($j=0;$j<=$banyakp;$j++){
                
                sort($bunga[$i]);
                
                if($j<$banyakp-1){
                    $garis = " -> ";
                } else {
                    $garis = "";
                }
                
                echo '
                    <span class="text-primary">' . array_search($bunga[$i][$j],$newarr[$i]) . '</span>'. $garis . '
                ';
            }
            
            echo '
                </td>
                </tr>
            ';
        }
?>

  </tbody>
</table>

<h4>Step 4 : Menghitung Total Jarak</h4>

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
                
                $agen[$j] = array_search($bunga[$i][$j],$newarr[$i]);
                
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
                
                sort($bunga[$i]);
                
                if($j<$banyakp-1){
                    $garis = " -> ";
                } else {
                    $garis = "";
                }
                
                echo '
                    <span class="text-primary">' . array_search($bunga[$i][$j],$newarr[$i]) . '</span> ('. $jarak[$i][$j] . ')' . $garis . '
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
        $x_best = $bunga[$tampilbunga]; 
?>

  </tbody>
</table>

<?php
    print("<pre>");
    var_export($x_best);
    print("</pre>");
?>

<h4>Step 5 : Menampilkan Bunga Terbaik Sementara</h4>

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
                $x = 3;
                for($i=1;$i<=$jmlbunga;$i++){
                    for($j=0;$j<$banyakp;$j++){
                        $x++;
                        echo '<span class="text-primary">'.array_search($bunga[$i][$j],$newarr[$tampilbunga]).' </span>';
                        
                        if($x<$banyakp*2){
                            echo " -> ";
                        }
                    }
                }
          ;?></td>
          <td><?php echo $permintaan;?></td>
          <td><?php echo $jarakterendah;?> Km</td>
      </tr>
  </tbody>
</table>

<h4>Step 6 : Membangkitkan nilai Pi</h4>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
          <th scope="col">Nilai Pi</th>
    </tr>
  </thead>
  <tbody>
      
      <?php
        //Step 6 : Membangkitkan nilai Pi
        $nilaipi = array();
        for($i=1;$i<=$jmlbunga;$i++){
            echo '
                <tr>
                    <td>'. $i .'</td>
            ';
            $decimals = 5;
            $div = pow(10, $decimals);
            $rand = mt_rand(0.00001 * $div, 1.00000 * $div) / $div;
            $nilaipi[$i] = number_format($rand,5);
            
            echo '
                <td>'.$nilaipi[$i].'</td>
            ';
            echo '
                </tr>
            ';
        
        }
    ?>
    </tbody>
</table>

<h4>Step 7 : Menentukan Jenis Penyerbukan</h4>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
          <th scope="col">Elemen</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $jenis = array();
      $value = array();
      $hasilpenyerbukan = array();
      $j=0;
      $u = array();
      $v = array();
      
      $bungabaru = $bunga;
      
      for($i=1;$i<=$jmlbunga;$i++){
          echo '
                <tr>
                    <td>'. $i .'</td>
          ';
          
          if($nilaipi[$i] < $p){
                $jenis[$i] = "Penyerbukan Global"; //Array Push
                
                //Penyerbukan Global
                include("penyerbukan_global.php");
                
            } else {
                $jenis[$i] = "Penyerbukan Lokal";
                
                //Penyerbukan Lokal
                include("penyerbukan_lokal.php");
                
            }
          
          echo '
                    <td>'. $nilaipi[$i] .' ('.$jenis[$i].')</td></tr>
          ';
      }
      
      ?>
  </tbody>
</table>

<h4>Step 8 : Hasil Penyerbukan</h4>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Bunga</th>
          <th scope="col">Elemen</th>
    </tr>
  </thead>
  <tbody>
      
    <?php
        for($i=1;$i<=$jmlbunga;$i++){
            echo "<tr><td>$i</td>";
            for($j=0;$j<$banyakp;$j++){
                echo "<td>".$bungabaru[$i][$j]."</td>";
            }
            echo "</tr>";
        }
    ?>
      
  </tbody>
</table>

<!--Batas-->