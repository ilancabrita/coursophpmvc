<?php
session_start();

require '../vendor/autoload.php';

define("URS_BASE", "localhost/");

$app = new App\Core\App();