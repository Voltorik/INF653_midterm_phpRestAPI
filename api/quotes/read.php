<?php
// Instantiate quote object
$quote = new Quote($db);

// Get quotes
$result = $quote->read();

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
  // No quotes found
  echo json_encode(array('message' => 'No Quotes Found'));
}