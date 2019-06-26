<?php
  session_start();
  include 'default.php';
  $bgColor = $_GET["id"];
?>

<script type="text/javascript">
  window.onload = function() {
    var color = "#<?php echo $bgColor ?>";
    document.body.style.background = color;
    var getDiv = document.getElementById("textHere");
    showText(getDiv, color);
}

function showText(getDiv, color){
  getDiv.innerHTML = color;
}
</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      #textHere{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 10rem;
        margin: 0 auto;
        text-align: center;
        vertical-align: middle;
        color: rgba(255, 255, 255, 0.53);
      }
    </style>
    <meta charset="utf-8">
    <title>읽기일기 감정공유</title>
    <link rel="stylesheet" href="./css/default.css?ver1">
    <link rel="shortcut icon" href="./image/logoforpages" />
    <link rel="icon" href="./image/logoforpages.png">

  </head>
  <body>
    <div id="textHere">
    </div>
  </body>
</html>
