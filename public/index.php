<?php
// Set the error reporting level
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the base path
chdir('../');

// Include database configuration
require_once('app/core/database.php');

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the router
require_once('app/core/router.php');
//require_once('router.php');
