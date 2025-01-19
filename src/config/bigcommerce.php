<?php

return [
    'base_url'  => env('BIGCOMMERCE_BASE_URL'),
    /**
     * BigCommerce Management API Paths
     */
    'api_paths' => [
        'catalog' => [
            'categories' => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/trees/categories',
                    'show' => 'catalog/trees/categories',
                ],
            ],
            'brands' => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/brands',
                    'show' => 'catalog/brands/{brand_id}',
                ],
            ],
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
            'modifiers' => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products/{product_id}/modifiers',
                    'show' => 'catalog/products/{product_id}/modifiers/{modifier_id}',
                ],
            ],
        ]
    ]
];