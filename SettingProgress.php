<?php
session_start();
include 'default.php';

// 수정 필요
  $id_input = $_SESSION['okID'];
  $pw_input = $_POST['pw_input'];
  $name_input = $_POST['name_input'];
  date_default_timezone_set('Asia/Seoul');
  $btday_input = strtotime($_POST['btday_input']);
  $reset_btday_input = date('Y-m-d', $btday_input);
  $em1_input = $_POST['em1Pick'];
  $em2_input = $_POST['em2Pick'];
  $em3_input = $_POST['em3Pick'];
  $em4_input = $_POST['em4Pick'];
  $em5_input = $_POST['em5Pick'];
  $em6_input = $_POST['em6Pick'];


  if($pw_input == $_SESSION['okPW']){
      $sqlforsignin = "update signin set pw = '$pw_input', name='$name_input', btday='$reset_btday_input', rg='$em1_input',
              good='$em2_input', nb='$em3_input', angry='$em4_input', sad='$em5_input', bad='$em6_input' where id = '$id_input'";
      $resultforsignin = mysqli_query($connect, $sqlforsignin);
      $row = mysqli_affected_rows($connect);
  }else {
    echo "<script>alert('비밀번호가 틀렸습니다'); location.href='Setting.php';</script>";
  }



  if($row){
    echo "<script>alert('정보 수정 성공 다시 로그인하세요'); location.href='index.php';</script>";
  }else{
    echo "<script>alert('정보 수정 실패'); location.href='Setting.php';</script>";
  }
?>
