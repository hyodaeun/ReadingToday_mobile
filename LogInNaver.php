
<?php
	session_start();
	include 'default.php';
	header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

	date_default_timezone_set('Asia/Seoul');
	$todayDate = date('Y-m-d', time());
	$dateSeperateMonth = substr($todayDate, 5, 2);
	if (!(strcmp(substr($dateSeperateMonth, 0, 1), "0"))) {
			$dateSeperateMonth = substr($dateSeperateMonth, 1);
	}
	$dateSeperateDay = substr($todayDate, 8, 2);
	if (!(strcmp(substr($dateSeperateDay, 0, 1), "0"))) {
			$dateSeperateDay = substr($dateSeperateDay, 1);
	}
	$dateID = 'date'.$dateSeperateMonth.$dateSeperateDay;

?>

<!DOCTYPE html>
<!-- 세연 네이버 로그인 창 -->
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>naverLogin</title>
</head>

<body>
	<!-- (1) LoginWithNaverId Javscript SDK -->
	<script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
	<!-- (2) LoginWithNaverId Javscript 설정 정보 및 초기화 -->
	<script>
		var naverLogin = new naver.LoginWithNaverId(
			{
				clientId: "{vn_zYvQLb3h8LnEuC6Hn}",
				callbackUrl: "{http://192.168.81.1:82/ReadingToday/MyDiary.php}",
				isPopup: false,
				callbackHandle: true
				/* callback 페이지가 분리되었을 경우에 callback 페이지에서는 callback처리를 해줄수 있도록 설정합니다. */
			}
		);

		var nicname;
		var birth;
		var name;
		var id;
		var pw;
		var email;
		/* (3) 네아로 로그인 정보를 초기화하기 위하여 init을 호출 */
		naverLogin.init();
		/* (4) Callback의 처리. 정상적으로 Callback 처리가 완료될 경우 main page로 redirect(또는 Popup close) */
		window.addEventListener('load', function () {
			naverLogin.getLoginStatus(function (status) {
				if (status) {
					/* (5) 필수적으로 받아야하는 프로필 정보가 있다면 callback처리 시점에 체크 */
				  //email = naverLogin.user.getEmail(); 		//이메일은 정보 제공이... 안되고 있음... 정보제공 했음에도 불구하고..
					nicname = naverLogin.user.getNickName();
					birth = naverLogin.user.getBirthday();		//08-15 의 형태로 나옴
					name = naverLogin.user.getName();
					pw = naverLogin.user.getNickName();		//table의 id 값으로 들어감
					id = naverLogin.user.getId();

					if( id == undefined || id == null ) {
						alert(" id 정보제공을 동의해주세요");
						/* (5-1) 사용자 정보 재동의를 위하여 다시 네아로 동의페이지로 이동함 */
						naverLogin.reprompt();
						return;
					}
					window.location.href='NaverProgress.php?birth='+birth+'&name='+name+'&id='+id+'&pw='+pw;
				} else {
					console.log("callback 처리에 실패하였습니다.");
				}

			});
		});
	</script>

</body>

</html>
