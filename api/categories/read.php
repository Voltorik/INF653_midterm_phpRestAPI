<?php
// Instantiate category object
$category = new Category($db);

// Get category
$result = $category->read();

// Get # of categories
$entries = $result->rowCount();

// Check if any categories
if ($entries > 0) {
    // Post categories
    $categories = array();

    while($entries = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($entries);

        $category_item = array(
            'id' => $id,
            'category' => $category
        );

        // Push to array
        array_push($categories, $category_item);
    }

    // Turn to JSON & output
    echo json_encode($categories);
} else {
    // No categories found
    echo json_encode(array('message' => 'No Categories Found'));
}