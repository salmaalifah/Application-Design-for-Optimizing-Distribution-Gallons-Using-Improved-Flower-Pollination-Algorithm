<?php
//Step 1 : Inisiasi
    $jmlbunga = 5;
    $max_iterasi = 2;
    $y = 0.2;
    $p = 0.80000;
    $lambda = 1.5;
    $banyakp = $jumlah_agen;
    $i=1;
    $j=1;
    $varians = 0.6965745;
    $gf = 0.2992067103;
    
    if($inisasi==0){
        $id_div = "hideaja";
        $h4 = "remove";
    }
    
?>

<h4 id="<?php echo $h4;?>">Inisiasi</h4>
<div id="<?php echo $id_div;?>" class="d-grid gap-2" style="margin-bottom:20px;">
    <span>Jumlah Bunga = <?php echo $jmlbunga;?></span>
    <span>Max Iterasi = <?php echo $max_iterasi;?></span>
    <span>y = <?php echo $y;?></span>
    <span>p = <?php echo $p;?></span>
    <span>lambda = <?php echo $lambda;?></span>
    <span>banyakp = <?php echo $banyakp;?></span>
</div>