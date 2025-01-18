<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductVariantResource extends BaseResource
{
    private const VERSION = 'bigcommerce.api_paths.catalog.variants.version';
    private const PATHS = [
        'list' => 'bigcommerce.api_paths.catalog.variants.paths.list',
        'show' => 'bigcommerce.api_paths.catalog.variants.paths.show',
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

    public function show(int $productId, int $variantId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['show'],
            $parameters,
            $includeHeaders,
            [
                'product_id' => $productId,
                'variant_id' => $variantId,
            ]
        );
    }
}