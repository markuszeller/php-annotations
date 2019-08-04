<?php
require_once '../vendor/autoload.php';
use markuszeller\Annotations\Reader;

// Create a reader and put some data in
$reader = new Reader();

// If you want to pass a string use
$cssString = file_get_contents('./example.css');
$reader->loadFromString($cssString);

// If you want to pass a file
if($reader->loadFromFile("./example.css") === false) {
    exit("Error loading file");
}

// Get all the annotations as an associative array
$annotationArray = $reader->getAnnotations();
var_dump($annotationArray);

// Get a single annotation by name
$title = $reader->getAnnotation('title');
$desc = $reader->getAnnotation('description');
var_dump($title, $desc);
