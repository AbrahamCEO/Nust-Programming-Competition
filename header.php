<?php
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}
?>

<header class="bg-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo Placeholder -->
        <div class="d-flex align-items-center">
            <div class="logo-placeholder mr-3" style="width: 50px; height: 50px; background-color: gray; text-align: center; color: white; font-weight: bold;">
                Logo
            </div>
            <h1 class="h4 mb-0 text-dark">NUST Competitions</h1>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link text-dark" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="schedule.php">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="speakers.php">Speakers</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="sponsors.php">Sponsors</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="faq.php">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </nav>

        <!-- Register Online Button and User Info -->
        <div class="header-info d-flex align-items-center">
            <a href="register.php" class="btn btn-primary text-white mr-3 w-50" style="border-radius: 20px; padding: 3px 10px; font-size: 13px">Register Online</a>
            <span class="welcome-msg text-dark">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            <a href="logout.php" class="btn btn-danger ml-3">Logout</a>
        </div>
    </div>
</header>
