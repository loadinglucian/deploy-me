/**
 * Confetti celebration effect using canvas-confetti
 * Auto-triggers on page load
 */

import confetti from 'canvas-confetti';

function randomInRange(min, max) {
    return Math.random() * (max - min) + min;
}

function fireConfetti() {
    const duration = 3000;
    const end = Date.now() + duration;

    const colors = ['#ff6b6b', '#4ecdc4', '#ffe66d', '#95e1d3', '#aa96da', '#0abde3'];

    (function frame() {
        // Launch from left side
        confetti({
            particleCount: 3,
            angle: 60,
            spread: 55,
            origin: { x: 0, y: 0.6 },
            colors: colors
        });

        // Launch from right side
        confetti({
            particleCount: 3,
            angle: 120,
            spread: 55,
            origin: { x: 1, y: 0.6 },
            colors: colors
        });

        if (Date.now() < end) {
            requestAnimationFrame(frame);
        }
    })();

    // Big center burst at the start
    confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 },
        colors: colors
    });

    // Staggered bursts from random positions
    setTimeout(() => {
        confetti({
            particleCount: 50,
            angle: randomInRange(55, 125),
            spread: randomInRange(50, 70),
            origin: { x: randomInRange(0.2, 0.8), y: 0.5 },
            colors: colors
        });
    }, 500);

    setTimeout(() => {
        confetti({
            particleCount: 50,
            angle: randomInRange(55, 125),
            spread: randomInRange(50, 70),
            origin: { x: randomInRange(0.2, 0.8), y: 0.5 },
            colors: colors
        });
    }, 1000);
}

document.addEventListener('DOMContentLoaded', fireConfetti);
