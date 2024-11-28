<?php

require 'environment.php';

$config = array();


if (ENVIRONMENT == 'development') {
  define("BASE_URL", "http://localhost/projeto-catalogo/");
  define("PATH_SITE", "./");

  $config['dbname'] = 'catalogo_database';
  $config['host'] = '127.0.0.1'; 
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
} else {
  define("BASE_URL", "https://devluizmattos.com.br/");
  define("PATH_SITE", "./");

  $config['dbname'] = 'devlui46_catalogo_database';
  $config['host'] = 'localhost'; 
  $config['dbuser'] = 'devlui46_luimattos';
  $config['dbpass'] = 'v[!7JF9k?[g+';
}

global $db;
try {
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
  echo "ERRO: ".$e->getMessage();
  exit;
}

