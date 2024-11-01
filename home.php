<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUST Programming Competition</title>
    <link rel="icon" type="image/x-icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEOzlbxEmqvdYu9Oew3JCYCAXrVAcqHOb2LtAKcBiHfByWnUsHlyrFAI6BC4sLUXCcGzY&usqp=CAU">
    <link rel="stylesheet" href="home.css">
    <script>
        function showDeRegisterForm() {
            document.getElementById("deRegisterForm").style.display = "block";
        }

        function hideDeRegisterForm() {
            document.getElementById("deRegisterForm").style.display = "none";
        }

        function showBroadcasts() {
            document.getElementById("broadcastModal").style.display = "block";
        }

        function hideBroadcasts() {
            document.getElementById("broadcastModal").style.display = "none";
        }

        async function deRegister() {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            const response = await fetch('deregister.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (data.status === 'success') {
                alert('Your account has been deleted successfully.');
                window.location.href = 'home.php'; // Redirect to home after successful deregistration
            } else {
                alert('Error: ' + data.message);
            }
        }
    </script>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-logo">
            <img src="./IMAGES NUST/NUST.png" alt="University Logo">
        </div>
        <nav>
            <ul>
                <li><a class="active" href="home.php">Home</a></li>
                <li><a href="about.html">About</a></li>
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

    <!-- De-Register Form -->
    <div id="deRegisterForm" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>De-Register Your Account</h3>
            <form onsubmit="event.preventDefault(); deRegister();">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" required placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" required placeholder="Enter your password">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn btn-danger">Confirm De-Registration</button>
                    <button type="button" class="btn btn-secondary" onclick="hideDeRegisterForm()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Broadcast Modal -->
    <div id="broadcastModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="hideBroadcasts()">&times;</span>
            <h2>Broadcasts</h2>
            <div class="broadcasts-container">
                <?php
                include "db_connection.php"; // Database connection

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch broadcasts from the database
                $sql = "SELECT * FROM broadcasts ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each broadcast
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="broadcast-item">';
                        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row['message']) . '</p>';
                        echo '<span>' . htmlspecialchars($row['created_at']) . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No broadcasts available.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <!-- Hero Section with Slider -->
    <section class="hero">
        <div class="carousel">
            <div class="list">
                <div class="item">
                    <img src="https://media.istockphoto.com/id/537331500/photo/programming-code-abstract-technology-background-of-software-deve.jpg?s=612x612&w=0&k=20&c=jlYes8ZfnCmD0lLn-vKvzQoKXrWaEcVypHnB5MuO-g8=" alt="NUST 2024 Programming Competition">
                    <div class="content">
                        <h2 class="title">NUST 2024 Programming Competition</h2>
                        <div class="buttons">
                            <a href="register.php?competition_id=1" class="btn btn-primary">REGISTER NOW</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="./IMAGES NUST/WATCHIG 1.png" alt="Previous Competition 2">
                    <div class="content">
                        <h2 class="title">Previous Competition 2</h2>
                        <p class="des">Description for competition 2 goes here.</p>
                        <div class="buttons">
                            <a href="register.php?competition_id=2" class="btn btn-primary">REGISTER NOW</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="./IMAGES NUST/SPEAKING1.png" alt="Previous Competition 3">
                    <div class="content">
                        <h2 class="title">Previous Competition 3</h2>
                        <p class="des">Description for competition 3 goes here.</p>
                        <div class="buttons">
                            <a href="register.php?competition_id=3" class="btn btn-primary">REGISTER NOW</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thumbnail"></div>
            <button id="prev"><!-- Previous Button --></button>
            <button id="next"><!-- Next Button --></button>
        </div>
    </section>
    <hr>

    <!-- About Competition Section -->
    <section class="about-competition">
        <div class="about-content">
            <h2>What is the NUST Programming Competition?</h2>
            <p>The programming competition is an annual event established by the Faculty of Computing and Informatics (FCI) to encourage critical thinking, problem-solving, and enhance participants’ interests in computing. Learners and students from various high schools and tertiary institutions are invited to participate.</p>
            <a href="about.html" class="learn-more-btn">Learn More</a>
        </div>
        <div class="about-image-container">
            <div class="about-image">
                <img src="./IMAGES NUST/SPEAKING2.png" alt="Competition Image">
            </div>
        </div>
    </section>
    <hr>

    <!-- Meet Our Sponsors Section -->
    <section class="meet-our-sponsors">
        <h2>Meet Our Sponsors</h2>
        <div class="sponsor-logos">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2nwxwGTGH9fzfRxyVGF7Q_lYvn5_YqRGc2g&usqp=CAU" alt="Sponsor 1">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzdmDROGqDIFod9T0R82DzU9i3ZW5pl0PQo18h8UePHU0t-mgblx_rwe5-2OGh6V8Lzo5I&usqp=CAU" alt="Sponsor 2">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQy78RLsGfg_OzY00G0CCqMxN4JWfdlsBbYFQ&usqp=CAU" alt="Sponsor 3">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUEFFKcWmOB5BIXkdOwE5I3MNyzwof5rbnA&usqp=CAU" alt="Sponsor 4">
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> NUST Programming Competition. All rights reserved.</p>
    </footer>

    <style>
        /* Basic styles for modals */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
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

        .broadcasts-container {
            max-height: 400px; /* Set a max height for the broadcast container */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .broadcast-item {
            border-bottom: 1px solid #ddd; /* Light border between items */
            padding: 10px 0; /* Padding around each item */
        }
    </style>

</body>
</html>
