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
            a.id ASC';
        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get author using specified id
    public function read_single() {
      // Create query
      $query = 'SELECT a.id, a.author
        FROM ' . $this->table . ' a
        WHERE a.id = ?';
  
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);
  
      // Execute query
      $stmt->execute();
  
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
      // Set properties
      $this->id = $result['id'];
      $this->author = $result['author'];
    }
}