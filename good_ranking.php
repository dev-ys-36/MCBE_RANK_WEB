<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>마인크래프트 BE 한국 서버 목록</title>
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="description" content="마인크래프트 BE 한국 서버 목록">
		
	<meta property="og:type" content="website"> 
	<meta property="og:title" content="마인크래프트 BE 한국 서버 목록">
	<meta property="og:description" content="마인크래프트 BE 서버 목록">
	<meta property="og:url" content="https://mcbe.kr">

	<!-- Mobile browser viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<!-- Google AdSense -->
	<script data-ad-client="ca-pub-4109567926919554" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158697158-1"></script>
	<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-158697158-1');</script>

	<!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!--Bootstrap JS-->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script>
	jQuery(document).ready(function ($) {
		$('[data-href]').click(function () {
			window.location = $(this).data("href");
		});
	});
	</script>
	<style>
	table th, td {
		text-align: center;
	}
	.test {
		text-align: left;
	}
	.center {
		text-align: center;
	}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
		<div class="container">
			<a class="navbar-brand" href="/">
				<img src="mcbe_logo" alt="mcbe_logo" style="width: 170px; height:auto;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="/search">쿼리 검색하기</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/add">서버 추가하기</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="alert alert-primary" role="alert">
		<strong>사이트 문의는 <a href="https://open.kakao.com/o/siVsGWXb">이곳</a>을 클릭 해주세요!</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="container">
		<!--<br/>
		<p>&nbsp;&nbsp;&nbsp;<small class="text-muted">배너를 클릭하면 해당 광고 사이트로 이동합니다..</small></p>
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<a href="https://mcbe.kr/server?ip=taon24.kro.kr&port=19132">
						<img class="d-block w-100" src="taon_sv" alt="taon_sv">
					</a>
				</div>
				<div class="carousel-item">
					<a href="https://mcbe.kr/server?ip=flat.kro.kr&port=19132">
						<img class="d-block w-100" src="flat_sv" alt="flat_sv">
					</a>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>-->
		<br>
		<br>
		<br>
		<h2>추천 순위 / <?=$argv[1]?> 페이지</h2>
		<div style="text-align:right;">
			<button type="button" class="btn btn-outline-primary" onclick="location.href='/add'">서버 추가 하기</button>
        </div>
        <br>
		<table class="table table-sm table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col" style="width:3em">#</th>
					<th scope="col">서버 목록</th>
					<th scope="col" class="text-left" style="width:3em"><div class='center'>추천</div></th>
				</tr>
			</thead>
			<?php

			include './utils/DataManager.php';

			$server_data = new utils\DataManager('/root/web/datas/server_new.json', utils\DataManager::JSON);
			$db['server_data'] = $server_data->getAll();

			$server_good = new utils\DataManager('/root/web/datas/good.json', utils\DataManager::JSON);
			$db['good'] = $server_good->getAll();

			$server_count = 0;
			$count = 0;
			$index = $argv[1];

			echo '<tbody>';

			foreach ($db['server_data']['good-ranking'] as $key => $value){

				$ip = explode(':', $key)[0];
				$port = explode(':', $key)[1];

				$server_count++;

				if(++$count >= ($index * 5 - 4) and $count <= ($index * 5)){

					//if ($value['status'] == 'on'){
					echo '<tr data-href="/server?ip=' . $ip . '&port=' . $port . '">';
					if ($value['good-num'] == '0'){
						echo '<td><div class="d-block font-weight-bold">' . '-' . '</div></td>'; // 순위 정보
					}else{
						echo '<td><div class="d-block font-weight-bold">' . $value['good-rank'] . '</div></td>'; // 순위 정보
					}
					//echo "<td><div class='test'><div class='d-block font-weight-bold'>" . $a[3] . "</div><div class='d-block small'><div class='d-block font-weight-bold'>" . $a[1] . ' : ' . $a[2] . '</div>' . $a[7] . "</div></div></td>";
					echo "<td><div class='d-block font-weight-bold'><p>" . $value['motd'] . "</p></div>";
					echo "<img class='d-block w-100' src='img_not' alt='img_not'></td>";
					if (isset($db['good'][$key])){
						echo "<td><div class='d-block font-weight-bold'>" . count($db['good'][$key]['players']) . "</div></td>"; // 추천수
					}else{
						echo "<td><div class='d-block font-weight-bold'>" . "0" . "</div></td>"; // 추천수
					}
					//echo "<td><div class='d-block font-weight-bold'>" . $value['player-num'] . "</div><div class='d-block small'><br/>" . $value['daily-num'] . "</div></td>"; // 동접 , 일일 최고 동접
					echo "</tr>";
					//}

				}

			}

			echo "</tbody>";

			?>
		</table>
		<br>
		<br>
		<br>
		<div style="text-align:center;">
		<?php
			$maxpage = ceil($server_count/5);
			$page = $argv[1];

			echo '<nav aria-label="Page navigation example">';
			echo '<ul class="pagination pagination-sm justify-content-center">';

			if ($page - 1 == 0){
				echo '<li class="page-item disabled"><a class="page-link" href="https://mcbe.kr/good_ranking?page=' . ($page - 1) . '">이전 페이지</a></li>';
			}else{
				echo '<li class="page-item"><a class="page-link" href="https://mcbe.kr/good_ranking?page=' . ($page - 1) . '">이전 페이지</a></li>';
			}

			for ($i=1; $i<=$maxpage; $i++){
				if ($i == $page){
					echo '<li class="page-item active"><a class="page-link" href="https://mcbe.kr/good_ranking?page=' . $i . '">' . $i . '</a></li>';
				}else if (ceil($i/5) == ceil($page/5)){
					echo '<a class="page-link" href="https://mcbe.kr/good_ranking?page=' . $i . '">' . $i . '</a>';
				}
			}

			if ($page == $maxpage){
				echo '<li class="page-item disabled"><a class="page-link" href="https://mcbe.kr/good_ranking?page=' . ($page + 1) . '">다음 페이지</a></li>';
			}else{
				echo '<li class="page-item"><a class="page-link" href="https://mcbe.kr/good_ranking?page=' . ($page + 1) . '">다음 페이지</a></li>';
			}

			echo '</ul>';
			echo '</nav>';
			?>
		</div>
	</div>
	<!-- footer -->
	<div class="jumbotron text-center mt-5 mb-0">
		<h3 class="text-secondary">Kim Developer - MCBE</h3>
		<p>Copyright(C) 2020 <span class="text-primary">Kim_Developer</span>. All rights reserved.</p>
		<p>
			<a href="http://validator.kldp.org/check?uri=referer"
			onclick="this.href=this.href.replace(/referer$/,encodeURIComponent(document.URL))"><img
			src="//validator.kldp.org/w3cimgs/validate/html5-blue.png" alt="Valid HTML 5" height="15" width="80">
			</a>
			<small>웹 표준 검사를 통과 받은 사이트 입니다</small>
		</p>
	</div>
</body>
</html>
