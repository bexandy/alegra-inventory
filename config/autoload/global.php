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
    ]
];
