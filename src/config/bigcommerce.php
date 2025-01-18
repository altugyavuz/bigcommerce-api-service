<?php

return [
    'base_url'  => env('BIGCOMMERCE_BASE_URL'),
    /**
     * BigCommerce Management API Paths
     */
    'api_paths' => [
        'catalog' => [
            'products' => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products',
                    'show' => 'catalog/products/{id}',
                ],
            ],
            'variants' => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products/{product_id}/variants',
                    'show' => 'catalog/products/{product_id}/variants/{variant_id}',
                ],
            ],
        ]
    ]
];