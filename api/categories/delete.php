<?php 
// Instantiate category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params
if (isset($data->id)) {
  // Set id to delete
  $category->id = $data->id;
  
  // Delete author
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
} else {
  echo json_encode(
  array(
    'message' => 'Missing Required Parameters'
  ));
}