<?php
  session_start();
  include 'default.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/setting.css">
    <title></title>
  </head>
  <body>
    <div id="DialogOutSignin">
      <div id="SignInForm">
        <div id="SignInFormContents">
          <form action="SettingProgress.php" method="post">
            <fieldset class="inputs">
              <input type="text" class="defaultInput" name="id_input" value=<?php echo $_SESSION['okID']; ?> disabled><br>
              <input type="password" class="defaultInput" name="pw_input" placeholder="PASSWORD" required><br>
              <input type="text" class="defaultInput" name="name_input" placeholder="NAME" required><br>
              <!-- <input type="date" class="defaultInput" name="btday_input" placeholder="BIRTHDAY"><br> -->
              <input type="text" class="defaultInput" name="btday_input" onfocus="(this.type='date')" onblur="(this.type='text')"placeholder="BIRTHDAY" required>
            </fieldset>
            <hr />
            <fieldset class="colorPick">
              <label>REALLY GOOD! </label><input type="color" name="em1Pick" value="#ff9898" required>
              <label>GOOD </label><input type="color" name="em2Pick" value="#ffd398" required>
              <label>NOT BAD </label><input type="color" name="em3Pick" value="#fff898" required><br /><br />
              <label>ANGRY </label><input type="color" name="em4Pick" value="#b3ff98" required>
              <label>SAD </label><input type="color" name="em5Pick" value="#98b2ff" required>
              <label>BAD </label><input type="color" name="em6Pick" value="#bf98ff" required>
            </fieldset>
            <fieldset class="buttons">
              <button class="buttonInput" type="button" onclick="location.href='mydiary.php'">취소</button>
              <input type="submit" class="buttonInput" id="signinBtn" name="submit_signin" value="정보수정">
              <input type="reset" class="buttonInput" name="reset_form" value="리-셋">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
