<?php

require 'environment.php';

$config = array();


define("BASE_URL", "http://localhost/projeto-catalogo/");
define("PATH_SITE", "./");

$config['dbname'] = 'catalogo_database';
$config['host'] = '127.0.0.1'; 
$config['dbuser'] = 'root';
$config['dbpass'] = '';

global $db;
try {
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
  echo "ERRO: ".$e->getMessage();
  exit;
}

