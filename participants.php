<?php
// Start session and check if admin is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Include database connection file
include("db_connection.php");

// Fetch registered users including name and surname
$query = "SELECT name, surname, email, preferred_language, preferred_ide, type_of_institution FROM registered";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle broadcast form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['broadcast'])) {
    // Add your broadcast handling code here if needed
}

// Handle user deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    // Add your user deletion handling code here if needed
}

// Fetch statistics for programming languages, IDEs, and institution types
$statistics_query = "
    SELECT preferred_language, preferred_ide, type_of_institution, COUNT(*) AS count
    FROM registered
    GROUP BY preferred_language, preferred_ide, type_of_institution
";
$statistics_result = mysqli_query($conn, $statistics_query);

if (!$statistics_result) {
    die("Statistics query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Participants - NUST Competitions</title>
    <link rel="stylesheet" href="admin_styles.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .admin-container {
        width: 80%;
        margin: auto;
        overflow: hidden;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    nav {
        margin-bottom: 20px;
    }
    nav ul {
        list-style: none;
        padding: 0;
    }
    nav ul li {
        display: inline;
        margin-right: 10px;
    }
    nav ul li a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }
    .participants-container {
        padding: 20px;
    }
    .page-header {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }
    .broadcast-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
    }
    .broadcast-button:hover {
        background-color: #45a049;
    }
    .broadcast-form {
        display: none; /* Initially hidden */
        margin: 20px 0;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .broadcast-form input, .broadcast-form textarea {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .participants-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .participants-table th, .participants-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        transition: background-color 0.3s ease;
    }
    .participants-table th {
        background-color: #f2f2f2;
        color: #555;
        font-weight: bold;
    }
    .participants-table tr:hover {
        background-color: #f5f5f5;
    }
    .participants-table td {
        color: #333;
    }
    .participants-table button {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .participants-table button:hover {
        background-color: #d32f2f;
    }
    .statistics {
        margin-top: 20px;
    }
    .statistics h3 {
        margin-bottom: 10px;
        color: #333;
    }
    .filter-container {
        margin-bottom: 20px;
    }
    .filter-container select {
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        transition: border-color 0.3s ease;
    }
    .filter-container select:hover {
        border-color: #888;
    }
    /* Responsive design */
    @media (max-width: 600px) {
        nav ul li {
            display: block;
            margin: 5px 0;
        }
        .broadcast-button {
            width: 100%;
        }
    }

    .statistics {
        background-color: #f9f9f9; /* Light background for contrast */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        padding: 20px; /* Inner spacing */
        margin: 20px 0; /* Outer spacing */
    }

    .statistics h3 {
        font-size: 24px; /* Main heading size */
        color: #333; /* Darker color for contrast */
        border-bottom: 2px solid #007BFF; /* Blue bottom border */
        padding-bottom: 10px; /* Padding below the heading */
        margin-bottom: 15px; /* Margin below the heading */
    }

    .statistics h4 {
        font-size: 20px; /* Subheading size */
        color: #555; /* Slightly lighter color */
        margin: 15px 0 10px; /* Spacing above and below */
    }

    .statistics ul {
        list-style: none; /* Remove default list style */
        padding: 0; /* Remove padding */
    }

    .statistics li {
        background-color: #fff; /* White background for list items */
        border: 1px solid #e0e0e0; /* Light gray border */
        border-radius: 4px; /* Rounded corners */
        padding: 10px; /* Padding within list items */
        margin-bottom: 10px; /* Space between list items */
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
    }

    .statistics li:hover {
        background-color: #f0f8ff; /* Light blue on hover */
        transform: translateY(-2px); /* Lift effect on hover */
    }

    </style>

    <script>
        function toggleBroadcastForm() {
            var form = document.getElementById('broadcastForm');
            form.style.display = form.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</head>
<body>

<div class="admin-container">
    <nav>
        <ul>
            <li><a href="adminhome.php">Dashboard</a></li>
            <li><a href="competitions.php">Competitions</a></li>
            <li><a href="participants.php">Participants</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </nav>

    <div class="participants-container">
        <h2 class="page-header">Registered Participants</h2>

        <div style="text-align: center; margin-bottom: 20px;">
            <button class="broadcast-button" onclick="toggleBroadcastForm()">Send Broadcast Message</button>
        </div>
        
        <form id="broadcastForm" class="broadcast-form" method="POST" action="">
            <input type="text" name="title" placeholder="Enter message title" required>
            <textarea name="message" rows="4" placeholder="Enter your broadcast message here" required></textarea>
            <button type="submit" name="broadcast">Send Broadcast</button>
        </form>

        <div class="filter-container">
            <form method="GET" action="">
                <select name="language" onchange="this.form.submit()">
                    <option value="">Select Programming Language</option>
                    <option value="Python" <?= (isset($_GET['language']) && $_GET['language'] === 'Python') ? 'selected' : ''; ?>>Python</option>
                    <option value="Java" <?= (isset($_GET['language']) && $_GET['language'] === 'Java') ? 'selected' : ''; ?>>Java</option>
                    <option value="JavaScript" <?= (isset($_GET['language']) && $_GET['language'] === 'JavaScript') ? 'selected' : ''; ?>>JavaScript</option>
                    <option value="C++" <?= (isset($_GET['language']) && $_GET['language'] === 'C++') ? 'selected' : ''; ?>>C++</option>
                </select>
                <select name="ide" onchange="this.form.submit()">
                    <option value="">Select IDE</option>
                    <option value="VSCode" <?= (isset($_GET['ide']) && $_GET['ide'] === 'VSCode') ? 'selected' : ''; ?>>VSCode</option>
                    <option value="PyCharm" <?= (isset($_GET['ide']) && $_GET['ide'] === 'PyCharm') ? 'selected' : ''; ?>>PyCharm</option>
                    <option value="Eclipse" <?= (isset($_GET['ide']) && $_GET['ide'] === 'Eclipse') ? 'selected' : ''; ?>>Eclipse</option>
                </select>
                <select name="institution" onchange="this.form.submit()">
                    <option value="">Select Institution Type</option>
                    <option value="University" <?= (isset($_GET['institution']) && $_GET['institution'] === 'University') ? 'selected' : ''; ?>>University</option>
                    <option value="College" <?= (isset($_GET['institution']) && $_GET['institution'] === 'College') ? 'selected' : ''; ?>>College</option>
                    <option value="High School" <?= (isset($_GET['institution']) && $_GET['institution'] === 'High School') ? 'selected' : ''; ?>>High School</option>
                </select>
            </form>
        </div>

        <table class="participants-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Preferred Language</th>
                    <th>Preferred IDE</th>
                    <th>Type of Institution</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['surname']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['preferred_language']); ?></td>
                        <td><?= htmlspecialchars($row['preferred_ide']); ?></td>
                        <td><?= htmlspecialchars($row['type_of_institution']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="user_email" value="<?= htmlspecialchars($row['email']); ?>">
                                <button type="submit" name="delete_user">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="statistics">
            <h3>Statistics Overview</h3>

            <h4>Programming Languages</h4>
            <ul>
                <?php
                $languages_query = "SELECT preferred_language, COUNT(*) AS count FROM registered GROUP BY preferred_language";
                $languages_result = mysqli_query($conn, $languages_query);

                while ($language = mysqli_fetch_assoc($languages_result)): ?>
                    <li><?= htmlspecialchars($language['preferred_language']); ?>: <?= $language['count']; ?></li>
                <?php endwhile; ?>
            </ul>

            <h4>Preferred IDEs</h4>
            <ul>
                <?php
                $ides_query = "SELECT preferred_ide, COUNT(*) AS count FROM registered GROUP BY preferred_ide";
                $ides_result = mysqli_query($conn, $ides_query);

                while ($ide = mysqli_fetch_assoc($ides_result)): ?>
                    <li><?= htmlspecialchars($ide['preferred_ide']); ?>: <?= $ide['count']; ?></li>
                <?php endwhile; ?>
            </ul>

            <h4>Type of Institution</h4>
            <ul>
                <?php
                $institutions_query = "SELECT type_of_institution, COUNT(*) AS count FROM registered GROUP BY type_of_institution";
                $institutions_result = mysqli_query($conn, $institutions_query);

                while ($institution = mysqli_fetch_assoc($institutions_result)): ?>
                    <li><?= htmlspecialchars($institution['type_of_institution']); ?>: <?= $institution['count']; ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
