<?php

namespace Yvz\BigcommerceApiService\Resources;

use Illuminate\Support\Facades\Config;
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

    /**
     * Handles HTTP requests by constructing the path and optionally removing headers.
     */
    protected function handleRequest(
        string $method,
        string $version,
        string $pathKey,
        array  $parameters,
        bool   $includeHeaders,
        array  $pathParams = []
    ): array
    {
        // Resolve the full URL path dynamically.
        $path = $this->buildPath(Config::get($pathKey), $pathParams);

        $response = $this->request(
            $method,
            Config::get($version),
            $path,
            $parameters
        );

        // Remove headers if not needed
        if (!$includeHeaders) {
            unset($response['headers']);
        }

        return $response;
    }
}