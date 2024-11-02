<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Include database connection file
include("db_connection.php");

// Check if the connection was successful
if (!isset($conn)) {
    die("Database connection variable is not set.");
} elseif (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch existing competitions from the database
$query = "SELECT * FROM competitions ORDER BY start_date ASC";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NUST Programming Competition</title>
    <link rel="stylesheet" href="admin_styles.css">
    <style>
        /* Add styles for card layout */
        .competitions-overview {
            display: flex;
            flex-wrap: wrap; /* Allows cards to wrap to the next line */
            gap: 20px; /* Space between cards */
            margin-top: 20px;
            justify-content: center; /* Center align the cards */
        }

        .competition-card {
            width: 200px; /* Set a fixed width for the cards */
            height: 250px; /* Set a fixed height for the cards */
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
            transition: transform 0.2s;
            display: flex; /* Use flexbox for vertical alignment */
            flex-direction: column; /* Stack elements vertically */
            justify-content: space-between; /* Space elements evenly */
        }

        .competition-card img {
            max-width: 100%;
            max-height: 100px; /* Limit the height of the logo */
            border-radius: 5px;
            margin-bottom: 10px; /* Space between image and title */
        }

        .competition-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 5px; /* Reduced space below the title */
        }

        .competition-date {
            color: #666;
            font-size: 0.9em;
        }

        .competitions-header {
            text-align: center; /* Center the header text */
            margin-bottom: 20px; /* Space below the header */
        }
    </style>
</head>
<body>

<div class="admin-container">
    <!-- Header -->
    <header>
    <div class="header-left">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="header-right">

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="adminhome.php">Dashboard</a></li>
            <li><a href="competitions.php">Competitions</a></li>
            <li><a href="participants.php">Participants</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="dashboard-content">
            <h2>Dashboard Overview</h2>
            <p>Manage all aspects of the NUST Annual Programming Competition from here.</p>
            
            <!-- Add Competition Button -->
            <button class="add-competition-btn" onclick="toggleCompetitionForm()">Add Competition</button>

            <!-- Competition Form (hidden by default) -->
            <div class="competition-form" id="competitionForm" style="display: none;">
                <h3>Create a New Competition</h3>
                <form action="add_competition.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Competition Name" required> <!-- Change this line -->
                    <textarea name="description" placeholder="Description" rows="4" required></textarea>
                    <input type="date" name="start_date" required>
                    <input type="date" name="end_date" required>
                    <input type="file" name="logo" accept="image/*"> <!-- File upload for logo -->
                    <button type="submit">Save Competition</button>
                </form>
            </div>

<!-- Competitions Overview -->
<div class="competitions-header">
    <h3>Upcoming Competitions</h3>
</div>
<section class="competitions-overview">
    <?php
    // Display fetched competitions
    while ($competition = mysqli_fetch_assoc($result)) {
        echo '<div class="competition-card">';
        echo '<div class="competition-title">' . htmlspecialchars($competition['title']) . '</div>';
        echo '<div class="competition-date">Starting: ' . htmlspecialchars($competition['start_date']) . '</div>';
        if (!empty($competition['logo_path'])) {
            echo '<img src="' . htmlspecialchars($competition['logo_path']) . '" alt="Competition Logo">';
        }
        // Add a delete button
        echo '<form action="delete_competition.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this competition?\');">
                <input type="hidden" name="competition_id" value="' . htmlspecialchars($competition['id']) . '">
                <button type="submit" class="delete-btn">Delete</button>
              </form>';
              
        echo '<form action="edit_competition.php" method="PUT" onsubmit="return">
            <input type="hidden" name="competition_id" value="' . htmlspecialchars($competition['id']) . '">
            <button type="submit" class="edit-btn">Edit</button>
            </form>';
        echo '</div>';
    }
    ?>
</section>
        </div>
    </main>
</div>
<div class="admin-buttons">
    <a href="editcontent.php" class="btn btn-warning">Edit Website Contents</a>
</div>

<script>
// Toggle Competition Form Visibility
function toggleCompetitionForm() {
    var form = document.getElementById("competitionForm");
    form.style.display = form.style.display === "none" ? "block" : "none";
}
</script>

</body>
</html>
