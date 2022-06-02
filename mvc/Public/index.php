<?php
session_start();

require '../vendor/autoload.php';

define("URS_BASE", "localhost/");

$app = new App\Core\App();

/**
 * Outra pasta
 * 
 * <?php
 * session_start();
 * 
 * require '../vendor/autoload.php';
 * 
 * define("URS_BASE", "so o dominho");
 * 
 * remover \
 * $app = new App\Core\App();
*/