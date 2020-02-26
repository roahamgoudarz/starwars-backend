<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;


$queryFields = [
    'longestOpeningCrawl' => [
        'type' => Type::string(),
        'args' => [
            'token' => ['type' => Type::string()],
        ],
        'resolve' => $DataLoader->longestOpeningCrawl()
    ]
];


$mutationFields = [];