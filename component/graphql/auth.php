<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;


$queryFields = [
    'login' => [
        'type' => Type::string(),
        'args' => [
            'email' => ['type' => Type::string()],
            'password' => ['type' => Type::string()],
        ],
        'resolve' => function ($rootValue, $args) {
            global $DataLoader;
            return $DataLoader->login($args);
        }
    ],
];

$mutationFields = [
    'signUp' => [
        'type' => Type::string(),
        'args' => [
            'email' => ['type' => Type::string()],
            'password' => ['type' => Type::string()],
        ],
        'resolve' => function ($rootValue, $args) {
            global $DataLoader;
            return $DataLoader->signUp($args);
        },
    ],
];