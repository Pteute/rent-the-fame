<?php

namespace App\Controller;

use App\Entity\Celebrite;
use App\Form\CelebriteType;
use App\Service\FileUploader;
use App\Repository\CelebriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/celebrite')]
class AdminCelebriteController extends AbstractController
{
    #[Route('/', name: 'admin_celebrite_index', methods: ['GET'])]
    public function index(CelebriteRepository $celebriteRepository): Response
    {
        return $this->render('admin_celebrite/index.html.twig', [
            'celebrites' => $celebriteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_celebrite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $celebrite = new Celebrite();
        $form = $this->createForm(CelebriteType::class, $celebrite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $imageFile = $form->get('imageUpload')->getData();

            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $celebrite->setImage($imageFileName);
            }
            $celebrite->setCreatedAt(new \DateTimeImmutable());  //if formulaire modifié on créer une date 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($celebrite);
            $entityManager->flush();
            return $this->redirectToRoute('admin_celebrite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_celebrite/new.html.twig', [
            'celebrite' => $celebrite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_celebrite_show', methods: ['GET'])]
    public function show(Celebrite $celebrite): Response
    {
        return $this->render('admin_celebrite/show.html.twig', [
            'celebrite' => $celebrite,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_celebrite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Celebrite $celebrite, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(CelebriteType::class, $celebrite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $imageFile = $form->get('imageUpload')->getData();

            if ($imageFile) {
                if ($celebrite->getImage('image') != null) {
                    $fileUploader->remove('imageUpload');
                }
                $imageFileName = $fileUploader->upload($imageFile);
                $celebrite->setImage($imageFileName);
            }
            $celebrite->setModifiedAt(new \DateTimeImmutable()); //if formulaire modifié on edit la date 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($celebrite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_celebrite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_celebrite/edit.html.twig', [
            'celebrite' => $celebrite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_celebrite_delete', methods: ['POST'])]
    public function delete(Request $request, Celebrite $celebrite): Response
    {
        if ($this->isCsrfTokenValid('delete' . $celebrite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($celebrite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_celebrite_index', [], Response::HTTP_SEE_OTHER);
    }
}
