<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorialController extends AbstractController
{
    /**
     * @Route("/editorial", name="editorial")
     */
    public function index(): Response
    {
        return $this->render('editorial/index.html.twig', [
            'controller_name' => 'EditorialController',
        ]);
    }
}
