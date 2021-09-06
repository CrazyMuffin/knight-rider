<?php

declare(strict_types=1);

namespace App\Entity;

class Board
{
    private int $size;

    private array $visitedFields;

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
        $this->size = $size;
        $this->visitedFields = array_fill(0, $size, array_fill(0, $size, 99));
    }

    /**
     * @return array<Field>
     */
    public function shortestKnightPath(Field $current, Field $end, int $pathLength): array
    {
        if ($current->equals($end)) {
            return [$current];
        }
        $this->visitedFields[$current->getX()][$current->getY()] = $pathLength;
        $pathLength++;
        $possibleMoves = [];
        foreach (self::KNIGHT_VECTORS as $vector) {
            $newField = $current->move($vector[0], $vector[1]);
            if ($this->isValidField($newField, $pathLength)) {
                $path = $this->shortestKnightPath($newField, $end, $pathLength);
                if (!empty($path) && end($path)->equals($end)) {
                    array_unshift($path, $current);
                    $possibleMoves[] = $path;
                }
            }
        }
        usort($possibleMoves, static fn (array $a, array $b) => count($a) - count($b));
        return reset($possibleMoves) ?: [];
    }

    private function isValidField(Field $current, int $pathLength): bool
    {
        if ($current->getX() < 0 || $current->getX() >= $this->size) {
            return false;
        }
        if ($current->getY() < 0 || $current->getY() >= $this->size) {
            return false;
        }
        if ($this->visitedFields[$current->getX()][$current->getY()] < $pathLength) {
            return false;
        }

        return true;
    }
}