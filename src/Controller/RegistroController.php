<?php

namespace App\Controller;

use App\Form\RegistrosSearchFormType;
use App\Repository\RegistroRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Translation\TranslatableMessage;

#[IsGranted('ROLE_ESPEDIENTEAK')]
#[Route(path: '/{_locale}')]
class RegistroController extends BaseController
{

    public function __construct( private readonly RegistroRepository $repo, private readonly int $maxRegistros = 50)
    {
    }

    #[Route('/registros/expediente/{numeroExpediente}', name: 'registros_expediente_index')]
    public function registrosExpediente(Request $request, string $numeroExpediente): Response
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

    #[Route('/registros', name: 'registros_index')]
    public function index(Request $request): Response
    {
        $this->loadQueryParameters($request);
        $criteria = $this->removePaginationParameters($request->query->all());
        $form = $this->createForm(RegistrosSearchFormType::class, $criteria, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $registros = $this->repo->findByCriteria($data,['id' => 'DESC'], $this->maxRegistros);
            $criteria = $this->removeBlankFilters($data);
            $this->setPage(1);
        }
        unset($criteria['returnUrl']);
        if ( $this->checkAtLeastOneFilter($criteria) ) {
            if ( $request->getMethod() === Request::METHOD_GET) {
                $registros = $this->repo->findByCriteria($criteria,['id' => 'DESC'], $this->maxRegistros);
            }
        } else {
            if ( $request->getMethod() === Request::METHOD_POST ) {
                $this->addFlash('error','messages.chooseAtLeastOneFilter');
            }
            $registros = [];
        }
        unset($criteria['expediente']);
        if (count($registros) === $this->maxRegistros ) {
            $this->addFlash('warning',new TranslatableMessage('messages.maxResultsReached', [ '%max%' => $this->maxRegistros]));
        }
        return $this->render('registro/registrosIndex.html.twig', [
            'form' => $form,
            'registros' => $registros,
            'filters' => $criteria,
        ]);
    }

    /**
     * Checks if any value if not null
     * @param array $filters
     * 
     * @return bool
     */
    private function checkAtLeastOneFilter(array $filters): bool
    {
        foreach ( $filters as $key => $value) {
            if ($value !== null) {
                return true;
            }
        }
        return false;
    }

}
