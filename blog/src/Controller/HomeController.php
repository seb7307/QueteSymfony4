<?php
/**
 * Created by PhpStorm.
 * User: seb
 * Date: 13/11/18
 * Time: 15:22
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */

    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',]);
    }

}