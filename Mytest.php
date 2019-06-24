<?php
session_start();
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
  include 'default.php';
        // id 불러오는 부분 수정 필요
        $id = $_SESSION['okID'];
        // $id = id;
        $sql = "select * from eachrecord where id = '$id';";
        $result = $connect->query($sql);
        $row = mysqli_affected_rows($connect);
        $tableID = $_GET["tableID"];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="./css/mytest.css?ver1">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--여기까지-->

</head>

<body>
    <!--0516효은수정-->

    <header id="header">
	<nav class="links" style="--items: 5;">
		<a href="#">기분색상</a>
		<a href="#">월별통계</a>
        <a href="index.php"><img src="image/logo2-1.png" width="210vw" height="80vh"></a>
		<a href="#">정보수정</a>
		<a href="#">로그아웃</a>
		<span class="line"></span>
	</nav>
    </header>
    <!--여기까지-->
 <form action="Logout.php" method="post">
  <!--0430효은수정-->
  <div class="navigation">
    <input type="submit" name="logout" id="idLogout" value="로그아웃">
    <div class="logout">LOGOUT</div>
  </div><br/>
  <a href="Setting.php">정보 수정</a>
  </form>
  <!--여기까지-->

  <!--이미지 로고 추가-->
    <!--0516효은수정
     <div class="header"><img src="image/logo2.png" class="logo"></div>-->
     <!--오늘 날짜로 돌아가는 버튼 기능 추가-->
     <div class="btn today" onclick="totoday()">Today</div>

    <div class="mainTable">
        <!-- 05-13 효은 수정(모바일용 테이블) -->
      <!--<table class="tables" id="tables">
        <tr class="firstLine" id="slash">
          <td></td>
          <td>J</td>
          <td>F</td>
          <td>M</td>
          <td>A</td>
          <td>M</td>
          <td>J</td>
          <td>J</td>
          <td>A</td>
          <td>S</td>
          <td>O</td>
          <td>N</td>
          <td>D</td>
        </tr>
        <script type="text/javascript">
          var x = 31;
          var n = 0;
          var day = 0;
          for (i = 1; i < 32; i++) { // 테이블 그리는 JS문
            document.write("<tr>");
            document.write("<td>"+i+"</td>")
            for(j = 1; j < 13; j++){
              var idSet = String(j) + String(i);
              document.write("<td id='date" + idSet + "'></td>");
            }
            document.write("</tr>");
          };
        </script>
      </table>-->

        <!-- 05-13 효은 수정(웹용 테이블) -->
        <table class="tables" id="tables" >
          <tr class="firstLine" id="slash">
              <td></td>
          <script type="text/javascript">
            for (i = 1; i < 32; i++) { // 테이블 그리는 JS문
              document.write("<td>"+i+"</td>")
            };
          </script>
          </tr>
          <tr>
          <script type="text/javascript">
            var Mon = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            for (i = 0; i < Mon.length; i++) { // 테이블 그리는 JS문
              document.write("<tr>");
              document.write("<td>"+Mon[i]+"</td>")
              for(j = 1; j < 32; j++){

                if (j < 10){
                  j = "0"+String(j);
                }else{
                  j = String(j);
                }
                var idSet = String(i+1) + j;
                document.write("<td id='date" + idSet + "'></td>");
              }

              document.write("</tr>");
            };
          </script>
          </tr>
        </table>
    </div>

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
              ////////////////////////////////////////////
              // //////////////// todaydate에서 가져온 날짜 가공하여 테이블 ID 만들기 ///////////////
              // $dateSeperateMonth = substr($dateGet, 5, 2);
              // if (!(strcmp(substr($dateSeperateMonth, 0, 1), "0"))) {
              //     $dateSeperateMonth = substr($dateSeperateMonth, 1);
              // }
              // $dateSeperateDay = substr($dateGet, 8, 2);
              // if (!(strcmp(substr($dateSeperateDay, 0, 1), "0"))) {
              //     $dateSeperateDay = substr($dateSeperateDay, 1);
              // }
              //
              // $dateID = 'date'.$dateSeperateMonth.$dateSeperateDay;
              // ////////////////////////////////////////////
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
        $("#tables td").click(function() {
          var tableID = $(this).attr("id");
          alert(tableID);
          window.location.href="MyDiary.php?tableID="+tableID; // POST 방식으로 php로 js 변수 넘김
        });
      });
    </script>

    <div class="mainForm">
        <?php
        // date_default_timezone_set('Asia/Seoul');
        // $todayDate = date('Y-m-d', time()); // 오늘 날짜를 시스템에서 불러와서
        $sql3 = "select * from eachrecord where id = '$id' and todayblock = '$tableID'"; // 쿼리
          $result3 = $connect->query($sql3);
          $savedRecord = mysqli_fetch_array($result3); // 저장된 레코드 (오늘의 일기가) 있으면
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
        <div class="diaryResult">
            <div class="feelCheck">
            <!--label내용 조금 바꿈-->

              <label class="fCheck1">오늘 하루 기분은 <?php echo $savedFeelingtoWord ?></label>
            </div>
            <!-- 저장된 일기 내용 출력 -->
            <div class="ContentsSaved">
              <?php echo $savedDiary ?>
            </div>
        </div>
        <!--여기까지-->

        <?php
          // "select * from eachrecord where id = $id 쿼리된 문장이 없으면
          } else {
        ?>
        <!-- 폼 띄워서 입력받을 수 있도록 하기 -->
        <div class="box">
        <form class="diaryForm" action="MyDiaryProgress.php" method="post">
            <div class="feelCheck">
                <!-- 05-15 효은 수정-->
              <!-- <label class="fCheck2">오늘 나의 기분</label>
              <select class="colorSelect" name="colorSelect">
                <option selected>오늘의 기분을 선택하세요</option>
                <option value="rg">REALLY GOOD!</option>
                <option value="good">GOOD</option>
                <option value="nb">NOT BAD</option>
                <option value="angry">ANGRY</option>
                <option value="sad">SAD</option>
                <option value="bad">BAD</option>
              </select><br>-->
                <select style="width:300px;height:50px;font-size:25px;margin-top:3vh;">
                    <option selected>기분을 선택하세요!</option>
                    <option value="rg">REALLY GOOD!</option>
                    <option value="good">GOOD</option>
                    <option value="nb">NOT BAD</option>
                    <option value="angry">ANGRY</option>
                    <option value="sad">SAD</option>
                    <option value="bad">BAD</option>
                </select>
            </div>
            <div class="Contents">
            <textarea name="diary" maxlength="1000" class= "diary" id="diary" rows="20" cols="100" placeholder="오늘의 하루는 어땠나요?"></textarea><br>
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

    <?php
          }//else
    ?>
    </div>
</body>

</html>
