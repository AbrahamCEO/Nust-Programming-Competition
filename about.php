<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NUST Annual Competition</title>
    <link rel="icon" type="image/x-icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEOzlbxEmqvdYu9Oew3JCYCAXrVAcqHOb2LtAKcBiHfByWnUsHlyrFAI6BC4sLUXCcGzY&usqp=CAU">
    <link rel="stylesheet" href="about.css"> <!-- Link to your CSS file -->
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
<header>
        <div class="header-logo">
            <img src="./IMAGES NUST/NUST.png" alt="University Logo">
        </div>
        <nav>
            <ul>
                <li><a  href="home.php">Home</a></li>
                <li><a class="active"href="about.php">About</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact.php">Contact</a></li>
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

<main>
        <!-- NUST Annual Competition Section -->
        <section class="about-competition">
            <div class="text-content">
                <h2>NUST Annual Competition</h2>
                <p>The NUST Annual Competition is a prestigious event that showcases the innovative talents of young minds in Namibia. Our mission is to inspire creativity, foster innovation, and provide a platform for students to bring their ideas to life. Participants are challenged to develop projects that address real-world problems, and they have the opportunity to present their work to a panel of esteemed judges.</p>
            </div>
            <div class="image-content">
                <img src="./IMAGES NUST/GROUP2.png" alt="NUST Annual Competition">
            </div>
        </section>
   <hr>
        <!-- Categories Section -->
        <section class="section-categories">
            <h3>Categories</h3>
            <p>We invite participants to compete in two main categories:</p>
            <ul>
                <li style="color: #1e3a6a;"><strong>High School Students:</strong> This category encourages young learners to think outside the box and explore innovative solutions.</li>
                <li style="color: #1e3a6a;"><strong>Tertiary Institutions:</strong> University and college students are challenged to develop more advanced projects that can make a significant impact.</li>
            </ul>
        </section>

        <!-- Previous Winners Section -->
        <section class="section-winners">
            <h3>Previous Winners</h3>
            <div class="winners-gallery">
                <img src="./IMAGES NUST/WINERS.png" alt="Previous Winner 1" />
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6BUoIoc1-z-TS6CmpHxqW09Py6h94LuQU_g&s" alt="Previous Winner 2" />
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_S-LkKEOKD2NqCG-nV0c5fWc6ZKlqOwoq-Q&s" alt="Previous Winner 3" />
                <!-- Add more images as needed -->
            </div>
            <p>Here are some of our past winners who have showcased exceptional talent and creativity in their projects. Each year, we are amazed by the innovative ideas that emerge from our participants!</p>
        </section>

        <!-- Sponsors Section -->
        <section class="section-sponsors">
            <h3>Our Sponsors</h3>
            <p>The NUST Annual Competition is made possible by the generous support of our sponsors. Their commitment to fostering innovation and education is invaluable.</p>
            <ul class="sponsors-list">
                <li><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Mtc_Namibia_Logo.svg/1200px-Mtc_Namibia_Logo.svg.png" alt="MTC Namibia" /></li>
                <li><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTu6DIaIS6QWEIPJj0UGw-ZuE33Hg5kqeksXA&s" alt="Shine Technologies" /></li>
                <li><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAB4CAMAAAB/yz8SAAAAyVBMVEX///85VqbcLigrSZ/29/sxT6IsS6A3VKXtpKXt7vbnenv65+gzUaPXIBiRnczXIx7cKiXslpjeRUOirdXy8/nP1en0x8jl6PPCyuPb3+/++vpAWqjV2uz63+G5wd9HYKv88PGrttlwgr4fPpl/kMUmRJ3HzuZRabCIlsiyu9ybptFLZK16i8Jec7X30tTcOTddcrVpfLrkbnDphojtoqTePj3ws7TphYUaOZfWLiziWFnwrrHrk5XVFw3kam32zdDjYGHcTEvyvcF8R4egAAANVElEQVR4nO1cC1fiOhe1pEkGDQ8VLAXlJeUhqKCjXme831X//4/68mqTtIGC1gE67rXunQWWkGxOTvZ5tAcH3/jGN/YUbtE7by/6/cWgUfdq257N7sIblmfTFkIIEgqIEICd+fj0/JuyGLz2rAUQIU4MmJIGRuXhN2EhvN4IQILjRCnGIIL9xjdf1Em1KVPLiQpBAJydb3uuW0axjFHMpjCRwA6O8TVvu9ue8PbgDRDU2aD+CeJ5vz9j6C869DXSrQ6j1uQvpas2BqFDx8wv4cXV0HN1Mtya3y7PISL8EklXe2sT3iJ6yqowAvNTf5nN1IaDDrW40MLQ/K/zXf4UhVRBMO8V0y4vt1DIFgbjv2ovumWAQ1kAx/5aHxleR7sWtupfPcPdgTdC0gcReLW+fvL7EcWg/IXT2yk0IAnFQHkzqekvQrrgKG3n5gNXcsEYzDZf8LADQ52x1u7dc8xQ6HiGH/m4G3LtoNyLCHcBpVkNPnqk+aFxgV6mU9s51EbCXWHc+Pgg7hhItk6zm9nuwZ0Krsj0c+65LbdintlypV3BxWdV5blD8s5WXzgbOPv8UMWOZGvy+bF2EmPBFbrKYrCa3NEgn5FiD4mgOaOdUxO2hZGXzXg7hbpwyiizQCVka5S/sLrW4lzBfnZDFuWQg+yG3BH0uRmQ6yzH9IWxgk9otp1EW+jIVrY1GjkqyVdQXZRHV9bBbxlmvbd3AGITouyDuRHmgeaHYvIdRZ1vF7LIfmRP5DA6OToRp2ITfoVrOeVswfyEPW30RZuQQWxEkpfqvtsR4vFrRj8PWPk6O627ZQjD+jInfDqY9fuD8ReN/ochDStTOZpbDFGOswNZY8E98Hzb09gLFLnGQnmL374GpywiwdNtT2M/MGX9LzDnVauM4ItdKMW7uxLbnekOQOxC6d5duBKd+TjeHtO8uPn988daOL7544vLGjwagbIG4yZ6t01gAjq6xGj+fCitj4fmVlaYHVyecAqLCm56WzLWSoE3z6VqYX1Ujra0yKwwZA17uCNfuXgdtsLD4MdGVBUKpUfLBLwGx9CPpzyKvV48+PZ7PcNv1iZ6S2KxodDWs5heb7Doj9v6F7jtntohxYl8Uev1fPMis+pZZhsPhoGbIgszOOqFo/7iAOG43v/diCpqWXcWri4RAgCx/3XMNE4/uIw7yA64NCgdBJeqU6cWsGEkApWa8+YAUX9LEOgrpnuXQRSs+gBdiq8+v0QtbfgZCMwU7zXWFakkC/Lp80WIhch/ZR+3yE8cVSQFa4FdWbU4rQmNtTodDBG1cGBEER0HxCzLRdEWCCcPVFFyCByiyIpIbAcY4uvZdQfhQKUKBhCFL6gcALKs7NKoTw3YBtjMWQqPHl0hyIKTog1e0euJGwh4qv6pxKl6vjtcA3eC126CrBlhv5Tr1s6vodGjVAQJoewDbPzSdG2OWs0VhD23FiJ8tx5QKvhF/uIfRcQIh5lOH0VcUQ6JEpxF5ARmSaLIg+hW+JWCLLQ8Y+pztmCZHoTPfPm/kuu34o7ZVuki8f4UR/ZzjfUAtQ5IvOWijcyEqwewlghfkMBSbulgldNUXNUiG/URBmorUw8ejbggMNbHUGdkqeyMJGtFwf2KyzI64g03rNvu8ksNHDOyKgkPX4NqZzWMXXYKE1HFgJipkQYiWkqxhWFSNQ+BNafpA1kgpcYaaA2KLnKQ/O0mIFFD5Xk/Evm6dLKE4KeLemRklY6XX2ninV1eebHMOtpZdeBoG69PEnW5UaxKcAW18J9uW0vipAyt2f82EFZD92BgZBAWROZA6XAgTgOv6ylzSydLmCL9tX5zsn4vv9LEDbesX/G3e5r99CDRCv0tjOL+HTot4425vp4GgJZk7IxAW8/TgHD/7kFsckXPG2k5lLVES+yYOfjoYFiDLF5gZN5kQ7K6jKzqSfw4pLOO9MFcT0Cu49+J6d9tDb8DQmz57BGnOcnVgRdg7sB7wFIY5sGOmq8ga0VJ7EpUmHubkyX0a5yskdIHDQQ1J2Hx7xNkelzq37UPLJLb5oC7GctPz2zUtXHFafTZ0A5OlqM6nKzoBxVkkVnv1IqrERSqtBiSlXBCy9B8sGkHeiqF9nOOoV4uO4WJytwAmjWVBtDIc1sYW7Ii1GPjVuKQ9NkxauVKnitUwFluqBFkRaNJUUqWpR2Eiuc9RJyswvPJStyqaPCkaiGLHhfzIlVFRX+MyFw36BlJFAWUNhIoQ21FReC0zj0BnZx24BAptBSojfYou4GlnuUzi25b/Z/bspKVEhxO3YisQnUlNGH1xsgqxchi+p1FBwAQ0x9Z9HsNKD3IcU1M/e4AiUv9k1TBJ+5/GNNvGxFoq/1RRkZ+B9vaDdyWszlZ4nyRZKWEzoqsExtZA+KgAAQBABC39JtfPqDfWZDGEZgSwhsxHmf66kcYN6YYWQuldEoOtnYTfcyyRpplfY6sKYbDIts5jTFyCFZs2fQ7XKnfMWrIYKcYt4oJJA7UbIXr9wayd6uwHpklbbVxstCqRCmRt5bzUnwWZNFZR/raa+kt5T2rfjecLtXvun930PKstzuD+uBCCY/srcYudvCSbqLYaXhQHpdX4ZorBy4Xf/ybnmZII8vX7YcFE9F6+xb/HotZy0TT755VvyvQzRVEDk7EmNTLQVu3ykgznthfTJ2ViglkDyhgv3rzaDV+VWNkWaTDRLcfep4pn95J6ndDgh5w/a7IG1rPL+3T9BeONKu00WtiPfOIY9MgDDNTwadjHCr4NMTSDCJJUega1xiRcVH7pWtJ/+7F3qJHgBF2J6MTAwsCo6BbxphUtwRJwWpKXQMiUbpBp9l5GBumIUaWCHdi2b+Rrg/qGhsW/+4bYTZXj5qet+v3A/2CyIijGHNGLL2ONJBY1h014YH0Bu1AUdYhDTGyLth5UDUD6RrS1z/TdsUpSuh3GoHo27CGnUDtQurfycqqpttRgWekQdjGT2wqKnWXdTKIJMIGTSENMwG2HP8zyRIpmkPjEsO/05ko47Do9xrUDyK2rbSfmC579RraUFE9iWzyCib3yHy5jYr+2DUMJZxyJ8yUpqB7azp0EUr+MK6ZIBTlT4ZIv8Eqqd/ZRlI3trh9aIhs6t+TU/IX0aqp81CmKvMzB+IHiGVwVvh3WTaEQ9eadU+gPhU5+NReriY3rIJKyRxyQ/vPuGhAYJu3BXjDGbUrZWV0fzpDX+A8XDFVi2RaZwuptTtUZuo64ooaS9RkENI8BmDAHnPiemXKlVL/WozZQ9g8Ylf5d1ndYY/kWQtASnj2yZuz5fj9xrkq/YzIO4kpCQbKPH9cEgSI/qc5KbolcRS8RHMvAxqHkFG/gyAGRtTNWsxwpJ0vJb3lABMqv64dGksFKq3oIq3m0MGxRLuZqo7hSj10Z13ggOuyh39XVOq5TqgqpSAOw2fjMHQDEGF6qm+7yaX6y6UisdFiFUDEngUX0wkYaAjCododwNkDQH88zvk/WlGxcWmG3WYpMo4hSmcnBlm/f0stR5feo68544fhq/ndfl3CjwvQugZ9m5z3xoNxuZ3wwJ7+AU1/exN2fcOwQrehv643zPPQawyXH6s1tJlZUbuSqiyVLD0z+FIxduW+Yp7SOBOjSqWGUsiq6EefdFl733N0FZD1gabqQXUpzUavesvMkUir7nvLUVqz3/Lev98vx8tx1jW+45hLUktfyDcSkLvwPf3Kb8hSfyzl8A07hHx/2vY09gKik2v/z8I/gnuuSN/2/yz8A+jyJKm1oXQP0RT4quGPLXHh/uK48kyxdl/ahjiKJSD2HN1Kgeqg0hdpRp5fLjx3v2b0Pw8usL/ouPqvlCvDYv1ATGHbOq8/P/QtH/o2Jx6L4V20ad9nP/J9qZC7SOdVeOGzrMc9E7/C/7Ied6sIb5foZjxsgSe9LDcL7DVEU0wlW5nd5A0PG3Se7gvERsw25yRUQylfm5Ch+yysYO3bANLxwq21mh+JpSCTTtkpop9ywFxmG2QvX6zG/mGEXOXOYQk8ZWlbx3KwL9Buu4E7ucAM/JbwV/G+mTyh+SZbQe8+qSCakvbKrxyFOXF03+QiTz51o/yRJD3XXFGTeJVsVT4Rzb0L3V4o5Zsrytah7G8vHXY/NkJXjZBzrg7CPAG7VfxDYfX7bcjV2neM7TMew2dbmP0Ka+HiVX64Wsmpvorj4jl6ZMN9d5MPHh1Wwk/eJm+0zym6d+GNOZXK09rWdfQUUlX9tPbYKzwWKiFdpdezNVbePHstRR+p5qRGuC6ocVUjuh5eblby1by4v42oqn74HN1j3JyohxhVSs+H70dWwppH73eFiClK1VsuswxpaL4/aM98qpRKt6/3jzfdrixgN7vdm8eX19vwdjlxgD7kqjSxCZqPD8YjsiqUMUrNLUdVvlKolk7e/ybHHkfz/VelEu+0FTeLx9+sVH6tcxLkG0cvt6XUR7CV6CGw7w+pywb0sHugO24ZYZVS5eTl4q83KoXm0ePhG/dR2v4TXuvk6fHbppLoXrzfP73eygfXFZ5/Hb6cXXS3PaudRlfeMd7tbnsm3/jGN/4e/B/DAB1dRoDm0AAAAABJRU5ErkJggg==" alt="Blue Sky IT Solutions" /></li>
                <li><img src="https://media.licdn.com/dms/image/D4E12AQGYFLYr9qIlcg/article-cover_image-shrink_720_1280/0/1700011497500?e=2147483647&v=beta&t=HTIn1wDAJ4j_kFFRilZsw-Uj-kSkGAz8rrltKqBNoNE" alt="Telecom Namibia" /></li>
            </ul>
        </section>

        <!-- Get Involved Section -->
        <section class="section-involved">
            <h3>Get Involved</h3>
            <p>Whether you're a student looking to participate, a sponsor wanting to support innovation, or a mentor willing to guide young minds, there are many ways to get involved with the NUST Annual Competition. Join us in celebrating creativity and innovation!</p>
            <a href="/register.php" class="cta-button">Get Involved</a>
        </section>
    </main>
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


    <footer>
        <p>&copy; 2024 NUST Annual Competition. All rights reserved.</p>
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
</body>
</html>