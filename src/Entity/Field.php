<?php

declare(strict_types=1);

namespace App\Entity;

class Field implements \JsonSerializable
{
    private int $x;
    private int $y;

    /**
     * @var array<Field>
     */
    private array $history;

    /**
     * @param array<Field> $history
     */
    public function __construct(int $x, int $y, array $history = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->history = array_merge($history, [$this]);
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
        return new self($this->x + $xVector, $this->y + $yVector, $this->getHistory());
    }

    public function equals(Field $field): bool
    {
        return $this->getX() === $field->getX() && $this->getY() === $field->getY();
    }

    /**
     * @return array<Field>
     */
    public function getHistory(): array
    {
        return $this->history;
    }

    /**
     * @return array<string, int>
     */
    public function jsonSerialize(): array
    {
        return ['x' => $this->getX(), 'y' => $this->getY()];
    }
}