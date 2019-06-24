<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <!--주석 처리한 부분들은 구글 로그인 부분들입니다-->
  <!-- <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="GOOGLEAPIID">
  <script src="https://apis.google.com/js/platform.js" async defer></script> -->
  <title>읽기일기</title>
    <!-- 05-13 효은 수정 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="./css/index.css?ver=2">
  <link rel="shortcut icon" href="#" />

  <!-- <script>
    function onSignIn(googleUser) {
      // Useful data for your client-side scripts:
      var profile = googleUser.getBasicProfile();
      console.log("ID: " + profile.getId()); // Don't send this directly to your server!
      console.log('Full Name: ' + profile.getName());
      console.log('Given Name: ' + profile.getGivenName());
      console.log('Family Name: ' + profile.getFamilyName());
      console.log("Image URL: " + profile.getImageUrl());
      console.log("Email: " + profile.getEmail());

      // The ID token you need to pass to your backend:
      var id_token = googleUser.getAuthResponse().id_token;
      console.log("ID Token: " + id_token);
    };
  </script> -->
</head>

<body>

  <!-- 로그인 팝업 -->
  <div id="DialogOutLogin">
    <div id="loginDialogIn">
      <span id="closeLogin">&times;</span>
      <div id="loginDialogContent">
        <form class="loginForm" action="LogInProgress.php" method="post">
          <input type="text" name="idLogin" id="idLogin" placeholder="ID"><br />
          <input type="password" name="pwLogin" id="pwLogin" placeholder="PASSWORD"><br />
          <input type="submit" name="loginBtn" id="loginBtn" value="로그-인" />
        </form>
        <div id="naverIdLogin"></div>
        <!-- //네이버아이디로로그인 버튼 노출 영역 -->

        <!-- 네이버아디디로로그인 초기화 Script -->
        <script type="text/javascript">
          var naverLogin = new naver.LoginWithNaverId(
            {
              clientId: "vn_zYvQLb3h8LnEuC6Hn",
              callbackUrl: "http://192.168.81.1:82/ReadingToday/LogInNaver.php",
              isPopup: false, /* 팝업을 통한 연동처리 여부 */
              loginButton: {color: "white", type: 3, height: 40} //녹색 큰배너형 높이 40px

            }
          );

          /* 설정정보를 초기화하고 연동을 준비 */
          naverLogin.init();

        </script>
      </div>
    </div>
  </div>


  <!-- 회원가입 팝업 -->
  <div id="DialogOutSignin">
    <div id="SignInForm">
      <span id="closeSignin">&times;</span>
      <div id="SignInFormContents">
        <form action="SignInProgress.php" method="post">
          <fieldset class="inputs">
            <input type="text" class="defaultInput" name="id_input" placeholder="ID"><br>
            <input type="password" class="defaultInput" name="pw_input" placeholder="PASSWORD"><br>
            <input type="text" class="defaultInput" name="name_input" placeholder="NAME"><br>
            <!-- <input type="date" class="defaultInput" name="btday_input" placeholder="BIRTHDAY"><br> -->
            <input type="text" class="defaultInput" name="btday_input" onfocus="(this.type='date')" onblur="(this.type='text')"placeholder="BIRTHDAY">
          </fieldset>
          <hr />
          <fieldset class="colorPick">
            <label>REALLY GOOD! </label><input type="color" name="em1Pick" value="#ff9898">
            <label>GOOD </label><input type="color" name="em2Pick" value="#ffd398">
            <label>NOT BAD </label><input type="color" name="em3Pick" value="#fff898"><br /><br />
            <label>ANGRY </label><input type="color" name="em4Pick" value="#b3ff98">
            <label>SAD </label><input type="color" name="em5Pick" value="#98b2ff">
            <label>BAD </label><input type="color" name="em6Pick" value="#bf98ff">
          </fieldset>
          <fieldset class="buttons">
            <input type="submit" class="buttonInput" id="signinBtn" name="submit_signin" value="회원가입">
            <input type="reset" class="buttonInput" name="reset_form" value="리-셋">
              <!-- 취소 버튼 추가하기
            <input type="button" class="buttonInput" name="cancel_form" value="취-소">-->
          </fieldset>
        </form>
      </div>
    </div>
  </div>

    <!-- 로고 -->
    <div class="logo">
      <img src="image/logo.png" alt="ReadingTodayLogo">
    </div><br />

    <!-- 로그인, 회원가입 버튼 -->
    <div class="mainButtons">
      <input type="button" id="login" name="login" value="로그인">
      <input type="button" id="signin" name="signin" value="회원가입">
    </div>

    <!-- 팝업 열고 닫는 자바스크립트 호출 -->
    <script type="text/javascript" src="./javascript/indexFunctions.js"></script>

</body>

</html>
