<?php
    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once 'config\Database.php';
    include_once 'models\Author.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

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
        $authors_arr['data'] = array();

        while($entries = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($result);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            // Push to "data"
            array_push($authors_arr['data'], $author_item);
        }

        // Turn to JSON & output
        echo json_encode($authors_arr);
    } else {
        // No authors found
        echo json_encode(array('message' => 'No Authors Found'));
    }
