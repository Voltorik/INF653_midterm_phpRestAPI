<?php 
// Instantiate author object
$author = new Author($db);

// Assign given id to author_id
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Check if author was found
if ($author->read_single()) {
  // If found output id and author
  echo json_encode(
  array(
    'id' => $author->id,
    'author' => $author->author
  ));
} else {
  // If not found output Not Found
  echo json_encode(
  array(
    'message' => 'author_id Not Found'
  ));
}
