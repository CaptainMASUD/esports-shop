<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

include 'db.php';
include 'nav.php'; // Keeping the original navbar

// Handle search functionality
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
}

// Fetch total earnings
$sql = "SELECT SUM(total_price) AS total_earnings FROM purchases";
$result = $conn->query($sql);
$total_earnings = $result->fetch_assoc()['total_earnings'] ?? 0;

// Fetch total items sold
$sql = "SELECT SUM(quantity) AS total_items_sold FROM purchases";
$result = $conn->query($sql);
$total_items_sold = $result->fetch_assoc()['total_items_sold'] ?? 0;

// Fetch purchase history with optional search filter
$sql = "SELECT p.id, g.name, p.quantity, p.total_price, p.purchased_at 
        FROM purchases p 
        JOIN games g ON p.game_id = g.id 
        WHERE g.name LIKE '%$search_query%' 
        ORDER BY p.purchased_at DESC";
$purchase_history = $conn->query($sql);

// Handle delete functionality
if (isset($_GET['delete'])) {
    $purchase_id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM purchases WHERE id = $purchase_id";
    if ($conn->query($delete_sql) === TRUE) {
        header('Location: admin_dashboard.php'); // Reload the page after deletion
        exit;
    } else {
        echo '<div class="alert alert-danger text-center mt-4">Error deleting purchase.</div>';
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
    <title>Admin Dashboard</title>
    <style>
        /* Valorant Red and Black Theme */
        :root {
            --valorant-red: #FF4655;
            --dark-bg: #121212;
            --black: #000000;
            --light-gray: #333333;
            --white: #FFFFFF;
        }

        body {
            background-color: #0f1923;
            color: #ffffff;
            font-family: "Parkinsans", sans-serif;
        }

        .dashboard-header {
            background-color: #0f1923;
            border: 1px solid var(--valorant-red);
            color: var(--white);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h2 {
            color: var(--valorant-red);
        }

        .card-summary {
            background-color: #0f1923;
            border: 1px solid var(--valorant-red);
            color: var(--white);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-radius: 15px;
        }

        .card-summary:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background: var(--valorant-red);
            border: none;
        }

        .btn-primary:hover {
            background: #e03e4d;
        }

        .btn-delete {
            background: var(--valorant-red);
            color: var(--white);
            border: none;
            transition: transform 0.2s ease, background 0.3s ease;
        }

        .btn-delete:hover {
            background: #e03e4d;
            transform: scale(1.05);
        }

        .search-box input {
            background: var(--dark-bg);
            color: var(--white);
            border: 1px solid var(--light-gray);
        }

        .search-box button {
            background: var(--valorant-red);
            color: var(--white);
            border: none;
        }

        table {
            background: var(--dark-bg);
            color: var(--white);
        }

        .purchase-history th {
            background-color: var(--valorant-red);
            color: var(--white);
        }

        .purchase-history td {
            text-align: center;
            background-color: #0f1923;
            color: var(--white);
        }
        .in{
            color: var(--valorant-red);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Header Section -->
        <div class="dashboard-header">
            <h2><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>
            <p>Manage purchases, view analytics, and add new content.</p>
        </div>

        <!-- Summary Cards -->
        <div class="row text-center mb-5">
            <div class="col-md-6">
                <div class="card card-summary p-3">
                    <h5><i class="fas fa-dollar-sign in"></i> Total Earnings</h5>
                    <p class="fs-4 fw-bold in">$<?php echo number_format($total_earnings, 2); ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-summary p-3">
                    <h5><i class="fas fa-shopping-cart in"></i> Total Items Sold</h5>
                    <p class="fs-4 fw-bold in"><?php echo $total_items_sold; ?></p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="" class="search-box mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by game name" value="<?php echo htmlspecialchars($search_query); ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>

        <!-- Purchase History -->
        <h3><i class="fas fa-history"></i> Purchase History</h3>
        <table class="table table-striped purchase-history">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Game</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Purchased At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($purchase_history->num_rows > 0): ?>
                    <?php while ($row = $purchase_history->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                            <td><?php echo $row['purchased_at']; ?></td>
                            <td>
                                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>" 
                                   class="btn btn-delete btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this purchase?')">
                                   <i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No purchases found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
