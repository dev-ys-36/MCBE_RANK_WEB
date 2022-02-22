<!DOCTYPE html>
<html>
	<head>
		<title>마인크래프트 BE 한국 서버 목록</title>

	    <meta charset="utf-8">
	    <meta name="description" content="마인크래프트 BE 한국 서버 목록, 마인크래프트 PE 한국 서버 목록, 마인크래프트 BE 24시간 한국 서버 목록, 마인크래프트 PE 24시간 한국 서버 목록">

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
	</head>
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
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
		<div class="container">
			<a class="navbar-brand" href="/">
                <img src="mcbe_logo" style="width: 170px; height:auto;">
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
	<body class="is-preload">
		<br/>
        <p>&nbsp;&nbsp;&nbsp;<small class="text-muted">배너를 클릭하면 해당 광고 사이트로 이동합니다..</small></p>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500">
            <div class="carousel-inner">
				<div class="carousel-item active">
                    <a href="https://mcbe.kr/server?ip=taon24.kro.kr&port=19132"><img class="d-block w-100" src="taon_sv"></a>
                </div>
				<div class="carousel-item">
                    <a href="https://mcbe.kr/server?ip=flat.kro.kr&port=19132"><img class="d-block w-100" src="flat_sv"></a>
                </div>
                <!--<div class="carousel-item">
                    <a href="https://pf.kakao.com/_hxcyxnT"><img class="d-block w-100" src="rp_cloud"></a>
                </div>
                <div class="carousel-item">
                    <a href="https://cafe.naver.com/mcbecafe"><img class="d-block w-100" src="kk_cafe"></a>
                </div>-->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
		<!-- Header -->
		<?php
			/*$object = json_decode(file_get_contents("datas/server.json"));
			$data = json_decode(json_encode($object), true);
			echo "<br/>";
			echo "<div class='d-block font-weight-bold'>" . "※ 갱신된 시간 : " . $data['date'] . "</div>";
			echo "<div class='d-block font-weight-bold'>" . "※ 동시 접속자 기준으로 순위가 나열되어 있습니다.." . "</div>";
			echo "<div class='d-block font-weight-bold'>" . "※ 목록에 있는 서버 클릭시 서버 정보가 표시 됩니다.." . "</div>";
			echo "<br/>";*/
		?>
		<br/>
			<p id="online">
				<h2>온라인
				<?php
					/*$object = json_decode(file_get_contents("datas/server.json"));
					$data = json_decode(json_encode($object), true);
					echo " / " . $data['allcount'] . "명";*/
				?>
				</h2>
				<div align ="right">
					<a href="/add">
                	<button type="button" class="btn btn-primary">서버 추가</button>
                	</a>
				</div>
			</p>
			<table class="table table-sm table-hover">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:2em">#</th>
						<th scope="col">서버 목록</th>
						<!--<th scope="col" class="text-left" style="width:6em"><div class='center'>추천수</div></th>-->
						<th scope="col" class="text-left" style="width:3em"><div class='center'>동접</div></th>
					</tr>
				</thead>
				<?php

				include './utils/DataManager.php';

				$object = json_decode(file_get_contents("datas/server.json"));
				$data = json_decode(json_encode($object), true);

				$server_list = new utils\DataManager('/root/web/datas/good.json', utils\DataManager::JSON);
		        $db['good'] = $server_list->getAll();

				echo "<tbody>";
				foreach ($data['online-server'] as $servers => $type){
					$a = explode("_*_", $type);
					echo '<tr data-href="/server?ip=' . $a[1] . '&port=' . $a[2] . '">';
					echo '<td><div class="d-block font-weight-bold">' . $a[0] . '</div></td>'; // 순위 정보
					//echo "<td><div class='test'><div class='d-block font-weight-bold'>" . $a[3] . "</div><div class='d-block small'><div class='d-block font-weight-bold'>" . $a[1] . ' : ' . $a[2] . '</div>' . $a[7] . "</div></div></td>";
					echo "<td><div class='d-block font-weight-bold'>" . $a[3] . "</div></td>";
					if (isset($db['good'][$a[1] . ':' . $a[2]])){
						//echo "<td><div class='d-block font-weight-bold'>" . count($db['good'][$a[1] . ':' . $a[2]]) . "</div></td>"; // 추천수
					}else{
						//echo "<td><div class='d-block font-weight-bold'>" . "0" . "</div></td>"; // 추천수
					}
					echo "<td><div class='d-block font-weight-bold'>" . $a[4] . "</div><div class='d-block small'><br/>" . $a[5] . "</div></td>"; // 동접 , 일일 최고 동접
					echo '</a>';
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "<br/>";
				?>
			</table>
			<p id="offline">
				<h2>오프라인</h2>
				<br/>
			</p>
			<table id="offline_table" class="table table-sm table-hover">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:2em">#</th>
						<th scope="col">서버 목록</th>
						<!--<th scope="col" class="text-left" style="width:3em">동접</th>-->
					</tr>
				</thead>
				<?php
				$object = json_decode(file_get_contents("datas/server.json"));
				$data = json_decode(json_encode($object), true);
				echo "<tbody>";
				if (isset($data['offline-server'])){
					foreach ($data['offline-server'] as $servers => $type){
						$a = explode("__", $type);
						echo "<tr>";
						echo "<td><div class='d-block font-weight-bold'>" . $a[0] . "</div></td>";
						echo "<td><div class='test'><div class='d-block small'>" . $a[1] . ' : ' . $a[2] . "</div></div></td>";
						//echo "<td><div class='d-block font-weight-bold'>0</div></td>";
						echo "</tr>";
					}
				}
				echo "</tbody>";
				echo "</table>";
				echo "<br/>";
				?>
			</table>
		</div>
	</body>
	<br/>
	<br/>
	<br/>
	<!-- footer -->
	<div class="jumbotron text-center mt-5 mb-0">
		<h3 class="text-secondary">Kim Developer - MCBE</h3>
		<p>Coyright(C) 2020 <span class="text-primary">Kim_Developer</span>. All rights reserved.</p>
	</div>
</html>
