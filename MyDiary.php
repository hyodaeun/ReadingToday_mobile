<?php
session_start();
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
  include 'default.php';
  $id = $_SESSION['okID'];

  function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}
 Console_log($id);

  $sql = "select * from eachrecord where id = '$id';";
  $result = $connect->query($sql);
  $row = mysqli_affected_rows($connect);
  $tableID = $_GET["tableID"];
  $sql3 = $_GET["sqlSent"];
?>
<script type="text/javascript">
    console.log("<?php echo $sql3 ?>");
</script>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="./css/mydiary.css?ver7">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="./javascript/mydiaryFunction.js"></script>
    
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v3.3&appId=2226372474098662&autoLogAppEvents=1"></script>
    
  <meta property="og:type" content="website">
    <meta property="og:title" content="읽기일기">
    <meta property="og:description" content="읽기일기의 일기를 공유">

</head>

<body>
    <header id="header">
      <nav class="links" style="--items: 5;">
        <div class="dropdown">
          <a href="#" class="menutag"  >기분별 색</a>
            <!-- <button type="button" class="dropbtn">기분별 색</button> -->
            <div class="dropdown-content">
              <a href="#" id="dropRG">REALLY GOOD</a>
              <a href="#" id="dropGOOD">GOOD</a>
              <a href="#" id="dropNB">NOT BAD</a>
              <a href="#" id="dropANGRY">ANGRY</a>
              <a href="#" id="dropSAD">SAD</a>
              <a href="#" id="dropBAD">BAD</a>
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
    <div class="f_table">
     <table class="tables" id="tables">
        <tr class="firstLine" id="slash">
          <td></td>
          <td>1월</td>
          <td>2월</td>
          <td>3월</td>
          <td>4월</td>
          <td>5월</td>
          <td>6월</td>
          <td>7월</td>
          <td>8월</td>
          <td>9월</td>
          <td>10월</td>
          <td>11월</td>
          <td>12월</td>
        </tr>
        <script type="text/javascript">
          var x = 31;
          var n = 0;
          var day = 0;
          for (i = 1; i < 32; i++) { // 테이블 그리는 JS문
            document.write("<tr>");
            document.write("<td>"+i+"</td>")
            if (i < 10){
              i = "0"+String(i);
            }else{
              i = String(i);
            }
            for(j = 1; j < 13; j++){
              var idSet = String(j) + i;
              document.write("<td id='date" + idSet + "'></td>");
            }
            document.write("</tr>");
          };
        </script>
      </table>
  </div>
    /////
    <?php
      //오른쪽 목록 그리기
      if ($row > 0) {
          // "select * from eachrecord where id = $id
          while ($results = mysqli_fetch_assoc($result)) { // 쿼리된 열이 없을 때까지 반복
              // id 불러오는 부분 수정 필요
              $feelings = $results['todayfeel']; // 쿼리 결과에서 todayfeel 값을 불러옴
              $dateGet = $results['todaydate']; // 쿼리 결과에서 todaydate 값을 불러옴
              ////////////////color setting///////////////
              $sql2 = "select * from signin where id = '$id'";
              $result2 = $connect->query($sql2);
              $feelingsGet = mysqli_fetch_array($result2);
              $tableIDforColor = $results['todayblock'];
              //////////////// 저장되어있던 감정에 따라 칸칸마다 색 설정 ///////////////
            switch ($feelings) {
              case 'rg':
                $cellColor = $feelingsGet['rg'];
              break;
              case 'good':
                $cellColor = $feelingsGet['good'];
              break;
              case 'nb':
                $cellColor = $feelingsGet['nb'];
              break;
              case 'angry':
                $cellColor = $feelingsGet['angry'];
              break;
              case 'sad':
                $cellColor = $feelingsGet['sad'];
              break;
              case 'bad':
                $cellColor = $feelingsGet['bad'];
              break;
            } //colorSwitch
            ////////////////////////////////////////////
            ?>
            <!-- 칸마다 색칠하는 JS 코드 -->
            <script type="text/javascript">
              var cellID = '<?php echo $tableIDforColor; ?>';
              var cellColor = '<?php echo $cellColor; ?>';
              document.getElementById(cellID).style.backgroundColor = cellColor;
            </script>
            <!-- ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ -->
    <?php
          } //while ($results = mysqli_fetch_assoc($result))
      } //if ($row > 0)
    ?>

    <!-- 칸 클릭시 아이디 불러오는 JS 코드 (가공 필요) -->
    <script type = "text/javascript">
      $("document").ready(function() {
        if('<?php echo $tableID ?>'){
            if('<?php echo $tableID ?>' != "undefined"){
              jQuery('#DialogOutLogin').css("display", "block");
              jQuery('#box').css("display", "block");
            }
        }
        $("#tables td").click(function() {
          <?php
          $todayDate = date('Y-m-d', time());
          $dateSeperateMonth = substr($todayDate, 5, 2);
          if (!(strcmp(substr($dateSeperateMonth, 0, 1), "0"))) {
              $dateSeperateMonth = substr($dateSeperateMonth, 1);
          }
          $dateSeperateDay = substr($todayDate, 8, 2);
          $checkToday = $dateSeperateMonth.$dateSeperateDay;
          ?>
            console.log(<?php echo $checkToday ?>);
            var tableID = $(this).attr("id");
            var checkAfterDate = tableID.substr(4);
            if(checkAfterDate > <?php echo $checkToday ?>){
              alert("내일은 아직 오지 않았어요.");
            }else{
            window.location.href="MyDiary.php?tableID="+tableID+"&sqlSent="
                                  +  "select * from eachrecord where id ='<?php echo $id; ?>' and todayblock ='" + tableID+"'"; // POST 방식으로 php로 js 변수 넘김
            }
        });
          
        $("body").click(function() {
          console.log($(event.target).is("#DialogOutLogin"));
          if($(event.target).is("#DialogOutLogin")){
            jQuery('#DialogOutLogin').css("display", "none");
          }
          console.log("clicked");
        });
          
      });
    </script>
    <div class="mainForm">
        <?php
          $result3 = $connect->query($sql3);
          $savedRecord = mysqli_fetch_array($result3); // 저장된 레코드 (오늘의 일기가) 있으면
          $row3 = mysqli_affected_rows($connect);
         // echo "<br />기록 ".$savedRecord;
         echo "<script>console.log('$row3')</script>";
          if ($savedRecord > 0) {
              $savedFeeling = $savedRecord['todayfeel'];
              $savedDiary = $savedRecord['todaydiary'];
              switch ($savedFeeling) { // 불러온 감정을 문자열로 바꾸고
              case 'rg':
                $savedFeelingtoWord = '아주 좋아요';
              break;
              case 'good':
                $savedFeelingtoWord = '좋아요';
              break;
              case 'nb':
                $savedFeelingtoWord = '나쁘지 않아요';
              break;
              case 'bad':
                $savedFeelingtoWord = '나빠요';
              break;
              case 'sad':
                $savedFeelingtoWord = '슬퍼요';
              break;
              case 'angry':
                $savedFeelingtoWord = '화가 나요';
              break;
            } // switch($savedFeeling)
        ?>
        <!-- 출력 -->
        <!-- 0430 효은수정-->
        <!--여기까지-->
    <div id="DialogOutLogin">
    <div id="loginDialogIn">
      <span id="closeLogin">&times;</span>
      <div id="loginDialogContent">
        <div class="box" id="box">
          <div class="diaryResult">
            <div class="feelCheck">
              <label class="fCheck1">오늘 하루 기분은 <?php echo $savedFeelingtoWord ?></label>
            </div>
            <!-- 저장된 일기 내용 출력 -->
            <div class="ContentsSaved">
              <?php echo $savedDiary ?>
            </div>
            <!-- 0524 세연수정 -->
            <div>
          <!--   <a href="javascript:shareFB();" title="facebook 공유">
               <img src="image/facebook_logo.png" width=5%>
            </a>   -->

          <div class="fb-share-button" data-href="http://192.168.81.1:82/ReadingToday/showingColor.php?id=<?php echo substr($cellColor,1,6); ?>" data-layout="button" data-size="large">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F192.168.81.1%3A82%2FReadingToday%2FshowingColor.php%3Fid%3D00ffff&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">공유하기</a>
          </div>
            <a href="javascript:shareTW()" title="twitter 공유">
              <img src="image/twitter.png" width=5%>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        <?php
          // "select * from eachrecord where id = $id 쿼리된 문장이 없으면
          } else {
        ?>
    <div id="DialogOutLogin">
    <div id="loginDialogIn">
      <span id="closeLogin">&times;</span>
      <div id="loginDialogContent">
                <!-- 폼 띄워서 입력받을 수 있도록 하기 -->
        <div class="box" id="box">
        <form class="diaryForm" action="MyDiaryProgress.php" method="post">
            <div class="sel sel--superman">
              <select name="select-superpower" id="select-superpower">
                <option value="" disabled>기분을 선택하세요</option>
                <option value="rg">아주 좋아요</option>
                <option value="good">좋아요</option>
                <option value="nb">나쁘지 않아요</option>
                <option value="sad">슬퍼요</option>
                <option value="angry">화나요</option>
                <option value="bad">나빠요</option>
              </select>
            </div>
            <div class="Contents">
            <textarea name="diary" maxlength="1000" class= "diary" id="diary" placeholder="오늘의 하루는 어땠나요?"></textarea><br>
            <span id="counter">###</span>
            <!-- 글자 수 세는 JS 코드 -->
            <script type="text/javascript">
              $(function() {
                $('#diary').keyup(function(e) {
                  var content = $(this).val();
                  $('#counter').html(content.length + '/1000');
                });
                $('#diary').keyup();
              });
            </script>
                <!-- 코드 출처 : https://zinee-world.tistory.com/237 -->
            </div><br>
            <input class="writeButton" type="submit" name="records" value="일기 쓰기">
            <?php echo "<input type='hidden' name='blockId' value=".$tableID.">"; ?>
        </form>
        </div>
      </div>
    </div>
  </div>
    <?php
          }//else
    ?>
    </div>
    <?php
      include 'chart.php';
    ?>
    <script>
      function shareTW()
      {
        var wurl = "http://192.168.81.1:82/ReadingToday/showingColor.php?id=<?php echo substr($cellColor,1,6); ?>";
        //alert("공유 주소" + wurl);
        window.open("http://twitter.com/intent/tweet?text="+"읽기일기"+"&url="+ wurl);
      }
      </script>
</body>
</html>
