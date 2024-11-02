<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - NUST Annual Competition</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/grid-overflow@1/src/GridOverflow3D.min.css">
    <link rel="stylesheet" href="gallery.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="color: #1e3a6a; background: white">

    <header>
    <div class="header-logo">
            <img src="./IMAGES NUST/NUST.png" alt="University Logo">
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a class="active" href="gallery.php">Gallery</a></li>
               
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
        
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Gallery</h1>
            <hr>
            <p>Explore highlights from past competitions, including moments of creativity, teamwork, and celebration.</p>
            <hr>
        </section>

        <section>
            <!-- Gallery Grid Section -->
            <div class="gridOverflow go-masonry go-3Dfx" id="grid">
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(0)">
                    <img src="./IMAGES NUST/SPEAKING1.png" alt="Opening Ceremony" />
                    <span class="go_caption">Opening Ceremony</span>
                </a>
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(1)">
                    <img src="./IMAGES NUST/GROUP2.png" alt="Participants and Judges 2023" />
                    <span class="go_caption">Participants and Judges 2023</span>
                </a>
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(2)">
                    <img src="./IMAGES NUST/WINERS.png" alt="Winners 2023" />
                    <span class="go_caption">Winners 2023</span>
                </a>
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(3)">
                    <img src="./IMAGES NUST/SPEAKING2.png" alt="Sponsors Representative" />
                    <span class="go_caption">Sponsors Representative</span>
                </a>
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(4)">
                    <img src="./IMAGES NUST/WATCHIG 1.png" alt="Viewers enjoying Project presentations" />
                    <span class="go_caption">Viewers enjoying Project presentations</span>
                </a>
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(5)">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6BUoIoc1-z-TS6CmpHxqW09Py6h94LuQU_g&s" alt="Winners 2022" />
                    <span class="go_caption">Winners 2022</span>
                </a>
                <a href="javascript:void(0);" class="go_gridItem" onclick="openModal(6)">
                    <img src="https://www.nust.na/sites/default/files/styles/medium/public/news/2024-07/DSC07691.JPG?itok=M81JG4bg" alt="Viewers enjoying Project presentations" />
                    <span class="go_caption">Viewers enjoying Project presentations</span>
                </a>
            </div>

            <!-- Modal Structure -->
            <div id="imageModal" class="modal" style="display:none;">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImage">
                <div class="caption" id="caption"></div>
                <button class="prev" onclick="changeImage(-1)">&#10094;</button>
                <button class="next" onclick="changeImage(1)">&#10095;</button>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/story-show-gallery@3/dist/ssg.min.js"></script>
    <script>
        const images = [
            { src: "./IMAGES NUST/SPEAKING1.png", caption: "Opening Ceremony" },
            { src: "./IMAGES NUST/GROUP2.png", caption: "Participants and Judges 2023" },
            { src: "./IMAGES NUST/WINERS.png", caption: "Winners 2023" },
            { src: "./IMAGES NUST/SPEAKING2.png", caption: "Sponsors Representative" },
            { src: "./IMAGES NUST/WATCHIG 1.png", caption: "Viewers enjoying Project presentations" },
            { src: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6BUoIoc1-z-TS6CmpHxqW09Py6h94LuQU_g&s", caption: "Winners 2022" },
            { src: "https://www.nust.na/sites/default/files/styles/medium/public/news/2024-07/DSC07691.JPG?itok=M81JG4bg", caption: "Viewers enjoying Project presentations" }
        ];

        let currentIndex = 0;

        function openModal(index) {
            currentIndex = index;
            const modal = document.getElementById("imageModal");
            const modalImage = document.getElementById("modalImage");
            const caption = document.getElementById("caption");
            
            modalImage.src = images[currentIndex].src;
            caption.innerText = images[currentIndex].caption;
            modal.style.display = "flex";
            console.log(images[currentIndex].src); 
        }

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }

        function changeImage(direction) {
            currentIndex += direction;
            if (currentIndex < 0) {
                currentIndex = images.length - 1; // Loop to last image
            } else if (currentIndex >= images.length) {
                currentIndex = 0; // Loop to first image
            }
            
            const modalImage = document.getElementById("modalImage");
            const caption = document.getElementById("caption");
            
            modalImage.src = images[currentIndex].src;
            caption.innerText = images[currentIndex].caption;
        }
    </script>
</body>
</html>
