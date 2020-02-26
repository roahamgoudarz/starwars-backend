<?php

/*
    Configuration of system
*/

$config = array(
    "debug" => true,
    "ssl" => false,
    "provider" => 'rest', // ['graphql', 'rest']
    "db" => array(
        "db1" => array(
            "dbname" => "prototype",
            "username" => "root",
            "password" => "",
            "host" => "localhost"
        )
    )
    // "limitedRangeIp" => array('172.20.20.11'),
);

if($config['ssl'] && $_SERVER["HTTPS"] != "on"){
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}


