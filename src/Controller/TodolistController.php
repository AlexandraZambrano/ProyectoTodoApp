<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Form\TodolistType;
use App\Repository\TodolistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class TodolistController extends AbstractController
{
    #[Route('/tasks', name: 'app_todolist_index', methods: ['GET'])]
    public function index(TodolistRepository $todolistRepository): Response
    {
        return $this->render('todolist/index.html.twig', [
            'todolists' => $todolistRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_todolist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TodolistRepository $todolistRepository): Response
    {
        $todolist = new Todolist();
        $form = $this->createForm(TodolistType::class, $todolist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todolistRepository->save($todolist, true);

            return $this->redirectToRoute('app_todolist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todolist/new.html.twig', [
            'todolist' => $todolist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_todolist_show', methods: ['GET'])]
    public function show(Todolist $todolist): Response
    {
        return $this->render('todolist/show.html.twig', [
            'todolist' => $todolist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_todolist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Todolist $todolist, TodolistRepository $todolistRepository): Response
    {
        $form = $this->createForm(TodolistType::class, $todolist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todolistRepository->save($todolist, true);

            return $this->redirectToRoute('app_todolist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todolist/edit_list.html.twig', [
            'todolist' => $todolist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_todolist_delete', methods: ['POST'])]
    public function delete(Request $request, Todolist $todolist, TodolistRepository $todolistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todolist->getId(), $request->request->get('_token'))) {
            $todolistRepository->remove($todolist, true);
        }

        return $this->redirectToRoute('app_todolist_index', [], Response::HTTP_SEE_OTHER);
    }
}
