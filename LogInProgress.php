<?php
  session_start();
  include 'default.php';
  header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
?>
<script type="text/javascript">
  window.onload = function () {
    <?php
      $id_send = $_POST['idLogin'];
      $pw_send = $_POST['pwLogin'];


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
    ?>
    window.location.href="MyDiary.php?tableID=<?php echo $dateID; ?>&sqlSent="
                                +  "select * from eachrecord where id ='<?php echo $id_send; ?>' and todayblock ='<?php echo $dateID; ?>'"
    <?php
  }else{ ?>
        swal({
          title : "로그인 실패",
          text : "아이디와 비밀번호를 다시 확인해주세요",
          confirmButtonColor : " #A99F92",
        }).then(function() {
          window.location.href="index.php";
        })
    <?php  }
    ?>
  }
</script>

<!DOCTYPE html>
<html>
  <head>
    <title>로그인 진행 중</title>
    <link rel="stylesheet" href="./css/default.css?ver1">
    <link rel="shortcut icon" href="./image/logoforpages" />
    <link rel="icon" href="./image/logoforpages.png">

  </head>
  <body></body>
</html>
