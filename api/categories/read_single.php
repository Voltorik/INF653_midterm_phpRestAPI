<?php 
// Instantiate category object
$category = new Category($db);

// Assign given id to category id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Check if category was found
if ($category->read_single()) {
  // If found output id and category
  echo json_encode(
  array(
    'id' => $category->id,
    'category' => $category->category
  ));
} else {
  // If not found output Not Found
  echo json_encode(
  array(
    'message' => 'category_id Not Found'
  ));
}