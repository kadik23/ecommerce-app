export default function incrementCounter() {
    const counterElements = document.querySelectorAll('.customerCounter');
    counterElements.forEach((counterElement) => {
        let currentCount = 0;
        const targetCount = parseInt(counterElement.getAttribute('data-target')) || 0;
        if(targetCount < 1) {
            counterElement.textContent = targetCount;
            return;
        }
        
        // Clear initial text for animation start
        counterElement.textContent = '0';
        
        const incrementInterval = 15; // Set smooth visual interval
        const incrementStep = Math.max(1, Math.ceil(targetCount / 100)); // Dynamic step size based on target

        const incrementTimer = setInterval(() => {
            currentCount += incrementStep;
            if (currentCount >= targetCount) {
                currentCount = targetCount;
                clearInterval(incrementTimer);
            }
            counterElement.textContent = currentCount;
        }, incrementInterval);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', incrementCounter);
} else {
    incrementCounter();
}
