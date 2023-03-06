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
      WHERE a.id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(':id', $this->id);

    // Execute query
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If result is not null
    if ($result) {
      // Set properties
      $this->id = $result['id'];
      $this->author = $result['author'];
    }
  }

  // Create new author
  public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (author) VALUES (:author) RETURNING id';
    
    // Prepare statment
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->author = htmlspecialchars(strip_tags($this->author));
  
    // Bind data
    $stmt->bindParam(':author', $this->author);

    // Execute query
    if($stmt->execute()) {
      // Get last inserted id and assign to current author object
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $result['id'];
      
      return true;
    }

    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Delete Author
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id RETURNING id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    //Execute query
    if($stmt->execute()) {
      // Get last inserted id and assign to current author object
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result) {
        $this->id = $result['id'];
        return true;
      } else {
        return false;
      }
    }
  }

  public function update() {
    // Create query
    $query = 'UPDATE ' . $this->table . 
    ' SET author = :author 
      WHERE 
        id = :id RETURNING id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':author', $this->author);
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      // Get returned id
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      // If id is set then author id exists
      if(isset($result['id'])) {
        return true;
      } else {
        return false;
      }
    }
  }
}