<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

$f = $DataLoader->mostAppreadSpecies();
$data = array($module=> $f());