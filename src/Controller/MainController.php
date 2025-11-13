<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
class MainController extends AbstractController
{
    #[Route('/start')]
    public function number(): Response
    {


        return $this->render('shop/MainPage.html.twig');

        //neu

    }
}
