<div class="row">
<?php
error_reporting(E_ALL);
    $e = array();
    $langkah3 = array();
    for($j=0;$j<$banyakp;$j++){
        $random = rand(1,$jmlbunga);
        $random2 = rand(1,$jmlbunga);
        $a = $bunga[$random][$j];
        $b = $bunga[$random2][$j];
        
        $decimals = 5;
        $div = pow(10, $decimals);
        $rand = mt_rand(0.00001 * $div, 1.00000 * $div) / $div;
        $e[$i][$j] = number_format($rand,5);
        
        $langkah1 = $bunga[$i][$j] + $e[$i][$j];
        $langkah2 = $a - $b;
        $langkah3 = $langkah1 * $langkah2;
        
        $langkah3 = number_format($langkah3,5);
        
        while($langkah3 == 0.00000){
            $langkah3 = NULL;
            $random = rand(1,$jmlbunga);
            $random2 = rand(1,$jmlbunga);
            $a = $bunga[$random][$j];
            $b = $bunga[$random2][$j];
            $rand = mt_rand(0.00001 * $div, 1.00000 * $div) / $div;
            $e[$i][$j] = number_format($rand,5);
            
            $langkah1 = $bunga[$i][$j] + $e[$i][$j];
            $langkah2 = $a - $b;
            $langkah3 = $langkah1 * $langkah2;
            
            $langkah3 = number_format($langkah3,5);
            
            
        }
        $bungabaru[$i][$j] = $langkah3;
        echo "<div class='col' style='margin-bottom:20px;font-size:0.75rem;'>";
        echo "<b>(Lokal) Bunga ke-$i Elemen ke-$j :</b><br/>a = ".$a."<br/>b = ".$b."<br/>e = ".$e[$i][$j]."<br/><br/>";
        echo "langkah1 = $langkah1<br/>langkah2 = $langkah2<br/>langkah3 = $langkah3";
        echo '</div>';
    }
?>
</div>