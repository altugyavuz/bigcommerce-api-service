<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class BrandResource extends BaseResource
{
    private const VERSION = 'bigcommerce.api_paths.catalog.brands.version';
    private const PATHS = [
        'list' => 'bigcommerce.api_paths.catalog.brands.paths.list',
        'show' => 'bigcommerce.api_paths.catalog.brands.paths.show',
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

    public function show(int $brandId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['show'],
            $parameters,
            $includeHeaders,
            ['brand_id' => $brandId]
        );
    }
}