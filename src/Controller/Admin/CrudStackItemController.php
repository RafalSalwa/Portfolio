<?php

namespace App\Controller\Admin;

use App\Entity\Tool;
use App\Form\StackItemType;
use App\Repository\ToolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud/stack/item')]
class CrudStackItemController extends AbstractController
{
    #[Route('/', name: 'admin_crud_stack_item_index', methods: ['GET'])]
    public function index(ToolRepository $stackItemRepository): Response
    {
        return $this->render('crud_stack_item/index.html.twig', [
            'stack_items' => $stackItemRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_crud_stack_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stackItem = new Tool();
        $form = $this->createForm(StackItemType::class, $stackItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stackItem);
            $entityManager->flush();

            return $this->redirectToRoute('admin_crud_stack_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_stack_item/new.html.twig', [
            'stack_item' => $stackItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_crud_stack_item_show', methods: ['GET'])]
    public function show(Tool $stackItem): Response
    {
        return $this->render('crud_stack_item/show.html.twig', [
            'stack_item' => $stackItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_crud_stack_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tool $stackItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StackItemType::class, $stackItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_crud_stack_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_stack_item/edit.html.twig', [
            'stack_item' => $stackItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_crud_stack_item_delete', methods: ['POST'])]
    public function delete(Request $request, Tool $stackItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stackItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($stackItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_crud_stack_item_index', [], Response::HTTP_SEE_OTHER);
    }
}
