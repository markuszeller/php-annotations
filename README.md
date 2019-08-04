# php-annotations
This class helps reading annotations.

![PHP from Packagist](https://img.shields.io/packagist/php-v/markuszeller/php-annotations/v1.0.0.svg)
![Install with Composer)](https://img.shields.io/badge/composer-markuszeller%2Fphp--annotations-blue.svg)

## Features

- reads from a string
- reads from a file
- supports multiline annotation values
- auto trims values

## Note
Reads only annotations from DocComments included in `/** [...] */`.

Look into that **double asterisk**.

## Usage

Initialise an Annotation object

    require_once '../vendor/autoload.php';
    use markuszeller\Annotations\Reader;

    $reader = new Reader();

Put some data into the annotation reader instance

* by a string

        $cssString = file_get_contents('./template.css');
        $reader->loadFromString($cssString);

* by file

        if($reader->loadFromFile("./example.css") === false) {
            exit("Error loading file");
        }


Get all the annotations as an associative array
    
    $annotationArray = $reader->getAnnotations();

Get a single annotation by name

    $title = $reader->getAnnotation('title');
