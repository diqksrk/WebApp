<?php
if ((!isset($_GET["boardid"]))){
	header("HTTP/1.1 400 Invalid Request");
	die("HTTP/1.1 400 Invalid Request - you passed in a wrong type parameter.");
} else {
	comments();
}
	
function comments(){
	try{
		if (isset($_GET["userid"])){
			$userid = $_GET["userid"];
		}
		$boardid = $_GET["boardid"];
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
			$db->query("INSERT INTO reviews(board_id, user_id,review) VALUES($boardid, '$userid', '$comment')");
		}
		$review = $db->query("SELECT * FROM reviews Where board_id=$boardid ORDER BY id");
		$result=array("reviews"=>array());
		foreach ($review as $rev){
			$reviw=array("userid"=>$rev["user_id"],"boardid"=>$rev["board_id"], "review"=>$rev["review"], "id"=>$rev["id"]);
			array_push($result["reviews"],$reviw);
		}
		header("Content-type: application/json");
		print json_encode($result);
	}catch (PDOException $ex){
		?>
	    <p>Sorry, a database error occurred. Please try again later.</p>
	    <p>(Error details: <?= $ex->getMessage() ?>)</p>
	    <?php
	}
}

?>