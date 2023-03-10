<?php 
// Instantiate quote object
$quote = new Quote($db);
$author = new Author($db);
$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check for required params
if(isset($data->quote) and isset($data->author_id) and isset($data->category_id)) {

  // Set quote properties
  $quote->quote = $data->quote;
  $quote->author_id = $data->author_id;
  $quote->category_id = $data->category_id;

  // Set ids to check
  $author->id = $data->author_id;
  $category->id = $data->category_id;

  // Check if ids exist in each table
  if($quote->exists($author, $category)) {
    // Create post
    if($quote->create()) {
      echo json_encode(
        array(
          'id' => $quote->id,
          'quote' => $quote->quote,
          'author_id' => $quote->author_id,
          'category_id' => $quote->category_id
        ));
    } else {
      echo json_encode(
        array('message' => 'Quote Not Created')
      );
    }
  }
  
} else {
  echo json_encode(array(
    'message' => 'Missing Required Parameters'
  ));
}