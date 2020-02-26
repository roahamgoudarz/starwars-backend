<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;

if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    die();
}

try {
    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => $queryFields,
    ]);

    $mutationType = new ObjectType([
        'name' => 'Calc',
        'fields' => $mutationFields
    ]);

    // See docs on schema options:
    // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
    $schema = new Schema([
        'query' => $queryType,
        'mutation' => $mutationType,
    ]);

    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    
    $query = $input['query'];
    $variableValues = isset($input['variables']) ? $input['variables'] : null;


    $rootValue = ['prefix' => 'You said: '];
    $result = GraphQL::executeQuery($schema, $query, null, null, $variableValues);
    $output = $result->toArray();

} catch (\Exception $e) {
    $output = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);