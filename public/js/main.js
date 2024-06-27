
document.addEventListener('DOMContentLoaded', function() {
    // Example sales data for the last month
    const salesData = [150, 200, 180, 220, 170, 190, 230, 210, 250, 300, 280, 320, 310, 340, 370, 400, 380, 420, 410, 430, 450, 470, 480, 500, 520, 540, 560, 580, 600, 620];
    const labels = Array.from({ length: salesData.length }, (_, i) => `Day ${i + 1}`);

    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line', // You can change this to 'bar', 'pie', etc.
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales',
                data: salesData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});