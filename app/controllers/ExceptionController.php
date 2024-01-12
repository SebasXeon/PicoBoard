<?php
class ExceptionController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function pageNotFound() {
        include_once('app/views/404.php');
    }
}