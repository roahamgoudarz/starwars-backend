<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

$f = $DataLoader->mostAppreadCharacter();
$data = array($module=> $f());