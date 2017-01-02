<?php

function dessiner_grille(){
  $tab = $GLOBALS['grille'];
  echo "\n\n";
  for($l = 0 ; $l < count($tab) ; $l++){
    $ligne = $tab[$l];
    dessiner_separateur(count($ligne));
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
  echo join('---', array_fill(0, $nb_cases + 1, '+'))."\n";
}

function lire_case($x, $y){
  $grille = $GLOBALS['grille'];
  return $grille[$y][$x] ;
}

function placer_bateau(){
  do {
    echo "Saisir les coordonnées :\n";
    echo "X : ";
    $x = trim(fgets(STDIN));
    echo "Y : ";
    $y = trim(fgets(STDIN));
    // Tout pendant que l'utilisateur fait n'importe quoi
  } while( ! is_case_disponible($x, $y) );

  // La case est dispo !
  $GLOBALS['grille'][$y][$x] = 'x';
  dessiner_grille();

}

function is_case_disponible($x, $y){
  $grille = $GLOBALS['grille'];

   return isset($grille[$y])
      && isset($grille[$y][$x])
      && $grille[$y][$x] == '~';
}
