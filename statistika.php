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
        <a href="statistika.php"><button class="lingid">Statistika</button></a>
        <a href="aine.php"><button class="lingid">Aine</button></a>
        <a href="kalender.php"><button class="lingid">Kalender</button></a>
        <a href="seaded.php"><button class="lingid">Seaded</button></a>
    </div>

    <canvas id="barChart"></canvas>
    <canvas id="pieChart"></canvas>

    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'bar',

            data: {
                labels: ['Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev', 'Pühapäev'],
                datasets: [{
                    label: 'Selle nädala aktiivsus',
                    backgroundColor: 'rgb(62,162,255)',
                    borderColor: 'rgb(62,162,255)',
                    data: [0, 4, 1, 2, 6, 1, 0]
                }]
            },

            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    display: true,

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



    </script>
    
  </body>
</html>