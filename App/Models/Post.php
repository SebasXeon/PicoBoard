<?php

namespace App\Models;

use App\Core\Database;

class Post {
    private $DB;

    public $id;
    public $board_id;
    public $is_thread;
    public $thread_id = null;  
    public $attachment_id = null;
    public $title;
    public $body;
    public $created_at;
    public $updated_at;
    public $replies = [];

    public function __construct($db) {
        $this->DB = $db;
    }
    // Set the post data
    public function set($id, $board_id, $is_thread, $thread_id, $attachment_id, $title, $body, $created_at, $updated_at) {
        $this->id = $id;
        $this->board_id = $board_id;
        $this->is_thread = $is_thread;
        $this->thread_id = $thread_id;
        $this->attachment_id = $attachment_id;
        $this->title = $title;
        $this->body = $body;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Create a new post
    public function create($board_id, $is_thread, $thread_id, $attachment_id, $title, $body) {
        // Create the post
        $this->DB->query('INSERT INTO Posts (board_id, is_thread, thread_id, attachment_id, title, body, created_at, updated_at) VALUES (:board_id, :is_thread, :thread_id, :attachment_id, :title, :body, :created_at, :updated_at)');
        $this->DB->bind(':board_id', $board_id);
        $this->DB->bind(':is_thread', $is_thread);
        $this->DB->bind(':thread_id', $thread_id);
        $this->DB->bind(':attachment_id', $attachment_id);
        $this->DB->bind(':title', $title);
        $this->DB->bind(':body', $body);
        $this->DB->bind(':created_at', date('Y-m-d H:i:s'));
        $this->DB->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->DB->execute();
        // Retrieve the post data
        $this->set($this->DB->lastInsertId(), $board_id, $is_thread, $thread_id, $attachment_id, $title, $body, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));

        // Update the main thread updated_at field
        if (!$is_thread) {
            $this->DB->query('UPDATE Posts SET updated_at = :updated_at WHERE id = :id');
            $this->DB->bind(':id', $thread_id);
            $this->DB->bind(':updated_at', date('Y-m-d H:i:s'));
            $this->DB->execute();
        }
    }

    // Update the post
    public function update() {
        // Update the post
        $this->DB->query('UPDATE Posts SET body = :body, updated_at = :updated_at WHERE id = :id');
        $this->DB->bind(':id', $this->id);
        $this->DB->bind(':body', $this->body);
        $this->DB->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->DB->execute();
        // Retrieve the post data
        $this->set($this->id, $this->board_id, $this->is_thread, $this->thread_id, $this->attachment_id, $this->title, $this->body, $this->created_at, date('Y-m-d H:i:s'));
    }

    // Get a post by its id
    public static function getById($id) {
        // Initialize the database connection
        $DB = new Database();
        // Get the post
        $DB->query('SELECT * FROM Posts WHERE id = :id');
        $DB->bind(':id', $id);
        $post = $DB->fetch();
        // Close the database connection
        $DB->closeConnection();
        if ($post == null) {
            return null;
        }
        // Create a new post
        $new_post = new Post($DB);
        $new_post->set($post['id'], $post['board_id'], $post['is_thread'], $post['thread_id'], $post['attachment_id'], $post['title'], $post['body'], $post['created_at'], $post['updated_at']);
        return $new_post;
    }

    // Get recent posts that are threads from a board
    public static function getRecentThreadsFromBoard($board_id, $page = 1, $limit = 10) {
        // Initialize the database connection
        $DB = new Database();
        // Get all threads
        $DB->query('SELECT * FROM Posts WHERE board_id = :board_id AND is_thread = 1 ORDER BY updated_at DESC');
        $DB->bind(':board_id', $board_id);
        $posts = $DB->fetchAll();
        // Close the database connection
        $DB->closeConnection();
        // List of posts
        $list = [];
        foreach ($posts as $post) {
            $new_post = new Post($DB);
            $new_post->set($post['id'], $post['board_id'], $post['is_thread'], $post['thread_id'], $post['attachment_id'], $post['title'], $post['body'], $post['created_at'], $post['updated_at']);
            $list[] = $new_post;
        }
        return $list;
    }
    
    
    // Get a post from main thread
    public static function getFromThread($thread_id) {
        // Initialize the database connection
        $DB = new Database();
        // Get the post
        $DB->query('SELECT * FROM Posts WHERE thread_id = :thread_id AND is_thread = 0');
        $DB->bind(':thread_id', $thread_id);
        $post = $DB->fetch();
        // Close the database connection
        $DB->closeConnection();
        if ($post == null) {
            return null;
        }
        // Create a new post
        $new_post = new Post($DB);
        $new_post->set($post['id'], $post['board_id'], $post['is_thread'], $post['thread_id'], $post['attachment_id'], $post['title'], $post['body'], $post['created_at'], $post['updated_at']);
        return $new_post;
    }

    // Get replies from a thread
    public static function getReplies($thread_id) {
        // Initialize the database connection
        $DB = new Database();
        // Get all replies
        $DB->query('SELECT * FROM Posts WHERE thread_id = :thread_id AND is_thread = 0 ORDER BY created_at ASC');
        $DB->bind(':thread_id', $thread_id);
        $posts = $DB->fetchAll();
        // Close the database connection
        $DB->closeConnection();
        // List of posts
        $list = [];
        foreach ($posts as $post) {
            $new_post = new Post($DB);
            $new_post->set($post['id'], $post['board_id'], $post['is_thread'], $post['thread_id'], $post['attachment_id'], $post['title'], $post['body'], $post['created_at'], $post['updated_at']);
            $list[] = $new_post;
        }
        return $list;
    }
}