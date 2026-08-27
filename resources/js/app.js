import './bootstrap';
import { initializeAdminCharts } from './admin/charts';
import { initializeFlashAlerts } from './flash-alerts';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

initializeFlashAlerts();

if (document.readyState === 'complete') {
    initializeAdminCharts();
} else {
    window.addEventListener('load', initializeAdminCharts, { once: true });
}
