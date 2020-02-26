<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

$f = $DataLoader->largestVehiclePilots();
$data = array($module=> $f());