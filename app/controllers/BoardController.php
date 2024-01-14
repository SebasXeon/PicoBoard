<?php
include_once('./app/models/BoardModel.php');

class BoardController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function index($board_url) {
        $page['board'] = Board::getByUrl($board_url);
        if ($page['board'] == null) {
            header('Location: /404');
        }
        $page['title'] = $page['board']->title . ' - PicoBoard';

        
        require_once('./app/views/board.php');
    }
}