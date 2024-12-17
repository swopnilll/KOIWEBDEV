<?php

class Book {
    public $title;
    public $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    public function getInfo() {
        return "Title: $this->title, Author: $this->author";
    }
}

class Library {
    public $books = array();

    public function addBook($book) {
        $this->books[] = $book;
    }

    public function displayBooks() {
        if (empty($this->books)) {
            echo "No books in the library.<br>";
        } else {
            foreach ($this->books as $book) {
                echo $book->getInfo() . "<br>";
            }
        }
    }
}

class Member {
    public $name;
    public $membership_type;
    public $borrowed_books = array();

    public function __construct($name, $membership_type) {
        $this->name = $name;
        $this->membership_type = $membership_type;
    }

    public function borrowBook($book, $library) {
        $key = array_search($book, $library->books);
        if ($key !== false) {
            unset($library->books[$key]);
            $this->borrowed_books[] = $book;
            echo "$this->name borrowed $book->title.<br>";
        } else {
            echo "$book->title is not available in the library.<br>";
        }
    }

    public function displayBorrowedBooks() {
        if (empty($this->borrowed_books)) {
            echo "$this->name has not borrowed any books.<br>";
        } else {
            foreach ($this->borrowed_books as $book) {
                echo $book->getInfo() . "<br>";
            }
        }
    }
}

?>
