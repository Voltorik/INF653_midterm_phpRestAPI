<?php 
include_once ('../../models/Author.php');

// Instantiate author object
$author = new Author($db);

// Assign given ID to author id
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author using given id
$author->read_single();

// Check if author was found
if ($author->author == null) {
  // If not found output Not Found
  echo json_encode(array(
    'message' => 'author_id Not Found'
  ));
} else {
  // If found output id and author
  echo json_encode(
  array(
    'id' => $author->id,
    'author' => $author->author
  ));
}
  
