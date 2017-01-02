<?php

function dessiner_grille($tab){
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

function lire_case($grille, $x, $y){
  return $grille[$y][$x] ;
}
function ecrire_case(&$grille, $x, $y, $valeur){
  $grille[$y][$x] = $valeur;
}

function placer_bateau(&$grille){
  do {
    echo "Saisir les coordonnées :\n";
    echo "X : ";
    $x = trim(fgets(STDIN));
    echo "Y : ";
    $y = trim(fgets(STDIN));
    // Tout pendant que l'utilisateur fait n'importe quoi
  } while( ! is_case_disponible($grille, $x, $y) );

  // La case est dispo !
  ecrire_case($grille, $x, $y, 'x');
  dessiner_grille($grille);
}

function placer_bateau_aleatoirement(&$grille){
  do {
    $y_aleatoire = rand(0, count($grille) - 1);
    $x_aleatoire = rand(0, count($grille[$y_aleatoire]) - 1);
    // Tout pendant que l'utilisateur fait n'importe quoi
  } while( ! is_case_disponible($grille, $x_aleatoire, $y_aleatoire) );
  ecrire_case($grille, $x_aleatoire, $y_aleatoire, 'o');

}

function is_case_disponible($grille, $x, $y){
   return isset($grille[$y])
      && isset($grille[$y][$x])
      && lire_case($grille, $x, $y) == '~';
}
