<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EntryRepository;
use App\Service\ScoreService;


final class EntryController extends AbstractController
{
    private $scoreService;

    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    #[Route('/entry', name: 'entry_index', methods: ['GET'])]
    public function index(EntryRepository $repository): Response
    {
        $entry = $repository->countWordsCaseInsensitive('TaBle');
        dump($entry);
        return $this->render('entry/index.html.twig', [
            'controller_name' => 'EntryController',
        ]);
    }
    #[Route('/entry/{word}')]
    public function show($word, EntryRepository $repository): JsonResponse
    {
        $entry = $repository->countWordsCaseInsensitive($word);

        $score = 0;

        if($entry>0)
        {
            $score = $this->scoreService->calculateScore($word);
        }

        return $this->json(['score' => $score]);
    }

    
}
