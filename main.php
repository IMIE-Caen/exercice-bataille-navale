<?php
require_once("grille.php");

echo "\n\n";

echo "Quelle taille pour grille ? ";
//$reponse = exec("zenity --entry --text 'Quelle taille pour la grille ?' 2> /dev/null");
$reponse = trim(fgets(STDIN));

$grille = array_fill(0, $reponse, array_fill(0, $reponse, '~'));
$grille[0][2] = "x";

dessiner_grille($grille);

echo "Placez vos bateaux\n";

placer_bateau();

echo "OK";
//$valeur_case = lire_case(1, 3);
//echo $valeur_case ;
