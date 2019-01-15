<?php
if(!isset($_POST["id"]) || empty($_POST["id"])){
	echo "<script>alert('아이디를 입력하세요.');history.back();</script>";
	exit;
}
if(!isset($_POST["pass"]) || empty($_POST["pass"])){
	echo "<script>alert('비밀번호를 입력하세요.');history.back();</script>";
	exit;
}
try{
	$db = new PDO("mysql:dbname=friedchicken", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$user_id = preg_replace('/[\r\n\s\t\’\'\;\”\=\-\-\#\/*]+/','', $_POST["id"]);

	$result = $db->query("SELECT 1 FROM member WHERE id='".$user_id."'")->fetch();

	if(count($result) == 1){
		echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
		exit;
	}

	$result = $db->query("SELECT num FROM log WHERE id ='".$user_id."'")->fetch();
	if($result[0] >= 5){
		$db->exec("UPDATE log SET lDate=NOW() where id='".$user_id."'");
		echo "<script>alert('비밀번호 입력횟수를 초과하였습니다.\\n관리자에게 문의하세요.');history.back();</script>";
		exit;
	}

	$result = $db->query("SELECT pass FROM member WHERE id ='".$user_id."'")->fetch();
	if (password_verify($_POST["pass"], $result[0])) {
		$db->exec("UPDATE log SET num=0,lDate=NOW() where id='".$user_id."'");
		echo "<script>alert('Password OK!');history.back();</script>";
	} else {
		$db->exec("UPDATE log SET num=num+1,lDate=NOW() where id='".$user_id."'");
		echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
	}

}catch(PDOException $e){
	echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
}
?>