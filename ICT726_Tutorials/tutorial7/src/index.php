<?php
// Include the file containing all the classes
include 'exercise6.php';

// Create a few books with famous tech people's names as authors
$book1 = new Book("Full Stack Development with JavaScript", "Elon Musk");
$book2 = new Book("Mastering Web Development", "Bill Gates");
$book3 = new Book("The Art of Full Stack Engineering", "Sundar Pichai");

// Create a library and add books to it
$library = new Library();
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Display all books in the library
echo "<h3>Books in Library:</h3>";
$library->displayBooks();

// Create members
$member1 = new Member("Mark Zuckerberg", "Premium");
$member2 = new Member("Satya Nadella", "Standard");

// Members borrow books
echo "<br>";
$member1->borrowBook($book1, $library);
$member2->borrowBook($book2, $library);
$member2->borrowBook($book3, $library);

// Display borrowed books for each member
echo "<br><h3>Borrowed Books:</h3>";
$member1->displayBorrowedBooks();
echo "<br>";
$member2->displayBorrowedBooks();
?>
