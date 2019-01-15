<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Team Fried Chicken</title>
		
		<meta name="author" content="Team Fried Chicken" />
		<meta name="description" content="WebProgramming Team Project" />
		<!-- <meta name="keywords" content="" /> -->
		
		<link rel="stylesheet" type="text/css" href="board.css" />
		<!-- <link href="./img/favicon.png" type="image/png" rel="shortcut icon" /> -->
	</head>

	<body>
		<?php
			if(isset($_POST["review"]) && !empty($_POST["review"])){

////////////////////////////
				$review = $_POST["review"];
				$insertDB->exec("INSERT INTO reviews VALUES ('$name', '$review')");//comment
////////////////////////////
			}
		?>
	<div id="page">
		<header>
			<h1><a href="main.php">TEAM FRIED CHICKEN</a></h1>
		</header>
		
		<nav>
			<ul>
				<li><a href="region.php">지역별</a></li>
				<li><a href="season.php">계절별</a></li>
				<li><a href="thismonth.php">이달의 축제</a></li>
			</ul>
		</nav>


		<article>
			<section id="detail">
<?php
				$host="localhost";//host name
				$username="root";//mysql username
				$password="realstart";//mysql password
				$db_name="teamfried";//db name
				$table_name="board_detail";//table name
				$db = new PDO("mysql:dbname=$db_name;host=$host", "$username", "$password");
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$page = (isset($_GET['page']))? $_GET['page'] : 0;
				$details = $db->query("SELECT contents FROM board_detail WHERE id = $page");
				$results = $db->query("SELECT title, imagePath FROM board WHERE id = $page");

				foreach ($results as $result) {
?>
					<h1><?=$result["title"]?></h1>
					<img src="<?=$result["imagePath"]?>" alt="">	
<?php
				}
				foreach($details as $detail){
?>
					<p><?=$detail["contents"]?></p>
<?php
				}
?>				
			</section>


			<?php
				try{
					$db = new PDO("mysql:dbname=comments;host=$host", "$username", "$password");
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$names = $db->query("SELECT name, review FROM reviews");
					if(is_array($names) || is_object($names)){
						foreach($names as $name){
			?>
			<section class="comment">
				<p class="name_comment"><?=$name["name"]?></p>
				<p class="review_comment"><?=$name["review"]?></p>
			</section>
			<?php
						}
					}
				}catch(PDOException $ex){
			?>
			
			<?php
				}

				
			?>
			<section>
				<form action="board.php" method="post">
					<input id="textbox_review" type="text" name="review" value="댓글을 입력하세요." onfocus="this.value=''" >
					<input id="submit_review" type="submit" value="등록">
				</form>
			</section>
		</article>
	</body>
</html>