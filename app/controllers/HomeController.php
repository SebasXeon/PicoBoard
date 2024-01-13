<?php
include_once('./app/models/BoardModel.php');

class HomeController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function index() {
        $page['title'] = 'PicoBoard';
        $page['boards'] = Board::getAll();
        
        require_once('./app/views/home.php');
    }
}