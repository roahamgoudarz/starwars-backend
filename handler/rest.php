<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode(array('data' => $data));