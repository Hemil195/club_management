// Function to highlight the event card based on the current slide index
function highlightEventCard(slideIndex) {
    // Remove the highlight from all event cards
    let eventCards = document.querySelectorAll('.event-card');
    eventCards.forEach(card => card.classList.remove('highlight-event'));

    // Highlight the corresponding event card
    if (eventCards[slideIndex]) {
        eventCards[slideIndex].classList.add('highlight-event');
        // Scroll the event card to the center of the container
        scrollToEventCard(eventCards[slideIndex]);
    }
}

// Function to scroll the event card into view, centered
function scrollToEventCard(card) {
    let container = document.querySelector('.event-container');
    let containerHeight = container.offsetHeight;
    let cardHeight = card.offsetHeight;
    let cardTop = card.offsetTop;
    let scrollPosition = cardTop - (containerHeight / 2) + (cardHeight / 2);

    container.scrollTop = scrollPosition;
}

// Initialize Swiper
let swiper = new Swiper(".mySwiper", {
    loop: true,  // Enables circular looping
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    speed: 1000,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    on: {
        slideChange: function () {
            highlightEventCard(this.realIndex); // Sync event card with the current Swiper slide
        }
    }
});
