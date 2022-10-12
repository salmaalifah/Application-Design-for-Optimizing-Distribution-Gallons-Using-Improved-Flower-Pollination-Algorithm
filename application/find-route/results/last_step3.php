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
  
        for($i=1;$i<=$jmlbunga;$i++){
            echo '
                <tr>
                    <td>'. $i .'</td>
                    <td>
            ';
            
            $k=1;
            
            sort($bungabaru[$i]);
            
            for($j=0;$j<$banyakp;$j++){
                
                
                
                if($j<$banyakp-1){
                    $garis = " -> ";
                } else {
                    $garis = "";
                }
                
                echo '
                    <span class="text-primary">' . array_search($bungabaru[$i][$j],$newarr[$i]) . '</span>'. $garis . '
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