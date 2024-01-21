<?php
// BoardModel class

namespace App\Models;

use App\Core\Database;

class Board {
    private $DB;

    public $id;
    public $title;
    public $description;
    public $url;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->DB = $db;
    }

    // Set the board data
    public function set($id, $title, $description, $url, $created_at, $updated_at) {
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
            $new_board = new Board($DB);
            $new_board->set($board['id'], $board['title'], $board['description'], $board['url'], $board['created_at'], $board['updated_at']);
            $list[] = $new_board;
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

        $new_board = new Board($DB);
        $new_board->set($board['id'], $board['title'], $board['description'], $board['url'], $board['created_at'], $board['updated_at']);

        return $new_board;
    }


}