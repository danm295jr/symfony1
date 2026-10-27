<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    private function getMovies(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Inception',
                'year' => 2010,
                'description' => 'Вор, который крадёт секреты через сны, получает задание внедрить идею в чужое подсознание.',
            ],
            [
                'id' => 2,
                'title' => 'The Matrix',
                'year' => 1999,
                'description' => 'Хакер узнаёт, что привычный мир — это симуляция, и присоединяется к восстанию против машин.',
            ],
            [
                'id' => 3,
                'title' => 'Interstellar',
                'year' => 2014,
                'description' => 'Группа астронавтов отправляется через червоточину на поиски новой планеты для человечества.',
            ],
            [
                'id' => 4,
                'title' => 'The Prestige',
                'year' => 2006,
                'description' => 'Два фокусника-соперника ведут опасную борьбу за создание лучшего трюка.',
            ],
        ];
    }

    #[Route('/movies', name: 'app_movie_index')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'movies' => $this->getMovies(),
        ]);
    }

    #[Route('/movies/{id}', name: 'app_movie_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $movie = null;
        foreach ($this->getMovies() as $item) {
            if ($item['id'] === $id) {
                $movie = $item;
                break;
            }
        }

        if ($movie === null) {
            throw $this->createNotFoundException('Фильм не найден');
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }
}