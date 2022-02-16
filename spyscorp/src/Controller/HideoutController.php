<?php

namespace App\Controller;

use App\Entity\Hideout;
use App\Form\HideoutType;
use App\Repository\HideoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/hideout')]
class HideoutController extends AbstractController
{
    #[Route('/', name: 'hideout_index', methods: ['GET'])]
    public function index(HideoutRepository $hideoutRepository): Response
    {
        return $this->render('hideout/index.html.twig', [
            'hideouts' => $hideoutRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'hideout_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hideout = new Hideout();
        $form = $this->createForm(HideoutType::class, $hideout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hideout);
            $entityManager->flush();

            return $this->redirectToRoute('hideout_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hideout/new.html.twig', [
            'hideout' => $hideout,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'hideout_show', methods: ['GET'])]
    public function show(Hideout $hideout): Response
    {
        return $this->render('hideout/show.html.twig', [
            'hideout' => $hideout,
        ]);
    }

    #[Route('/{id}/edit', name: 'hideout_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hideout $hideout, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HideoutType::class, $hideout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('hideout_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hideout/edit.html.twig', [
            'hideout' => $hideout,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'hideout_delete', methods: ['POST'])]
    public function delete(Request $request, Hideout $hideout, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hideout->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hideout);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hideout_index', [], Response::HTTP_SEE_OTHER);
    }
}
