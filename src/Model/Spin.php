<?php
declare(strict_types = 1);

namespace App\Model;

use InvalidArgumentException;

class Spin
{

    const LEFT  = 'L';
    const RIGHT = 'R';
    const AVAILABLE_SPINS = [self::LEFT, self::RIGHT];

    /**
     * @var string $spin
     */
    private $spin = '';

    /**
     * Spin constructeur.
     * @param string $input
     */
    public function __construct(string $input)
    {
        // Je vérifie que la rotation correspond au direction disponbible
        if (!in_array($input, self::AVAILABLE_SPINS)) {
            throw new InvalidArgumentException(
                sprintf("La rotations ne peut se faire que dans les directions suivantes %s", $input, implode(self::AVAILABLE_SPINS))
            );
        }

        $this->spin = $input;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->spin;
    }
}
