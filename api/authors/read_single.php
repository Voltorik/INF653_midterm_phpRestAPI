<?php 
// Instantiate author object
$author = new Author($db);

// Assign given id to author_id
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

if (existsInTable($author->id, $author)) {
  // Get author using given id
  $author->read_single();
}

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
  
