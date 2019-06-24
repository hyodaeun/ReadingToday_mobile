<?php

include 'default.php';
session_start();
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

date_default_timezone_set('Asia/Seoul');
$todayDate = date('Y-m-d', time());
$dateSeperateMonth = substr($todayDate, 5, 2);
if (!(strcmp(substr($dateSeperateMonth, 0, 1), "0"))) {
    $dateSeperateMonth = substr($dateSeperateMonth, 1);
}
$dateSeperateDay = substr($todayDate, 8, 2);
if (!(strcmp(substr($dateSeperateDay, 0, 1), "0"))) {
    $dateSeperateDay = substr($dateSeperateDay, 1);
}
$dateID = 'date'.$dateSeperateMonth.$dateSeperateDay;

$pw = $_GET['id'];
$name = $_GET['name'];
$id = $_GET['birth'];
$nickname = $_GET['pw'];

$sql = "insert into signin(id, pw, name, btday, rg, good, nb, angry, sad, bad)
      values('$id', '$pw', '$name', 'null','#ff989', '#ffd398', '#fff898', '#b3ff98', '#98b2ff', '#bf98ff')";
$result = mysqli_query($connect, $sql);
$row = mysqli_affected_rows($connect);

if($row){ // 위 쿼리문의 결과가 있으면
  $_SESSION['okID'] = $id;
  $_SESSION['okPW'] = $pw;
  echo "<script>alert('$id'+' ' + '$pw');</script>"; // 메인 화면으로
?>
<script>  window.location.href="MyDiary.php?tableID='<?php echo $dateID; ?>'&sqlSent="
                        +  "select * from eachrecord where id ='<?php echo $id; ?>' and todayblock ='<?php echo $dateID; ?>'"</script>
<?php } else{
  echo "<script>alert('naver로그인 실패'); location.href='index.php'</script>";
} ?>
