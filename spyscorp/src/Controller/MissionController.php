<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/mission')]
class MissionController extends AbstractController
{
    #[Route('/mission', name: 'mission_index', methods: ['GET'])]
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('mission/index.html.twig', [
            'missions' => $missionRepository->findAll(),
        ]);
    }

    #[Route('/admin/mission/new', name: 'mission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$mission->missionIsValid()) {
                $this->addFlash(
                    'error',
                    'La mission ne respecte pas les contraintes, vérifiez les informations suivantes:');
                $this->addFlash(
                    'error',
                    'Sur une mission, la ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents');
                $this->addFlash(
                    'error',
                    'Sur une mission, les contacts sont obligatoirement de la nationalité du pays de la mission,
                    la planque est obligatoirement dans le même pays que la mission,
                    il faut assigner au moins 1 agent disposant de la spécialité requise
                ');
                $this->addFlash(
                    'error',
                    'Sur une mission, la planque est obligatoirement dans le même pays que la mission.');
                $this->addFlash(
                    'error',
                    'Sur une mission, il faut assigner au moins un agent disposant de la spécialité requise.');
                return $this->redirectToRoute('mission_new');
            }

            $entityManager->persist($mission);
            $entityManager->flush();

            return $this->redirectToRoute('mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/mission/{id}', name: 'mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    #[Route('/admin/mission/{id}/edit', name: 'mission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mission $mission, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$mission->missionIsValid()) {
                $this->addFlash(
                    'error',
                    'La mission ne respecte pas les contraintes, vérifiez les informations suivantes:');
                $this->addFlash(
                    'error',
                    'Sur une mission, la ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents');
                $this->addFlash(
                    'error',
                    'Sur une mission, les contacts sont obligatoirement de la nationalité du pays de la mission,
                    la planque est obligatoirement dans le même pays que la mission,
                    il faut assigner au moins 1 agent disposant de la spécialité requise
                ');
                $this->addFlash(
                    'error',
                    'Sur une mission, la planque est obligatoirement dans le même pays que la mission.');
                $this->addFlash(
                    'error',
                    'Sur une mission, il faut assigner au moins un agent disposant de la spécialité requise.');
                return $this->redirectToRoute('mission_new');
            }

            $entityManager->flush();

            return $this->redirectToRoute('mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/admin/mission/{id}', name: 'mission_delete', methods: ['POST'])]
    public function delete(Request $request, Mission $mission, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mission->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mission_index', [], Response::HTTP_SEE_OTHER);
    }
}
