<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Illuminate\Support\Facades\Config;
use Psr\Http\Message\ResponseInterface;
use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductResource extends BaseResource
{
    public function list(array $parameters, bool $needHeaders = true): array
    {
        $response = $this->request(
            HttpMethods::GET,
            Config::get('bigcommerce.api_paths.catalog.products.version'),
            Config::get('bigcommerce.api_paths.catalog.products.paths.list'),
            $parameters,
        );

        if (!$needHeaders) {
            unset($response['headers']);
        }

        return $response;
    }

    public function show(int $id, array $parameters = [], bool $needHeaders = true): array
    {
        $response = $this->request(
            HttpMethods::GET,
            Config::get('bigcommerce.api_paths.catalog.products.version'),
            $this->buildPath(
                Config::get('bigcommerce.api_paths.catalog.products.paths.show'),
                ['id' => $id]
            ),
            $parameters,
        );

        if (!$needHeaders) {
            unset($response['headers']);
        }

        return $response;
    }
}