<?php
require_once("grille.php");

echo "\n\n";

echo "Quelle taille pour grille ? ";
//$reponse = exec("zenity --entry --text 'Quelle taille pour la grille ?' 2> /dev/null");
$reponse = trim(fgets(STDIN));

$ma_grille = array_fill(0, $reponse, array_fill(0, $reponse, '~'));
$grille_adversaire = array_fill(0, $reponse, array_fill(0, $reponse, '~'));

dessiner_grille($ma_grille);

/*
echo "Placez vos bateaux\n";
for($i = 0 ; $i < 5 ; $i++){
  placer_bateau($ma_grille);
}
*/
echo "Placement des bateaux adverses";
for($i = 0 ; $i < 5 ; $i++){
  placer_bateau_aleatoirement($grille_adversaire);
}
dessiner_grille($grille_adversaire);


do{
  // on joue
  tour_joueur($grille_adversaire);
  dessiner_grille($grille_adversaire);

  // successivement tour joueur, tour ordi jusqu'à ce que quelqu'un ait gagnés
} while ( true /* quelqu'un a gagné */);
