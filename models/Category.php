<?php
class Category {
  private $conn;
  private $table = 'categories';

  // Category Properties
  public $id;
  public $category;

  public function __construct($db) {
      $this->conn = $db;
  }

  // Create new category
  public function create() {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (category) VALUES (:category) RETURNING id';
    
    // Prepare statment
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
  
    // Bind data
    $stmt->bindParam(':category', $this->category);

    // Execute query
    if($stmt->execute()) {
      // Get last inserted id and assign to current category object
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $result['id'];
      
      return true;
    }

    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Get categories
  public function read() {
      // Create query
      $query = 'SELECT c.id, c.category
      FROM '. $this->table . ' c
      ORDER BY 
          c.id ASC';
      // Prepare statment
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
  }

  // Get category using specified id
  public function read_single() {
    // Create query
    $query = 'SELECT c.id, c.category
      FROM ' . $this->table . ' c
      WHERE c.id = :id';

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
      $this->category = $result['category'];
    }
  }

  // Delete Category
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
      // Get last inserted id and assign to current category object
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result) {
        $this->id = $result['id'];
        return true;
      } else {
        return false;
      }
    }
  }

  // Update Category
  public function update() {
    // Create query
    $query = 'UPDATE ' . $this->table . 
    ' SET category = :category 
      WHERE 
        id = :id RETURNING id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      // Get returned id
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      // If id is set then category id exists
      if(isset($result['id'])) {
        return true;
      } else {
        return false;
      }
    }
  }
}