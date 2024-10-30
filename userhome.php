<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit; // Always exit after a header redirect
}

include "db_connection.php"; // Make sure your connection is included

$query = "SELECT * FROM competitions ORDER BY start_date DESC";
$result = mysqli_query($conn, $query); // Use $conn instead of $data

if (!$result) {
    die("Query Failed: " . mysqli_error($conn)); // Error handling for query
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user_styles.css">
</head>
<body>
    <div class="user-container">
        <header>
            <h1>NUST Competitions</h1>
            <div class="header-info">
                <span class="welcome-msg">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </header>
        <main>
            <h2>Available Competitions</h2>
            <div class="competition-grid">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="competition-card">
                        <?php if (!empty($row['logo_path'])): ?>
                            <img src="<?php echo htmlspecialchars($row['logo_path']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['title']); ?> logo" 
                                 class="competition-logo">
                        <?php else: ?>
                            <div class="competition-logo placeholder">No Logo</div>
                        <?php endif; ?>
                        <div class="competition-details">
                            <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                            <p class="competition-description"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="competition-dates">
                                <span>Start: <?php echo htmlspecialchars($row['start_date']); ?></span>
                                <span>End: <?php echo htmlspecialchars($row['end_date']); ?></span>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </main>
    </div>
</body>
</html>
