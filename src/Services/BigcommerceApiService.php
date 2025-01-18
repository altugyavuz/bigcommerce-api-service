<?php

namespace Yvz\BigcommerceApiService\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use InvalidArgumentException;
use Yvz\BigcommerceApiService\Contracts\BigcommerceApiServiceInterface;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductResource;

class BigcommerceApiService implements BigcommerceApiServiceInterface
{
    protected string          $baseUrl;
    protected string          $storeHash   = '';
    protected string          $accessToken = '';
    protected string          $version     = 'v3';
    protected array           $headers     = [];
    protected array           $resources   = [];
    protected ?PendingRequest $httpClient  = null;

    public function __construct(string $storeHash, string $accessToken)
    {
        $this->baseUrl     = config('bigcommerce.base_url', 'https://api.bigcommerce.com/stores');
        $this->headers     = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $this->storeHash   = $storeHash;
        $this->accessToken = $accessToken;
    }

    /**
     * Dynamically fetch resource objects like $service->products or $service->orders
     */
    public function __get(string $name)
    {
        $resourceMap = $this->getResourceMap();

        if (!array_key_exists($name, $resourceMap)) {
            throw new InvalidArgumentException("Resource '{$name}' does not exist.");
        }

        // If the resource has been created before, retrieve it from the cache.
        if (!isset($this->resources[$name])) {
            $resourceClass          = $resourceMap[$name];
            $this->resources[$name] = new $resourceClass($this);
        }

        return $this->resources[$name];
    }

    /**
     * Get resource map to dynamically initialize resources
     */
    protected function getResourceMap(): array
    {
        return [
            'products' => ProductResource::class,
        ];
    }

    protected function setStoreHash(string $storeHash): void
    {
        $this->storeHash = $storeHash;
    }

    protected function setAccessToken(string $accessToken): void
    {
        $this->accessToken             = $accessToken;
        $this->headers['X-Auth-Token'] = $accessToken;
    }

    /**
     * Set up the HTTP client.
     */
    protected function createHttpClient(): void
    {
        $this->httpClient = Http::withHeaders($this->headers);
    }

    /**
     * Perform the actual HTTP request based on the method.
     */
    private function makeHttpRequest(string $method, string $url, array $parameters = []): Response
    {
        return $method === 'delete'
            ? $this->httpClient->{$method}($url)
            : $this->httpClient->{$method}($url, $parameters);
    }

    /**
     * Handle a generic HTTP request.
     */
    protected function handleRequest(string $method, string $url, array $parameters = []): array
    {
        if (!$this->httpClient) {
            $this->createHttpClient();
        }

        $method = strtolower($method);

        $response = $this->makeHttpRequest($method, $url, $parameters);

        return $response->successful()
            ? [
                'status'     => true,
                'statusCode' => $response->status(),
                'data'       => $response->json(),
                'headers'    => $response->headers(),
            ]
            : [
                'status'     => false,
                'statusCode' => $response->status(),
                'error_bag'  => $response->body(),
                'headers'    => $response->headers(),
            ];
    }

    /**
     * Build a full API URL with the given path.
     */
    public function buildUrl(string $version, string $path): string
    {
        $path = ltrim($path, '/');
        return sprintf('%s/%s/%s/%s', $this->baseUrl, $this->storeHash, $version, $path);
    }

    /**
     * Make a request (implements the interface).
     */
    public function makeRequest(string $method, string $version, string $url, array $parameters = []): array
    {
        $method = strtolower($method);

        if (!in_array($method, ['get', 'post', 'put', 'delete', 'head'])) {
            throw new InvalidArgumentException("Invalid HTTP method: $method");
        }

        $fullUrl = $this->buildUrl($version, $url);

        return $this->handleRequest($method, $fullUrl, $parameters);
    }
}