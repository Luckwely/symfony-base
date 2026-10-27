<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StudentController extends AbstractController
{
    #[Route('/student', name: 'student.index')]
    public function index(StudentRepository $repo): Response
    {
        $students = $repo->findAll();

        return $this->render('student/index.html.twig', [
            'students' => $students
        ]);
    }

    #[Route('/student/{id}', name: 'student.show')]
    public function show(int $id, StudentRepository $repo): Response
    {
        $student = $repo->find($id);

        if (!$student) {
            return $this->redirectToRoute('student.index');
        }

        return $this->render('student/show.html.twig', [
            'student' => $student
        ]);
    }
}
