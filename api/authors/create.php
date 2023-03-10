<?php 
// Instantiate author object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params
if(isset($data->author)) {
  $author->author = $data->author;
  
  // Create author
  $author->create();
  echo json_encode(
    array(
      'id' => $author->id,
      'author' => $author->author
    ));
  
} else {
  echo json_encode(array(
    'message' => 'Missing Required Parameters'
  ));
}

