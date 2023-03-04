<?php 
include_once '../../models/Author.php';

// Instantiate blog post object
$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Delete post
if($author->delete()) {
    echo json_encode(
    array('message' => 'Deleted Author id: '. $author->id)
    );
} else {
    echo json_encode(
    array('message' => 'Author Not Deleted')
    );
}