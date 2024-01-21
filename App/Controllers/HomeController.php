<?php
namespace App\Controllers;

use App\Core\Render;

use App\Models\Board;

class HomeController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function index() {
        $page['title'] = 'PicoBoard';
        $page['boards'] = Board::getAll();
        
        //require_once('./App/Views/Home.php');
        Render::view('./App/Views/Home.php', ['page' => $page]);
    }
}