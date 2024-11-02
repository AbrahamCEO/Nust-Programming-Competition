const images = [
    { src: "/IMAGES NUST/SPEAKING1.png", caption: "Opening Ceremony" },
    { src: "/IMAGES NUST/GROUP2.png", caption: "Participants and Judges 2023" },
    { src: "/IMAGES NUST/WINERS.png", caption: "Winners 2023" },
    { src: "/IMAGES NUST/SPEAKING2.png", caption: "Sponsors Representative" },
    { src: "/IMAGES NUST/WATCHIG 1.png", caption: "Viewers enjoying Project presentations" },
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
