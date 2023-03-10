<?php
// Instantiate author object
$author = new Author($db);

// Get authors
$result = $author->read();

// Get # of authors
$entries = $result->rowCount();

// Check if any authors
if ($entries > 0) {
  
  // Post authors
  $authors_arr = array();

  while($entries = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($entries);

    $author_item = array(
        'id' => $id,
        'author' => $author
    );

    // Push to authors array
    array_push($authors_arr, $author_item);
  }

  // Turn to JSON & output
  echo json_encode($authors_arr);
  
} else {
  // No authors found
  echo json_encode(array('message' => 'No Authors Found'));
}
