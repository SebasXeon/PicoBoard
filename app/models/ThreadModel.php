<?php
// ThreadModel class

class Thread {
    private $DB;

    public $id;
    public $board_id;
    public $title;
    public $created_at;
    public $updated_at;
    public $posts = [];

    public function __construct($db) {
        $this->DB = $db;
    }

    // Set the thread data
    public function set($id, $board_id, $title, $created_at, $updated_at) {
        $this->id = $id;
        $this->board_id = $board_id;
        $this->title = $title;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Create a new thread 
    public function create($board_id, $title) {
        // Create a new thread
        $this->DB->query('INSERT INTO Threads (board_id, title, created_at, updated_at) VALUES (:board_id, :title, :created_at, :updated_at )');
        $this->DB->bind(':board_id', $board_id);
        $this->DB->bind(':title', $title);
        $this->DB->bind(':created_at', date('Y-m-d H:i:s'));
        $this->DB->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->DB->execute();
        // Retrieve the thread data
        $this->set($this->DB->lastInsertId(), $board_id, $title, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
    }

    // Update the thread
    public function update() {
        // Update the thread
        $this->DB->query('UPDATE Threads SET title = :title, updated_at = :updated_at WHERE id = :id');
        $this->DB->bind(':id', $this->id);
        $this->DB->bind(':title', $this->title);
        $this->DB->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->DB->execute();
        // Retrieve the thread data
        $this->set($this->id, $this->board_id, $this->title, $this->created_at, date('Y-m-d H:i:s'));
    }

    // Get all threads from a board
    public static function getFromBoard($board_id) {
        // Initialize the database connection
        $DB = new Database();
        // Get all threads
        $DB->query('SELECT * FROM Threads WHERE board_id = :board_id');
        $DB->bind(':board_id', $board_id);
        $threads = $DB->fetchAll();
            
        // List of threads
        $list = [];
        foreach ($threads as $thread) {
            $new_thread = new Thread($DB);
            $new_thread->set($thread['id'], $thread['board_id'], $thread['title'], $thread['created_at'], $thread['updated_at']);
            $list[] = $new_thread;
        }

        // Close the database connection
        $DB->closeConnection();

        return $list;
    }

    // Get recent threads from a board
    public static function getRecentFromBoard($board_id, $page, $limit = 10) {
        // Initialize the database connection
        $DB = new Database();
        // Get recent threads
        $DB->query('SELECT * FROM Threads WHERE board_id = :board_id ORDER BY updated_at DESC LIMIT :limit OFFSET :offset');
        $DB->bind(':board_id', $board_id);
        $DB->bind(':limit', $limit);
        $DB->bind(':offset', ($page - 1) * $limit);
        $threads = $DB->fetchAll();
            
        // List of threads
        $list = [];
        foreach ($threads as $thread) {
            $new_thread = new Thread($DB);
            $new_thread->set($thread['id'], $thread['board_id'], $thread['title'], $thread['created_at'], $thread['updated_at']);
            $list[] = $new_thread;
        }

        // Close the database connection
        $DB->closeConnection();

        return $list;
    }
}