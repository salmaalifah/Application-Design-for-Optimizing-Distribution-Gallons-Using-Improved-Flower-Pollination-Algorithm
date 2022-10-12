<h4>Mengurutkan Nilai dari yang Terkecil</h4>
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
        
        $x_best_fix = array();
        
        for($i=1;$i<=$jmlbunga;$i++){
            echo '
                <tr>
                    <td>'. $i .'</td>
                    <td>
            ';
            
            $k=1;
            
            sort($bunga[$i]);
            
            for($j=0;$j<$banyakp;$j++){
                
                
                    //Menentukan X_Best
                    $newkey = $namaagen[$j+1]; //Menulis key baru
                    $x_best_fix[$i][$newkey] = $bunga_sebelum_sort[$i][$j+1];
                    //Masukkan ke array
                    //
                
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