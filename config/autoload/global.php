<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/data/zf3-tutorial.db', realpath(getcwd())),
    ],
    'alegra' => [
    	'user' => 'bexandy@gmail.com',
    	'token' => '4544c5a69069065406cb',
    	'authentication' => 'Basic',
    	'api-url' => [
    		'company' => 'https://app.alegra.com/api/v1/company',
            'items' => 'https://app.alegra.com/api/v1/items/',
            'price-list' => 'https://app.alegra.com/api/v1/price-lists/',
            'categories' => 'https://app.alegra.com/api/v1/categories/',
            'warehouses' => 'https://app.alegra.com/api/v1/warehouses/',
            'taxes' =>  'https://app.alegra.com/api/v1/taxes/',
            'atachment' => '/attachment'
    	]
    ],
    'translatable' => [
        'strings' => [
            'name',
            'description',
            'observation',
            'regime',
            'type'
        ],
        'prices' => [
            'price',
            'unitCost'
        ],
        'convert_currency' => [
            'rate' => 2784.78 ,
            'api_url' => 'http://apilayer.net/api/',
            'endpoint' => 'live',
            'access_key' => '697bee86c1bd1128bf49fe7270dfbb97',
            'currencies' => 'COP'
        ],
        'yandex_translator' => [
            'key' => 'trnsl.1.1.20180326T025546Z.8759566ac41c77b4.3c47c8593776b4cfd74613030dd1bac355e6715f'
        ]
    ]
];
