<?php

namespace App\Controller\Admin;

use App\Entity\Application;
use App\Form\ApplicationType;
use App\Repository\AppsRepository;
use App\Uploader\FTPUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/crud/application')]
class CrudApplicationController extends AbstractController
{
    #[Route('/', name: 'admin_crud_application_index', methods: ['GET'])]
    public function index(AppsRepository $applicationRepository): Response
    {
        return $this->render('crud_application/index.html.twig', [
            'applications' => $applicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_crud_application_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FTPUploader $ftpUploader): Response
    {
        $application = new Application();
        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('imgFile')->getData();
            if ($uploadedFile) {
                $newFilename = $ftpUploader->uploadAppImg($uploadedFile);
                if ($newFilename) {
                    $application->setImg($newFilename);
                    $entityManager->persist($application);
                    $entityManager->flush();
                    $this->addFlash('success', 'Saved new Application');
                }
            }

            return $this->redirectToRoute('admin_crud_application_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_application/new.html.twig', [
            'application' => $application,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_crud_application_show', methods: ['GET'])]
    public function show(Application $application): Response
    {
        return $this->render('crud_application/show.html.twig', [
            'application' => $application,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_crud_application_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Application $application,
        EntityManagerInterface $entityManager,
        FTPUploader $ftpUploader
    ): Response {
        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('imgFile')->getData();
            if ($uploadedFile) {
                $newFilename = $ftpUploader->uploadAppImg($uploadedFile);
                if ($newFilename) {
                    $application->setImg($newFilename);

                    $this->addFlash('success', 'Saved new Application');
                }
            }
            $entityManager->persist($application);
            $entityManager->flush();

            return $this->redirectToRoute('admin_crud_application_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->getErrors()->count()) {
            dd($form->getErrors());
        }

        return $this->render('crud_application/edit.html.twig', [
            'application' => $application,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_crud_application_delete', methods: ['POST'])]
    public function delete(Request $request, Application $application, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$application->getId(), $request->request->get('_token'))) {
            $entityManager->remove($application);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_crud_application_index', [], Response::HTTP_SEE_OTHER);
    }
}
