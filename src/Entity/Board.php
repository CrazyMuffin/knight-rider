<?php

declare(strict_types=1);

namespace App\Entity;

class Board
{
    private int $size;

    /**
     * @var array<int, array<int, array<Field>>>
     */
    private array $shortestPaths;

    /**
     * @var array<Field>
     */
    private array $queue = [];

    private const KNIGHT_VECTORS = [
        [1, 2],
        [1, -2],
        [-1, -2],
        [-1, 2],
        [2, 1],
        [2, -1],
        [-2, -1],
        [-2, 1],
    ];

    public function __construct(int $size)
    {
        assert($size > 0);
        $this->size = $size;
        $this->shortestPaths = array_fill(0, $size, array_fill(0, $size, []));
    }

    /**
     * @return array<Field>
     */
    public function shortestKnightPath(Field $start, Field $end): array
    {
        $this->queue[] = $start;

        while (!empty($this->queue)) {
            $current = array_shift($this->queue);

            $this->shortestPaths[$current->getX()][$current->getY()] = $current->getHistory();

            if ($current->equals($end)) {
                return $this->shortestPaths[$current->getX()][$current->getY()];
            }

            foreach (self::KNIGHT_VECTORS as $vector) {
                $newField = $current->move($vector[0], $vector[1]);
                if ($this->isValidField($newField)) {
                    $this->queue[] = $newField;
                }
            }
        }

        throw new \RuntimeException("No Such path exists.");
    }

    private function isValidField(Field $current): bool
    {
        if ($current->getX() < 0 || $current->getX() >= $this->size) {
            return false;
        }
        if ($current->getY() < 0 || $current->getY() >= $this->size) {
            return false;
        }
        if (!empty($this->shortestPaths[$current->getX()][$current->getY()])) {
            return false;
        }

        return true;
    }
}