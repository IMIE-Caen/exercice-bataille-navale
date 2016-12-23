<?php
require_once("grille.php");

$grille = array(
      array(" ", " ", " "),
      array(" ", " ", " "),
      array(" ", " ", " "),
      array(" ", " ", " ")
    );
dessiner_grille($grille);

echo $grille[3][2];
