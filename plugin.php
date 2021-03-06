<!DOCTYPE html>
<html>
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

			/** PLUGIN DATA */
			$server_plugin = new utils\DataManager('/root/web/datas/plugin.json', utils\DataManager::JSON);
			$db['server_plugin'] = $server_plugin->getAll();

			/** SERVER DATA */
			$server_data = new utils\DataManager('/root/web/datas/server_new.json', utils\DataManager::JSON);
			$db['server_data'] = $server_data->getAll();

			$server_count = 0;

			foreach($db['server_data']['count-ranking'] as $key => $value){
				if ($value['status'] == 'on'){
					$server_count++;
				}
			}

			echo '<br>';

			echo '* 온라인 서버 ' . $server_count . '개 중에서 ' . $db['server_plugin']['count'] . '개의 서버가 수집 되었습니다..';

			echo '<br>';
			echo '<br>';

			?>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">플러그인 이름</th>
						<th scope="col">플러그인 버전</th>
						<th scope="col">-</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach ($db['server_plugin']['plugins'] as $key => $value){
					echo '<tr>';

					echo '<td>' . $key . '</td>';

					echo '<td>';
					foreach ($value as $a => $b){
						echo $a . "<br>";
					}
					echo '</td>';

					echo '<td>';
					foreach ($value as $a => $b){
						echo $b . "<br>";
					}
					echo '</td>';

					echo '</tr>';
				}
				?>
				</tbody>
			</table>
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
