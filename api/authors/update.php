<?php 
include_once '../../models/Author.php';

// Instantiate blog post object
$author = new Author($db);

// Set ID to update
$author->id = isset($_GET['id']) ? $_GET['id'] : die();
$author->read_single();

// Update post
if($author->update()) {
    echo json_encode(
    array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
    array('message' => 'Post Not Updated')
    );
}