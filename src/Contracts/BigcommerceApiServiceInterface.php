<?php

namespace Yvz\BigcommerceApiService\Contracts;

interface BigcommerceApiServiceInterface
{
    /**
     * @param string $storeHash
     * @param string $accessToken
     */
    public function __construct(string $storeHash, string $accessToken);

    /**
     * @param string $version
     * @param string $path
     * @return string
     */
    public function buildUrl(string $version, string $path): string;

    /**
     * Make an HTTP request to the BigCommerce API.
     */
    public function makeRequest(string $method, string $version, string $url, array $parameters = []): array;
}