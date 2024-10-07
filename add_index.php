<?php include 'api.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Library Management System</h1>

        <!-- Add or Edit Book Form -->
        <div class="form-section">
            <h2 id="formTitle">Add New Book</h2>
            <form id="addBookForm" method="POST">
                <input type="text" name="title" placeholder="Title" required>
                <input type="text" name="author" placeholder="Author" required>
                <input type="number" name="publication_year" placeholder="Publication Year" required>
                <input type="text" name="genre" placeholder="Genre" required>
                <input type="hidden" name="id" id="bookId">
                <button type="submit" id="formButton">Add Book</button>
            </form>
        </div>

        <!-- Modal for Edit Book -->
        <div id="editBookModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close"></span>
                <h2>Edit Book</h2>
                <form id="editBookForm">
                    <input type="text" name="title" id="editTitle" placeholder="Title" required>
                    <input type="text" name="author" id="editAuthor" placeholder="Author" required>
                    <input type="number" name="publication_year" id="editPublicationYear" placeholder="Publication Year"
                        required>
                    <input type="text" name="genre" id="editGenre" placeholder="Genre" required>
                    <input type="hidden" name="id" id="editBookId">
                    <button type="submit">Update Book</button>
                </form>
            </div>
        </div>

        <!-- Book List -->
        <div class="book-list">
            <h2>Book List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publication Year</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>   
                </thead>
                <tbody id="bookList">
                   
                </tbody>
            </table>
        </div>
    </div>

    <script src="test.js"></script>
</body>

</html>