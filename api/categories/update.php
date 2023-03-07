<?php 
// Instantiate category object
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params 
if(isset($data->category) and isset($data->id)) {
  
  // Set id to update
  $category->id = $data->id;
  $category->category = $data->category;
  
  // Update category
  if($category->update()) {
      echo json_encode(
      array(
        'id' => $category->id,
        'category' => $category->category
      ));
    // If id not found
  } else {
      echo json_encode(
      array(
        'message' => 'category_id Not Found'
      ));
    }
  // If missing params
} else {
  echo json_encode(
    array(
      'message' => 'Missing Required Parameters'
    ));
}