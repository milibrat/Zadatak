<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MyConsoleControlerController extends AbstractController
{
    #[Route('', name: 'app_my_console_controler')]
    public function index(): Response
    {
        return $this->render('my_console_controler/index.html.twig', [
            'controller_name' => 'MyConsoleControlerController',
        ]);
    }
}
