<?php

namespace Yvz\BigcommerceApiService\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use InvalidArgumentException;
use Yvz\BigcommerceApiService\Contracts\BigcommerceApiServiceInterface;
use Yvz\BigcommerceApiService\Resources\Catalog\BrandResource;
use Yvz\BigcommerceApiService\Resources\Catalog\CategoryResource;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductCustomFieldResource;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductMetafieldResource;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductModifierResource;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductResource;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductVariantMetafieldResource;
use Yvz\BigcommerceApiService\Resources\Catalog\ProductVariantResource;

/**
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\CategoryResource $categories
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\BrandResource $brands
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\ProductResource $products
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\ProductVariantResource $variants
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\ProductModifierResource $modifiers
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\ProductCustomFieldResource $customFields
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\ProductMetafieldResource $metafields
 * @property-read \Yvz\BigcommerceApiService\Resources\Catalog\ProductVariantMetafieldResource $variantMetafields
 */
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
        $this->baseUrl = config('bigcommerce.base_url', 'https://api.bigcommerce.com/stores');
        $this->initializeHeaders();
        $this->updateStoreHash($storeHash);
        $this->updateAccessToken($accessToken);
    }

    /**
     * Dynamically fetch resource objects like $service->products or $service->orders.
     */
    public function __get(string $name)
    {
        $resourceMap = $this->getResourceMap();

        if (!array_key_exists($name, $resourceMap)) {
            throw new InvalidArgumentException("Resource '{$name}' does not exist.");
        }

        return $this->resources[$name] ?? $this->initializeResource($name, $resourceMap[$name]);
    }

    /**
     * Set up request headers.
     */
    protected function initializeHeaders(): void
    {
        $this->headers = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Dynamically initialize a resource and cache it.
     */
    protected function initializeResource(string $name, string $class)
    {
        return $this->resources[$name] = new $class($this);
    }

    /**
     * Get a resource map to dynamically initialize resources.
     */
    protected function getResourceMap(): array
    {
        return [
            'categories'        => CategoryResource::class,
            'brands'            => BrandResource::class,
            'products'          => ProductResource::class,
            'variants'          => ProductVariantResource::class,
            'modifiers'         => ProductModifierResource::class,
            'customFields'      => ProductCustomFieldResource::class,
            'metafields'        => ProductMetafieldResource::class,
            'variantMetafields' => ProductVariantMetafieldResource::class,
        ];
    }

    /**
     * Updates the store hash and stores it locally.
     */
    protected function updateStoreHash(string $storeHash): void
    {
        $this->storeHash = $storeHash;
    }

    /**
     * Updates the access token and refreshes headers.
     */
    protected function updateAccessToken(string $accessToken): void
    {
        $this->accessToken             = $accessToken;
        $this->headers['X-Auth-Token'] = $accessToken;
    }

    /**
     * Handle a generic HTTP request with dynamic method.
     */
    private function handleRequest(string $method, string $url, array $parameters = []): array
    {
        $this->httpClient ??= Http::withHeaders($this->headers);

        $response = $method === 'delete'
            ? $this->httpClient->{$method}($url)
            : $this->httpClient->{$method}($url, $parameters);

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
            throw new InvalidArgumentException("Invalid HTTP method: {$method}");
        }

        return $this->handleRequest(
            $method,
            $this->buildUrl($version, $url),
            $parameters
        );
    }
}