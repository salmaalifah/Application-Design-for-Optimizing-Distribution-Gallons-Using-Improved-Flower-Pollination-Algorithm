<h4>Generate Angka</h4>
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
    $bunga_sebelum_sort = array();
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
            
            $bunga_sebelum_sort = $bunga;
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