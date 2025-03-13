import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    // Value Trend Chart
    const valueTrendCtx = document.getElementById('valueTrendChart');
    if (valueTrendCtx) {
        const trendData = JSON.parse(valueTrendCtx.dataset.trends);
        new Chart(valueTrendCtx, {
            type: 'line',
            data: {
                labels: trendData.map(item => item.month),
                datasets: [
                    {
                        label: 'Total Value',
                        data: trendData.map(item => item.value),
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Asset Count',
                        data: trendData.map(item => item.count),
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Department Distribution Chart
    const departmentCtx = document.getElementById('departmentChart');
    if (departmentCtx) {
        const departmentData = JSON.parse(departmentCtx.dataset.statistics);
        new Chart(departmentCtx, {
            type: 'pie',
            data: {
                labels: departmentData.map(item => item.name),
                datasets: [{
                    data: departmentData.map(item => item.count),
                    backgroundColor: [
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                        '#6366F1',
                        '#8B5CF6',
                        '#EC4899'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const percentage = departmentData[context.dataIndex].percentage;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        const statusData = JSON.parse(statusCtx.dataset.statistics);
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: statusData.map(item => item.status),
                datasets: [{
                    data: statusData.map(item => item.count),
                    backgroundColor: [
                        '#10B981',
                        '#3B82F6',
                        '#F59E0B'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const percentage = statusData[context.dataIndex].percentage;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
});