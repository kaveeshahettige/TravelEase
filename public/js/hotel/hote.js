// JavaScript for the slideshow
let slideIndex = 0;

function showSlides() {
    const slides = document.getElementsByClassName("my-slide");
    
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    
    slideIndex++;
    
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    
    slides[slideIndex - 1].style.display = "block";
    
    setTimeout(showSlides, 3000); // Change image every 3 seconds (adjust as needed)
}

showSlides(); // Start the slideshow
