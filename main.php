<?php



require_once("grille.php");

effacer_ecran();

echo "\n\n";

echo "Quelle taille pour grille ? ";
//$reponse = exec("zenity --entry --text 'Quelle taille pour la grille ?' 2> /dev/null");
$taille = trim(fgets(STDIN));
$grille_ordi = $grille_humain = init_grille($taille);
// colorier : \033[37m\033[46m~\033[39m\033[49m

$cases_frappees_ordi = array();

dessiner_grille($grille_humain);

echo "Placez vos bateaux\n";
for($i = 0 ; $i < 50 ; $i++){
  //placer_bateau($grille_humain, true, $i);
  // on en profite pour placer aussi le bateau adverse dans sa grille
  placer_bateau($grille_ordi, false, $i);
  dessiner_grille($grille_ordi);
  sleep(1);
  effacer_ecran();
}

// Le joueur commence (par opposition à l'ordi)
$tour_humain = false;

// tour par tour
do{
  $tour_humain = !$tour_humain;
  $partie_finie = false;
  $filtrer = $tour_humain;

  $prompt = $tour_humain ? "Humain" : "Ordi";

  // L'OPERATEUR TERNAIRE NE MARCHE PAS :(
  if($tour_humain)
    $grille_visee = &$grille_ordi;
  else
    $grille_visee = &$grille_humain;

  echo "----- Tour de $prompt ----- \n";
  dessiner_grille($grille_visee, $filtrer);

  // joueur rejoue ?
  do{

    $impact = false;

    $coords = $tour_humain ? get_saisie_coords() : get_random_coords($grille_visee, $cases_frappees_ordi);

    $impact = is_bateau_touche($grille_visee, $coords);

    if($impact){
      ecrire_case($grille_visee, $coords, "*");
      echo "Touché !\n\n";
    }
    else{
      echo "Raté !\n\n";
    }
    dessiner_grille($grille_visee, $filtrer);

    $partie_finie = is_grille_gagnee($grille_visee);
    if((!$partie_finie) && $impact)
      echo "$prompt rejoue !\n";

  } while((!$partie_finie) && $impact);


  // successivement tour joueur, tour ordi jusqu'à ce que quelqu'un ait gagnés
} while ( ! $partie_finie);
echo "Partie gagnée par $prompt !";
