<?php
  session_start();
  include 'default.php';

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
    echo "<script>alert('입력 성공');</script>";
?>
      <script>  window.location.href="MyDiary.php?tableID=<?php echo $selectBlockId; ?>&sqlSent="
                              +  "select * from eachrecord where id ='<?php echo $testID; ?>' and todayblock ='<?php echo $selectBlockId; ?>'"</script>

<?php
  }else{
    echo "<script>alert('입력 실패'); location.href='MyDiary.php';</script>";
  }
?>
