<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/** 
* @IsGranted("ROLE_ESPEDIENTEAK")
*/
class DefaultController extends AbstractController
{

   /**
    * @Route("/", name="app_home")
    */
   public function home(Request $request): Response
   {
      return $this->redirectToRoute('regexpedientes_index');
   }
}