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

        ]
    ]
];