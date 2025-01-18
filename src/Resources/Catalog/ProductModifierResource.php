<?php

namespace Yvz\BigcommerceApiService\Resources\Catalog;

use Illuminate\Support\Facades\Config;
use Yvz\BigcommerceApiService\Resources\BaseResource;
use Yvz\BigcommerceApiService\Constants\HttpMethods;

class ProductModifierResource extends BaseResource
{
    public function list(int $productId, array $parameters, bool $needHeaders = true): array
    {
        $response = $this->request(
            HttpMethods::GET,
            Config::get('bigcommerce.api_paths.catalog.modifiers.version'),
            $this->buildPath(
                Config::get('bigcommerce.api_paths.catalog.modifiers.paths.list'),
                ['product_id' => $productId],
            ),
            $parameters,
        );

        if (!$needHeaders) {
            unset($response['headers']);
        }

        return $response;
    }

    public function show(int $productId, int $modifierId, array $parameters = [], bool $needHeaders = true): array
    {
        $response = $this->request(
            HttpMethods::GET,
            Config::get('bigcommerce.api_paths.catalog.modifiers.version'),
            $this->buildPath(
                Config::get('bigcommerce.api_paths.catalog.modifiers.paths.show'),
                [
                    'product_id'  => $productId,
                    'modifier_id' => $modifierId,
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