<nav class="navbar navbar-expand-lg" style="background-color: #0f1923;">
  <div class="container">
    <a class="navbar-brand" href="index.php" style="color: #ff4655; font-weight: bold;">SB Game Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(93deg) brightness(103%) contrast(103%);"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php" style="color: #ffffff;">Home</a>
        </li>
        <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
          <li class="nav-item">
            <a class="nav-link" href="add_game.php" style="color: #ffffff;">Add Game</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_post.php" style="color: #ffffff;">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_dashboard.php" style="color: #ffffff;">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: #ffffff;">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="admin_login.php" style="color: #ffffff;">Admin Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
