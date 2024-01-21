<?php
// Set the error reporting level
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the base path
chdir('../');

// Include the autoloader
require_once('App/Core/AutoLoad.php');

// Include database configuration
require_once('App/Core/DataBase.php');

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the router
require_once('App/Core/Router.php');
//require_once('router.php');
