<?php
$userid = "Tester";
$boardid = "5316";
$dbname="reviews";
$host="localhost";//host name
$username="root";//mysql username
$password="root";//mysql password
$db_name="fried__chicken";//db name
$db = new PDO("mysql:dbname=$db_name;host=$host", "$username", "$password");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET["delete"])||isset($_GET["curuserid"])){
	$curuserid=$_GET["curuserid"];
	if ($userid==$curuserid){
		$id=$_GET["id"];
		$db->query("DELETE FROM $dbname WHERE id=$id");
	}
}
if (isset($_GET["comment"])){
	$comment=$_GET["comment"];
	$db->query("INSERT INTO $dbname(board_id, user_id,review) VALUES($boardid, '$userid', '$comment')");
}
$review = $db->query("SELECT * FROM reviews Where board_id=$boardid");
$nan=array();
$result=array("reviews"=>array());
foreach ($review as $rev){
	$reviw=array("userid"=>$rev["user_id"],"boardid"=>$rev["board_id"], "review"=>$rev["review"], "id"=>$rev["id"]);
	array_push($nan,$reviw);
}
sort($nan);
// array_push($result["reviews"],$nan);
print_r($nan);
// $boardid = "5316";
// $dbname="reviews";
// $host="localhost";//host name
// $username="root";//mysql username
// $password="root";//mysql password
// $db_name="fried__chicken";//db name
// $db = new PDO("mysql:dbname=$db_name;host=$host", "$username", "$password");
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $db->query("insert into reviews(board_id, user_id,review) values(5316, 'Tester', 'goodbdas')");
?>