<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductMetafieldResource extends BaseResource
{
    private const VERSION = 'bigcommerce.api_paths.catalog.metafields.version';
    private const PATHS   = [
        'list'        => 'bigcommerce.api_paths.catalog.metafields.paths.list',
        'batchList'   => 'bigcommerce.api_paths.catalog.metafields.paths.batch_list',
        'show'        => 'bigcommerce.api_paths.catalog.metafields.paths.show',
        'create'      => 'bigcommerce.api_paths.catalog.metafields.paths.create',
        'batchCreate' => 'bigcommerce.api_paths.catalog.metafields.paths.batch_create',
        'update'      => 'bigcommerce.api_paths.catalog.metafields.paths.update',
        'batchUpdate' => 'bigcommerce.api_paths.catalog.metafields.paths.batch_update',
        'delete'      => 'bigcommerce.api_paths.catalog.metafields.paths.delete',
        'batchDelete' => 'bigcommerce.api_paths.catalog.metafields.paths.batch_delete',
    ];

    public function list(int $productId, array $parameters = [], bool $includeHeaders = true): array
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

    public function show(int $productId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::GET,
            self::VERSION,
            self::PATHS['show'],
            $parameters,
            $includeHeaders,
            [
                'product_id'   => $productId,
                'metafield_id' => $metafieldId,
            ]
        );
    }

    public function create(int $productId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::POST,
            self::VERSION,
            self::PATHS['create'],
            $parameters,
            $includeHeaders,
            ['product_id' => $productId]
        );
    }

    public function batchCreate(array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::POST,
            self::VERSION,
            self::PATHS['batchCreate'],
            $parameters,
            $includeHeaders
        );
    }

    public function update(int $productId, int $metafieldId, array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::PUT,
            self::VERSION,
            self::PATHS['update'],
            $parameters,
            $includeHeaders,
            [
                'product_id'   => $productId,
                'metafield_id' => $metafieldId,
            ]
        );
    }

    public function batchUpdate(array $parameters = [], bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::PUT,
            self::VERSION,
            self::PATHS['batchUpdate'],
            $parameters,
            $includeHeaders
        );
    }

    public function delete(int $productId, int $metafieldId, bool $includeHeaders = true): array
    {
        return $this->handleRequest(
            HttpMethods::DELETE,
            self::VERSION,
            self::PATHS['delete'],
            [],
            $includeHeaders,
            [
                'product_id'   => $productId,
                'metafield_id' => $metafieldId,
            ]
        );
    }

    public function batchDelete(): array
    {
        return $this->handleRequest(
            HttpMethods::DELETE,
            self::VERSION,
            self::PATHS['batchDelete'],
            [],
            true
        );
    }
}