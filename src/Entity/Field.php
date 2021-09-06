<?php

declare(strict_types=1);

namespace App\Entity;

class Field implements \JsonSerializable
{
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function move(int $xVector, int $yVector): Field
    {
        return new Field($this->x + $xVector, $this->y + $yVector);
    }

    public function equals(Field $field): bool
    {
        return $this->getX() === $field->getX() && $this->getY() === $field->getY();
    }

    /**
     * @return array<string, int>
     */
    public function jsonSerialize(): array
    {
        return ['x' => $this->getX(), 'y' => $this->getY()];
    }
}