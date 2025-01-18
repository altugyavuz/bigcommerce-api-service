<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductModifierResource extends BaseResource
{
    private const VERSION = 'bigcommerce.api_paths.catalog.modifiers.version';
    private const PATHS   = [
        'list' => 'bigcommerce.api_paths.catalog.modifiers.paths.list',
        'show' => 'bigcommerce.api_paths.catalog.modifiers.paths.show',
    ];

    public function list(int $productId, array $parameters, bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['list'],
            $parameters,
            $includeHeaders,
            ['product_id' => $productId]
        );
    }

    public function show(int $productId, int $modifierId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['show'],
            $parameters,
            $includeHeaders,
            [
                'product_id'  => $productId,
                'modifier_id' => $modifierId,
            ]
        );
    }
}