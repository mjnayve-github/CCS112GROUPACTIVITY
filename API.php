<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "library_db";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// api for adding book
function addBook($conn)
{
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $publication_year = htmlspecialchars($_POST['publication_year']);
    $genre = htmlspecialchars($_POST['genre']);

    $stmt = $conn->prepare("INSERT INTO books (title, author, publication_year, genre) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $author, $publication_year, $genre);

    if ($stmt->execute()) {
        echo "Book added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// api for updating book
function updateBook($conn)
{
    $id = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $publication_year = htmlspecialchars($_POST['publication_year']);
    $genre = htmlspecialchars($_POST['genre']);

    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, publication_year=?, genre=? WHERE id=?");
    $stmt->bind_param("ssisi", $title, $author, $publication_year, $genre, $id);

    if ($stmt->execute()) {
        echo "Book updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// api for deleting book
function deleteBook($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Book deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle form submissions (add/update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['id'])) {
        updateBook($conn);
    } else {
        addBook($conn);
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteBook($conn, $id);
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['delete'])) {
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<tr data-id='{$row['id']}'>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['publication_year']}</td>
                <td>{$row['genre']}</td>
                <td>
                    <button class='editBtn'>Edit</button>
                    <button class='deleteBtn' onclick='confirmDelete({$row['id']})'>Delete</button>
                </td>
            </tr>";
        }

    }
}

$conn->close();