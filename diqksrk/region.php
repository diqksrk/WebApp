<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Team Fried Chicken</title>
		
		<meta name="author" content="Team Fried Chicken" />
		<meta name="description" content="WebProgramming Team Project" />
		<!-- <meta name="keywords" content="" /> -->
		
		<link rel="stylesheet" type="text/css" href="region.css" />
		<!-- <link href="./img/favicon.png" type="image/png" rel="shortcut icon" /> -->
		<link rel="stylesheet" href="DB_etc9.css" type="text/css"></link>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script><!--jquery¶óÀÌºê·¯¸®-->
		<script type="text/javascript" src="jquery.DB_map.min.js"></script>
	</head>

	<body>
	<div id="page">

		<header>
			<h1>TEAM FRIED CHICKEN</h1>
		</header>
		<div class="login">
	            <?php
	            if(isset($_GET['pasu'])){
	               echo $_GET['pasu']."님 환영합니다.";
	            }else{?>
	               <a href="./로그인/login.html" id="login">Log In</a>
	            <?php
	         	}
	            ?>
	    </div>
		<nav>
			<ul>
				<li><a href="localhost/지도 4/main.php">지역</a></li>
				<li><a href="">계절</a></li>
				<li><a href="">진행중</a></li>
			</ul>
		</nav>
<!-- 
		<nav id="section_navi">
			<a href=""><img src="images/arrow_left.png" alt="arrow_left"></a>
			<h1>지역별</h1>
			<a href=""><img src="images/arrow_right.png" alt="arrow_right"></a>
		</nav>
 -->
		<div id="boxcontainer">
			<article>
				<section>
				<?php
				if (isset($_GET["pasu"])){
					if ($_GET["pasu"]=="Tester"){

					}
				}
				$host="localhost";//host name
				$username="root";//mysql username
				$password="root";//mysql password
				$db_name="fried__chicken";//db name
				$table_name="board";//table name
				$value = "board.id,title, date, imagePath";//value from table
				$db = new PDO("mysql:dbname=$db_name;host=$host", "$username", "$password");
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// $results = $db->query("SELECT $value FROM $table_name LIMIT 12");
			// test start
				$page = (isset($_GET['page'])) ? $_GET['page'] : "gangwon";
				$number = (isset($_GET['number']))? $_GET['number'] : "1";
				$size = 12;
				$start = ($number - 1) * $size;
				$pg=$start;

				if ($page=="gangwon"){
					$kregion="강원";
				}else if ($page=="gyeonggi") {
					$kregion="경기";
				}else if ($page=="seoul"){
					$kregion="서울";
				}else if ($page=="gyeongsangnam"){
					$kregion="경상남도";
				}else if ($page=="gyeongsangbuk"){
					$kregion="경상북도";
				}else if ($page=="gwangju"){
					$kregion="광주";
				}else if ($page=="daegu"){
					$kregion="대구";
				}else if ($page=="daejeon"){
					$kregion="대전";
				}else if ($page=="busan"){
					$kregion="부산";
				}else if ($page=="sejong"){
					$kregion="세종";
				}else if ($page=="ulsan"){
					$kregion="울산";
				}else if ($page=="incheon"){
					$kregion="인천";
				}else if ($page=="jeollanam"){
					$kregion="전라남도";
				}else if ($page=="jeollabuk"){
					$kregion="전라북도";
				}else if ($page=="jeju"){
					$kregion="제주";
				}else if ($page=="chungchengnam"){
					$kregion="충청남도";
				}else if ($page=="chungchengbuk"){
					$kregion="충청북도";
				}
				$listcounts = $db->query("SELECT count(*) from board join board_detail on board.id=board_detail.id where contents like '%개최지역 : $kregion%'");
					// $row = fetch_array($listcounts);
					// $total = $row[0];
				foreach ($listcounts as $listcount) {
				}
				$results = $db->query("SELECT $value from board join board_detail on board.id=board_detail.id where contents like '%개최지역 : $kregion%' limit $start, $size");
				if(is_array($results) || is_object($results)){
					foreach($results as $result){?>
		      			<div>
			        		<a href="board.php?page=<?=$result["id"]?>">
		          			<h1><?=$result["title"]?></h1>
		          			<h2>날짜: <?=$result["date"]?></h2>
		          			<img src="<?=$result["imagePath"]?>" alt="">
			        		</a>
		      			</div>
					<?php
						$pg++;
					}
				}?>	
				</section>
			</article>
		</div>
		<div id="DB_etc9">
			<div id="DB_mapBg"><img src="img/map_trans.gif" width="100%" height="100%" alt="" border="0" usemap="#DB_mapArea"/>
			  <map name="DB_mapArea" id="DB_mapArea">
		        <area class="gangwon-do" shape="poly" coords="47,8,55,11,67,10,77,8,83,4,91,16,104,33,114,47,114,55,97,58,85,58,75,53,64,57,67,43,58,36,58,23" href="main.php?page=gangwon" onfocus="this.blur()"/>
				<area class="gyeonggi-do" shape="poly" coords="25,37,27,27,35,20,33,16,48,10,56,22,58,36,65,44,62,57,54,66,33,65,24,54,31,51,31,40,40,45,46,41,44,33,36,32" href="main.php?page=gyeonggi" onfocus="this.blur()"/>
				<area class="gyeongsangnam-do" shape="poly" coords="68,110,60,117,60,127,63,140,67,159,80,152,95,158,99,149,89,146,92,138,102,135,111,128,102,117,80,117" href="main.php?page=gyeongsangnam" onfocus="this.blur()"/>
		        <area class="gyeongsangbuk-do" shape="poly" coords="90,60,86,66,75,69,68,78,69,89,74,95,68,104,72,111,80,116,86,102,95,101,98,108,93,116,99,119,109,115,120,116,127,98,116,98,115,94,121,83,116,56,129,44,139,48,137,34,128,39,125,45,109,58" href="main.php?page=gyeongsangbuk" onfocus="this.blur()"/>
				<area class="gwangju-si" shape="poly" coords="31,134,26,141,37,144,40,141,40,131" href="main.php?page=gwangju" onfocus="this.blur()"/>
		        <area class="daegu-si" shape="poly" coords="82,114,85,103,94,101,99,111,93,117" href="main.php?page=daegu" onfocus="this.blur()"/>
				<area class="daejeon-si" shape="poly" coords="46,89,52,97,57,97,60,91,56,85,50,85" href="main.php?page=daejeon" onfocus="this.blur()"/>
				<area class="busan-si" shape="poly" coords="111,128,95,137,90,147,98,148,113,140,116,132" href="main.php?page=busan" onfocus="this.blur()"/>
				<area class="seoul-si" shape="poly" coords="31,36,39,32,45,37,43,45,37,44,30,42" href="main.php?page=seoul" onfocus="this.blur()"/>
				<area class="sejong-si" shape="poly" coords="48,72,41,78,44,87,54,85,54,74" href="main.php?page=sejong" onfocus="this.blur()"/>
		        <area class="ulsan-si" shape="poly" coords="104,120,112,116,122,117,118,131" href="main.php?page=ulsan" onfocus="this.blur()"/>   
				<area class="incheon-si" shape="poly" coords="18,28,11,34,17,44,6,52,7,57,17,60,25,52,29,45,28,38,23,30" href="main.php?page=incheon" onfocus="this.blur()"/>
				<area class="jeollanam-do" shape="poly" coords="20,128,13,140,7,139,4,152,7,168,3,177,13,180,20,173,42,176,45,168,56,170,58,164,65,162,65,150,60,132,36,129,25,136" href="main.php?page=jeollanam" onfocus="this.blur()"/>
				<area class="jeollabuk-do" shape="poly" coords="25,101,25,116,20,128,25,133,36,128,47,133,60,132,59,120,71,106,65,100,58,96,47,101,42,100,33,104" href="main.php?page=jeollabuk" onfocus="this.blur()"/>  
				<area class="jeju-do" shape="poly" coords="26,182,12,188,12,197,30,196,39,189,34,181" href="main.php?page=jeju"  onfocus="this.blur()"/>
				<area class="chungchengnam-do" shape="poly" coords="29,63,22,62,11,69,15,80,23,93,25,100,34,102,42,97,46,101,57,102,56,95,47,94,44,85,43,74,50,72,54,68" href="main.php?page=chungchengnam" onfocus="this.blur()"/>
			    <area class="chungchengbuk-do" shape="poly" coords="62,56,51,69,54,83,61,94,64,103,75,98,69,84,72,71,86,65,88,60,78,54" href="main.php?page=chungchengbuk" onfocus="this.blur()"/>
			  </map>	
		    </div>	
		</div>
		<div id="region">
			<a href="main.php?page=gangwon">강원도</a>
			<a href="main.php?page=gyeonggi">경기도</a>
			<a href="main.php?page=seoul">서울특별시</a>
			<a href="main.php?page=incheon">인천광역시</a>
			<a href="main.php?page=gyeongsangbuk">경상북도</a>
			<a href="main.php?page=chungchengbuk">충청북도</a>
			<a href="main.php?page=sejong">세종시</a>
			<a href="main.php?page=chungchengnam">충청남도</a>
			<a href="main.php?page=daegu">대구광역시</a>
			<a href="main.php?page=daejeon">대전광역시</a>
			<a href="main.php?page=ulsan">울산광역시</a>
			<a href="main.php?page=gyeongsangnam">경상남도</a>
			<a href="main.php?page=daejeon">대전광역시</a>
			<a href="main.php?page=jeollabuk">전라북도</a>
			<a href="main.php?page=jeollanam">전라남도</a>
			<a href="main.php?page=gwangju">광주광역시</a>
			<a href="main.php?page=jeju">제주시</a>
			<a href=href="main.php?page=busan">부산광역시</a>
		</div>
			<ul id="page_num">
			<?php
				$total_pages = ceil($listcount[0]/$size);

				$page_size = 10;
				$block = ceil($number/$page_size);
				$max_block = ceil($total_pages/$page_size);

				$start_page = ($block*$page_size)-9;
				$end_page = $block * $page_size;
				if($end_page > $total_pages){
					$end_page = $total_pages;
				}
				if($block != 1){
			?>
						<li><a href="http://localhost/region.php?page=<?= $page ?>&number=1">[처음]</a></li>
						<li><a href="http://localhost/지도 4/main.php?page=<?= $page ?>&number=<?= $start_page-1 ?>">[이전]</a></li>
			<?php
					}
				for($i = $start_page; $i <= $end_page; $i++){
			?>
						<li><a href="http://localhost/region.php?page=<?= $page ?>&number=<?=$i?>">[<?=$i?>]</a></li>
			<?php
				}
				if($block != $max_block){
			?>
			 			<li><a href="http://localhost/region.php?page=<?= $page ?>&number=<?=$end_page+1?>">[다음]</a></li>
			 			<li><a href="http://localhost/region.php?$page=<?= $page ?>&number=<?=$total_pages?>">[마지막]</a></li>
			<?php
				}
			?>	
		</ul>

	</div>

	</body>
</html>