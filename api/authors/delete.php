<?php 
// Instantiate author object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set id to update
$author->id = $data->id;

// Delete author
if($author->delete()) {
  echo json_encode(
  array(
    'id' => $author->id
  ));
} else {
    echo json_encode(
    array(
      'message' => 'author_id Not Found'
    ));
}