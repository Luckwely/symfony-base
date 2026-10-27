<?php

namespace App\Controller;

use App\Entity\Instructor;
use App\Form\InstructorType;
use App\Repository\InstructorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InstructorController extends AbstractController
{
    #[Route('/instructor', name: 'instructor.index')]
    public function index(InstructorRepository $repo): Response
    {
        $instructors = $repo->findAll();

        return $this->render('instructor/index.html.twig', [
            'instructors' => $instructors
        ]);
    }

    #[Route('/instructor/create', name: 'instructor.create', methods:['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $instructor = new Instructor();
        $form = $this->createForm(InstructorType::class, $instructor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($instructor);
            $manager->flush();

            return $this->redirectToRoute('instructor.index');
        }

        return $this->render('instructor/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/instructor/{id}/edit', name: 'instructor.edit', methods:['GET', 'POST'])]
    public function edit(Request $request, Instructor $instructor, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(InstructorType::class, $instructor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('instructor.index');
        }

        return $this->render('instructor/edit.html.twig', [
            'instructor' => $instructor,
            'form' => $form
        ]);
    }

    #[Route('/instructor/{id}', name: 'instructor.show')]
    public function show(int $id, InstructorRepository $repo): Response
    {
        $instructor = $repo->find($id);

        return $this->render('instructor/show.html.twig', [
            'instructor' => $instructor
        ]);
    }

    #[Route('/instructor/{id}/delete', name: 'instructor.delete')]
    public function delete(int $id, InstructorRepository $repo, EntityManagerInterface $manager): Response
    {
        $instructor = $repo->find($id);

        $manager->remove($instructor);
        $manager->flush();

        return $this->redirectToRoute('instructor.index');
    }
}
