<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ESPEDIENTEAK')]
class DefaultController extends AbstractController
{

   #[Route(path: '/', name: 'app_home')]
   public function home() : Response
   {
       return $this->redirectToRoute('regexpedientes_index');
   }
}