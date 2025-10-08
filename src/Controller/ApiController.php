<?php

namespace App\Controller;

use App\Entity\Registro;
use App\Repository\RegistroRepository;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ESPEDIENTEAK')]
#[Route(path: '/api')]
class ApiController extends BaseController
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

    #[Route('/registro/{registro}', name: 'api_registro_show')]
    public function show(
        Request $request, 
        #[MapEntity(expr: 'repository.find(registro)')]
        Registro $registro): Response
    {
        $this->loadQueryParameters($request);
        $pattern = $registro->getNameFilter().$registro->getPattern();
        $this->finder->in($registro->getRutaEntrada($this->chooseBasePath($registro)))->followLinks()->files()->name([$pattern,mb_strtolower($pattern)]);
        $entradas = [];
        if ($this->finder->hasResults()) {
            foreach ($this->finder as $file) {
                $fileNameWithExtension = $file->getRelativePathname();
                $entradas[] = $fileNameWithExtension;
            }      
        }
        $url = $registro->getTipo()->getId() === Tipo::TIPO_OFICIO ? $this->urlDocumentos.'/' : $this->urlImagenes.'/';
        return $this->render('registro/_listEntradas.html.twig', [
            'registro' => $registro,
            'entradas' => $entradas,
            'url' => $url,
        ]);
    }

    private function chooseBasePath(Registro $registro) {
        $base = $this->rutaImagenes;
        if ($registro->getTipo()->getId() === Tipo::TIPO_OFICIO) {
            $base = $this->rutaDocumentos;
        }
        return $base;
    }
}