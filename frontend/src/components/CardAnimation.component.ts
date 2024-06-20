export default function CardAnimation() {
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.remove("product-card");
          entry.target.classList.add("visible-card");
          observer.unobserve(entry.target); // Stop observing once the animation is applied
        }
      });
    });
  
    // observe cards
    const hiddenCards = document.querySelectorAll(".product-card");
    hiddenCards.forEach((card) => {
      observer.observe(card);
    });
}
  
window.onload = CardAnimation; // Assign the function as a callback without invoking it