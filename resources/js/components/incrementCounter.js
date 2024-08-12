export default function incrementCounter() {// Function to increment the counter
        const counterElements = document.querySelectorAll('.customerCounter');
        counterElements.forEach((counterElement) => {
            let currentCount = parseInt(counterElement.textContent);
            const targetCount = parseInt(counterElement.getAttribute('data-target')); // Set the target count
            if(targetCount < 1){
                return;
            }
            const incrementInterval = 1; // Adjust the interval as needed (in milliseconds)
            const incrementStep = 1; // Adjust the increment step as needed

            const incrementTimer = setInterval(() => {
                currentCount += incrementStep;
                counterElement.textContent = currentCount;

                if (currentCount >= targetCount) {
                    clearInterval(incrementTimer); // Stop when reaching the target count
                }
            }, incrementInterval);
        }
    )}
console.log('success 2')
    // Call the incrementCounter function when the page loads
    window.onload = incrementCounter();
