<?php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Field;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KnightController extends AbstractController
{
    #[Route('/knight/{size}/{startX},{startY}/{endX},{endY}', name: 'knight')]
    public function index(int $size, int $startX, int $startY, int $endX, int $endY): Response
    {
        $board = new Board($size);

        $path = $board->shortestKnightPath(new Field($startX, $startY), new Field($endX, $endY), 0);
        return $this->json(
            [
                'boardSize' => $size,
                'start' => ['x' => $startX, 'y' => $startY],
                'end' => ['x' => $endX, 'y' => $endY],
                'path' => $path,
            ]
        );
    }
}
