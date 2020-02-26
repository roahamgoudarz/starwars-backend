<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

require_once 'vendor/autoload.php';
require_once 'inc/config.php';
require_once 'inc/DataLoader.php';

$DataLoader = new DataLoader();


//Check ErrorLog configuration from config file
if($config['debug']){
	ini_set('display_errors', '1');
	error_reporting(E_ALL);
}
else{
	ini_set('display_errors', 0);
	error_reporting(0);
}

//Add define to prevent direct access to a php include file
define("STARWARS" , "6f521dce74b666f02dec94aba5bf37af");


if(isset($_GET['action'])){ 
	$action = $DataLoader->inj($_GET['action']);
} else {
	$action = 'auth';
}



//check, in which format should program pass data
$provider = ($config['provider'] == 'rest'?'rest':'graphql');


//Routes
switch($action){

	case 'longestOpeningCrawl':$module = 'longestOpeningCrawl';break;
	case 'mostAppreadCharacter':$module = 'mostAppreadCharacter';break;
	case 'mostAppreadSpecies':$module = 'mostAppreadSpecies';break;
	case 'largestVehiclePilots':$module = 'largestVehiclePilots';break;

	default: $module = 'auth';break;
}



require_once 'component/'.$provider.'/'.$module.'.php';
require_once 'handler/'.$provider.'.php';