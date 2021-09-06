<?php

namespace App\Tests;

use App\Entity\Board;
use App\Entity\Field;
use PHPUnit\Framework\TestCase;

class KnightTest extends TestCase
{
    public function testSameStartAndEnd(): void
    {
        $board = new Board(8);

        $startAndEnd = new Field(2,2);

        $result = $board->shortestKnightPath($startAndEnd, $startAndEnd, 0);

        $this->assertCount(1, $result);
        $this->assertTrue($startAndEnd->equals(reset($result)));
    }

    public function testOneMove(): void
    {
        $board = new Board(8);

        $start = new Field(2,2);
        $end = new Field(3, 4);

        $result = $board->shortestKnightPath($start, $end, 0);

        $this->assertCount(2, $result);
        $this->assertTrue($start->equals(reset($result)));
        $this->assertTrue($end->equals(end($result)));
    }

    public function testCornerToCorner(): void
    {
        $board = new Board(8);

        $start = new Field(0,7);
        $end = new Field(7, 0);

        $result = $board->shortestKnightPath($start, $end, 0);

        $this->assertCount(7, $result);
        $this->assertTrue($start->equals(reset($result)));
        $this->assertTrue($end->equals(end($result)));
    }
}
