<?php

class Render{

    // Render view
    public static function view($view, $args) {
        // Extract the arguments
        extract($args);
        // Include the view
        require_once($view);
    }
}