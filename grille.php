<?php

function dessiner_grille($tab){
  echo "\n\n";
  dessiner_separateur($tab);
  for($i = 0 ; $i < count($tab) ; $i = $i+1 ){
    echo "| $tab[$i] ";
    // Se je suis à la dernière case, je ferme le
    // tableau
    if($i == count($tab) - 1){
      echo "|\n";
    }
  }
  dessiner_separateur($tab);
  echo "\n\n";
}
function dessiner_separateur($tab){
  for($i = 0 ; $i < count($tab) ; $i = $i+1 ){
    echo "+---";
    if($i == count($tab) - 1){
      echo "+\n";
    }
  }
}
