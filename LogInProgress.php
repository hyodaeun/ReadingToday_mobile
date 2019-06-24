<?php
  session_start();
  include 'default.php';
  header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

  // 수정 필요 //
  $id_send = $_POST['idLogin'];
  $pw_send = $_POST['pwLogin'];
  // 수정 필요 //

  $sql = "select * from signin where id='$id_send' and pw='$pw_send'";
  $result = $connect->query($sql);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);

  date_default_timezone_set('Asia/Seoul');
  $todayDate = date('Y-m-d', time());
  $dateSeperateMonth = substr($todayDate, 5, 2);
  if (!(strcmp(substr($dateSeperateMonth, 0, 1), "0"))) {
      $dateSeperateMonth = substr($dateSeperateMonth, 1);
  }
  $dateSeperateDay = substr($todayDate, 8, 2);
  $dateID = 'date'.$dateSeperateMonth.$dateSeperateDay;

  if($row){ // 위 쿼리문의 결과가 있으면
    $_SESSION['okID'] = $id_send;
    $_SESSION['okPW'] = $pw_send;
    echo "<script>alert('로그인 성공');</script>"; // 메인 화면으로
?>
    <script>window.location.href="MyDiary.php?tableID=<?php echo $dateID; ?>&sqlSent="
                            +  "select * from eachrecord where id ='<?php echo $id_send; ?>' and todayblock ='<?php echo $dateID; ?>'"</script>
<?php
  }else{
    echo "<script>alert('로그인 실패'); location.href='index.php'</script>";
  }
?>
