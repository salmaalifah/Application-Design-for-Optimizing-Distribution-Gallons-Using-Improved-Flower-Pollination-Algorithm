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
                    for($j=0;$j<$banyakp;$j++){
                        
                        if($j<$banyakp-1){
                            $garis = " -> ";
                        } else {
                            $garis = "";
                        }
                        
                        echo '<span class="text-primary">'.array_search($bungabaru[$tampilbunga][$j],$newarr[$tampilbunga]).' </span>'.$garis;
                        
                    }
          ;?></td>
          <td><?php echo $permintaan;?></td>
          <td><?php echo $jarakterendah;?> Km</td>
      </tr>
  </tbody>
</table>