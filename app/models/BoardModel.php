<?php
// BoardModel class

class Board {
    private $db;

    public $id;
    public $title;
    public $description;
    public $url;
    public $created_at;
    public $updated_at;

    public function __construct($id, $title, $description, $url, $created_at, $updated_at) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function getAll() {
        // Initialize the database connection
        $DB = new Database();
        // Get all boards
        $DB->query('SELECT * FROM Boards');
        $boards = $DB->fetchAll();

        // List of boards
        $list = [];
        foreach ($boards as $board) {
            $list[] = new Board($board['id'], $board['title'], $board['description'], $board['url'], $board['created_at'], $board['updated_at']);
        }

        // Close the database connection
        $DB->closeConnection();

        return $list;
    }
    
    public static function getByUrl($url) {
        // Initialize the database connection
        $DB = new Database();
        // Get all boards
        $DB->query('SELECT * FROM Boards WHERE url = :url');
        $DB->bind(':url', $url);
        $board = $DB->fetch();

        // Close the database connection
        $DB->closeConnection();

        if ($board == null) {
            return null;
        }

        return new Board($board['id'], $board['title'], $board['description'], $board['url'], $board['created_at'], $board['updated_at']);
    }
}