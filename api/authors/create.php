<?php 
include_once '../../models/Author.php';

// Instantiate author object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$author->author = $data->author;

// Create post
if($author->create()) {
  echo json_encode(
    array('message' => 'Created Author - '. $author->author )
  );
} else {
  echo json_encode(
    array('message' => 'Author Not Created')
  );
}