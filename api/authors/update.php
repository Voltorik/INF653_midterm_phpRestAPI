<?php 
// Instantiate author object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params 
if(isset($data->author) and isset($data->id)) {
  
  // Set id to update
  $author->id = $data->id;
  $author->author = $data->author;
  
  // Update post
  if($author->update()) {
      echo json_encode(
      array(
        'id' => $author->id,
        'author' => $author->author
      ));
    // If id not found
  } else {
      echo json_encode(
      array(
        'message' => 'author_id Not Found'
      ));
    }
  // If missing params
} else {
  echo json_encode(
    array(
      'message' => 'Missing Required Parameters'
    ));
}

