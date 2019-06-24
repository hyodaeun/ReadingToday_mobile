<?php
session_start();
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
  include 'default.php';
  $id = $_SESSION['okID'];
  $countSql = "select * from eachrecord where id = '$id';";
  $colorSql = "select * from signin where id = '$id';";
  $countResult = $connect->query($countSql);
  $colorResult = $connect->query($colorSql);
  $rbCnt = 0; $goodCnt = 0; $nbCnt = 0; $sadCnt = 0; $angryCnt = 0; $badCnt = 0; $total = 0;
  $rgColor; $goodColor; $nbColor; $sadColor; $angryColor; $badColor;

  while ($getCount = mysqli_fetch_assoc($countResult)) {
    $total++;
      switch ($getCount['todayfeel']) { // todayfeel에 따라 누적
      case "rg":
        $rgCnt++;
      break;
      case "good":
        $goodCnt++;
      break;
      case "nb":
        $nbCnt++;
      break;
      case "sad":
        $sadCnt++;
      break;
      case "angry":
        $angryCnt++;
      break;
      case "bad":
        $badCnt++;
      break;
    } // switch-case
  //  echo "<script>console.log($rgCnt, $goodCnt, $nbCnt, $sadCnt, $angryCnt, $badCnt)</script>";
  }

  while ($getColor = mysqli_fetch_assoc($colorResult)) {
      $rgColor = $getColor['rg'];
      $goodColor = $getColor['good'];
      $nbColor = $getColor['nb'];
      $sadColor = $getColor['sad'];
      $badColor = $getColor['bad'];
      $angryColor = $getColor['angry'];
  }

  // echo "rg : ".$rgCnt;
  // echo "good : ".$goodCnt;
  // echo "nb : ".$nbCnt;
  // echo "bad : ".$badCnt;
  // echo "sad : ".$sadCnt;
  // echo "angry : ".$angryCnt;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>-->
    <script type="text/javascript" src="https://npmcdn.com/chart.js@latest/dist/Chart.bundle.min.js"></script>

  </head>
  <body>
    <canvas id="myChart" width="50" height="3"></canvas>
<script>
var total = Number('<?php echo $total ?>');
console.log('<?php echo $total ?>');
console.log(total, typeof total);
var popTitle = '감정들';
var ctx = document.getElementById('myChart');
Chart.defaults.global.defaultFontFamily = 'Jeju Myeongjo';
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: ['총계'],

        datasets: [
        {
            label: '아주 좋아요',
            data: ['<?php echo $rgCnt ?>'],
            backgroundColor: '<?php echo $rgColor ?>',
            borderWidth: 1
        },{
            label: '좋아요',
            data: ['<?php echo $goodCnt ?>'],
            backgroundColor: '<?php echo $goodColor ?>'
        },{
            label: '나쁘지 않아요',
            data: ['<?php echo $nbCnt ?>'],
            backgroundColor: '<?php echo $nbColor ?>'
        },{
            label: '슬퍼요',
            data: ['<?php echo $sadCnt ?>'],
            backgroundColor: '<?php echo $sadColor ?>'
        },{
            label: '화나요',
            data: ['<?php echo $angryCnt ?>'],
            backgroundColor: '<?php echo $angryColor ?>'
        },{
            label: '나빠요',
            data: ['<?php echo $badCnt ?>'],
            backgroundColor: '<?php echo $badColor ?>'
        },
      ]
    },
    options: {
      scales: {
        xAxes: [{
            stacked: true,
            gridLines: {
                display: false,
                drawBorder: false
            },
            ticks : {
              max : total,
              min : 0
            }
        }],
        yAxes: [{
            stacked: true,
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks : {
              max : total,
              min : 0
            }
        }]
      },
      responsive: true,
      legend: {
        display : false
      },
      tooltips: {
          mode: 'nearest',
      }
    }
});
</script>
  </body>
</html>
