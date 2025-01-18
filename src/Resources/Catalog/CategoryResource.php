<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class CategoryResource extends BaseResource
{
    private const VERSION = 'bigcommerce.api_paths.catalog.categories.version';
    private const PATHS = [
        'list' => 'bigcommerce.api_paths.catalog.categories.paths.list',
        'show' => 'bigcommerce.api_paths.catalog.categories.paths.show',
    ];

    public function list(array $parameters, bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['list'],
            $parameters,
            $includeHeaders
        );
    }

    public function show(int $id, array $parameters = [], bool $includeHeaders = true): array
    {
        $parameters = array_merge(['category_id:in' => $id], $parameters);

        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['show'],
            $parameters,
            $includeHeaders
        );
    }
}