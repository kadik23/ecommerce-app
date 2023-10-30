export default function cardAnimation() {
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // When the card enters the viewport, remove the "product-card" class and add the "visible-card" class
          entry.target.classList.remove("product-card");
          entry.target.classList.add("visible-card");
          observer.unobserve(entry.target); // Stop observing once the animation is applied
        }
      });
    });
  
    // Select all elements with the "product-card" class and observe them
    const hiddenCards = document.querySelectorAll(".product-card");
    hiddenCards.forEach((card) => {
      observer.observe(card);
    });
  }
  
  window.onload = cardAnimation; // Assign the function as a callback without invoking it
  