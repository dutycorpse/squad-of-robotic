<?php
declare(strict_types = 1);

namespace App\IO;

use App\Model\Coordinate;
use App\Model\Direction;
use App\Model\Position;
use InvalidArgumentException;

Class Input
{

    /**
     * @param string $input
     * @return Position
     */
    public static function plateauInputFromString(string $input): Position
    {
        $inputArray = self::toArray($input);

        //Je vérifie si j'ai 2 valeur dans mon entrée
        if (count($inputArray) !== 2) {
            throw new InvalidArgumentException('Entrée attendue int(X Y)');
        }

        //Je vérifie que ce soit bien des digits pour respecter le X Y N
        if (!self::IsDigit($inputArray)) {
            throw new InvalidArgumentException(sprintf('Les valeurs entrées doivent être de ce type, (int(X) int(Y)) %s', implode(' ', $inputArray)));
        }
        
        return new Position(new Coordinate(intval($inputArray[0])), new Coordinate(intval($inputArray[1])));
    }

    /**
     * @param string $input
     * @return array
     */
    public static function roverInputFromString(string $input): array
    {
        $inputArray = self::toArray($input);

        //Je vérifie qu'il y ait bien 3 entité dans mon tableau
        if (count($inputArray) !== 3) {
            throw new InvalidArgumentException('Entrée attendue int(X Y D)');
        }

        //Je vérifie que ce soit bien des digits pour respecter le X Y N
        if (!self::IsDigit($inputArray)) {
            throw new InvalidArgumentException(sprintf('Les valeurs en entrées doivent être de ce type, (int(X) int(Y) char(D)) %s', implode(' ', $inputArray)));
        }

        return  [
            'position'  => new Position(new Coordinate(intval($inputArray[0])), new Coordinate(intval($inputArray[1]))),
            'direction' => new Direction($inputArray[2])
        ];
    }

    /**
     * @param string $commands
     * @return array
     */
    public static function movementCommandsFromString(string $commands): array
    {
        return array_filter(
            array_map(
                function (string $command) {
                    return mb_strtoupper($command);
                },
                str_split(trim($commands))
            )
        );
    }

    /**
     * @param array $inputArray
     * @return bool
     */
    private static function IsDigit(array $inputArray): bool
    {
        return (ctype_digit($inputArray[0]) && ctype_digit($inputArray[1]));
    }

    /**
     * @param string $input
     * @return array
     */
    private static function toArray(string $input): array
    {
       return explode(' ', trim($input));
    }
}
