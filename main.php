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

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158697158-1"></script>
	<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-158697158-1');</script>

	<!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!--Bootstrap JS-->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="//cdn.rawgit.com/hiun/NanumSquare/master/nanumsquare.css">
	<style>
		p { font-size: 1.2em; }
		.nanum-square { font-family: 'Nanum Square'; }
		.bold { font-weight: bold; }
	</style>
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
		</div>
	</nav>
	<div class="alert alert-primary" role="alert">
		<strong>사이트 문의는 <a href="https://open.kakao.com/o/siVsGWXb">이곳</a>을 클릭 해주세요!</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<br>
	<div class="container">
		<div style="text-align:center;">
			<?php

			include './utils/DataManager.php';

			$server_count = 0;

			/** SERVER LIST DATA */
			$server_list = new utils\DataManager('/root/web/datas/list.json', utils\DataManager::JSON);
			$db['server_list'] = $server_list->getAll();

			/** SERVER DATA */
			$server_data = new utils\DataManager('/root/web/datas/server_new.json', utils\DataManager::JSON);
			$db['server_data'] = $server_data->getAll();

			$s = 0;
			$m = 0;

			echo '<p><small>#인생서버 #경제서버 #RPG서버 #야생서버 #마인팜서버 #미니게임서버 #PVP서버</small></p>';

			echo '<br>';

			echo '<p class="nanum-square bold">' . $db['server_data']['date'] . ' 기준으로</p>';

			//echo '<p class="nanum-square bold">한국 서버 ' . count($db['server_list']) . '개가 등록 되어 있습니다</p>';
			
			foreach($db['server_data']['count-ranking'] as $key => $value){

				if (explode(':', $key)[0] == $value['ip']){
					$m++;
				}

				if ($value['status'] == 'on'){
					$server_count++;
					
					if ($key == "crush24.kro.kr:19133"){
						$s = $value['player-num'];
					}

				}
			}
			?>
			<table class="table table-bordered">
			<thead>
				<tr>
				<th scope="col" style="width:10em">#</th>
				<th scope="col" style="width:10em">#</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<th scope="row">등록된 서버</th>
				<td><?=count($db['server_list']) . '개'?></td>
				</tr>
				<tr>
				<th scope="row">온라인 서버</th>
				<td><?=$server_count . '개'?></td>
				</tr>
				<tr>
				<th scope="row">오프라인 서버</th>
				<td><?=(count($db['server_list']) - $server_count - $m) . '개'?></td>
				</tr>
				<tr>
				<th scope="row">종료된 서버</th>
				<td><?=$m . '개'?></td>
				</tr>
			</tbody>
			</table>
			<?php
			//echo '<p class="nanum-square bold">온라인 서버 ' . $server_count . '개, 오프라인 서버 ' . (count($db['server_list']) - $server_count - $m) . '개, 종료된 서버 ' . $m . '개</p>';

			echo '<p class="nanum-square bold">서버 전체 동접수 ' . ($db['server_data']['allcount'] - $s) . '명</p>';

			echo '<br>';

			echo '<p class="nanum-square bold">서버 목록 클릭시 서버 정보를 확인 할 수 있습니다</p>';

			?>
			<br>
			<button type="button" class="btn btn-outline-primary" onclick="location.href='/good_ranking'">추천 순위</button>
			&nbsp;&nbsp;&nbsp;
			<button type="button" class="btn btn-outline-primary" onclick="location.href='/count_ranking'">동접 순위</button>
			&nbsp;&nbsp;&nbsp;
			<button type="button" class="btn btn-outline-primary" onclick="location.href='/plugin'">플러그인</button>
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
