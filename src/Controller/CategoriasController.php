<?php

namespace App\Controller;
use App\Entity\Category;
use App\Form\TodolistType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorias')]
class CategoriasController extends AbstractController
{
    #[Route('/categorias', name: 'app_categorias', methods: ['GET', 'POST'])]
    public function categorias(Request $request, CategoryRepository $categoryRepository): Response
    {
        return $this->render('categorias/categoria_trabajo.html.twig', [
            'controller_name' => $categoryRepository,
        ]);
    }

    #[Route('/home', name: 'app_todolist_landing')]
    public function landing()
    {
        return $this->render('landingP/greet.html.twig');
    }
}
