<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="css/header.css"> <!-- Adjust path if necessary -->
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="./IMAGES NUST/NUST.png" alt="University Logo">
        </div>
        <nav>
            <ul>
                <li><a class="active" href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="Gallery.html">Gallery</a></li>
                <li><a href="Sponsors.html">Sponsors</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li>
                    <div class="buttons">
                        <?php if (isset($_SESSION["email"])): ?>
                            <a href="#" class="btn btn-danger" onclick="showDeRegisterForm()">DE-REGISTER</a>
                        <?php else: ?>
                            <a href="register.php" class="btn btn-primary">REGISTER NOW</a>
                        <?php endif; ?>
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <?php if (isset($_SESSION["email"])): ?>
                            <a href="logout.php" class="btn btn-secondary">LOGOUT</a> <!-- Logout button -->
                        <?php else: ?>
                            <a href="login.php" class="btn btn-secondary">LOGIN</a> <!-- Login button -->
                        <?php endif; ?>
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <button class="btn btn-info" onclick="showBroadcasts()">Notifications</button>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>
