<?php

namespace App\Controller;

use App\Entity\Streamer;
use App\Form\StreamerType;
use App\Repository\StreamerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/streamer")
 */
class StreamerController extends AbstractController
{
    /**
     * @Route("/", name="streamer_index", methods="GET")
     */
    public function index(StreamerRepository $streamerRepository): Response
    {
        return $this->render('streamer/index.html.twig', ['streamers' => $streamerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="streamer_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $streamer = new Streamer();
        $form = $this->createForm(StreamerType::class, $streamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($streamer);
            $em->flush();

            return $this->redirectToRoute('streamer_index');
        }

        return $this->render('streamer/new.html.twig', [
            'streamer' => $streamer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="streamer_show", methods="GET")
     */
    public function show(Streamer $streamer): Response
    {
        return $this->render('streamer/show.html.twig', ['streamer' => $streamer]);
    }

    /**
     * @Route("/{id}/edit", name="streamer_edit", methods="GET|POST")
     */
    public function edit(Request $request, Streamer $streamer): Response
    {
        $form = $this->createForm(StreamerType::class, $streamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('streamer_index', ['id' => $streamer->getId()]);
        }

        return $this->render('streamer/edit.html.twig', [
            'streamer' => $streamer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="streamer_delete", methods="DELETE")
     */
    public function delete(Request $request, Streamer $streamer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$streamer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($streamer);
            $em->flush();
        }

        return $this->redirectToRoute('streamer_index');
    }
}
