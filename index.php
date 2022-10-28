<?php
  require('db.php');
  include("header.php");

  $dbCon = new db();
?>

  <div class="container-fluid">
    <?php
      include('layout/navigation.php');
    ?>
    <section class="main-content">
      <div class="col-6 offset-md-4">
        <div id="chart-container">FusionCharts will render here</div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
    $(function() {
      $.ajax({
        url: "chartData.php",
        type: "GET",
        success: function(data) {
          chartData = data;
          var chartProperties = {
            caption: "Dee Martian Bases Evasions",
            xAxisName: "Martian Bases",
            yAxisName: "Number of Martians",
            rotatevalues: "1",
            theme: "zune"
          };
          apiChart = new FusionCharts({
            type: "column2d",
            renderAt: "chart-container",
            width: "550",
            height: "350",
            dataFormat: "json",
            dataSource: {
              chart: chartProperties,
              data: chartData
            }
          });
          apiChart.render();
        }
      });
    });
  </script>
<?php
  include("footer.php");
?>
  
