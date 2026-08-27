const ALERT_SELECTOR = '[data-flash-alert]';
const CLOSE_SELECTOR = '[data-flash-close]';
const DISMISS_DELAY = 6000;
const TRANSITION_DELAY = 200;

function dismissAlert(alert) {
    alert.style.opacity = '0';
    alert.style.transform = 'translateY(-8px)';

    window.setTimeout(() => alert.remove(), TRANSITION_DELAY);
}

export function initializeFlashAlerts() {
    document.querySelectorAll(ALERT_SELECTOR).forEach((alert) => {
        if (alert.dataset.flashInitialized === 'true') {
            return;
        }

        alert.dataset.flashInitialized = 'true';
        alert.style.transition = 'opacity .2s ease, transform .2s ease';

        alert.querySelector(CLOSE_SELECTOR)?.addEventListener('click', () => {
            dismissAlert(alert);
        });

        window.setTimeout(() => dismissAlert(alert), DISMISS_DELAY);
    });
}
