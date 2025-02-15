<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductVariantMetafieldResource extends BaseResource
{
    private const VERSION = 'bigcommerce.api_paths.catalog.variant_metafields.version';
    private const PATHS   = [
        'list'      => 'bigcommerce.api_paths.catalog.variant_metafields.paths.list',
        'batchList' => 'bigcommerce.api_paths.catalog.variant_metafields.paths.batch_list',
        'show'      => 'bigcommerce.api_paths.catalog.variant_metafields.paths.show',
        'create'    => 'bigcommerce.api_paths.catalog.variant_metafields.paths.create',
        'update'    => 'bigcommerce.api_paths.catalog.variant_metafields.paths.update',
        'delete'    => 'bigcommerce.api_paths.catalog.variant_metafields.paths.delete',
    ];

    public function list(int $productId, int $variantId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['list'],
            $parameters,
            $includeHeaders,
            [
                'product_id' => $productId,
                'variant_id' => $variantId,
            ]
        );
    }

    public function batchList(array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['batchList'],
            $parameters,
            $includeHeaders
        );
    }

    public function show(int $productId, int $variantId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['show'],
            $parameters,
            $includeHeaders,
            [
                'product_id'   => $productId,
                'variant_id'   => $variantId,
                'metafield_id' => $metafieldId,
            ]
        );
    }

    public function create(int $productId, int $variantId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::POST,
            self::VERSION,
            self::PATHS['create'],
            $parameters,
            $includeHeaders,
            [
                'product_id' => $productId,
                'variant_id' => $variantId,
            ]
        );
    }

    public function update(int $productId, int $variantId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::PUT,
            self::VERSION,
            self::PATHS['update'],
            $parameters,
            $includeHeaders,
            [
                'product_id'   => $productId,
                'variant_id'   => $variantId,
                'metafield_id' => $metafieldId,
            ]
        );
    }

    public function delete(int $productId, int $variantId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::DELETE,
            self::VERSION,
            self::PATHS['delete'],
            $parameters,
            $includeHeaders,
            [
                'product_id'   => $productId,
                'variant_id'   => $variantId,
                'metafield_id' => $metafieldId,
            ]
        );
    }
}