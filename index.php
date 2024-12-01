<?php include 'db.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <title>Game Store</title>
    <style>
        /* Dark Valorant-Inspired Theme */
        :root {
            --valorant-dark: #1A1A1A; /* Dark background */
            --valorant-gray: #333F4B; /* Dark gray for text */
            --valorant-red: #FF4655; /* Valorant red */
            --valorant-light-gray: #EAEAEA; /* Light gray accents */
            --valorant-white: #FFFFFF; /* White for text and buttons */
        }

        body {
            background-color: #0f1923;
            color: #ffffff;
            font-family: "Parkinsans", sans-serif;
        }

        .container {
            max-width: 1200px;
        }

        .gradient-bg {
            background: linear-gradient(90deg, #FF4655, #FF7E5F);
            color: #ffffff;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 2rem;
        }

        .carousel-item img {
            height: 400px;
            width: 100%;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 1rem;
            border-radius: 8px;
        }

        .card {
            border: 1px solid var(--valorant-red);
            border-top: 3px solid transparent;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            margin-bottom: 2rem;
            background-color: #0f1923;
            color: #ffffff;

        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
            border-top-color: var(--valorant-red);
        }

        .btn-custom {
            background-color: var(--valorant-red);
            color: var(--valorant-white);
            border: none;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            border-radius: 20px;
        }

        .btn-custom:hover {
            background-color: #e03e4d;
            transform: scale(1.05);
        }

        .btn-info {
            background-color: var(--valorant-red);
            color: var(--valorant-white);
            border: none;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 20px;
        }

        .btn-info:hover {
            background-color: #e03e4d;
            transform: scale(1.05);
        }

        .badge-custom {
            background: var(--valorant-red);
            color: var(--valorant-white);
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            border-radius: 20px;
        }

        .post-card {
            background-color:  background-color: #0f1923;; /* Dark background for post cards */
            border: 1px solid  var(--valorant-red);;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            margin-bottom: 2rem;
            padding: 1.5rem;
        }

        .post-card h5 {
            color: var(--valorant-red);
        }

        .post-card p {
            color: var(--valorant-light-gray);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gradient-bg {
                font-size: 1.2rem;
                padding: 1rem;
            }

            .card-title {
                font-size: 1rem;
            }

            .btn-custom {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Carousel -->
    <div id="carouselExample" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://i.ytimg.com/vi/AcADYKT4O78/maxresdefault.jpg" class="d-block w-100" alt="Game 1">
                <div class="carousel-caption d-none d-md-block">
                    <h2><i class="fas fa-gamepad"></i> Game Store</h2>
                    <p>Discover the best games and exclusive deals!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://static1.squarespace.com/static/5ccb12039b8fe875b08fae37/t/5f6274abd7434f2d80fc01a9/1600287921434/hitherto-board-games.jpg?format=1500w" class="d-block w-100" alt="Game 1">
                <div class="carousel-caption d-none d-md-block">
                    <h2><i class="fas fa-gamepad"></i> Game Store</h2>
                    <p>Discover the best games and exclusive deals!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn.sanity.io/images/dsfx7636/news_live/a9118d1f77e9f5fd0c292a0c7c4fb860e25af23e-1920x1080.jpg" class="d-block w-100" alt="Game 2">
                <div class="carousel-caption d-none d-md-block">
                    <h2><i class="fas fa-newspaper"></i> Exciting Posts</h2>
                    <p>Stay updated with the latest gaming news and reviews.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
      
        <!-- Games Section -->
        <div class="gradient-bg">
            <h2><i class="fas fa-gamepad"></i> Available Games</h2>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM games";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Determine the image URL based on the game name
                    $image_url = 'https://via.placeholder.com/350x200';

                    if (stripos($row['name'], 'Valorant') !== false) {
                        $image_url = 'https://i.ytimg.com/vi/xi10SuaE49I/maxresdefault.jpg';
                    } elseif (stripos($row['name'], 'GTA 5') !== false) {
                        $image_url = 'https://sm.pcmag.com/pcmag_me/news/s/sony-confi/sony-confirms-gta-v-is-4k60fps-on-ps5_mvu1.jpg';
                    } elseif (stripos($row['name'], 'COD Warzone') !== false || stripos($row['name'], 'COD') !== false) {
                        $image_url = 'https://wallpapers.com/images/featured/call-of-duty-warzone-4k-kzetz7h7t75073ye.jpg';
                    } elseif (stripos($row['name'], 'NFSMW') !== false) {
                        $image_url = 'https://c4.wallpaperflare.com/wallpaper/551/273/298/bmw-m3-gtr-need-for-speed-most-wanted-need-for-speed-most-wanted-2012-video-game-car-street-racing-hd-wallpaper-preview.jpg';
                    }

                    echo '
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="' . $image_url . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                                <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                                <p class="card-text"><strong>$' . number_format($row['price'], 2) . '</strong></p>
                                <a href="purchase.php?id=' . intval($row['id']) . '" class="btn btn-custom"><i class="fas fa-cart-plus"></i> Buy Now</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No games available.</p>';
            }
            ?>
        </div>

        <!-- Posts Section -->
        <div class="gradient-bg">
            <h2><i class="fas fa-newspaper"></i> Latest Posts</h2>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM posts ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4">
                        <div class="post-card">
                            <div class="card-body text-center">
                                <h5 class="card-title"><i class="fas fa-pen"></i> ' . $row['title'] . '</h5>
                                <p class="card-text">' . substr($row['content'], 0, 100) . '...</p>
                                <p class="card-text"><small><i class="fas fa-calendar-alt"></i> ' . $row['created_at'] . '</small></p>
                                <a href="#" class="btn btn-info"><i class="fas fa-book-open"></i> Read More</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No posts available.</p>';
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
