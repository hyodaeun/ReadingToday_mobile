<?php

header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ERROR | E_PARSE);

// mysql 로그인 명령문 있는 default.php 파일을 모든 파일에 include
$connect = mysqli_connect('localhost', 'root', '000000', 'readingdiary', 3307);

?>
