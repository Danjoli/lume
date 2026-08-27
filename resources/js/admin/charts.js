const CHART_SELECTOR = '[data-admin-chart]';

function parseJson(value, fallback = []) {
    try {
        return JSON.parse(value ?? '');
    } catch {
        return fallback;
    }
}

function tooltipOptions() {
    return {
        backgroundColor: '#FFFFFF',
        titleColor: '#0F172A',
        bodyColor: '#475569',
        borderColor: '#E2E8F0',
        borderWidth: 1,
        cornerRadius: 10,
        padding: 12,
        displayColors: false,
    };
}

function createOrdersLineChart(canvas) {
    const labels = parseJson(canvas.dataset.chartLabels);
    const values = parseJson(canvas.dataset.chartValues);
    const context = canvas.getContext('2d');
    const gradient = context.createLinearGradient(0, 0, 0, 280);

    gradient.addColorStop(0, 'rgba(99,102,241,.10)');
    gradient.addColorStop(.5, 'rgba(99,102,241,.04)');
    gradient.addColorStop(1, 'rgba(99,102,241,0)');

    return new window.Chart(canvas, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Pedidos',
                data: values,
                borderColor: '#6366F1',
                backgroundColor: gradient,
                fill: true,
                borderWidth: 2,
                tension: .10,
                pointRadius: 3,
                pointHoverRadius: 5,
                pointBackgroundColor: '#FFFFFF',
                pointBorderColor: '#6366F1',
                pointBorderWidth: 2,
                clip: 20,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { top: 10, right: 15, bottom: 5, left: 10 } },
            interaction: { mode: 'index', intersect: false },
            plugins: { legend: { display: false }, tooltip: tooltipOptions() },
            scales: {
                x: {
                    offset: true,
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#94A3B8', padding: 14, font: { size: 12, weight: 500 } },
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: 60,
                    border: { display: false },
                    grid: { color: '#EEF2F7', drawBorder: false },
                    ticks: { stepSize: 10, padding: 12, color: '#94A3B8', font: { size: 12, weight: 500 } },
                },
            },
        },
    });
}

function createOrdersStatusChart(canvas) {
    return new window.Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: parseJson(canvas.dataset.chartLabels),
            datasets: [{
                data: parseJson(canvas.dataset.chartValues),
                backgroundColor: parseJson(canvas.dataset.chartColors),
                borderWidth: 0,
                hoverOffset: 4,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '62%',
            plugins: { legend: { display: false }, tooltip: tooltipOptions() },
        },
    });
}

export function initializeAdminCharts() {
    if (typeof window.Chart === 'undefined') {
        return;
    }

    document.querySelectorAll(CHART_SELECTOR).forEach((canvas) => {
        if (canvas.dataset.chartInitialized === 'true') {
            return;
        }

        const chart = canvas.dataset.adminChart === 'orders-line'
            ? createOrdersLineChart(canvas)
            : createOrdersStatusChart(canvas);

        canvas.dataset.chartInitialized = 'true';
        canvas.chartInstance = chart;
    });
}
