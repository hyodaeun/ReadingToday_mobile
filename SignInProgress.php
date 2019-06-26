<?php
  include 'default.php';
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
?>
  <script type="text/javascript">
    window.onload = function () {
      <?php
      $id_input = $_POST['id_input'];
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


      $sql = "insert into signin(id, pw, name, btday, rg, good, nb, angry, sad, bad)
              values('$id_input', '$pw_input', '$name_input', '$reset_btday_input',
              '$em1_input', '$em2_input', '$em3_input', '$em4_input', '$em5_input', '$em6_input')";
      $result = mysqli_query($connect, $sql);
      $row = mysqli_affected_rows($connect);

      if($row){ ?>
        swal({
          title : "회원가입 완료",
          text : "로그인해주세요",
        }).then(function() {
          window.location.href="index.php";
        })
    <?php  }else{ ?>
      swal({
        title : "회원가입 실패",
        text : "내용을 다시 확인해주세요",
      }).then(function() {
        window.location.href="index.php";
      })
    <?php  }
    ?>
    }
  </script>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>회원가입 진행 중</title>
    <link rel="stylesheet" href="./css/default.css?ver1">
    <link rel="shortcut icon" href="./image/logoforpages" />
    <link rel="icon" href="./image/logoforpages.png">

  </head>
  <body>

  </body>
</html>
