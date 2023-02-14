// Define the Intersection Observer callback function
const observerCallback = (entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const video = entry.target;
            const isMobile = window.innerWidth < 480;
            const src = isMobile ? video.getAttribute('data-src-mobile') : video.getAttribute('data-src-desktop');
            video.src = src;
            observer.unobserve(video);
            video.addEventListener('canplay', () => {
                video.play();
            });
        }
    });
};

// Create an Intersection Observer for each video on the page
const videos = document.querySelectorAll('.bg-video');
videos.forEach(video => {
    const observer = new IntersectionObserver(observerCallback, {
        rootMargin: '0px',
        threshold: 0.1
    });
    observer.observe(video);
});


// Get all the images with the "lazy" class
const lazyImages = document.querySelectorAll('.lazy');

// Create a new IntersectionObserver
const lazyObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
        // Check if the image is intersecting with the viewport
        if (entry.isIntersecting) {
            // Swap out the "src" attribute with the "data-src" attribute
            const img = entry.target;
            img.src = img.dataset.src;

            // Remove the "lazy" class from the image
            img.classList.remove('lazy');

            // Stop observing the image
            lazyObserver.unobserve(img);
        }
    });
});

// Observe all the images with the "lazy" class
lazyImages.forEach((img) => {
    lazyObserver.observe(img);
});
