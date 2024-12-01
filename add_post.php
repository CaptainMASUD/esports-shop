<?php
// Protect the page - restrict access to logged-in admins
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

include 'db.php';
include 'nav.php';

// Handle deletion request
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $delete_sql = "DELETE FROM posts WHERE id = ?";
    
    if ($stmt = $conn->prepare($delete_sql)) {
        $stmt->bind_param('i', $post_id);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success mt-3">Post deleted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger mt-3">Error: ' . $conn->error . '</div>';
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <title>Add Post</title>
    <style>
        /* Valorant-Inspired White Theme */
        :root {
            --valorant-red: #FF4655;
            --valorant-gray: #333F4B;
            --valorant-light: #EAEAEA;
            --valorant-white: #FFFFFF;
            --valorant-light-gray: #F4F4F4;
        }

        body {
            background-color: #0f1923;
            color: #ffffff;
            font-family: "Parkinsans", sans-serif;
        }

        .container {
            max-width: 900px;
        }

        .form-container {
            background-color: #0f1923;
            border : 1px solid var(--valorant-red);
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-container h2 {
            color: var(--valorant-red);
        }

        .btn-primary {
            background-color: var(--valorant-red);
            border: none;
        }

        .btn-primary:hover {
            background-color: #e03e4d;
        }

        .alert {
            border-radius: 10px;
        }

        .post-list {
            margin-top: 2rem;
        }

        .post-card {
            background-color: #0f1923;
            border: 1px solid var(--valorant-red);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .post-card h4 {
            color: var(--valorant-red);
        }

        .post-card i {
            color: var(--valorant-red);
        }

        .post-card p {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Form to Add a Post -->
        <div class="form-container">
            <h2><i class="fas fa-plus-circle"></i> Add New Post</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Post
                </button>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $title = $conn->real_escape_string($_POST['title']);
                $content = $conn->real_escape_string($_POST['content']);

                $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success mt-3">Post added successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3">Error: ' . $conn->error . '</div>';
                }
            }
            ?>
        </div>

        <!-- Display Added Posts -->
        <div class="post-list">
            <h3><i class="fas fa-list"></i> Recently Added Posts</h3>
            <?php
            $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($post = $result->fetch_assoc()) {
                    ?>
                    <div class="post-card">
                        <h4><i class="fas fa-newspaper"></i> <?php echo htmlspecialchars($post['title']); ?></h4>
                        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                        <!-- Delete Button -->
                        <a href="?delete=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="alert alert-info">No posts added yet.</div>';
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
