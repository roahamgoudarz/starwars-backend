<?php

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

$query = $input['query'];

preg_match('#\((.*?)\)#', $query, $args);
$args = explode(',', $args[1]);


foreach($args as $key=>$value){
    $args[$key] =  strstr($args[$key], '"');
    $args[$key] =  trim($args[$key], '"');
}



if (strpos($query, 'signUp') !== false) {
    $data = array('signUp'=> $DataLoader->signUp($args));
}else{
    $data = array('login'=> $DataLoader->login($args));

}

// $mutationFields = [
//     'signUp' => [
//         'type' => Type::string(),
//         'args' => [
//             'email' => ['type' => Type::string()],
//             'password' => ['type' => Type::string()],
//         ],
//         'resolve' => function ($rootValue, $args) {
//             global $core;
//             return $core->signUp($args);
//         },
//     ],
// ];

