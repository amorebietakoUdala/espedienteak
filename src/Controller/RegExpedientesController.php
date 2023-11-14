<?php

namespace App\Controller;

use App\Entity\RegExpedientes;
use App\Form\RegExpedienteSearchFormType;
use App\Repository\RegExpedientesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;

class RegExpedientesController extends BaseController
{
    private RegExpedientesRepository $repo;
    private string $urlDocumentos;
    private int $maxExpedientes;

    public function __construct(RegExpedientesRepository $repo, $urlDocumentos = '/documentos', $maxExpedientes = 50)
    {
        $this->repo = $repo;
        $this->urlDocumentos = $urlDocumentos;
        $this->maxExpedientes = $maxExpedientes;
    }

    /**
     * @Route("/{_locale}/regexpedientes/{regexpediente}/detail", name="regexpendientes_detail")
     */
    public function show(Request $request, RegExpedientes $regexpediente): Response
    {
        $this->loadQueryParameters($request);
        $criteria = $request->query->all();
        $criteria = $this->removePaginationParameters($criteria);
        $pasosexpedientes = $regexpediente->getPasosExpedientes();
        $template = !$this->getAjax() ? 'regexpedientes/show.html.twig' : 'regexpedientes/_pasosList.html.twig';
        return $this->renderForm($template, [
            'pasosexpedientes' => $pasosexpedientes,
            'urlDocumentos' => $this->urlDocumentos,
        ]);                
    }

    /**
     * @Route("/{_locale}/regexpedientes", name="regexpedientes_index")
     */
    public function index(Request $request): Response
    {
        $this->loadQueryParameters($request);
        $criteria = $request->query->all();
        $criteria = $this->removePaginationParameters($criteria);
        $criteria = $this->changeStringToDates($criteria);
        $form = $this->createForm(RegExpedienteSearchFormType::class, $criteria, []);
        $regexpedientes = [];
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $regexpedientes = $this->repo->findByCriteria($data,['id' => 'DESC'], $this->maxExpedientes);
            $criteria = $this->removeBlankFilters($data);
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
