<?php

namespace App\Controller;

use App\Entity\Streamer;
use App\Form\StreamerType;
use App\Repository\StreamerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
