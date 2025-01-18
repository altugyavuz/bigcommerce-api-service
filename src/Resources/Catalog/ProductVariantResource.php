<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Illuminate\Support\Facades\Config;
use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductVariantResource extends BaseResource
{
    public function list(int $productId, array $parameters, bool $needHeaders = true): array
    {
        $response = $this->request(
            HttpMethods::GET,
            Config::get('bigcommerce.api_paths.catalog.variants.version'),
            $this->buildPath(
                Config::get('bigcommerce.api_paths.catalog.variants.paths.list'),
                ['product_id' => $productId],
            ),
            $parameters,
        );

        if (!$needHeaders) {
            unset($response['headers']);
        }

        return $response;
    }

    public function show(int $productId, int $variantId, array $parameters = [], bool $needHeaders = true): array
    {
        $response = $this->request(
            HttpMethods::GET,
            Config::get('bigcommerce.api_paths.catalog.variants.version'),
            $this->buildPath(
                Config::get('bigcommerce.api_paths.catalog.variants.paths.show'),
                [
                    'product_id' => $productId,
                    'variant_id' => $variantId,
                ]
            ),
            $parameters,
        );

        if (!$needHeaders) {
            unset($response['headers']);
        }

        return $response;
    }
}