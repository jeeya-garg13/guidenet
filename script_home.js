// Array of images
const images = [
    'bvo.png',  // Replace with actual image paths
    'bv1.jpg',
    'bv2.jpeg',
    'bv3.jpeg'
];

let currentIndex = 0;
const heroSection = document.querySelector('.hero');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

// Function to update background image
function updateBackground(index) {
    heroSection.style.backgroundImage = `url('${images[index]}')`;
}

// Auto-slide every 5 seconds
function autoSlide() {
    currentIndex = (currentIndex + 1) % images.length;
    updateBackground(currentIndex);
}

// Manual navigation
prevButton.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateBackground(currentIndex);
});

nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % images.length;
    updateBackground(currentIndex);
});

// Keyboard navigation
document.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowLeft') {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateBackground(currentIndex);
    } else if (event.key === 'ArrowRight') {
        currentIndex = (currentIndex + 1) % images.length;
        updateBackground(currentIndex);
    }
});

// Start the slider
updateBackground(currentIndex);
setInterval(autoSlide, 2000);

document.addEventListener("DOMContentLoaded", function() {
    const columns = document.querySelectorAll(".image-column");
    
    columns.forEach(column => {
        const slides = column.querySelectorAll(".slide");
        let currentIndex = 0;
        let interval;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove("active"));
            slides[index].classList.add("active");
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        column.addEventListener("mouseenter", () => {
            interval = setInterval(nextSlide, 1000);
        });

        column.addEventListener("mouseleave", () => {
            clearInterval(interval);
            currentIndex = 0;
            showSlide(0);
        });
    });
});

function startSlideshow(containerId) {
    let index = 0;
    const Slides = document.querySelectorAll(`#${containerId} .slidE`);
    
    setInterval(() => {
        Slides[index].style.opacity = 0;
        index = (index + 1) % Slides.length;
        Slides[index].style.opacity = 1;
    }, 3000);
}

startSlideshow("slider1");
startSlideshow("slider2");
startSlideshow("slider3");