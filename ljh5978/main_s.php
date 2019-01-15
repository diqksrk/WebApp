<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Team Fried Chicken</title>

		<meta name="author" content="Team Fried Chicken" />
		<meta name="description" content="WebProgramming Team Project" />

		<link href="main_s.css" type="text/css" rel="stylesheet" />

		<script src="./main.js" type="text/javascript"></script>
		<!-- <script src="./prototype.js" type="text/javascript"></script> -->

		<!-- <link href="./img/favicon.png" type="image/png" rel="shortcut icon" /> -->
	</head>

	<body>
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
			<section>
<?php
	$host="localhost";//host name
	$username="root";//mysql username
	$password="realstart";//mysql password
	$db_name="teamfried";//db name
	$table_name="board";//table name
	$value = "id, title, date, imagePath";//value from table
  $db = new PDO("mysql:dbname=teample", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $results = $db->query("SELECT $value FROM $table_name LIMIT 12");
// test start
	$page = (isset($_GET['page']))? $_GET['page'] : 1;

	$size = 12;//number of list on a page
	$listcounts = $db->query("SELECT count(*) FROM $table_name");
	// $row = fetch_array($listcounts);
	// $total = $row[0];
	foreach ($listcounts as $listcount) {
	}
	$start = ($page - 1) * $size;
	$results = $db->query("SELECT $value FROM $table_name LIMIT $start, $size");
// test end

	if(is_array($results) || is_object($results)){
		foreach($results as $result){
?>
		      <div>
		        <a href="board.php?page=<?=$result["id"]?>">
	          <h1><?=$result["title"]?></h1>
	          <h2>날짜: <?=$result["date"]?></h2>
	          <img src="<?=$result["imagePath"]?>" alt="">
		        </a>
		      </div>
<?php

		}
	}
?>
  		</section>
		</article>


		<ul id="page_num">
<?php
	$total_pages = ceil($listcount[0]/$size);
	$page_size = 10;
	$block = ceil($page/$page_size);
	$max_block = ceil($total_pages/$page_size);
	$start_page = ($block*$page_size)-9;
	$end_page = $block * $page_size;
	if($end_page > $total_pages){
		$end_page = $total_pages;
	}
	if($block != 1){
?>
			<li><a href="http://localhost/webEX/team/main.php?page=1">[처음]</a></li>
			<li><a href="http://localhost/webEX/team/main.php?page=<?=$start_page-1?>">[이전]</a></li>
<?php
		}
	for($i = $start_page; $i <= $end_page; $i++){
?>
			<li class="pages" id="page<?=$i?>"><a href="http://localhost/webEX/team/main.php?page=<?=$i?>">[<?=$i?>]</a></li>
<?php
	}
	if($block != $max_block){
?>
 			<li><a href="http://localhost/webEX/team/main.php?page=<?=$end_page+1?>">[다음]</a></li>
 			<li><a href="http://localhost/webEX/team/main.php?page=<?=$total_pages?>">[마지막]</a></li>
<?php
	}
?>

		</ul>
	</div>



	</body>
</html>
