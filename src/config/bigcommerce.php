<?php

return [
    'base_url'  => env('BIGCOMMERCE_BASE_URL'),
    /**
     * BigCommerce Management API Paths
     */
    'api_paths' => [
        'catalog' => [
            'categories'    => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/trees/categories',
                    'show' => 'catalog/trees/categories',
                ],
            ],
            'brands'        => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/brands',
                    'show' => 'catalog/brands/{brand_id}',
                ],
            ],
            'products'      => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products',
                    'show' => 'catalog/products/{id}',
                ],
            ],
            'variants'      => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products/{product_id}/variants',
                    'show' => 'catalog/products/{product_id}/variants/{variant_id}',
                ],
            ],
            'modifiers'     => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products/{product_id}/modifiers',
                    'show' => 'catalog/products/{product_id}/modifiers/{modifier_id}',
                ],
            ],
            'custom_fields' => [
                'version' => 'v3',
                'paths'   => [
                    'list' => 'catalog/products/{product_id}/custom-fields',
                    'show' => 'catalog/products/{product_id}/custom-fields/{custom_field_id}',
                ],
            ],
            'metafields'   => [
                'version' => 'v3',
                'paths'   => [
                    'list'   => 'catalog/products/{product_id}/metafields',
                    'show'   => 'catalog/products/{product_id}/metafields/{metafield_id}',
                    'create' => 'catalog/products/{product_id}/metafields',
                    'update' => 'catalog/products/{product_id}/metafields/{metafield_id}',
                    'delete' => 'catalog/products/{product_id}/metafields/{metafield_id}',
                ],
            ],
        ]
    ]
];