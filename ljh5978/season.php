<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Team Fried Chicken</title>

		<meta name="author" content="Team Fried Chicken" />
		<meta name="description" content="WebProgramming Team Project" />
		<!-- <meta name="keywords" content="" /> -->

		<link rel="stylesheet" type="text/css" href="main.css" />
		<!-- <link href="./img/favicon.png" type="image/png" rel="shortcut icon" /> -->
	</head>

	<body>
	<div id="page">
		<header>
			<h1>TEAM FRIED CHICKEN</h1>
		</header>

		<nav>
			<div class="login">
				<?php
				if(isset($_GET['id'])){
					echo $_GET['id']."님 환영합니다.";
				}else{?>
					<a href="" id="login">Log In</a>
				<?php
			}
				?>
			</div>
			<ul>
				<li><a href="http://localhost/newteample/all.php">전체 보기</a></li>
        <li><a href="">지역</a></li>
				<li><a href="http://localhost/newteample/season.php">계절</a></li>
				<li><a href="http://localhost/newteample/thismonth.php">이달의 축제</a></li>
        <li><a href="http://localhost/newteample/wanting.php">나의 관심 축제</a></li>
			</ul>
		</nav>
    <!-- season button -->
    <div>
      <div>
        <form class="seasonbutton" action="http://localhost/newteample/season.php" method="post">
					<input id="spr" type="submit" name="season" value="spring" align="absmiddle">
					<input id="sum" type="submit" name="season" value="summer" align="absmiddle">
					<input id="aut" type="submit" name="season" value="autumn" align="absmiddle">
					<input id="win" type="submit" name="season" value="winter" align="absmiddle">
          <!--
					<input type="image" src="spring.png" name="season" value="spring"  align="absmiddle">
          <input type="image" src="summer.png" name="season" value="summer"  align="absmiddle">
          <input type="image" src="autumn.png" name="season" value="autumn"  align="absmiddle">
          <input type="image" src="winter.png" name="season" value="winter"  align="absmiddle">-->
        </form>
      </div>
<!-- seasonbutton end-->

		<article>
			<section>
<?php
	$host="localhost";//host name
	$username="root";//mysql username
	$password="realstart";//mysql password
	$db_name="teamfried";//db name
	$table_name="board";//table name
	$value = "title, date, imagePath";//value from table
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
////////////////////////////////////////////////////////////////////*****************************
  if(!empty($_POST["season"])){
    $season = $_POST["season"];
    $nowseason = "";
    //echo "계절 버튼 눌림 O / ". $season;
    switch($season){
      case "spring" :
        $nowseason = "SELECT * FROM board b join board_detail bd on b.id = bd.id WHERE date
        REGEXP '3월|4월|5월|2017.03|2017. 3|2017.3|2017.04|2017. 4|2017.4|2017.05|2017. 5|2017.5' LIMIT $start";
        break;
      case "summer":
        $nowseason = "SELECT * FROM board b join board_detail bd on b.id = bd.id WHERE date
        REGEXP '6월|7월|8월|2017.06|2017. 6|2017.6|2017.07|2017. 7|2017.7|2017.08|2017. 8|2017.8' LIMIT $start";
        break;
      case "autumn":
        $nowseason = "SELECT * FROM board b join board_detail bd on b.id = bd.id WHERE date
        REGEXP '9월|10월|11월|2017.09|2017. 9|2017.9|2017.10|2017. 10|2017.11|2017. 11' LIMIT $start";
        break;
      case "winter":
        $nowseason = "SELECT * FROM board b join board_detail bd on b.id = bd.id WHERE date
        REGEXP '12월|1월|2월|2017.12|2017. 12|2017.01|2017. 1|2017.1|2017.02|2017. 2|2017.2' LIMIT $start";
        break;
    }
  }else{
        $nowseason = "SELECT * FROM board b join board_detail bd on b.id = bd.id WHERE date
        REGEXP '3월|4월|5월|2017.03|2017. 3|2017.3|2017.04|2017. 4|2017.4|2017.05|2017. 5|2017.5' LIMIT $start";
    }

	$results = $db->query("$nowseason, $size");
// test end//////////////////////////////////////////////////////////****************************

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
			<li><a href="http://localhost/newteample/season.php?page=1">[처음]</a></li>
			<li><a href="http://localhost/newteample/season.php?page=<?=$start_page-1?>">[이전]</a></li>
<?php
		}

	for($i = $start_page; $i <= $end_page; $i++){

?>
			<li><a href="http://localhost/newteample/season.php?page=<?=$i?>">[<?=$i?>]</a></li>
<?php
	}
	if($block != $max_block){
?>
 			<li><a href="http://localhost/newteample/season.php?page=<?=$end_page+1?>">[다음]</a></li>
 			<li><a href="http://localhost/newteample/season.php?page=<?=$total_pages?>">[마지막]</a></li>
<?php
	}

?>

		</ul>
	</div>



	</body>
</html>
