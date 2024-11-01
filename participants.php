<?php
// Start session and check if admin is logged in
session_start();
if (!isset($_SESSION['username'])) {
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
        $insert_query = "INSERT INTO broadcasts (title, message) VALUES ('$title', '$message')";
        if (mysqli_query($conn, $insert_query)) {
            // Redirect to the same page to prevent re-submission
            header("Location: participants.php?success=1");
            exit; // Ensure no further code is executed
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Title and message cannot be empty.');</script>";
    }
}

// Display success message if applicable
$successMessage = '';
if (isset($_GET['success'])) {
    $successMessage = 'Broadcast message sent successfully!';
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
        /* Container styling */
        .participants-container {
            max-width: 1000px;
            margin: 50px auto; /* Center container */
            padding: 2px;
        }

        /* Table styling */
        .participants-table {
            width: 100%; /* Adjusted to 100% for better responsiveness */
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

        /* Page header */
        .page-header {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Broadcast Button */
        .broadcast-btn {
            display: block;
            margin: 20px auto; /* Center the button */
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #28a745; /* Green color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .broadcast-btn:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Modal styling */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal h2 {
            color: #333;
        }

        .modal input[type="text"], .modal textarea {
            width: 100%; /* Full width */
            padding: 10px;
            margin: 10px 0; /* Spacing between elements */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .modal button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff; /* Blue color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Success Message */
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="admin-container">
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

    <!-- Participants Table -->
    <div class="participants-container">
        <h2 class="page-header">Registered Participants</h2>
        
        <!-- Broadcast Button -->
        <button id="broadcastBtn" class="broadcast-btn">Broadcast Message</button>

        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>

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

<!-- Modal for Broadcast Message -->
<div id="broadcastModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Broadcast Message</h2>
        <form method="POST" action="">
            <input type="text" name="title" placeholder="Message Title" required>
            <textarea name="message" placeholder="Message Content" rows="4" required></textarea>
            <button type="submit" name="broadcast">Send Broadcast</button>
        </form>
    </div>
</div>

<script>
// Get modal element
var modal = document.getElementById("broadcastModal");

// Get button that opens the modal
var btn = document.getElementById("broadcastBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
