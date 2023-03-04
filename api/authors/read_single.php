<?php 
include_once ('../../models/Author.php');

// Instantiate blog post object
$author = new Author($db);

// Get ID
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post 
$author->read_single();

if ($author->author == null) {
  echo json_encode(array(
    'message' =>'author_id ' . $_GET['id'] . ' Not Found'
  ));
} else {
  // Make JSON
  echo json_encode(
  array(
    'id' => $author->id,
    'author' => $author->author
  ));
}
  
