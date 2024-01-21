<?php

namespace App\Core;

class Render{

    // Render view
    public static function view($view, $args) {
        // Extract the arguments
        extract($args);
        // Start output buffering
        ob_start();
        // Include the view
        require_once($view);
        // Get the content
        $content = ob_get_contents();
        // End output buffering
        ob_end_clean();
        // Check if the layout is set
        if(!isset($layout)) {
            $layout = 'App/Views/Layouts/MainLayout.php';
        }
        // Include the layout
        require_once($layout);
    }
}