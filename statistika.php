<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="script.js"></script>
      <script src="chart.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Statistika</title>
  </head>
  <body>
    <?php include('nav-bar.php'); ?>
    <div class="links">
        <a href="statistika.php" class="selectedLink"> Statistika</a>
        <a href="aine.php" class="lingid" >Aine</a>
        <a href="kalender.php" class="lingid">Kalender</a>
        <a href="seaded.php" class="lingid"> Seaded</a>
    </div>

    <canvas id="barChart"></canvas>
    <canvas id="pieChart"></canvas>
    <canvas id="radarChart"></canvas>


    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'line',

            data: {
                labels: ['Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev', 'Pühapäev'],
                datasets: [{
                    label: 'Selle nädala aktiivsus',
                    backgroundColor: 'rgb(62,162,255)',
                    borderColor: 'rgb(62,162,255)',
                    data: [0, 4, 1, 2, 6, 1, 24]
                }]
            },

            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    display: true,

                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 7
                            // hiljem peaks võtma väärtuste min ja max väärtused ja siia panema
                        }
                    }]
                },
                "hover": {
                    "animationDuration": 0
                },
                "animation": {
                    "onComplete": function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                },
                title: {
                    display: false,
                    text: ''
                },
            },
        });

        var ctx = document.getElementById('pieChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'pie',

            data: {
                labels: ['Vähem aega kulutatud', 'Rohkem aega kulutatud'],
                datasets: [{
                    label: 'Selle nädala aktiivsus',
                    backgroundColor: [
                        'rgb(255,54,44)',
                        'rgb(158,156,160)'
                        ],
                    borderColor: 'rgb(158,156,160)',
                    data: [25,300]
                }]
            },

            options: {}
        });

        var ctx = document.getElementById('radarChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'radar',

            data: {
                labels: ['Matemaatika', 'Java', 'PHP', 'Tarkvara testimine'],
                datasets: [{
                    label: 'Erinevatele ainetele kulutatud aeg',
                    data: [1, 3, 2, 5],
                    backgroundColor: [
                        'rgba(255,54,44,0.5)'
                    ],
                    borderColor: 'rgba(255,54,44,0.5)',
                }]
            },

            options: {

                scale: {
                    ticks: {
                        beginAtZero: true,
                        max: 5,
                        min: 0,
                        stepSize: 1
                    }
                }


            }
        });


    </script>
    
  </body>
</html>