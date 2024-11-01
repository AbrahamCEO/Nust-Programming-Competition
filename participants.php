<?php
// Start session and check if admin is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Include database connection file
include("db_connection.php");

// Fetch registered users
$query = "SELECT * FROM registered";
$result = mysqli_query($conn, $query);

// Check for query error
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle broadcast form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['broadcast'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];

    if (!empty($title) && !empty($message)) {
        // Insert broadcast into database
        $insert_query = "INSERT INTO broadcasts (title, message) VALUES ('$title', '$message')";
        if (mysqli_query($conn, $insert_query)) {
            // Insert announcement into the announcements table
            $announcement_query = "INSERT INTO announcements (title, message) VALUES ('$title', '$message')";
            mysqli_query($conn, $announcement_query); // Ignore error handling for simplicity

            // Fetch all emails from the registered users
            $email_query = "SELECT email FROM registered";
            $email_result = mysqli_query($conn, $email_query);

            if ($email_result) {
                // Send email to each registered user
                while ($row = mysqli_fetch_assoc($email_result)) {
                    $to = $row['email'];
                    $subject = $title;
                    $body = $message;
                    $headers = "From: no-reply@yourdomain.com\r\n"; // Replace with your domain

                    // Send email
                    mail($to, $subject, $body, $headers);
                }
                // Redirect to the same page to prevent re-submission
                header("Location: participants.php?success=1");
                exit;
            } else {
                echo "<script>alert('Error fetching emails: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error inserting broadcast: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Title and message cannot be empty.');</script>";
    }
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
        /* Style for broadcast button and form */
        .broadcast-button {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .broadcast-button:hover {
            background-color: #218838;
        }

        .broadcast-form {
            display: none;
            margin: 20px auto;
            padding: 20px;
            max-width: 500px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .broadcast-form input, .broadcast-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .broadcast-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .broadcast-form button:hover {
            background-color: #0056b3;
        }

        /* Style for participants table */
        .participants-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 2px;
        }

        .participants-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .participants-table th, .participants-table td {
            padding: 15px;
            text-align: left;
        }

        .participants-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
        }

        .participants-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .participants-table tr:hover {
            background-color: #e9f5ff;
        }

        .page-header {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
    <script>
        // Function to toggle the broadcast form visibility
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

        <!-- Broadcast button and form -->
        <div style="text-align: center; margin-bottom: 20px;">
            <button class="broadcast-button" onclick="toggleBroadcastForm()">Send Broadcast Message</button>
        </div>
        
        <form id="broadcastForm" class="broadcast-form" method="POST" action="">
            <input type="text" name="title" placeholder="Enter message title" required>
            <textarea name="message" rows="4" placeholder="Enter your broadcast message here" required></textarea>
            <button type="submit" name="broadcast">Send Broadcast</button>
        </form>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="participants-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['contact_number']); ?></td>
                            <td><?php echo htmlspecialchars($user['registration_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No registered participants found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
