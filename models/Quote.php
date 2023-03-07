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
}