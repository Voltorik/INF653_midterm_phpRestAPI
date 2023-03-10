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
    try {
      $stmt->execute();
      
      // Get last inserted id and assign to current author object
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $result['id'];
      
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
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
    try {
      $stmt->execute();
      return $stmt;
      
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  // Get author using given id
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
    try {
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // If id in table, set properties
      if (!empty($result['id'])) {
        $this->id = $result['id'];
        $this->author = $result['author'];
        return true;
      }
      return false;
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  // Update author at given id
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
    try {
      $stmt->execute();
      
      // Get last inserted id
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
      // If id exists in table, return true
      if(!empty($result['id'])) {
        return true;
      } 
      return false;
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    } 
  }
  
  // Delete author at given id
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
    try {
      $stmt->execute();
      
      // Get last inserted id 
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      // If id exists in table, set id 
      if(!empty($result['id'])) {
        $this->id = $result['id'];
        return true;
      } 
      return false;
      
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
}