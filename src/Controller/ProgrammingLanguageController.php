<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ProgrammingLanguage;
use App\Form\ProgrammingLanguageType;
use App\Repository\ProgrammingLanguageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/programming-languages')]
class ProgrammingLanguageController extends AbstractController
{
    #[Route('/', name: 'app_programming_language_index', methods: ['GET'])]
    public function index(
        ProgrammingLanguageRepository $programmingLanguageRepository,
        EntityManagerInterface $em
    ): Response {
        return $this->render('programming_language/index.html.twig', [
            'programming_languages' => $programmingLanguageRepository->findAll(),
        ]);
    }

    #[Route('/list', name: 'api_app_programming_language_index', methods: ['GET'])]
    public function langList(ProgrammingLanguageRepository $programmingLanguageRepository): JsonResponse
    {
        return $this->json($programmingLanguageRepository->findAll());
    }

    #[Route('/new', name: 'app_programming_language_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $programmingLanguage = new ProgrammingLanguage();
        $form = $this->createForm(ProgrammingLanguageType::class, $programmingLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($programmingLanguage);
            $entityManager->flush();

            return $this->redirectToRoute('app_programming_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programming_language/new.html.twig', [
            'programming_language' => $programmingLanguage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_programming_language_show', methods: ['GET'])]
    public function show(ProgrammingLanguage $programmingLanguage): Response
    {
        return $this->render('programming_language/show.html.twig', [
            'programming_language' => $programmingLanguage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_programming_language_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        ProgrammingLanguage $programmingLanguage,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(ProgrammingLanguageType::class, $programmingLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_programming_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programming_language/edit.html.twig', [
            'programming_language' => $programmingLanguage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_programming_language_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        ProgrammingLanguage $programmingLanguage,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $programmingLanguage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($programmingLanguage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_programming_language_index', [], Response::HTTP_SEE_OTHER);
    }
}
