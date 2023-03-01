<?php
class Author {
    private $conn;
    private $table = 'authors';

    // Author Properties
    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get authors
    public function read() {
        // Create query
        $query = 'SELECT a.id, a.author
        FROM '. $this->table . ' a
        ORDER BY 
            a.author ASC';
        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

}