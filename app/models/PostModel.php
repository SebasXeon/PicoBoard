<?php
// Post model

class Post {
    private $DB;

    public $id;
    public $thread_id;  
    public $attachment_id = null;
    public $body;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->DB = $db;
    }
    // Set the post data
    public function set($id, $thread_id, $attachment_id, $body, $created_at, $updated_at) {
        $this->id = $id;
        $this->thread_id = $thread_id;
        $this->attachment_id = $attachment_id;
        $this->body = $body;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Create a new post
    public function create($thread_id, $attachment_id, $body) {
        // Create a new post
        $this->DB->query('INSERT INTO Posts (thread_id, attachment_id, body, created_at, updated_at) VALUES (:thread_id, :attachment_id, :body, :created_at, :updated_at )');
        $this->DB->bind(':thread_id', $thread_id);
        $this->DB->bind(':attachment_id', $attachment_id);
        $this->DB->bind(':body', $body);
        $this->DB->bind(':created_at', date('Y-m-d H:i:s'));
        $this->DB->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->DB->execute();
        // Retrieve the post data
        $this->set($this->DB->lastInsertId(), $thread_id, $attachment_id, $body, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
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
        $this->set($this->id, $this->thread_id, $this->attachment_id, $this->body, $this->created_at, date('Y-m-d H:i:s'));
    }

    public static function getFromThread($thread_id) {
        // Initialize the database connection
        $DB = new Database();
        // Get all posts
        $DB->query('SELECT * FROM Posts WHERE thread_id = :thread_id');
        $DB->bind(':thread_id', $thread_id);
        $posts = $DB->fetchAll();
            
        // List of posts
        $list = [];
        foreach ($posts as $post) {
            $new_post = new Post($DB);
            $new_post->set($post['id'], $post['thread_id'], $post['attachment_id'], $post['body'], $post['created_at'], $post['updated_at']);
            $list[] = $new_post;
        }

        // Close the database connection
        $DB->closeConnection();

        return $list;
    }
}