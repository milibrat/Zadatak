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

    

    #[Route('/entry', methods:['POST'])]
    public function show(Request $request, EntryRepository $repository): JsonResponse
    {
        
        $data = json_decode($request->getContent(), true);
        $word = $data['word'] ?? ''; 

        
        if (empty($word)) {
            return $this->json(['score' => 0, 'message' => 'No word provided'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $entry = $repository->countWordsCaseInsensitive($word);

        $score = 0;

        if ($entry > 0) {
            $score = $this->scoreService->calculateScore($word);
        }

        return $this->json(['score' => $score]);
    }

    
}
