<?php

class Book {
    private $title;
    private $author;
    private $year;

    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    public function getDetails() {
        return "Title: " . $this->title . " | Author: " . $this->author . " | Year: " . $this->year;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setYear($year) {
        $this->year = $year;
    }
}

$myBook = new Book("The Great Gatsby", "F. Scott Fitzgerald", 1925);

echo "Original Book Details:<br>";
echo $myBook->getDetails();

echo "<br><br>";

$myBook->setTitle("1984");
$myBook->setAuthor("George Orwell");
$myBook->setYear(1949);

echo "Updated Book Details:<br>";
echo $myBook->getDetails();

?>
