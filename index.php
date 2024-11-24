<?php
session_start(); // Inicia sessão php

require 'config.php'; // Caminho para o config (database)
require 'vendor/autoload.php'; // Caminho para o autoload

$core = new Core\Core();
$core->run();
?>