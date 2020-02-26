<?php

if(!defined('STARWARS')) {
    die('Direct access not permitted');
}

$f = $DataLoader->longestOpeningCrawl();
$data = array($module=> $f());