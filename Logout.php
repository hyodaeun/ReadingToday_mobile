<?php

session_start();

session_unset();
session_destroy();

?>
<meta http-equiv='refresh' content='0;url=index.php'>
<?php
    echo "<script>alert('로그아웃 성공'); location.href='index.php';</script>";
 ?>
