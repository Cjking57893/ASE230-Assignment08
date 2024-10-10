<?php

function create_book($book_title, $book_author, $book_year, $book_description) {
    // Reading the JSON file
    $filePath = 'data/book_list.json';
    $jsonData = file_get_contents($filePath);

    // Decoding JSON file into PHP array
    $bookArray = json_decode($jsonData, true);

    // Check if JSON decoding was successful
    if ($bookArray === null) {
        die('Error decoding JSON');
    }

    // Creating a new book object with the given parameters
    $newBook = array(
        'title' => $book_title,
        'author' => $book_author,
        'year' => $book_year,
        'description' => $book_description
    );

    $bookArray[] = $newBook;

    // Re-encoding array back into JSON
    $newJsonData = json_encode(array_values($bookArray), JSON_PRETTY_PRINT);

    // Saving updated JSON back into the file
    file_put_contents($filePath, $newJsonData);

}