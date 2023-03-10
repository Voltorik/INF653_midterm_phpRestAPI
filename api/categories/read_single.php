<?php 
// Instantiate category object
$category = new Category($db);

// Assign given ID to author id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get category using given id
$category->read_single();

// Check if category was found
if ($category->category == null) {
  // If not found output Not Found
  echo json_encode(array(
    'message' => 'category_id Not Found'
  ));
} else {
  // If found output id and author
  echo json_encode(
  array(
    'id' => $category->id,
    'category' => $category->category
  ));
}