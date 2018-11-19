<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category")
     */
    public function show(category $category) :Response
    {
        return $this->render('category/index.html.twig', [
            'category' => $category
        ]);
    }
}
