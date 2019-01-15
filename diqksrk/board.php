<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Team Fried Chicken</title>
		
		<meta name="author" content="Team Fried Chicken" />
		<meta name="description" content="WebProgramming Team Project" />
		<!-- <meta name="keywords" content="" /> -->
		<script src="prototype.js" type="text/javascript"></script>
		<script src="gasipan.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="board.css" />
		<!-- <link href="./img/favicon.png" type="image/png" rel="shortcut icon" /> -->
	</head>	

	<body>
	<div id="page">
		<header>
			<h1>
				TEAM FRIED CHICKEN
			</h1>
		</header>
		<nav>
			<ul>
				<li><a href="">지역</a></li>
				<li><a href="">계절</a></li>
				<li><a href="">진행중</a></li>
			</ul>
		</nav>

		<article>
			<section id="detail">
<?php
				$host="localhost";//host name
				$username="root";//mysql username
				$password="root";//mysql password
				$db_name="fried__chicken";//db name
				$table_name="board_detail";//table name
				$db = new PDO("mysql:dbname=$db_name;host=$host", "$username", "$password");
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$page = (isset($_GET['page']))? $_GET['page'] : 0;
				$details = $db->query("SELECT contents FROM board_detail Where id=$page");
				$results = $db->query("SELECT title, imagePath FROM board Where id=$page");

				foreach ($results as $result) {
?>
					<img src="<?=$result["imagePath"]?>" alt="">
					<h1 id="title" value="<?= $page ?>"><?=$result["title"]?></h1>
				
<?php
				}
				foreach($details as $detail){
?>
					<p><?=$detail["contents"]?></p>
<?php
				}
?>				
			</section>
			<section>
				<ul id="commentlist" reversed></ul>
			</section>
			<section>
				<form action="board.php" method="post">
					<input id="review" type="text" name="review" value="댓글을 입력하세요." onfocus="this.value=''" >
					<button id="enter" type="submit" name="boardid" form="nameform" value="submit">등록</button>
				</form>
			</section>
		</article>
		<div id="errors"></div>
	</body>
</html>