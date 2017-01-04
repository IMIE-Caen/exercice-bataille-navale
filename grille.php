<?php






function init_grille($taille){
  return array_fill(0, $taille, array_fill(0, $taille, "~"));
}

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

function lire_case($grille, $coords){
  return $grille[$coords['y']][$coords['x']] ;
}
function ecrire_case(&$grille, $coords, $valeur){
  $grille[$coords['y']][$coords['x']] = $valeur;
}

function is_case_disponible($grille, $coords){
   return isset($grille[$coords['y']])
      && isset($grille[$coords['y']][$coords['x']])
      && lire_case($grille, $coords) == "~";
}


function placer_bateau(&$grille, $interactive = false, $index_bateau = 0){

  do {
    if($interactive)
      $coords = get_saisie_coords();
    else
      $coords = get_random_coords($grille);

    $coordonnees_bateau = array($coords);
    for($i = 1 ; $i <= $index_bateau + 1; $i++){
      $coordonnees_bateau[] = ['x' => $coords['x'], 'y' => $coords['y'] + $i ];
    }

  } while( ! is_tableau_sur_grille( $coordonnees_bateau, $grille )  );

  // La case est dispo !
  foreach($coordonnees_bateau as $coords){
    ecrire_case($grille, $coords, "o");
  }
}

function is_tableau_sur_grille($tab, $grille){
  $ok = true;
  foreach($tab as $coords){
    $ok = $ok && is_case_disponible($grille, $coords);
  }
  return $ok;
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

function is_bateau_touche($grille, $coords){
  return lire_case($grille, $coords) == "o";
}

function get_saisie_coords(){
  echo "Saisir les coordonnées :\n";
  echo "X : ";
  $x = trim(fgets(STDIN));
  echo "Y : ";
  $y = trim(fgets(STDIN));
  return array('x'=> $x, 'y' => $y);
}

function get_random_coords($grille, &$memo_cases_frappees = array()){
  do{
    $y_aleatoire = rand(0, count($grille) - 1);
    $x_aleatoire = rand(0, count($grille[$y_aleatoire]) - 1);
    $coords_aleatoires = array('x'=> $x_aleatoire, 'y' => $y_aleatoire);
  }
  while(in_array($coords_aleatoires, $memo_cases_frappees));
  $memo_cases_frappees[]= $coords_aleatoires;
  return $coords_aleatoires;
}

function effacer_ecran(){
  system('clear');
}
