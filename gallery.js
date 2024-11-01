let currentImageIndex = null;
const galleryItems = document.querySelectorAll(".gallery-item");

function openLightbox(element) {
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");

    // Get the image element from the clicked item and set its src to the lightbox image
    const img = element.querySelector("img");
    lightboxImg.src = img.src; // Get the src of the image directly
    currentImageIndex = Array.from(galleryItems).indexOf(element);

    // Show the lightbox
    lightbox.style.display = "flex";
}

function closeLightbox(event) {
    // Close lightbox only if clicking outside of the image and buttons
    if (event.target.id === "lightbox") {
        document.getElementById("lightbox").style.display = "none";
    }
}

function nextImage(event) {
    event.stopPropagation(); // Prevents the lightbox from closing
    currentImageIndex = (currentImageIndex + 1) % galleryItems.length;
    const nextImageSrc = galleryItems[currentImageIndex].querySelector("img").src; // Get src directly from the image
    document.getElementById("lightbox-img").src = nextImageSrc;
}

function previousImage(event) {
    event.stopPropagation(); // Prevents the lightbox from closing
    currentImageIndex = (currentImageIndex - 1 + galleryItems.length) % galleryItems.length;
    const prevImageSrc = galleryItems[currentImageIndex].querySelector("img").src; // Get src directly from the image
    document.getElementById("lightbox-img").src = prevImageSrc;
}
