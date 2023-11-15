<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected array $queryParams = [];
    protected array $parameters = [];
    
    public function __construct(array $parameters) {
        $this->queryParams = $parameters;
        $this->parameters = $parameters;
    }

    protected function loadQueryParameters(Request $request) {
        if (
            $request->getMethod() === Request::METHOD_GET || 
            $request->getMethod() === Request::METHOD_POST || 
            $request->getMethod() === Request::METHOD_DELETE ) {
            $this->setDefaults();
            $this->queryParams = array_merge($this->queryParams, $request->query->all());
            if ( $this->queryParams !== null ) {
                $query = parse_url($this->queryParams['returnUrl'], PHP_URL_QUERY);
                parse_str($query,$query);
                $this->queryParams = array_merge($this->queryParams, $query);
            }
            dump($this->queryParams);
        }
    }

    protected function getPaginationParameters() : array {
        return $this->queryParams;
    }

    protected function getAjax(): bool {
        if ( array_key_exists('ajax', $this->queryParams) ) {
            return $this->queryParams['ajax'] === 'true' ? true : false;
        }
        
        return false;
    }

    protected function render(string $view, array $parameters = [], Response $response = null): Response {
        $paginationParameters = $this->getPaginationParameters();
        $viewParameters = array_merge($parameters, $paginationParameters);
        return parent::render($view, $viewParameters, $response);
    }

    protected function renderForm(string $view, array $parameters = [], Response $response = null): Response {
        $paginationParameters = $this->getPaginationParameters();
        $viewParameters = array_merge($parameters, $paginationParameters);
        return parent::renderForm($view, $viewParameters, $response);
    }

    protected function redirectToRoute(string $route, array $parameters = [], int $status = 302): RedirectResponse {
        $paginationParameters = $this->getPaginationParameters();
        $viewParameters = array_merge($parameters, $paginationParameters);
        unset($viewParameters['returnUrl']);
        return parent::redirectToRoute($route, $viewParameters, $status);
    }    

    protected function removeBlankFilters($filter) {
        $criteria = [];
        foreach ( $filter as $key => $value ) {
            if (null !== $value) {
                $criteria[$key] = $value;
            }
        }
        return $criteria;
    }

    protected function removePaginationParameters(array $filters) {
        unset($filters['page'],$filters['pageSize'],$filters['sortName'],$filters['sortOrder']);
        return $filters;
    }

    protected function changeDatesToString(&$criteria) {
        foreach ( $criteria as $key => $value) {
            if (gettype($value) === 'object' && get_class($value) === 'DateTime') {
                $criteria[$key] = $value->format('Y-m-d');
            }
        }
        return $criteria;
    }

    protected function changeStringToDates(&$criteria) {
        foreach ( $criteria as $key => $value) {
            if ( str_starts_with($key, 'fecha') || str_starts_with($key, 'date') ) {
                $criteria[$key] = new DateTime($value);
            }
        }
        return $criteria;
    }

    protected function setPage($number): self {
        $this->queryParams['page'] = $number;
        return $this;
    }

    protected function setDefaults() {
        $this->queryParams['page'] = isset($this->parameters['page']) ? $this->parameters['page'] : 1;
        $this->queryParams['pageSize'] = isset($this->parameters['pageSize']) ? $this->parameters['pageSize'] : 10;
        $this->queryParams['sortName'] = isset($this->parameters['sortName']) ?  $this->parameters['sortName'] : 0;
        $this->queryParams['sortOrder'] = isset($this->parameters['sortOrder']) ? $this->parameters['pageOrder'] : 'asc';
        $this->queryParams['returnUrl'] = null;
    }
}
