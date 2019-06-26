<?php
  session_start();
  include 'default.php';

  $id = $_SESSION['okID'];

    $sqlColor = "select rg, good, nb, sad, angry, bad from signin where id = '$id'";
    $resultColor = $connect->query($sqlColor);
    while($getColors = mysqli_fetch_assoc($resultColor)){
      $rgColor = $getColors['rg'];
      $goodColor = $getColors['good'];
      $nbColor = $getColors['nb'];
      $sadColor = $getColors['sad'];
      $angryColor = $getColors['angry'];
      $badColor = $getColors['bad'];
    }
  // $monthlyMax = array();

  $rgCnt = 0; $goodCnt = 0; $nbCnt = 0; $sadCnt = 0; $angryCnt = 0; $badCnt = 0;

  for ($i = 0; $i < 12; $i++) {
      $key = $i+1;

      $sql = "select todayfeel, todayblock from eachrecord where id = '$id' and todaymonth = '$key';";
      $result = $connect->query($sql);
      $row = mysqli_affected_rows($connect);
      clearFeels();
      getFeels($result, $key);
  }
?>

<?php
  // DB에 저장된 감정들을 월별로 누적하여 저장
  function getFeels($result, $key) { // sql문을 실행한 결과가 저장된 변수와 월(1월~12월) 받아옴
      $rbCnt = 0; $goodCnt = 0; $nbCnt = 0; $sadCnt = 0; $angryCnt = 0; $badCnt = 0;
      //  $sql = "select todayfeel, todayblock from eachrecord where id = '$id' and todaymonth = '$key';";
      // 결과가 존재하는 동안 결과를 객체 형태로 받아와 $monthResult에 대입
      while ($monthResult = mysqli_fetch_assoc($result)) {
        switch ($monthResult['todayfeel']) { // todayfeel에 따라 누적
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
      } // while

      countFeel($rgCnt, $goodCnt, $nbCnt, $sadCnt, $angryCnt, $badCnt, $key); // countFeel에 누적한 변수들과 월 보냄
  }// function getFeels


  // 가장 많이 느낀 감정을 계산하는 함수
  function countFeel($rg, $good, $nb, $sad, $angry, $bad, $month) {
      $maxCnt = 0;

      //우선 값이 들어있는지 확인한 후 값이 하나라도 있으면 최대값을 구함
      if (max($rg, $good, $nb, $sad, $angry, $bad) != null) {
          $maxCnt = max($rg, $good, $nb, $sad, $angry, $bad);
      }

      // 이 함수 밖에서도 사용할 것이기 때문에 global 변수로 선언
      // 월별 가장 많이 느낀 감정의 수가 저장될 배열
      global $monthlyMax;
      $monthlyMax[$month] = $maxCnt;

      // 월별 가장 많이 느낀 감정의 인덱스가 저장될 배열
      // 추후 인덱스에 맞춰 텍스트로 변경
      global $monthlyFeel;

      // $monthlyFeel에 넣기 위해 잠시 배열 형태로 저장해둘 변수 $temp
      $temp = array($rg, $good, $nb, $sad, $angry, $bad);

      if ($maxCnt != 0) {
        $j = 0;
        for($j = 0; $j < 6; $j++){
            //echo $temp[$j]."<br />";
            if($temp[$j] == $maxCnt){
                $monthlyFeel[$month][$j] = $temp[$j];
            } // if($temp[$j] == $maxCnt)
        } // for j
      }// if $maxCnt
  } // function countFeel


  function clearFeels()
  {
      $rgCnt = 0;
      $goodCnt = 0;
      $nbCnt = 0;
      $sadCnt = 0;
      $angryCnt = 0;
      $badCnt = 0;
  } // clearFeels();

  function monthFeelDiary() {

  }

  function getDiary($i){
    return $i;
  }
  ?>

  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>읽기일기 월별통계</title>
      <link rel="stylesheet" href="./css/monthly.css?ver=1">
      <link rel="stylesheet" type="text/css" href="./css/mydiary.css?ver1">
      <link rel="shortcut icon" href="./image/logoforpages" />
      <link rel="icon" href="./image/logoforpages.png">

      <style media="screen">
        .outerDiv{
            text-align: center;
            background: #A99F92;
        }
        .monthly{
            width: 25vw;
            height: 17vw;
            margin: 2vh;
            padding: 2vh;
            display: inline-block;
            color: rgba(255, 255, 255, 0.61);
            font-size: 5rem;
            text-align: center;
            line-height: 15vw;
            background-color: rgb(227, 227, 227);
          }
      </style>
    </head>
    <body>
      <header id="header">
        <nav class="links" style="--items: 5;">
          <div class="dropdown">
            <a href="#" class="menutag"  >기분별 색</a>
              <!-- <button type="button" class="dropbtn">기분별 색</button> -->
              <div class="dropdown-content">
              <a href="#" id="dropRG">아주 좋아요</a>
              <a href="#" id="dropGOOD">좋아요</a>
              <a href="#" id="dropNB">나쁘지 않아요</a>
              <a href="#" id="dropANGRY">화나요</a>
              <a href="#" id="dropSAD">슬퍼요</a>
              <a href="#" id="dropBAD">나빠요</a>
            </div>
          </div>
          <a href="monthly.php" class="menuhover"  >월별통계</a>
          <a href="MyDiary.php" class="menulogo">
            <center><img id = "logo" src="image/logo2-1.png" width="200vw" height="60vh" align="center"></center>
          </a>
          <a href="Setting.php" class="menuhover"  >정보수정</a>
          <a href="Logout.php" class="menuhover" >로그아웃</a>
          <span class="line"></span>
        </nav>
      </header>

    <?php
      $sqlForColors = "select * from signin where id = '$id';";
      $resultForColors = $connect->query($sqlForColors);
      while ($getColor = mysqli_fetch_assoc($resultForColors)) {
        $reallygood = $getColor['rg'];
        $good = $getColor['good'];
        $nb = $getColor['nb'];
        $sad = $getColor['sad'];
        $bad = $getColor['bad'];
        $angry = $getColor['angry'];
        echo "<script>
               document.getElementById('dropRG').style.background = '$reallygood';
               document.getElementById('dropGOOD').style.background = '$good';
               document.getElementById('dropNB').style.background = '$nb';
               document.getElementById('dropSAD').style.background = '$sad';
               document.getElementById('dropBAD').style.background = '$bad';
               document.getElementById('dropANGRY').style.background = '$angry';
        </script>";
      }
    ?>

      <?php

        for ($i = 1; $i < count($monthlyMax)+1; $i++) {
          $sqlForMonthly = "select todaydiary from eachrecord where todaymonth=$i";
          $resultforMonthly = $connect->query($sqlForMonthly);
          $rowDiary = mysqli_affected_rows($connect);
          $getDiary = array();
          $j = 0;
            while ($monthResultGetFeels = mysqli_fetch_assoc($resultforMonthly)) {
              $getDiary[$j++] = $monthResultGetFeels['todaydiary'];
            }
            if ($i == 1) {
                echo "<div class='outerDiv'>";
            }
            if ($i == 5 || $i == 9) {
                echo "</div>";
                echo "<div class='outerDiv'>";
            }
            /*echo "<h1 class='monthlyH1' id='monthlyH1".$i."'>".getDiary($i)."</h1>";*/
            echo "<div class='monthly' id='month".$i."'>".$i."</div>
                    <div class='DialogOutMonthly' id='DialogOutMonthly".$i."'>
                      <div class='monthlyDialogIn' id='monthlyDialogIn".$i."'>
                        <span class='closeMonthly' id='closeMonthly".$i."'>&times;</span>
                        <div class='monthlyDialogContent' id='monthlyDialogContent".$i."'>
                          <div id='monthlyDiary".$i."'>
                          </div>
                        </div>
                      </div>
                    </div>";
            if ($i == 12) {
                echo "</div>";
            }?>
            <script type="text/javascript">
            //var feels = new Array();
            var feels = new Array();
            var feelsString = new Array();
            var cnt = 0;
            var monthlyID = '<?php echo 'month'.$i ?>';
            </script>
            <?php
            for($j = 0; $j < 6; $j++){
              if($monthlyFeel[$i][$j]){
            ?>
          <script type="text/javascript">
            console.log("i : " + <?php echo $i ?> + " j : " + <?php echo $j ?>);
            var monthlyFeel = '<?php echo count($monthlyFeel[$i][$j]) ?>';
            var month = '<?php echo $i ?>';
            var type = '<?php echo $j ?>';
            if(type == 0){
              feels[cnt] = "<?php echo $rgColor ?>";
              feelsString[cnt] = "REALLY GOOD";
            }else if(type == 1){
              feels[cnt] = "<?php echo $goodColor ?>";
              feelsString[cnt] = "GOOD";
            }else if(type == 2){
              feels[cnt] = "<?php echo $nbColor ?>";
              feelsString[cnt] = "NOT BAD";
            }else if(type == 3){
              feels[cnt] = "<?php echo $sadColor ?>";
              feelsString[cnt] = "SAD";
            }else if(type == 4){
              feels[cnt] = "<?php echo $angryColor ?>";
              feelsString[cnt] = "ANGRY";
            }else if(type == 5){
              feels[cnt] = "<?php echo $badColor ?>";
              feelsString[cnt] = "BAD";
            }
            cnt++;
            //console.log(feels);
          </script>
      <?php
    }// if $monthlyFeel
  } // for j
    if(count($monthlyFeel[$i])<2){?>
      <script type="text/javascript">
      document.getElementById(monthlyID).style.backgroundColor = feels.toString();
      //titleH1.innerHTML = feelsString.toString();
      </script>
  <?php
}else{?>
  <script type="text/javascript">
    //console.log(feels.toString());
            document.getElementById(monthlyID).style.backgroundImage = "linear-gradient(to right, "+feels.toString()+")";
            //titleH1.innerHTML = feelsString.toString();

  </script>
<?php }
        } // for i
      ?>
      <div style="padding:15px"></div>
      <?php
        echo '<br>';
        include 'chart.php';
      ?>
    </body>
  </html>
