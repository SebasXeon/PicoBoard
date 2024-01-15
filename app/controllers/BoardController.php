<?php
include_once('./app/models/BoardModel.php');
include_once('./app/models/ThreadModel.php');
include_once('./app/models/PostModel.php');

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

        // Get all threads from the board
        $page['threads'] = Thread::getRecentFromBoard($page['board']->id, 1);
        // Get all posts from the threads
        foreach ($page['threads'] as $thread) {
            $thread->posts = Post::getFromThread($thread->id);
        }


        require_once('./app/views/board.php');
    }
}