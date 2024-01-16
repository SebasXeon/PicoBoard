<?php
include_once('./app/models/BoardModel.php');
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

        // Get recent threads from the board
        $page['threads'] = Post::getRecentThreadsFromBoard($page['board']->id, 0, 10);

        // Get replies from the threads
        foreach ($page['threads'] as $thread) {
            $thread->replies = Post::getReplies($thread->id);
        }

        require_once('./app/views/board.php');
    }
}