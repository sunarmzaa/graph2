<?php include "db.php"; ?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Stacked Bar Chart</title>
  <link href="https://playground.anychart.com/chartopedia/samples/Stacked_Bar_Chart/iframe" rel="canonical">
  <meta content="Animation,Bar Chart,Bar Graph,Column Chart,Multi-Series Chart,Stacked Chart,Tooltip,Vertical Chart" name="keywords">
  <meta content="AnyChart - JavaScript Charts designed to be embedded and integrated" name="description">
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <link href="css/anychart-ui.min.css" rel="stylesheet" type="text/css">
  <link href="css/anychart-font.min.css" rel="stylesheet" type="text/css">
  <style>html, body, #container {
    width: 98%;
    height: 98%;
    margin: 20px auto;
    padding: 0;
}</style>
 </head>
 <body>
  <div id="container"></div>
  <script src="js/anychart-base.min.js"></script>
  <script src="js/anychart-exports.min.js"></script>
  <script src="js/anychart-ui.min.js"></script>
  <script type="text/javascript">anychart.onDocumentReady(function () {
    // create data set on our data
    var dataSet = anychart.data.set([
      ['', 'number1', 'number2', 'number3'],
        <?php
        $query="select * from people";
        $res=mysqli_query($conn,$query);
        while($data=mysqli_fetch_array($res)){
            $subdistrict=$data['subdistrict'];
            $number1=$data['number1'];
            $number2=$data['number2'];
            $number3=$data['number3'];
            ?>
        ['<?php echo $subdistrict;?>','<?php echo $number1;?>','<?php echo $number2;?>','<?php echo $number3;?>'],
        <?php
        }
        ?>
  ]);

    // map data for the first series, take x from the zero column and value from the first column of data set
    var seriesData_1 = dataSet.mapAs({'x': 0, 'value': 1});

    // map data for the second series, take x from the zero column and value from the second column of data set
    var seriesData_2 = dataSet.mapAs({'x': 0, 'value': 2});

    // map data for the third series, take x from the zero column and value from the third column of data set
    var seriesData_3 = dataSet.mapAs({'x': 0, 'value': 3});

    // map data for the fourth series, take x from the zero column and value from the fourth column of data set
    var seriesData_4 = dataSet.mapAs({'x': 0, 'value': 4});

    // create bar chart
    var chart = anychart.bar();

    // turn on chart animation
    chart.animation(true).barGroupsPadding(0.5);;
    chart.title('การลงทะเบียนของประชากรจังหวัดภูเก็ตแยกตามตำบล');
    chart.title().fontSize(24).fontColor('#000000')
    // set container id for the chart
    chart.container('container');
    chart.padding([10, 40, 5, 20]);

    // set scale minimum
    chart.yScale().minimum(0);

    // force chart to stack values by Y scale.
    chart.yScale().stackMode('value');

    chart.yAxis().labels().format(function () {
        return this.value.toLocaleString();
    });

    // set titles for axises
    chart.xAxis().title('ตำบล');
    chart.yAxis().title('จำนวน (คน)');

    // helper function to setup label settings for all series
    var setupSeriesLabels = function (series, name, color) {
        series.name(name);
        // series.tooltip().valuePrefix('$');
        series.stroke('1 #000000 1');
        series.hovered().stroke('1 #000000 1')
        series.fill(color);;
    };
    chart.labels()
            .enabled(true)
            .position('center-bottom')
            .anchor('center-bottom')
            .format('{%value}{decimalsCount:0} คน')
            .fontColor('black');
  

    // temp variable to store series instance
    var series;

    // create first series with mapped data
    series = chart.bar(seriesData_1);
    setupSeriesLabels(series, 'จำนวนประชากรทั้งหมด', '#98FB98 0.8');

    // create second series with mapped data
    series = chart.bar(seriesData_2);
    setupSeriesLabels(series, 'จำนวนคนที่ลงทะเบียนแล้ว', '#EE964B 0.8');

    // create third series with mapped data
    series = chart.bar(seriesData_3);
    setupSeriesLabels(series, 'คงเหลือ', '#33CCFF 0.8');

    // create fourth series with mapped data
    // series = chart.bar(seriesData_4);
    // setupSeriesLabels(series, 'Nevada');

    // turn on legend
    chart.legend().enabled(true).fontSize(20).padding([0, 0, 20, 0]).fontColor('#000000');
    chart.interactivity().hoverMode('by-x');
    chart.tooltip().displayMode('union');
    // initiate chart drawing
    chart.draw();
});</script>
 </body>
</html>