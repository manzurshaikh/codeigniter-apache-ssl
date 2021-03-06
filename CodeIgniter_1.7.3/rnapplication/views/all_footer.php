<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url("js/dist/jquery-3.3.1.min.js"); ?>"></script>
    <script src="<?php echo base_url("js/dist/popper.min.js"); ?>"></script>
    <script src="<?php echo base_url("js/dist/bootstrap.min.js"); ?>"></script>

    <!-- Icons -->
    <script src="<?php echo base_url("js/dist/feather.min.js"); ?>"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="<?php echo base_url("js/dist/Chart.min.js"); ?>"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  

	</body>
</html>