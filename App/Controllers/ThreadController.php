<?php

namespace App\Controllers;

use App\Core\Render;
use App\Models\Board;
use App\Models\Post;

class ThreadController {
    // Constructor
    public function __construct() {
        $page = [];
    }
    // Index action
    public function index($board_url, $thread_id) {
        $page['board'] = Board::getByUrl($board_url);
        if ($page['board'] == null) {
            header('Location: /404');
        }
        $page['title'] = $page['board']->title . ' - PicoBoard';

        // Get the thread
        $page['thread'] = Post::getById($thread_id);

        // Get replies from the thread
        $page['thread']->replies = Post::getReplies($page['thread']->id);

        Render::view('./App/Views/Thread.php', ['page' => $page]);
    }
}