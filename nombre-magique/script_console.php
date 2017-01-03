<?php

  $nombre_à_deviner = rand(0,100);
  $nombre_trouvé = false;
  $i = 0;
  do {
    echo "Tentative #$i : ";
    $proposition = trim(fgets(STDIN));
    if($proposition > $nombre_à_deviner)
      echo "C'est plus petit !\n";
    elseif($proposition < $nombre_à_deviner)
      echo "C'est plus grand !\n";
    else{
      echo "Gagné !\n";
      $nombre_trouvé = true;
    }
    $i++;
  } while (!$nombre_trouvé && $i < 5);
  if( ! $nombre_trouvé)
    echo "Perdu, c'était $nombre_à_deviner :(\n";

?>
