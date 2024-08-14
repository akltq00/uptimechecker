<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uptime Kontrol Paneli</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Uptime Kontrol Paneli</h1>
        <canvas id="uptimeChart"></canvas>
    </div>

    <script>
        async function fetchData() {
            const response = await fetch('getdata.php');
            return await response.json();
        }

        async function renderChart() {
            const data = await fetchData();
            const labels = data.map(entry => entry.date);
            const uptime = data.map(entry => entry.uptime);

            const ctx = document.getElementById('uptimeChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Uptime %',
                        data: uptime,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 100
                        }
                    }
                }
            });
        }

        renderChart();
    </script>
</body>
</html>
