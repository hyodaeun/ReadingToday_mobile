
<?php
session_start();
include 'default.php';
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
?>
<script type="text/javascript">
  window.onload = function () {
    <?php

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
      }else { ?>
        swal({
          title : "정보 수정 실패",
          text : "비밀번호를 다시 확인해주세요",
        }).then(function() {
          window.location.href="Setting.php";
        })
      <?php }

      if($row){ ?>
        swal({
          title : "정보 수정 완료",
          text : "다시 로그인해주세요",
        }).then(function() {
          window.location.href="index.php";
        })
      <?php }else{ ?>
        swal({
          title : "정보 수정 실패",
          text : "수정할 내용을 다시 확인해주세요",
        }).then(function() {
          window.location.href="Setting.php";
        })
    <?php  }
    ?>

  }
</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>정보수정 진행 중</title>
    <link rel="stylesheet" href="./css/default.css?ver1">
    <link rel="shortcut icon" href="./image/logoforpages" />
    <link rel="icon" href="./image/logoforpages.png">

  </head>
  <body></body>
</html>
