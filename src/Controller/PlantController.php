<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Form\PlantType;
use App\Repository\PlantRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/plant')]
final class PlantController extends AbstractController
{
    #[Route(name: 'app_plant_index', methods: ['GET'])]
    public function index(PlantRepository $plantRepository, Request $request, EntityManagerInterface $em): Response
    {
        $page = $request->query->getInt('page', 1);

        $plants = $em->createQueryBuilder()
            ->select('plants')
            ->from(Plant::class, 'plants')
            ->setFirstResult(10 * $page - 10)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        return $this->render('plant/index.html.twig', [
            'plants' => $plants,
            'page' => $page
        ]);
    }

    #[Route('/new', name: 'app_plant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plant = new Plant();
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plant->setCreatedAt(new DateTimeImmutable());
            $entityManager->persist($plant);
            $entityManager->flush();



            return $this->redirectToRoute('app_plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plant/new.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plant_show', methods: ['GET'])]
    public function show(Plant $plant): Response
    {
        return $this->render('plant/show.html.twig', [
            'plant' => $plant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plant $plant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plant/edit.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plant_delete', methods: ['POST'])]
    public function delete(Request $request, Plant $plant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $plant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($plant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plant_index', [], Response::HTTP_SEE_OTHER);
    }
}
