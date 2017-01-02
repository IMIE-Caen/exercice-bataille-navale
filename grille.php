<?php

function dessiner_grille($tab, $filtre_bateaux = false){
  echo "\n\n";
  for($l = 0 ; $l < count($tab) ; $l++){
    $ligne = $tab[$l];
    dessiner_separateur(count($ligne));
    for($i = 0 ; $i < count($ligne) ; $i++ ){

      $contenu_case = $ligne[$i];
      $contenu =  $filtre_bateaux && ($contenu_case != "~" && $contenu_case != "*") ? "~" : $contenu_case;

      echo "│ $contenu ";
      // Se je suis à la dernière case, je ferme le
      // tableau
      if($i == count($ligne) - 1){
        echo "│\n";
      }
    }

  }
  dessiner_separateur(count($ligne));
  echo "\n\n";
}

function dessiner_separateur($nb_cases){
  echo join('───', array_fill(0, $nb_cases + 1, '┼'))."\n";
}

function lire_case($grille, $x, $y){
  return $grille[$y][$x] ;
}
function ecrire_case(&$grille, $x, $y, $valeur){
  $grille[$y][$x] = $valeur;
}

function is_case_disponible($grille, $x, $y){
   return isset($grille[$y])
      && isset($grille[$y][$x])
      && lire_case($grille, $x, $y) == "~";
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

function tour_joueur(&$grille_adversaire){
  // $impact = false;
  do{
    // saisit des coordonnees
    $impact = false;
    //effacer_ecran();
    echo "Saisir les coordonnées à viser :\n";
    echo "X : ";
    $x = trim(fgets(STDIN));
    echo "Y : ";
    $y = trim(fgets(STDIN));

    $impact = is_bateau_touche($grille_adversaire, $x, $y);
    if($impact){
      ecrire_case($grille_adversaire, $x, $y, "*");
      echo "Touché !";
      dessiner_grille($grille_adversaire, true);
    }
    else{
      echo "Raté !";
    }
    if(is_grille_gagnee($grille_adversaire)){
      die("GAGNÉ !");
    }
  }
  // tant qu'on touche un bateau (il devient coulé), on rejoue
  while($impact);

  // sinon tour suivant
  // voilà !
}

function is_grille_gagnee($grille){
  for($i = 0 ; $i < count($grille) ; $i++){
    for($j = 0 ; $j < count($grille[$i]) ; $j++){
      if($grille[$i][$j] == 'o'){
        return false;
      }
    }
  }
  return true;
}

function is_bateau_touche($grille, $x, $y){
  return lire_case($grille, $x, $y) == "o";
}

function effacer_ecran(){
  system('clear');
}
