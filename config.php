<?php

require 'environment.php';

$config = array();


if (ENVIRONMENT == 'development') {
  define("BASE_URL", "http://localhost/projeto-catalogo/");
  define("PATH_SITE", "./");

  $config['dbname'] = 'catalogo_database';
  $config['host'] = '127.0.0.1'; // Use 127.0.0.1 ao invés de localhost
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
} else {
  define("BASE_URL", "http://localhost/projeto-catalogo/");
  define("PATH_SITE", "./");

  $config['dbname'] = 'intensebikes_catalogo';
  $config['host'] = '127.0.0.1'; // Use 127.0.0.1 ao invés de localhost
  $config['dbuser'] = 'intensebikes_ismaelfm';
  $config['dbpass'] = 't3p$qcMG7W93h,vAuy';
}

global $db;
try {
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
  echo "ERRO: ".$e->getMessage();
  exit;
}

