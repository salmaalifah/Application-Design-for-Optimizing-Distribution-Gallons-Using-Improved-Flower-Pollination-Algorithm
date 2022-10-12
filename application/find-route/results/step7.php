<h4>Menentukan Jenis Penyerbukan</h4>
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