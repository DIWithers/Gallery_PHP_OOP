  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- WYSIWYG - https://alex-d.github.io/Trumbowyg/documentation/ -->
    <script src="../node_modules/trumbowyg/dist/trumbowyg.min.js"></script>
    <!-- Import Trumbowyg plugins...  -->
    <script src="../node_modules/trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.js"></script>
    <script src="../node_modules/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="js/scripts.js"></script>
    <script src="js/dropzone.js"></script>

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Counts'],
          ['Views', <?php echo $session->count; ?>],
          ['Comments',  <?php echo Comment::count_all(); ?>],
          ['Users', <?php echo User::count_all(); ?>],
          ['Photos', <?php echo Photo::count_all(); ?>],

        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
          legend: 'none',
          pieSliceText: 'label',
          backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</body>

</html>
