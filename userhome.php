<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}

include "db_connection.php"; // Database connection
include "header.php"; // Include the header component

// Fetch competitions
$query = "SELECT * FROM competitions ORDER BY start_date DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - NUST Competitions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="user_styles.css">
</head>
<body>
    <main class="container my-4">
        <h2 class="text-nust-blue">Available Competitions</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card competition-card shadow-sm">
                        <?php if (!empty($row['logo_path'])): ?>
                            <img src="<?php echo htmlspecialchars($row['logo_path']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['title']); ?> logo" 
                                 class="card-img-top competition-logo">
                        <?php else: ?>
                            <div class="competition-logo placeholder text-center d-flex align-items-center justify-content-center">
                                <span>No Logo</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h4>
                            <p class="card-text competition-description"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="competition-dates">
                                <span>Start: <?php echo htmlspecialchars($row['start_date']); ?></span><br>
                                <span>End: <?php echo htmlspecialchars($row['end_date']); ?></span>
                            </p>
                            <a href="register.php?competition_id=<?php echo $row['id']; ?>" class="btn btn-primary">Register Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
