<h4>Membangkitkan nilai Pi</h4>
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