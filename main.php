<?php

/*
echo "\033[3;3f";
echo "COUCOU";
echo "\033[4;3f";
echo "les amis";


echo "\033[3;13f";
echo "COUCOU";
echo "\033[4;13f";
echo "les amis";
die();


$tab  = array('a', 'b', 'c');
var_dump($tab);

unset($tab[1]);

for($i = 0 ; $i < count($tab) ; $i++){
  echo "$i: $tab[$i]\n";
}
echo "FOREACH\n\n";
foreach ($tab as $index => $valeur) {
  echo "$index : $valeur\n";
}


//var_dump($tab);

die();
*/
require_once("grille.php");

effacer_ecran();
echo "\033[37m\033[46m";

echo "\n\n";

echo "Quelle taille pour grille ? ";
//$reponse = exec("zenity --entry --text 'Quelle taille pour la grille ?' 2> /dev/null");
$reponse = trim(fgets(STDIN));
// colorier : \033[37m\033[46m~\033[39m\033[49m
$ma_grille = array_fill(0, $reponse, array_fill(0, $reponse, "~"));
$grille_adversaire = array_fill(0, $reponse, array_fill(0, $reponse, "~"));

$cases_frappees = array();



echo "Placez vos bateaux\n";
for($i = 0 ; $i < 2 ; $i++){
  placer_bateau($ma_grille);
}
dessiner_grille($ma_grille);

echo "Placement des bateaux adverses\n";
for($i = 0 ; $i < 2 ; $i++){
  placer_bateau_aleatoirement($grille_adversaire);
}


$tour_joueur = true;
do{
  // on joue
  // joueur ou ordi ?
  $partie_finie = false;

  if($tour_joueur){
    echo "Grille adversaire:";
    dessiner_grille($grille_adversaire, true);

    do{
      echo "Tour joueur: \n";
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
        echo "Touché !\nGrille adversaire";
        dessiner_grille($grille_adversaire, true);
      }
      else{
        echo "Raté !";
      }
      $partie_finie = is_grille_gagnee($grille_adversaire);
      if((!$partie_finie) && $impact)
        echo "Rejouez\n";
    } while((!$partie_finie) && $impact);

    $tour_joueur = !$tour_joueur;
  }
  else{
    echo "Ma grille";

    dessiner_grille($ma_grille);
    do{
      echo "Tour ordi :\n";
      $impact = false;
      //effacer_ecran();

      do{
        $y_aleatoire = rand(0, count($ma_grille) - 1);
        $x_aleatoire = rand(0, count($ma_grille[$y_aleatoire]) - 1);
      } while(in_array([$x_aleatoire,$y_aleatoire],$cases_frappees));


      $cases_frappees[]=[$x_aleatoire,$y_aleatoire];


      echo "$x_aleatoire, $y_aleatoire";
      $impact = is_bateau_touche($ma_grille, $x_aleatoire, $y_aleatoire);
      if($impact){
        ecrire_case($ma_grille, $x_aleatoire, $y_aleatoire, "*");
        echo "Touché !\n";
        echo "Ma grille :";
        dessiner_grille($ma_grille);
      }
      else{
        echo "Raté !";
      }
      $partie_finie = is_grille_gagnee($ma_grille);
    } while(!$partie_finie && $impact);

    $tour_joueur = ! $tour_joueur;
  }
  // successivement tour joueur, tour ordi jusqu'à ce que quelqu'un ait gagnés
} while ( ! $partie_finie);
echo "Gagné !";
