<?php

function dessiner_grille($tab){
  echo "\n\n";
  dessiner_separateur(count($tab[0]));
  echo "|   ";
  for($l = 1 ; $l < count($tab) ; $l++){
    echo "| ";
    printf("%c", 64+$l);
    echo " ";
  }
  echo "|\n";
  for($l = 0 ; $l < count($tab) ; $l++){
    $ligne = $tab[$l];
    dessiner_separateur(count($ligne));
    echo "| ".($l + 1)." ";
    for($i = 0 ; $i < count($ligne) ; $i++ ){
      echo "| $ligne[$i] ";
      // Se je suis à la dernière case, je ferme le
      // tableau
      if($i == count($ligne) - 1){
        echo "|\n";
      }
    }

  }
  dessiner_separateur(count($ligne));
  echo "\n\n";
}


function dessiner_separateur($nb_cases){
  echo join('---', array_fill(0, $nb_cases + 2, '+'))."\n";
}
