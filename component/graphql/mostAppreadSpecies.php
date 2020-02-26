<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;

$listType = new ObjectType([
    'name' => 'species',
    'description' => 'Most Appread Species',
    'fields' => [
        'name' => Type::string(),
        'count' => Type::string()
    ]
]);

$queryFields = [
    'mostAppreadSpecies' => [
        'type' => Type::listOf($listType),
        'fields' => [
            'name' =>  Type::string(),
            'count' => Type::string()
        ],
        'args' => [
            'token' => ['type' => Type::string()],
        ],
        'resolve' => $DataLoader->mostAppreadSpecies()
    ]
];

$mutationFields = [];