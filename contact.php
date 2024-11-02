<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUST Programming Competition Contact</title>
    <link rel="icon" type="image/x-icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEOzlbxEmqvdYu9Oew3JCYCAXrVAcqHOb2LtAKcBiHfByWnUsHlyrFAI6BC4sLUXCcGzY&usqp=CAU">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZv51qY8w5ozW+qPQIK7I9C2hW/Lncn7PAujGd1wMfRTe9Sc0VtXjWzj5CkS4Y+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZv51qY8w5ozW+qPQIK7I9C2hW/Lncn7PAujGd1wMfRTe9Sc0VtXjWzj5CkS4Y+" crossorigin="anonymous">
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
<style>
      li i {
            font-size: 24px;
            color: #007bff;
            margin-right: 10px;
        }
</style>
<body>
    <!-- Header -->
    <header>
    <div class="header-logo">
            <img src="./IMAGES NUST/NUST.png" alt="University Logo">
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a  href="gallery.php">Gallery</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
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
            </ul>
        </nav>
    </header>
<section id="contact-details" class="section-p1">
    <div class="details">
      <span>GET IN TOUCH IF YOU HAVE ANY ENQUIRIES</span>
      <h2>Visit our location or contact us today</h2>
      <h3>Head Office</h3>
      <div>
        <li>
          <i class="fas fa-map"></i>
          <p>Namibia University of Science and Technology </p>
        </li>
        <li>
          <i class="fas fa-envelope"></i>
          <p> prg.competition@nust.na</p>
        </li>
        <li>
          <i class="fas fa-phone-alt"></i>
          <p>+264 81 3643798  , +264 81 867 8032  </p>
        </li>
        <li>
         <i class="bi bi-clock-fill"></i>
          <p>Monday to Friday: 9.00am to 4.00pm</p>
        </li>
      </div>
    </div>
    <div class="map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d358.5988063636779!2d17.077313756499834!3d-22.566649716517027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1c0b1b564215f94f%3A0x853571f813c71638!2sNUST%20Main%20Gate!5e1!3m2!1sen!2sin!4v1730487330574!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>"
      </iframe>
    </div>
  </section>

  <section id="form-details">
    <form action="">
      <span>LEAVE A MESSAGE</span>
      <h2>We love to hear from you</h2>
      <input type="text" placeholder="Your Name">
      <input type="text" placeholder="E-mail">
      <input type="text" placeholder="Subject">
      <textarea name="message" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
      <button class="normal">Submit</button>
    </form>

    <div class="people">
      <div>
        <img src="./assets/assets/media/people/female.png">
        <p><span>Ms Nashandi Ndinelago</span>Lecturer<br> +264 81 867 8032   <br>Email:
            nnashandi@nust.na </p>
      </div>
      <div>
      <img src="./assets/assets/media/people/male.png">
      <p><span>Dr Ambrose Azeta </span>Lecturer<br>+264 81 3643798  <br>Email:
        aazeta@nust.na   </p>
        </div>
    </div>
  </section>

  <section id="newsletter" class="section-p1">
    <div class="newstext">
      <h4>Register to for our newsletter</h4>
      <p>Get E-mail updates about our competitions</p>
    </div>
    <div class="form">
      <input type="text" placeholder="Your email address">
      <button class="normal">Register</button>
    </div>
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

/* Broadcast Container Styles */
.broadcasts-container {
    max-height: 400px; /* Set a max height for the broadcast container */
    overflow-y: auto; /* Enable vertical scrolling */
}

.broadcast-item {
    border-bottom: 1px solid #ddd; /* Light border between items */
    padding: 10px 0; /* Padding around each item */
}
</style>

  </section>
</body>
    </html>