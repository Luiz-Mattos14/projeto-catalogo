<?php

require 'environment.php';

$config = array();


if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost:8000/");

	$config['dbname'] = 'catalogo_database';

	$config['host'] = 'mysql';

	$config['dbuser'] = 'root';

	$config['dbpass'] = 'root';
} else {
	define("BASE_URL", "https://intensebikes.com.br/");

	$config['dbname'] = 'intensebikes_catalogo';

	$config['host'] = 'localhost';

	$config['dbuser'] = 'intensebikes_ismaelfm';

	$config['dbpass'] = 't3p$qcMG7W93h,vAuy';
}

global $db;

try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();

	exit;
}
