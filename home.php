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

    <section class="meet-our-sponsors">
    <h2>Meet Our Sponsors</h2>
    <div class="sponsors-container">
        <a href="https://www.mtc.com.na" target="_blank" class="sponsor-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Mtc_Namibia_Logo.svg/1200px-Mtc_Namibia_Logo.svg.png" alt="Sponsor 1 Logo">
        </a>
        <a href="https://www.blueskyask.com" target="_blank" class="sponsor-logo">
            <img src="data:image/png;base64,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...">
        </a>
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

<!-- Hovering Chatbot Button -->
<div class="chatbot-button" onclick="toggleChat()">
    💬
</div>

<!-- Chatbot Interface -->
<div class="chatbot-wrapper" id="chatbotWrapper">
    <div class="chatbot-header">
        <span>NUST Competition Assistant</span>
        <button onclick="toggleChat()" style="background: none; border: none; color: white;">×</button>
    </div>
    <div class="chatbot-messages" id="chatMessages">
        <div class="message bot-message">Hello! How can I help you with the NUST Programming Competition?</div>
    </div>
    <div class="chat-input-area">
        <input type="text" class="chat-input" id="chatInput" placeholder="Type your message...">
        <button class="chat-send-btn" onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
function toggleChat() {
    const wrapper = document.getElementById('chatbotWrapper');
    if (wrapper.style.transform === 'translateY(0)') {
        wrapper.style.transform = 'translateY(100%)'; // Hide the chat
    } else {
        wrapper.style.transform = 'translateY(0)'; // Show the chat
    }
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (message === '') return;
    
    // Add user message
    const messagesDiv = document.getElementById('chatMessages');
    messagesDiv.innerHTML += `<div class="message user-message">${message}</div>`;
    
    // Clear input
    input.value = '';
    
    // Send to server
    fetch('message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `text=${encodeURIComponent(message)}`
    })
    .then(response => response.text())
    .then(reply => {
        messagesDiv.innerHTML += `<div class="message bot-message">${reply}</div>`;
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    })
    .catch(error => {
        console.error('Error:', error);
        messagesDiv.innerHTML += `<div class="message bot-message">Sorry, there was an error processing your request.</div>`;
    });
    
    // Scroll to bottom
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

// Allow Enter key to send message
document.getElementById('chatInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
</script>

</body>
</html>