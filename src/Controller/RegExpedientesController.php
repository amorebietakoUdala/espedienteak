<?php

namespace App\Controller;

use App\Entity\RegExpedientes;
use App\Form\RegExpedienteSearchFormType;
use App\Repository\PasosExpedientesRepository;
use App\Repository\RegExpedientesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;
use \Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ESPEDIENTEAK')]
class RegExpedientesController extends BaseController
{
    public function __construct(
        private readonly PasosExpedientesRepository $pasosRepo, 
        private readonly RegExpedientesRepository $repo,
        $parameters, 
        private readonly string $urlDocumentos = '/documentos', 
        private readonly int $maxExpedientes = 50)
    {
        parent::__construct($parameters);
    }

    #[Route(path: '/{_locale}/regexpedientes/{regexpediente}/detail', name: 'regexpendientes_detail')]
    public function show(
        Request $request, 
        #[MapEntity(expr: 'repository.find(regexpediente)')]
        RegExpedientes $regexpediente): Response
    {
        $this->loadQueryParameters($request);
        $criteria = $request->query->all();
        $criteria = $this->removePaginationParameters($criteria);
        $pasosexpedientes = $this->pasosRepo->getPasosExpendienteOrdered($regexpediente);
        $template = !$this->getAjax() ? 'regexpedientes/show.html.twig' : 'regexpedientes/_pasosList.html.twig';
        return $this->renderForm($template, [
            'pasosexpedientes' => $pasosexpedientes,
            'urlDocumentos' => $this->urlDocumentos,
            'filters' => $criteria,
        ]);                
    }

    #[Route(path: '/{_locale}/regexpedientes', name: 'regexpedientes_index')]
    public function index(Request $request): Response
    {
        $this->loadQueryParameters($request);
        $criteria = $request->query->all();
        $criteria = $this->removePaginationParameters($criteria);
        $criteria = $this->changeStringToDates($criteria);
        $criteria = $this->changeStringToBool($criteria);
        $form = $this->createForm(RegExpedienteSearchFormType::class, $criteria, []);
        $regexpedientes = [];
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $criteria = $this->removeBlankFilters($data);
            $regexpedientes = $this->repo->findByCriteria($criteria,['id' => 'DESC'], $this->maxExpedientes);
            $this->setPage(1);
        }
        if ( count($criteria) > 0 && $request->getMethod() === 'GET') {
            $regexpedientes = $this->repo->findByCriteria($criteria,['id' => 'DESC'], $this->maxExpedientes);
        }
        if (count($regexpedientes) === $this->maxExpedientes) {
            $this->addFlash('warning', new TranslatableMessage('messages.maxExpedientesReached',[
                '{maxExpedientes}' => $this->maxExpedientes,
            ]));
        }
        $criteria = $this->changeDatesToString($criteria);
        $template = !$this->getAjax() ? 'regexpedientes/index.html.twig' : 'regexpedientes/_list.html.twig';
        return $this->renderForm($template, [
            'regexpedientes' => $regexpedientes,
            'form' => $form,
            'filters' => $criteria,
        ]);                
    }
}
