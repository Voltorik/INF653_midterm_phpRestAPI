<?php 
// Instantiate quote object
$quote = new Quote($db);

// Assign given id to proper variable
if (isset($_GET['id'])) {
  $quote->id = $_GET['id'];
} else if (isset($_GET['authorId'], $_GET['categoryId'])) {
  $quote->author_id = $_GET['authorId'];
  $quote->category_id =  $_GET['categoryId'];
} else if (isset($_GET['authorId'])) {
  $quote->author_id = $_GET['authorId'];
} else if (isset($_GET['categoryId'])) {
  $quote->category_id = $_GET['categoryId'];   
} else {
  die();
}

$result = $quote->read_single();

// Get # of quotes
$entries = $result->rowCount();

// Check if any quotes
if ($entries > 0) {
  
  // Post quotes
  $quotes = array();

  while($entries = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($entries);
    
    $quote_item = array(
        'id' => $id,
        'quote' => html_entity_decode($quote),
        'author' => $author,
        'category' => $category
    );

    // Push to quotes array
    array_push($quotes, $quote_item);
  }

  // Turn to JSON & output
  echo json_encode($quotes);
  
} else {
  // If not found output Not Found
  echo json_encode(
  array(
    'message' => 'No Quotes Found'
  ));
}