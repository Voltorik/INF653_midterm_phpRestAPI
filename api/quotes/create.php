<?php 
// Instantiate quote object
$quote = new Quote($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params
if(isset($data->quote) and isset($data->author_id) and isset($data->category_id)) {
  
  // Set quote properties
  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;

  // Check if ids exist in each table
  if(!existsInTable($data->author_id, new Author($db))) {
    // If not found output Not Found
    echo json_encode(
    array(
      'message' => 'author_id Not Found'
    ));
  } else if (!existsInTable($data->category_id, new Category($db))) {
    // If not found output Not Found
    echo json_encode(
    array(
      'message' => 'category_id Not Found'
    ));
  } else {
    // Create post
    $quote->create();
    echo json_encode(
    array(
      'id' => $quote->id,
      'quote' => $quote->quote,
      'author_id' => $quote->author_id,
      'category_id' => $quote->category_id
    ));
  }
  
} else {
  echo json_encode(array(
    'message' => 'Missing Required Parameters'
  ));
}