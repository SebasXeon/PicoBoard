<?php
class HomeController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function index() {
        $page['title'] = 'PicoBoard';

        include_once('app/views/layouts/MainLayout.php');
    }
}