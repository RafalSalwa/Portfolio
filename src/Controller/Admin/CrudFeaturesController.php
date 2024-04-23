<?php

namespace App\Controller\Admin;

use App\Entity\Features;
use App\Form\FeaturesType;
use App\Repository\FeaturesRepository;
use App\Uploader\FTPUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/crud/features')]
class CrudFeaturesController extends AbstractController
{
    #[Route('/', name: 'app_crud_features_index', methods: ['GET'])]
    public function index(FeaturesRepository $featuresRepository): Response
    {
        return $this->render('crud_features/index.html.twig', [
            'features' => $featuresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_crud_features_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FTPUploader $ftpUploader): Response
    {
        $feature = new Features();
        $form = $this->createForm(FeaturesType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('imgFile')->getData();
            if ($uploadedFile) {
                $newFilename = $ftpUploader->uploadFeatureImg($uploadedFile);
                if ($newFilename) {
                    $feature->setImg($newFilename);
                    $entityManager->persist($feature);
                    $entityManager->flush();
                    $this->addFlash('success', 'Saved new Feature');
                }
            }
            $entityManager->persist($feature);
            $entityManager->flush();

            return $this->redirectToRoute('app_crud_features_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_features/new.html.twig', [
            'feature' => $feature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_features_show', methods: ['GET'])]
    public function show(Features $feature): Response
    {
        return $this->render('crud_features/show.html.twig', [
            'feature' => $feature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crud_features_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Features $feature,
        EntityManagerInterface $entityManager,
        FTPUploader $ftpUploader
    ): Response {
        $form = $this->createForm(FeaturesType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('imgFile')->getData();
            if ($uploadedFile) {
                $newFilename = $ftpUploader->uploadFeatureImg($uploadedFile);
                if ($newFilename) {
                    $feature->setImg($newFilename);
                    $entityManager->persist($feature);
                    $entityManager->flush();
                    $this->addFlash('success', 'Saved new Feature');
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_crud_features_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('crud_features/edit.html.twig', [
            'feature' => $feature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_features_delete', methods: ['POST'])]
    public function delete(Request $request, Features $feature, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feature->getId(), $request->request->get('_token'))) {
            $entityManager->remove($feature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_crud_features_index', [], Response::HTTP_SEE_OTHER);
    }
}
