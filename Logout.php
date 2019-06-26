<?php

session_start();

session_unset();
session_destroy();
echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

?>
<meta http-equiv='refresh' content='0;url=index.php'>
<script type="text/javascript">
  window.onload = function () {
    swal({
      title : "로그아웃 성공",
      text : "내일 또 만나요",
    }).then(function() {
      window.location.href="index.php";
    })
  }
</script>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>로그아웃 진행 중</title>
    <link rel="shortcut icon" href="./image/logoforpages" />
    <link rel="icon" href="./image/logoforpages.png">

  </head>
  <body></body>
</html>
