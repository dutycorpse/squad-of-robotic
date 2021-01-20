<?php

require 'vendor/autoload.php';

use App\Action;
use App\IO\Input;
use App\Entity\Plateau;
use App\Entity\Rover;


echo "Entrée les données pour le plateau\n";
// On récupère les entrées du plateau
$plateauInput = fgets(STDIN);

$outputData = [];
for($i = 0; $i < 1; ++$i) {
    echo "Entrée les données pour le Rover{$i} \n";
    //On récupère les entrées du rover
    $roverInput = fgets(STDIN);
    //Mouvement du rover
    $movementInput = fgets(STDIN);

    //On positionne sur le Plateau
    $position = Input::plateauInputFromString($plateauInput);
    //Je déclare mon plateau avec sa position
    $plateau  = new Plateau($position);

    $input = Input::roverInputFromString($roverInput);
    //Je déclare mon Rover avec sa position de départ et sa direction
    $rover = new Rover($input['position'], $input['direction']);
    $action = new Action($rover);
    $outputData[] = $action->act(Input::movementCommandsFromString($movementInput));
}

echo "Résultats\n";

foreach ($outputData as $result) {
    echo $result . "\n";
}

