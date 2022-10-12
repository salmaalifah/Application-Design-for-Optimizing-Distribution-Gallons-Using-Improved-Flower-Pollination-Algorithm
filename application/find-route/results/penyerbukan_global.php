<div class="row">
<?php

    $s = array();
    $l = array();
    $x == 0;
    $rumus6 = array();
    $u_rand = array();
    
    for($j=0;$j<$banyakp;$j++){
        
        //Normal Distribution
        $decimals = 5;
        $div = pow(10, $decimals);
        $z = mt_rand(0.00001 * $div, 9.99999 * $div) / $div; //Angka Real U
        $random = (exp(-$z^2/2)) / sqrt(2*(pi()));
        $random = $random * $varians;
        $rand1 = rand(0,1);
        if($rand1==0){
        	$random = "-".$random;
        }
        $random = round($random,5); //Random Real U

        $z2 = mt_rand(0.00001 * $div, 9.99999 * $div) / $div; //Angka Real V
        $random2= (exp(-$z2^2/2)) / sqrt(2*(pi()));
        $rand2 = rand(0,1);
        if($rand2==0){
        	$random2 = "-".$random2;
        }
        $random2 = round($random2,5);
        
        $u_rand[$i][$j] = $random; // Disini
        $u[$i][$j] = $u_rand[$i][$j];

        $v[$i][$j] = $random2;
        
        $s[$i][$j] = $u[$i][$j] / pow($v[$i][$j],1/1.5);
        $l[$i][$j] = $gf * 1 / pow($s[$i][$j],5/2);
        
        $a = rand(0,1);
        
        $angka1 = rand(1,$jmlbunga);
        $angka2 = rand(1,$banyakp);
        $xk = $bunga_sebelum_sort[$angka1][$angka2];
        
        //Langkah2
        
        $rumus = $y * $l[$i][$j] + $bunga_sebelum_sort[$i][$j+1];
        $rumus2 = $x_best_fix[$tampilbunga][$namaagen[$j+1]] - $bunga_sebelum_sort[$i][$j+1];
        $rumus3 = $bunga_sebelum_sort[$i][$j+1] - $xk;
        $rumus4 = $rumus * $rumus2;
        $rumus5 = $a * $rumus3;
        $rumus6 = $rumus4 + $rumus5;
        
        $rumus6 = number_format($rumus6,5);
        
        while($rumus6 == 0.00000){
            $rumus6 = NULL;

            //Normal Distribution
            $decimals = 5;
            $div = pow(10, $decimals);
            $z = mt_rand(0.00001 * $div, 9.99999 * $div) / $div; //Angka Real U
            $random = (exp(-$z^2/2)) / sqrt(2*(pi()));
            $random = $random * $varians;
            $rand1 = rand(0,1);
            if($rand1==0){
            	$random = "-".$random;
            }
            $random = round($random,5); //Random Real U
    
            $z2 = mt_rand(0.00001 * $div, 9.99999 * $div) / $div; //Angka Real V
            $random2= (exp(-$z2^2/2)) / sqrt(2*(pi()));
            $rand2 = rand(0,1);
            if($rand2==0){
            	$random2 = "-".$random2;
            }
            $random2 = round($random2,5);
            
            $u_rand[$i][$j] = $random; // Disini
            $u[$i][$j] = $u_rand[$i][$j];
    
            $v[$i][$j] = $random2;
             
            $s[$i][$j] = $u[$i][$j] / pow($v[$i][$j],1/1.5);
            $l[$i][$j] = $gf * 1 / pow($s[$i][$j],5/2);
            
            $a = rand(0,1);
            
            $angka1 = rand(1,$jmlbunga);
            $angka2 = rand(1,$banyakp);
            $xk = $bunga_sebelum_sort[$angka1][$angka2];
            
            //Langkah2
            
            $rumus = $y * $l[$i][$j] + $bunga_sebelum_sort[$i][$j+1];
            $rumus2 = $x_best_fix[$tampilbunga][$namaagen[$j+1]] - $bunga_sebelum_sort[$i][$j+1];
            $rumus3 = $bunga_sebelum_sort[$i][$j+1] - $xk;
            $rumus4 = $rumus * $rumus2;
            $rumus5 = $a * $rumus3;
            $rumus6 = $rumus4 + $rumus5;
            
            $rumus6 = number_format($rumus6,5);
            
        }
        
        $bungabaru[$i][$j] = $rumus6;
        echo "<div class='col' style='margin-bottom:20px;font-size:0.75rem;'>";
        echo "<b>(Global) Bunga ke-$i Elemen ke-$j :</b><br/>u = ".$u[$i][$j]."<br/>v = ".$v[$i][$j]."<br/>xk = ".$xk."<br/><b>x_best</b> = ".$x_best_fix[$tampilbunga][$namaagen[$j+1]]."<br/><b>bunga</b> =".$bunga_sebelum_sort[$i][$j+1]."<br/>a = ".$a."<br/><br/>";
        echo "rumus1 = $rumus<br/>rumus2 = $rumus2<br/>rumus3 = $rumus3<br/>rumus4 = $rumus4<br/>rumus5 = $rumus5<br/>rumus6 = $rumus6";
        echo '</div>';
    }
?>
</div>