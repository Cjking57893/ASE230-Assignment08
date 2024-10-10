<?php

function delete_book($book_title) {
    // Reading the JSON file
    $filePath = '../../data/book_list.json';
    $jsonData = file_get_contents($filePath);

    // Decoding JSON file into PHP array
    $bookArray = json_decode($jsonData, true);

    // Check if JSON decoding was successful
    if ($bookArray === null) {
        die('Error decoding JSON');
    }

    // Finding and deleting book object with specified title
    foreach($bookArray as $key => $book) {
        if (isset($book['title']) && $book['title'] === $book_title) {
            // Removing book from array
            unset($bookArray[$key]);
            break; // Exiting loop after finding the book
        }
    }

    // Re-encoding array back into JSON
    $newJsonData = json_encode(array_values($bookArray), JSON_PRETTY_PRINT);

    // Saving updated JSON back into the file
    file_put_contents($filePath, $newJsonData);

}
