<?php

namespace App\Controllers;

use App\Core\Render;

class ExceptionController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function pageNotFound() {
        $page['title'] = 'PicoBoard - 404';

        Render::view('./App/Views/404.php', ['page' => $page]);
    }
}