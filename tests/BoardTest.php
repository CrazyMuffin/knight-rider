<?php

namespace App\Tests;

use App\Entity\Board;
use App\Entity\Field;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testSameStartAndEnd(): void
    {
        $board = new Board(8);

        $startAndEnd = new Field(2,2);

        $result = $board->shortestKnightPath($startAndEnd, $startAndEnd);

        $this->assertCount(1, $result);
        $field = reset($result);
        $this->assertInstanceOf(Field::class, $field);
        $this->assertTrue($startAndEnd->equals($field));
    }

    public function testOneMove(): void
    {
        $board = new Board(8);

        $start = new Field(2,2);
        $end = new Field(3, 4);

        $result = $board->shortestKnightPath($start, $end);

        $this->assertCount(2, $result);
        $firstField = reset($result);
        $lastField = end($result);
        $this->assertInstanceOf(Field::class, $firstField);
        $this->assertInstanceOf(Field::class, $lastField);

        $this->assertTrue($start->equals($firstField));
        $this->assertTrue($end->equals($lastField));
    }

    public function testCornerToCorner(): void
    {
        $board = new Board(8);

        $start = new Field(0,7);
        $end = new Field(7, 0);

        $result = $board->shortestKnightPath($start, $end);

        $this->assertCount(7, $result);
        $firstField = reset($result);
        $lastField = end($result);
        $this->assertInstanceOf(Field::class, $firstField);
        $this->assertInstanceOf(Field::class, $lastField);

        $this->assertTrue($start->equals($firstField));
        $this->assertTrue($end->equals($lastField));
    }
}
