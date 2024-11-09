<?php
session_start(); // Inicia sessão php

require '../vendor/autoload.php'; // Caminho para o autoload
require 'config.php'; // Caminho para o config (database)

$core = new Core\Core();
$core->run();
?>