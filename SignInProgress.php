<?php
$connect = mysqli_connect('localhost', 'root', '000000', 'readingdiary', 3307);

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

  if($row){
    echo "<script>alert('회원가입 성공'); location.href='index.php';</script>";
  }else{
    echo "<script>alert('회원가입 실패'); location.href='index.php';</script>";
  }
?>
