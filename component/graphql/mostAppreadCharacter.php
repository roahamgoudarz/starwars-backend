<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;


$queryFields = [
    'mostAppreadCharacter' => [
        'type' => Type::string(),
        'args' => [
            'token' => ['type' => Type::string()],
        ],
        'resolve' => $DataLoader->mostAppreadCharacter()
    ]
];

$mutationFields = [];