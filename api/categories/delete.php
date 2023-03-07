<?php 
// Instantiate category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$category->id = $data->id;

// Delete post
if($category->delete()) {
  echo json_encode(
  array(
    'id' => $category->id
  ));
} else {
    echo json_encode(
    array(
      'message' => 'category_id Not Found'
    ));
}