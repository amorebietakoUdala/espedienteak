<?php

namespace App\Controller;

use App\Entity\Registro;
use App\Repository\RegistroRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
use \Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ESPEDIENTEAK')]
class RegistroController extends BaseController
{

    public function __construct( 
        private readonly RegistroRepository $repo, 
        private readonly string $rutaImagenes,
        private readonly string $urlImagenes,
        private readonly string $rutaDocumentos,
        private readonly string $urlDocumentos,
        private ?Finder $finder = null)
    {
        $this->finder = new Finder();
    }

    #[Route('/registros/expediente/{numeroExpediente}', name: 'registros_expediente_index')]
    public function index(Request $request, string $numeroExpediente): Response
    {
        $this->loadQueryParameters($request);
        $criteria = $this->removePaginationParameters($request->query->all());
        $criteria['expediente'] = $numeroExpediente;
        unset($criteria['returnUrl']);
        $registros = $this->repo->findby($criteria,['id' => 'ASC']);
        unset($criteria['expediente']);
        return $this->render('registro/index.html.twig', [
            'registros' => $registros,
            'numeroExpediente' => $numeroExpediente,
            'filters' => $criteria,
        ]);
    }
}
