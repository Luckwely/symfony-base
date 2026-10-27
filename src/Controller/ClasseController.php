<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'classe.index')]
    public function index(ClasseRepository $repo): Response
    {
        $classes = $repo->findAll();
        return $this->render('classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    #[Route('/classe/new', name: 'classe.new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isvalid()){
            $manager->persist($classe);
            $manager->flush();

            return $this->redirectToRoute('classe.index');
        }
        return $this->render('classe/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/classe/{id}/edit', name: 'classe.edit', methods:['GET', 'POST'])]
    public function edit(Request $request, Classe $classe, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isvalid()){
            $manager->flush();

            return $this->redirectToRoute('classe.index');
        }
        return $this->render('classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form
        ]);
    }

    #[Route('/classe/{id}', name: 'classe.show')]
    public function show(string $id, ClasseRepository $repo): Response
    {
        $classe = $repo->find($id);
        return $this->render('classe/show.html.twig', [
            'classe' => $classe,
        ]);
    }

    #[Route('/classe/delete/{id}', name: 'classe.delete')]
    public function delete(string $id, ClasseRepository $repo, EntityManagerInterface $manager): Response
    {
        $classe = $repo->find($id);
        if (!$classe) {
            return $this->redirectToRoute('classe.index');
        }

        $manager->remove($classe);
        $manager->flush();

        return $this->redirectToRoute('classe.index');

    }

}
