<h1><?php
    $proposition = $_GET["proposition"];
    $seed = $_GET["seed"];
    if(!$seed)
      $seed = rand(0, 999999999999);
    // Ci-dessous, on se détend
    $nombre_à_deviner = intval(intval(substr(hexdec(hash('md5', $seed))/1000, -6, 2))/99*100);

    // Le jeu
    if($proposition > $nombre_à_deviner)
      echo "C'est plus petit !\n";
    elseif($proposition < $nombre_à_deviner)
      echo "C'est plus grand !\n";
    else{
      echo "Gagné !\n";
    }
?></h1>
<form method="get" action="">
  <input type="hidden" name="seed" value="<?php echo $seed ?>">
  <input type="text" autofocus name="proposition" placeholder="<?php echo $proposition ?>">
  <input type="submit" />
</form>
