<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected array $parameters = [];
    
    public function __construct(protected array $queryParams = []) {
        $this->parameters = $this->queryParams;
    }

    protected function loadQueryParameters(Request $request) {
        if (
            $request->getMethod() === Request::METHOD_GET || 
            $request->getMethod() === Request::METHOD_POST || 
            $request->getMethod() === Request::METHOD_DELETE ) {
            $this->setDefaults();
            $this->queryParams = array_merge($this->queryParams, $request->query->all());
            if ( $this->queryParams !== null ) {
                $query = parse_url((string) $this->queryParams['returnUrl'], PHP_URL_QUERY);
                if ( $query === null) {
                    $query = [];
                } else {
                    parse_str($query,$query);
                }
                $this->queryParams = array_merge($this->queryParams, $query);
            }
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
        return parent::render($view, $viewParameters, $response);
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
            if (gettype($value) === 'object' && $value::class === 'DateTime') {
                $criteria[$key] = $value->format('Y-m-d');
            }
        }
        return $criteria;
    }

    protected function changeStringToDates(&$criteria) {
        foreach ( $criteria as $key => $value) {
            if ( str_starts_with((string) $key, 'fecha') || str_starts_with((string) $key, 'date') ) {
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
        $this->queryParams['page'] = $this->parameters['page'] ?? 1;
        $this->queryParams['pageSize'] = $this->parameters['pageSize'] ?? 10;
        $this->queryParams['sortName'] = $this->parameters['sortName'] ?? 0;
        $this->queryParams['sortOrder'] = isset($this->parameters['sortOrder']) ? $this->parameters['pageOrder'] : 'asc';
        $this->queryParams['returnUrl'] = null;
    }
}
