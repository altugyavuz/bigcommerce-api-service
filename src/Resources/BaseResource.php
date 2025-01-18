<?php

namespace Yvz\BigcommerceApiService\Resources;

use Yvz\BigcommerceApiService\Services\BigcommerceApiService;

abstract class BaseResource
{
    protected BigcommerceApiService $service;

    public function __construct(BigcommerceApiService $service)
    {
        $this->service = $service;
    }

    /**
     * Replace parameters in the URL path.
     */
    protected function buildPath(string $path, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $path = str_replace("{" . $key . "}", $value, $path);
        }
        return $path;
    }

    /**
     * Make HTTP requests with automatic path building.
     */
    protected function request(string $method, string $version, string $url, array $parameters = []): array
    {
        return $this->service->makeRequest($method, $version, $url, $parameters);
    }
}