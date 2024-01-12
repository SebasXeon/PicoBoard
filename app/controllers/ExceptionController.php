<?php
class ExceptionController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function pageNotFound() {
        $page['title'] = 'PicoBoard - 404';

        require_once('app/views/404.php');
    }
}