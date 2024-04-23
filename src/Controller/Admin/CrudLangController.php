<?php

namespace App\Controller\Admin;

use App\Entity\Stack;
use App\Form\Lang1Type;
use App\Repository\AppsRepository;
use App\Repository\StackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud/lang')]
class CrudLangController extends AbstractController
{
    #[Route('/', name: 'admin_crud_lang_index', methods: ['GET'])]
    public function index(StackRepository $langRepository): Response
    {
        return $this->render('crud_lang/index.html.twig', [
            'langs' => $langRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_crud_lang_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lang = new Stack();
        $form = $this->createForm(Lang1Type::class, $lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lang);
            $entityManager->flush();

            return $this->redirectToRoute('admin_crud_lang_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_lang/new.html.twig', [
            'lang' => $lang,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_crud_lang_show', methods: ['GET'])]
    public function show(Stack $stack, AppsRepository $repository): Response
    {
        $apps = $repository->getForStack($stack);

        return $this->render('crud_lang/show.html.twig', [
            'lang' => $stack,
            'apps' => $apps,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_crud_lang_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stack $lang, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Lang1Type::class, $lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_crud_lang_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_lang/edit.html.twig', [
            'lang' => $lang,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_crud_lang_delete', methods: ['POST'])]
    public function delete(Request $request, Stack $lang, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lang->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lang);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_crud_lang_index', [], Response::HTTP_SEE_OTHER);
    }
}
