<?php 
include 'lib\admin_functions\file_reading_functions_admin.php';
include 'lib\admin_functions\file_writing_functions_admin.php';
include 'lib\admin_functions\file_creating_functions.php';
include 'lib\admin_functions\file_editing_functions.php';

// Variables to hold book data
$book_title = '';
$book_author = '';
$book_year = '';
$book_description = '';

// Check if the book title is passed via the query string
if (isset($_GET['book_title'])) {
    $book_title = urldecode($_GET['book_title']); // Decode the book title from the URL

    // Read the book list from the JSON file
    $file_path = 'data/book_list.json';
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $book_list = json_decode($json_data, true);

        // Search for the book by title
        foreach ($book_list as $book) {
            if (strcasecmp($book['title'], $book_title) == 0) {
                // Book found, populate the form fields
                $book_author = $book['author'];
                $book_year = $book['year'];
                $book_description = $book['description'];
                break;
            }
        }
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $new_book_title = $_POST['book_title'];
    $new_book_author = $_POST['book_author'];
    $new_book_year = $_POST['book_year'];
    $new_book_description = $_POST['book_description'];

    // Call the edit_book function to save the updated book information
    edit_book(urldecode($_GET['book_title']), $new_book_title, $new_book_author, $new_book_year, $new_book_description);

    // Redirect back to a confirmation or main page after submission
    header('Location: admin_page.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Book</title>
        <link href="bootstrap_resources/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">BookBound</a>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!--acts as a spacer for the sign in/sign out menu-->
                <div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class=" sb-sidenav-menu">
                        <div class="nav sticky-top">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Books & Clubs
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Create Book
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Create Club
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">My Books</a>
                                    <a class="nav-link" href="">My Clubs</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Username
                    </div>
                </nav>
            </div>
            <div>
            <main>
            <div class="container mx-auto">
                <h2 class="mt-3 text-center">Edit Book</h2>
                <form method="post">
                    <!-- Book Title Input -->
                    <div class="mb-3">
                        <label for="bookTitle" class="form-label">Book Title</label>
                        <input type="text" class="form-control" id="bookTitle" name="book_title" value="<?php echo htmlspecialchars($book_title); ?>" required>
                    </div>
                    <!-- Author Input -->
                    <div class="mb-3">
                        <label for="bookAuthor" class="form-label">Author</label>
                        <input type="text" class="form-control" id="bookAuthor" name="book_author" value="<?php echo htmlspecialchars($book_author); ?>" required>
                    </div>
                    <!-- Year Input -->
                    <div class="mb-3">
                        <label for="yearPublished" class="form-label">Year</label>
                        <input type="number" class="form-control" id="yearPublished" name="book_year" min="1000" max="2099" value="<?php echo htmlspecialchars($book_year); ?>" required>
                    </div>
                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="bookDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="bookDescription" name="book_description" rows="3" required><?php echo htmlspecialchars($book_description); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>