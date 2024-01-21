<?php

namespace App\Controllers;

use App\Core\Render;

use App\Models\Board;
use App\Models\Post;

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

        Render::view('Board', ['page' => $page]);
    }
}