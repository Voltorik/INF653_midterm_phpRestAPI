<?php
class Quote {
  private $conn;
  private $table = 'quotes';

  // Quote Properties
  public $id;
  public $quote;
  public $author_id;
  public $category_id;

  public function __construct($db) {
      $this->conn = $db;
  }

  public function exists($author, $category) {
    $author->read_single();
    $category->read_single();

    if ($author->author == null) {
      // If not found output Not Found
      echo json_encode(array(
      'message' => 'author_id Not Found'
      ));
      return false;
    } else if ($category->category == null) {
      // If not found output Not Found
      echo json_encode(array(
        'message' => 'category_id Not Found'
      ));
      return false;
    }
    return true;
  }
  
  // Create quote
  public function create(){
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id) RETURNING id';
    
    // Prepare statment
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->author_id = htmlspecialchars(strip_tags($this->author_id));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
  
    // Bind data
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':author_id', $this->author_id);
    $stmt->bindParam(':category_id', $this->category_id);

    try {
      // Execute query
      $stmt->execute();
      
      // Get last inserted id and assign to current quote object
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $result['id'];

    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
}