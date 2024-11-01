let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');

let carouselDom = document.querySelector('.carousel');
let SliderDom = carouselDom.querySelector('.list');
let thumbnailBorderDom = carouselDom.querySelector('.thumbnail');
let SliderItemsDom = SliderDom.querySelectorAll('.item');
let timeRunning = 3000;
let timeAutoNext = 7000;

// Automatically append first thumbnail
for (let item of SliderItemsDom) {
    let thumbnailItem = document.createElement('div');
    thumbnailItem.classList.add('item');
    thumbnailItem.appendChild(item.querySelector('img').cloneNode());
    thumbnailBorderDom.appendChild(thumbnailItem);
}

nextDom.onclick = function() {
    showSlider('next');
}

prevDom.onclick = function() {
    showSlider('prev');
}

let runTimeOut;
let runNextAuto = setTimeout(() => {
    nextDom.click();
}, timeAutoNext);

function showSlider(type) {
    let SliderItemsDom = SliderDom.querySelectorAll('.item');
    let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');

    if (type === 'next') {
        // Move the first item to the end
        let firstSliderItem = SliderItemsDom[0];
        let firstThumbnailItem = thumbnailItemsDom[0];

        SliderDom.appendChild(firstSliderItem); // Move the first item to the end
        thumbnailBorderDom.appendChild(firstThumbnailItem); // Move the corresponding thumbnail to the end
        carouselDom.classList.add('next');
    } else {
        // Move the last item to the beginning
        let lastSliderItem = SliderItemsDom[SliderItemsDom.length - 1];
        let lastThumbnailItem = thumbnailItemsDom[thumbnailItemsDom.length - 1];

        SliderDom.prepend(lastSliderItem); // Move the last item to the start
        thumbnailBorderDom.prepend(lastThumbnailItem); // Move the corresponding thumbnail to the start
        carouselDom.classList.add('prev');
    }

    // Remove transition class after a short delay
    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        nextDom.click();
    }, timeAutoNext);
}

// Optional: Prevent rapid clicking from interfering with transitions
nextDom.addEventListener('click', function() {
    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        nextDom.click();
    }, timeAutoNext);
});

prevDom.addEventListener('click', function() {
    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        nextDom.click();
    }, timeAutoNext);
});

