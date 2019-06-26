<?php
  session_start();
  include 'default.php';
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
?>
<script type="text/javascript">
window.onload = function () {
  <?php
  $selectFeel = $_POST['select-superpower'];
  $diaryContent = $_POST['diary'];

//  $testID = "alice2431";
  $testID = $_SESSION["okID"];                //session id 값 받아오기 !!
  $selectBlockId = $_POST["blockId"];


  $blockMonthCheck = substr($selectBlockId, 4);
  if(strlen($blockMonthCheck) == 4){
    $blockMonthCheck = substr($blockMonthCheck, 0, 2);
  }else{
    $blockMonthCheck = substr($blockMonthCheck, 0, 1);
  }

  date_default_timezone_set('Asia/Seoul');
  $todayDate = date('Y-m-d', time());

  $sql = "insert into eachrecord(id, todayfeel, todaydiary, todaydate, todayblock, todaymonth) values('$testID', '$selectFeel', '$diaryContent', '$todayDate','$selectBlockId', '$blockMonthCheck')";
  $result = $connect->query($sql);
  $row = mysqli_affected_rows($connect);

  if($row >= 1){
?>
var url = "MyDiary.php?tableID=<?php echo $selectBlockId; ?>&sqlSent="
                              +  "select * from eachrecord where id ='<?php echo $testID; ?>' and todayblock ='<?php echo $selectBlockId; ?>'";

window.location.href= url;

<?php
}else{ ?>
  swal({
    title : "일기 작성 실패",
    text : "내용을 다시 확인해주세요",
  }).then(function() {
    window.location.href=url;
  })
<?php  }
?>
}
</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>일기 입력 중</title>
    <link rel="stylesheet" href="./css/default.css?ver1">
    <link rel="shortcut icon" href="./image/logoforpages" />
    <link rel="icon" href="./image/logoforpages.png">

  </head>
  <body>

  </body>
</html>
