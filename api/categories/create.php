<?php 
// Instantiate category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params
if(isset($data->category)) {
  $category->category = $data->category;
  
  // Create category
  $category->create();
  echo json_encode(
    array(
      'id' => $category->id,
      'category' => $category->category
    ));
  
} else {
  echo json_encode(array(
    'message' => 'Missing Required Parameters'
  ));
}