<?php
include 'db.php';
include 'nav.php';

// Get the game ID from the URL
if (isset($_GET['id'])) {
    $game_id = intval($_GET['id']);

    // Fetch game details
    $sql = "SELECT * FROM games WHERE id = $game_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $game = $result->fetch_assoc();
    } else {
        echo '<div style="background-color: #0f1923; color: #ffffff; border: 1px solid #ff4655; padding: 15px; margin: 10px 0; border-radius: 5px; text-align: center;">Game not found.</div>';
        exit;
    }
} else {
    echo '<div style="background-color: #0f1923; color: #ffffff; border: 1px solid #ff4655; padding: 15px; margin: 10px 0; border-radius: 5px; text-align: center;">Invalid game selection.</div>';
    exit;
}

// Handle purchase submission
if (isset($_POST['purchase'])) {
    $quantity = intval($_POST['quantity']);
    $total_price = $quantity * $game['price'];

    // Insert purchase into the database
    $sql = "INSERT INTO purchases (game_id, quantity, total_price) VALUES ($game_id, $quantity, $total_price)";
    if ($conn->query($sql) === TRUE) {
        echo '<div style="background-color: #0f1923; color: #ffffff; border: 1px solid #ff4655; padding: 15px; margin: 10px 0; border-radius: 5px; text-align: center;">Purchase successful!</div>';
    } else {
        echo '<div style="background-color: #0f1923; color: #ffffff; border: 1px solid #ff4655; padding: 15px; margin: 10px 0; border-radius: 5px; text-align: center;">Error: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <title>Purchase Game</title>
    <style>
        body {
            background-color: #0f1923;
            color: #ffffff;
            font-family: "Parkinsans", sans-serif;
        }
        .card {
            background-color: #1a2330;
            border: 1px solid #ff4655;
        }
        .btn-primary {
            background-color: #ff4655;
            border-color: #ff4655;
        }
        .btn-primary:hover {
            background-color: #ff6475;
            border-color: #ff6475;
        }
        .form-control {
            background-color: #1a2330;
            color: #ffffff;
            border: 1px solid #ff4655;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center" style="color: #ff4655;">Purchase Game</h2>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title" style="color: #ff4655;"><?php echo $game['name']; ?></h5>
                <p class="card-text" style="color: #a8b3cf;"><?php echo $game['description']; ?></p>
                <p class="card-text" style="color: #ffffff;"><strong>Price: $<?php echo number_format($game['price'], 2); ?></strong></p>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="quantity" class="form-label" style="color: #a8b3cf;">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                    </div>
                    <button type="submit" name="purchase" class="btn btn-primary">Confirm Purchase</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
