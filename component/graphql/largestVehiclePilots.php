<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;


$listType = new ObjectType([
    'name' => 'vehicle',
    'description' => 'Most Appread Species',
    'fields' => [
        'planet' => Type::string(),
        'count' => Type::string(),
        'pilots' => Type::string()
    ]
]);

$queryFields = [
    'largestVehiclePilots' => [
        'type' => Type::listOf($listType),
        'fields' => [
            'planet' => Type::string(),
            'count' => Type::string(),
            'pilots' => Type::string()
        ],
        'args' => [
            'token' => ['type' => Type::string()],
        ],
        'resolve' => $DataLoader->largestVehiclePilots()
    ]
];


$mutationFields = [];